<?php
/**
*   Class to handle coupon operations
*
*   @author     Lee Garner <lee@leegarner.com>
*   @copyright  Copyright (c) 2018 Lee Garner <lee@leegarner.com>
*   @package    paypal
*   @version    0.6.0
*   @license    http://opensource.org/licenses/gpl-2.0.php
*               GNU Public License v2 or later
*   @filesource
*
*   Based on https://github.com/joashp/simple-php-coupon-code-generator
*/
namespace Paypal;

/**
*   Class for coupons
*   @package paypal
*/
class Coupon extends Product
{
    public function __construct($prod_id = 0)
    {
        parent::__construct($prod_id);
        $this->prod_type == PP_PROD_COUPON;
        $this->taxable = 0; // coupons are not taxable

        // Add special fields for Coupon products
        // Relies on $LANG_PP for the text prompts
        $this->addSpecialField('recipient_email');
        $this->addSpecialField('sender_name');
    }


    /**
    *   Generate a single coupon code based on options given.
    *   Mask, if used, is "XXXX-XXXX" where "X" indicates a character and any
    *   other character is passed through.
    *
    *   @author     Joash Pereira
    *   @author     Alex Rabinovich
    *   @see        https://github.com/joashp/simple-php-coupon-code-generator
    *   @param array $options
    *   @return string
    */
    public static function generate($options = array())
    {
        global $_PP_CONF;

        $length = PP_getVar($options, 'length', 'int', $_PP_CONF['gc_length']);
        $prefix = PP_getVar($options, 'prefix', 'string', $_PP_CONF['gc_prefix']);
        $suffix = PP_getVar($options, 'suffix', 'string', $_PP_CONF['gc_suffix']);
        $useLetters = PP_getVar($options, 'letters', 'int', $_PP_CONF['gc_letters']);
        $useNumbers = PP_getVar($options, 'numbers', 'int', $_PP_CONF['gc_numbers']);
        $useSymbols = PP_getVar($options, 'symbols', 'int', $_PP_CONF['gc_symbols']);
        $mask = PP_getVar($options, 'mask', 'string', $_PP_CONF['gc_mask']);

        $uppercase = array('Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P',
                            'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L',
                            'Z', 'X', 'C', 'V', 'B', 'N', 'M',
        );
        $lowercase = array('q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p',
                            'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l',
                            'z', 'x', 'c', 'v', 'b', 'n', 'm',
        );
        $numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $symbols = array('`', '~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')',
                        '-', '_', '=', '+', '\\', '|', '/', '[', ']', '{', '}',
                        '"', "'", ';', ':', '<', '>', ',', '.', '?',
        );
        $characters = array();
        $coupon = '';

        switch ($useLetters) {
        case 1:     // uppercase only
            $characters = $uppercase;
            break;
        case 2:     // lowercase only
            $characters = $lowercase;
            break;
        case 3:     // both upper and lower
            $characters = array_merge($characters, $uppercase, $lowercase);
            break;
        case 0:     // no letters
        default:
            break;
        }
        if ($useNumbers) {
            $characters = array_merge($characters, $numbers);
        }
        if ($useSymbols) {
            $characters = array_merge($characters, $symbols);
        }
        $charcount = count($characters);

        // If a mask is specified, use it and substitute 'X' for coupon chars.
        // Otherwise use the specified length.
        if ($mask) {
            $len = strlen($mask);
            for ($i = 0; $i < $len; $i++) {
                if ($mask[$i] === 'X') {
                    $coupon .= $characters[mt_rand(0, $charcount - 1)];
                } else {
                    $coupon .= $mask[$i];
                }
            }
        } else {
            for ($i = 0; $i < $length; $i++) {
                $coupon .= $characters[mt_rand(0, $charcount - 1)];
            }
        }
        return $prefix . $coupon . $suffix;
    }


    /**
    *   Generate a number of coupon codes.
    *
    *   @param  integer $num        Number of coupon codes
    *   @param  array   $options    Options for code creation
    *   @return array       Array of coupon codes
    */
    public static function generate_coupons($num = 1, $options = array())
    {
        $coupons = array();
        for ($i = 0; $i < $num; $i++) {
            $coupons[] = self::generate($options);
        }
        return $coupons;
    }


    /**
    *   Record a coupon purchase
    *
    *   @param  float   $amount     Coupon value
    *   @param  integer $uid        User ID, default = current user
    *   @return mixed       Coupon code, or false on error
    */
    public static function Purchase($amount = 0, $uid = 0, $exp = '')
    {
        global $_TABLES, $_USER;

        if ($amount == 0) return false;
        if ($uid == 0) {
            $uid = $_USER['uid'];
        }
        if ($exp == '') $exp = '9999-12-31';
        $options = array();     // Use all options from global config
        do {
            // Make sure there are no duplicates
            $code = self::generate($options);
            $code = DB_escapeString($code);
        } while (DB_count($_TABLES['paypal.coupons'], 'code', $code));

        $uid = (int)$uid;
        $exp = DB_escapeString($exp);
        $amount = (float)$amount;
        $sql = "INSERT INTO {$_TABLES['paypal.coupons']} SET
                code = '$code',
                buyer = $uid,
                amount = $amount,
                balance = $amount,
                purchased = UTC_TIMESTAMP(),
                expires = '$exp'";
        DB_query($sql);
        return DB_error() ? false : $code;
    }


    /**
    *   Apply a coupon to the user's account.
    *   Adds the value to the gc_bal field in user info, and marks the coupon
    *   as "redeemed" so it can't be used again.
    *
    *   @param  string  $code   Coupon code
    *   @param  integer $uid    Optional user ID, current user by default
    *   @return integer     Status code (0=success, 1=already done, 2=error)
    */
    public static function Apply($code, $uid = 0)
    {
        global $_TABLES, $_USER;

        if ($uid == 0) {
            $uid = $_USER['uid'];
        }
        $uid = (int)$uid;
        $code = DB_escapeString($code);
        $sql = "SELECT * FROM {$_TABLES['paypal.coupons']}
                WHERE code = '$code'";
        $res = DB_query($sql);
        if (DB_numRows($res) == 0) {
            COM_errorLog("Attempting to redeem coupon $code, not found in database");
            return 3;
        } else {
            $A = DB_fetchArray($res, false);
            if (!is_null($A['redeemed'])) {
                COM_errorLog("Coupon code $code was already redeemed");
                return 1;
            }
        }
        $amount = (float)$A['amount'];
        if ($amount > 0) {
            DB_query("UPDATE {$_TABLES['paypal.coupons']} SET
                    redeemer = $uid,
                    redeemed = UTC_TIMESTAMP()
                    WHERE code = '$code'");
            Cache::delete('coupons_' . $uid);
            if (DB_error()) {
                COM_errorLog("A DB error occurred marking coupon $code as redeemed");
                return 2;
            }
        }
        return 0;
    }


    /**
    *   Redeem a coupon value against an order.
    *   Does not update the coupon table, but deducts the maximum of the
    *   coupon balance or the order value from the userinfo table.
    *
    *   @param  float   $amount     Amount to redeem (order value)
    *   @return float               Remaining order value, if any
    */
    public static function Redeem($amount, $uid = 0, $Order = NULL)
    {
        global $_TABLES, $_USER;

        if ($uid == 0) $uid = $_USER['uid'];
        $coupons = self::getUserCoupons($uid);
        $remain = (float)$amount;
        foreach ($coupons as $coupon) {
            $bal = (float)$coupon['balance'];
            if ($bal > $remain) {
                $bal -= $remain;
                $remain = 0;
            } else {
                $remain -= $bal;
                $bal = 0;
            }
            $code = DB_escapeString($coupon['code']);
            $order_id = '';
            if ($Order !== NULL) {
                $order_id = DB_escapeString($Order->order_id);
            }
            $sql = "UPDATE {$_TABLES['paypal.coupons']}
                    SET balance = $bal
                    WHERE code = '$code';";
            $sql .= "INSERT INTO {$_TABLES['paypal.coupon_log']}
                    (code, order_id, amount, msg)
                    VALUES
                    ('{$code}', '{$order_id}', '$amount', 'Applied to order');";
            DB_query($sql);
            if ($remain == 0) break;
        }
        Cache::delete('coupons_' . $uid);
        return $remain;     // Return unapplied balance
    }


    /**
    *   Handle the purchase of this item.
    *
    *   @param  object  $Item       Item object, to get options, etc.
    *   @param  object  $Order      Order object
    *   @param  array   $ipn_data   Paypal IPN data
    *   @return integer     Zero or error value
    */
    public function handlePurchase(&$Item, $Order=NULL, $ipn_data=array())
    {
        global $LANG_PP;

        $status = 0;
        $amount = (float)$Item->price;
        $special = PP_getVar($Item->extras, 'special', 'array');
        $recip_email = PP_getVar($special, 'recipient_email', 'string');
        $sender_name = PP_getVar($special, 'sender_name', 'string');

        $gc_code = self::Purchase($amount, $Item->user_id);
        // Add the code to the options text. Saving the item will happen
        // next during addSpecial
        $Item->addOptionText($LANG_PP['code'] . ': ' . $gc_code, false);
        $Item->addSpecial('gc_code', $gc_code);

        parent::handlePurchase($Item, $Order);
        self::Notify($gc_code, $recip_email, $amount, $sender_name);
        return $status;
    }


    /**
    *   Send a notification email to the recipient of the gift card.
    *
    *   @param  string  $gc_code    Gift Cart Code
    *   @param  string  $recip      Recipient Email, from the custom text field
    *   @param  float   $amount     Gift Card Amount
    *   @param  string  $sender     Optional sender, from the custom text field
    */
    public static function Notify($gc_code, $recip, $amount, $sender='')
    {
        global $_CONF, $LANG_PP_EMAIL;

        if ($recip!= '') {
            PAYPAL_debug("Sending Coupon to " . $recip);
            $T = PP_getTemplate('coupon_email_message', 'message');
            $T->set_var(array(
                'gc_code'   => $gc_code,
                'sender_name' => $sender,
            ) );
            $T->parse('output', 'message');
            $msg_text = $T->finish($T->get_var('output'));
            COM_emailNotification(array(
                    'to' => array(array('email'=>$recip, 'name' => $recip)),
                    'from' => $_CONF['site_mail'],
                    'htmlmessage' => $msg_text,
                    'subject' => $LANG_PP_EMAIL['coupon_subject'],
            ) );
        }
    }


    /**
    *   Get additional text to add to the buyer's recipt for a product
    *
    *   @param  object  $item   Order Item object, to get the code
    *   @return string          Additional message to include in email
    */
    public function EmailExtra($item)
    {
        global $LANG_PP;
        $code = PP_getVar($item->extras['special'], 'gc_code', 'string');
        $s = '';
        if (!empty($code)) {
            $s = sprintf($LANG_PP['apply_gc_email'],
                PAYPAL_URL . '/index.php?redeem=x&code=' . $code,
                PAYPAL_URL . '/index.php?apply_gc&code=' . $code,
                PAYPAL_URL . '/index.php?apply_gc&code=' . $code);
        }
        return $s;
    }


    /**
    *   Get the display price for the catalog.
    *   Returns "See Details" if the price is zero, or the price if
    *   one is set.
    *
    *   @param  mixed   $price  Fixed price override (not used)
    *   @return string          Formatted price, or "See Details"
    */
    public function getDisplayPrice($price = NULL)
    {
        global $LANG_PP;

        $price = $this->getPrice();
        if ($price == 0) {
            return $LANG_PP['see_details'];
        } else {
            return $this->currency->Format($price);
        }
    }


    /**
    *   Get all the current Gift Card records for a user
    *   If $all is true then all records are returned, if false then only
    *   those that are not redeemed and not expired are returned.
    *
    *   @param  integer $uid    User ID, default = curent user
    *   @param  boolean $all    True to get all, False to get currently usable
    *   @return array           Array of gift card records
    */
    public static function getUserCoupons($uid = 0, $all = false)
    {
        global $_TABLES, $_USER;
        static $coupons = array();

        if ($uid == 0) $uid = $_USER['uid'];
        $uid = (int)$uid;

        if (!isset($coupons[$uid])) {
            $cache_key = 'coupons_' . $uid;
            $coupons[$uid] = Cache::get($cache_key);
            $today = date('Y-m-d');
            if (!$coupons[$uid]) {
                $coupons[$uid] = array();
                $sql = "SELECT * FROM {$_TABLES['paypal.coupons']}
                        WHERE redeemer = '$uid'";
                if (!$all) {
                    $sql .= " AND expires >= '$today'
                            AND balance > 0";
                }
                $sql .= " ORDER BY redeemed ASC";
                $res = DB_query($sql);
                while ($A = DB_fetchArray($res, false)) {
                    $coupons[$uid][] = $A;
                }
                Cache::set($cache_key, $coupons[$uid], 'coupons');
            }
        }
        return $coupons[$uid];
    }


    /**
    *   Get the current unused Gift Card balance for a user
    *
    *   @param  integer $uid    User ID, default = current user
    *   @return float           User's gift card balance
    */
    public static function getUserBalance($uid = 0)
    {
        global $_USER;
        static $bals = array();

        if ($uid == 0) $uid = $_USER['uid'];
        if (!isset($bals[$uid])) {
            $bals[$uid] = (float)0;
            $coupons = self::getUserCoupons($uid);
            foreach ($coupons as $coupon) {
                $bals[$uid] += $coupon['balance'];
            }
        }
        return (float)$bals[$uid];
    }


    /**
    *   Verifies that the given user has sufficient Gift Card balances
    *   to cover an amount.
    *
    *   @uses   self::getUserBalance()
    *   @param  float   $amount     Amount to check
    *   @param  integer $uid        User ID, default = current user
    *   @return boolean             True if the GC balance is sufficient.
    */
    public static function verifyBalance($amount, $uid = 0)
    {
        $amount = (float)$amount;
        $balance = self::getUserBalance($uid);
        return $amount <= $balance ? true : false;
    }

}

?>
