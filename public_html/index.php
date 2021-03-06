<?php
/**
 * Public index page for users of the paypal plugin.
 *
 * By default displays available products along with links to purchase history
 * and detailed product views.
 *
 * @author      Lee Garner <lee@leegarner.com>
 * @author      Vincent Furia <vinny01@users.sourceforge.net
 * @copyright   Copyright (c) 2009-2018 Lee Garner
 * @copyright   Copyright (c) 2005-2006 Vincent Furia
 * @package     paypal
 * @version     v0.6.0
 * @license     http://opensource.org/licenses/gpl-2.0.php
 *              GNU Public License v2 or later
 * @filesource
 */

/** Require core glFusion code */
require_once '../lib-common.php';

// If plugin is installed but not enabled, display an error and exit gracefully
if (!isset($_PP_CONF) || !in_array($_PP_CONF['pi_name'], $_PLUGINS)) {
    COM_404();
}

// Ensure sufficient privs and dependencies to read this page
if (!PAYPAL_access_check()) {
    COM_404();
    exit;
}

// Import plugin-specific functions
USES_paypal_functions();

$action = '';
$actionval = '';
$view = '';

/*if (!empty($action)) {
    $id = COM_sanitizeID(COM_getArgument('id'));
} else {*/
    $expected = array(
        // Actions
        'updatecart', 'checkout', 'searchcat',
        'savebillto', 'saveshipto',
        'emptycart', 'delcartitem',
        'addcartitem', 'addcartitem_x', 'checkoutcart',
        'processorder', 'thanks', 'do_apply_gc', 'action',
        'redeem',
        // 'setshipper',
        // Views
        'order', 'view', 'detail', 'printorder', 'orderhist', 'packinglist',
        'couponlog',
        'cart', 'pidetail', 'apply_gc', 'viewcart',
    );
    $action = 'productlist';    // default view
    foreach($expected as $provided) {
        if (isset($_POST[$provided])) {
            $action = $provided;
            $actionval = $_POST[$provided];
            break;
        } elseif (isset($_GET[$provided])) {
            $action = $provided;
            $actionval = $_GET[$provided];
            break;
        }
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = '';
    }
//}
$content = '';

switch ($action) {
case 'updatecart':
    \Paypal\Cart::getInstance()->Update($_POST);
    $view = 'cart';
    break;

case 'checkout':
    // Set the gift card amount first as it will be overridden
    // if the _coupon gateway is selected
    $Cart = \Paypal\Cart::getInstance();
    $gateway = PP_getVar($_POST, 'gateway');
    if ($gateway !== '') {
        $Cart->setGateway($gateway);
    }
    if ($gateway !== '') $Cart->setGateway($gateway);
    if (isset($_POST['by_gc'])) {
        $Cart->setGC($_POST['by_gc']);
    } elseif ($gateway == '_coupon') {
        $Cart->setGC(-1);
    } else {
        $Cart->setGC(0);
    }
    if (isset($_POST['order_instr'])) {
        $Cart->instructions = $_POST['order_instr'];
    }
    if (isset($_POST['payer_email'])) {
        $Cart->buyer_email = $_POST['payer_email'];
    }
    if (isset($_POST['shipper_id'])) {
        $Cart->setShipper($_POST['shipper_id']);
    }
    if (isset($_POST['quantity'])) {
        // Update the cart quantities if coming from the cart view.
        // This also calls Save() on the cart
        $Cart->Update($_POST);
    }
    // See what workflow elements we already have.
    $next_step = PP_getVar($_POST, 'next_step', 'integer', 0);
    if ($_PP_CONF['anon_buy'] == 1 || !COM_isAnonUser()) {
        $view = 'none';
        $content .= $Cart->getView($next_step);
        break;
    } else {
        $content .= SEC_loginRequiredForm();
        $view = 'none';
    }
    break;

case 'savebillto':
case 'saveshipto':
    $addr_type = substr($action, 4);   // get 'billto' or 'shipto'
    $status = \Paypal\UserInfo::isValidAddress($_POST);
    if ($status != '') {
        $content .= \Paypal\PAYPAL_errMsg($status, $LANG_PP['invalid_form']);
        $view = $addr_type;
        break;
    }
    $U = new \Paypal\UserInfo();
    if ($U->uid > 1) {      // only save addresses for logged-in users
        $addr_id = $U->SaveAddress($_POST, $addr_type);
        if ($addr_id[0] < 0) {
            if (!empty($addr_id[1]))
                $content .= PAYPAL_errorMessage($addr_id[1], 'alert',
                        $LANG_PP['missing_fields']);
            $view = $addr_type;
            break;
        } else {
            $_POST['useaddress'] = $addr_id[0];
        }
    }
    //$view = \Paypal\Workflow::getNextView($addr_type);
    \Paypal\Cart::getInstance()->setAddress($_POST, $addr_type);
    $next_step = PP_getVar($_POST, 'next_step', 'integer');
    $content = \Paypal\Cart::getInstance()->getView($next_step);
    $view = 'none';
    break;

case 'addcartitem':
case 'addcartitem_x':   // using the image submit button, such as Paypal's
    $view = 'productlist';
    if (isset($_POST['_unique']) && $_POST['_unique'] &&
            \Paypal\Cart::getInstance()->Contains($_POST['item_number']) !== false) {
        break;
    }
    \Paypal\Cart::getInstance()->addItem(array(
        'item_number' => isset($_POST['item_number']) ? $_POST['item_number'] : '',
        'item_name' => isset($_POST['item_name']) ? $_POST['item_name'] : '',
        'description' => isset($$_POST['item_descr']) ? $_POST['item_descr'] : '',
        'quantity' => isset($_POST['quantity']) ? (float)$_POST['quantity'] : 1,
        'price' => isset($_POST['amount']) ? $_POST['amount'] : 0,
        'options' => isset($_POST['options']) ? $_POST['options'] : array(),
        'extras' => isset($_POST['extras']) ? $_POST['extras'] : array(),
    ) );
    if (isset($_POST['_ret_url'])) {
        COM_refresh($_POST['_ret_url']);
        exit;
    } elseif (PAYPAL_is_plugin_item($$_POST['item_number'])) {
        COM_refresh(PAYPAL_URL . '/index.php');
        exit;
    } else {
        COM_refresh(PAYPAL_URL.'/detail.php?id='.$_POST['item_number']);
        exit;
    }
    break;

case 'delcartitem':
    \Paypal\Cart::getInstance()->Remove($_GET['id']);
    $view = 'cart';
    break;

case 'emptycart':
    \Paypal\Cart::getInstance()->Clear();
    COM_setMsg($LANG_PP['cart_empty']);
    echo COM_refresh(PAYPAL_URL . '/index.php');
    break;

case 'thanks':
    // Allow for no thanksVars function
    $message = $LANG_PP['thanks_title'];
    if (!empty($actionval)) {
        $gw = \Paypal\Gateway::getInstance($actionval);
        if ($gw !== NULL) {
            $tVars = $gw->thanksVars();
            if (!empty($tVars)) {
                $T = PP_getTemplate('thanks_for_order', 'msg');
                $T->set_var('site_name', $_CONF['site_name']);
                foreach ($tVars as $name=>$val) {
                    $T->set_var($name, $val);
                }
                $message = $T->parse('output', 'msg');
            }
        }
    }
    $content .= COM_showMessageText($message, $LANG_PP['thanks_title'], true, 'success');
    $view = 'productlist';
    break;

case 'redeem':
    if (COM_isAnonUser()) {
        SESS_setVar('login_referer', $_CONF['site_url'] . $_SERVER['REQUEST_URI']);
        COM_setMsg($LANG_PP['gc_need_acct']);
        COM_refresh($_CONF['site_url'] . '/users.php?mode=login');
        exit;
    }
    // Using REQUEST here since this could be from a link in an email of from
    // the apply_gc form
    $code = PP_getVar($_REQUEST, 'gc_code');
    $uid = $_USER['uid'];
    list($status, $msg) = \Paypal\Coupon::Redeem($code, $uid);
    if ($status > 0) {
        $persist = true;
        $type = 'error';
    } else {
        $persist = false;
        $type = 'info';
    }
    // Redirect back to the provided view, or to the default page
    if (isset($_REQUEST['refresh'])) {
        COM_setMsg($msg, $type, $persist);
        COM_refresh(PAYPAL_URL . '/index.php?' . $_REQUEST['refresh']);
    } else {
        $content .= COM_showMessageText($msg, '', $persist, $type);
    }
    break;

/*case 'setshipper':
    $s_id = (int)$_POST['shipper_id'];
    if ($s_id > 0) {
        $order = \Paypal\Cart::getInstance($_POST['order_id']);
        $info = $order->getItemShipping();
        $shippers = \Paypal\Shipper::getShippers($info['units']);
        $order->setField('shipping', $shippers[$s_id]->best_rate);
    }
    $next_step = PP_getVar($_POST, 'next_step', 'integer', 0);
    $content = \Paypal\Cart::getInstance()->getView($next_step);
    $view = 'none';
    break;
 */
case 'action':      // catch all the "?action=" urls
    switch ($actionval) {
    case 'thanks':
        $T = PP_getTemplate('thanks_for_order', 'msg');
        $T->set_var(array(
            'site_name'     => $_CONF['site_name'],
            'payment_date'  => $_POST['payment_date'],
            'currency'      => $_POST['mc_currency'],
            'mc_gross'      => $_POST['mc_gross'],
            'paypal_url'    => $_PP_CONF['paypal_url'],
        ) );
        $content .= COM_showMessageText($T->parse('output', 'msg'),
                    $LANG_PP['thanks_title'], true);
        $view = 'productlist';
        break;
    }
    break;

case 'view':            // "?view=" url passed in
    $view = $actionval;
    break;

case 'processorder':
    // Process the order, similar to what an IPN would normally do.
    // This is for internal, manual processes like C.O.D. or Prepayment orders
    $gw_name = isset($_POST['gateway']) ? $_POST['gateway'] : $actionval;
    $gw = \Paypal\Gateway::getInstance($gw_name);
    if ($gw !== NULL) {
        $output = $gw->handlePurchase($_POST);
        if (!empty($output)) {
            $content .= $output;
            $view = 'none';
            break;
        }
        $view = 'thanks';
        //\Paypal\Cart::getInstance()->Clear(false);
    }
    $view = 'productlist';
    break;

default:
    $view = $action;
    break;
}

switch ($view) {
case 'couponlog':
    if (COM_isAnonUser()) COM_404();
    $content .= \Paypal\PAYPAL_userMenu($view);
    $content .= \Paypal\CouponLog();
    $menu_opt = $LANG_PP['gc_activity'];
    $page_title = $LANG_PP['gc_activity'];
    break;

case 'orderhist':
case 'history':
    if (COM_isAnonUser()) COM_404();
    PP_setUrl($_SERVER['request_uri']);
    $content .= \Paypal\PAYPAL_userMenu($view);
    $content .= \Paypal\listOrders();
    $menu_opt = $LANG_PP['purchase_history'];
    $page_title = $LANG_PP['purchase_history'];
    break;

case 'billto':
case 'shipto':
    // Editing the previously-submitted billing or shipping info.
    // This is accessed from the final order confirmation page, so return
    // there after submission
    $step = 8;     // form will return to ($step + 1)
    $U = new \Paypal\UserInfo();
    $A = isset($_POST['address1']) ? $_POST : \Paypal\Cart::getInstance()->getAddress($view);
    $content .= $U->AddressForm($view, $A, $step);
    break;

case 'order':
    // View a completed order record
    if ($_PP_CONF['anon_buy'] == 1 || !COM_isAnonUser()) {
        $order = \Paypal\Order::getInstance($actionval);
        if ($order->canView()) {
            $content .= $order->View();
        } else {
            COM_404();
        }
    } else {
        COM_404();
    }
    break;

case 'packinglist':
case 'printorder':
    if ($_PP_CONF['anon_buy'] == 1 || !COM_isAnonUser()) {
        $order = \Paypal\Order::getInstance($actionval);
        if ($order->canView()) {
            echo $order->View($view);
            exit;
        }
    }
    // else
    COM_404();
    break;

case 'vieworder':
    if ($_PP_CONF['anon_buy'] == 1 || !COM_isAnonUser()) {
        \Paypal\Cart::setSession('prevpage', $view);
        $content .= \Paypal\Cart::getInstance()->View($view);
        $page_title = $LANG_PP['vieworder'];
    } else {
        COM_404();
    }
    break;

case 'pidetail':
    // Show detail for a plugin item wrapped in the catalog layout
    $item = explode(':', $actionval);
    $status = LGLIB_invokeService($item[0], 'getDetailPage',
        array(
            'item_id' => $actionval,
        ),
        $output,
        $svc_msg
    );
    if ($status != PLG_RET_OK) {
        $output = $LANG_PP['item_not_found'];
    }
    $T = PP_getTemplate('paypal_title', 'header');
    $T->set_var('breadcrumbs', COM_createLink($LANG_PP['back_to_catalog'], PAYPAL_URL . '/index.php'));
    $T->parse('output', 'header');
    $content .= $T->finish($T->get_var('output'));
    $content .= $output;
    break;

case 'detail':
    // deprecated, should be displayed via detail.php
    COM_errorLog("Called detail from index.php, deprecated");
    COM_404();
    $P = new \Paypal\Product($id);
    $content .= $P->Detail();
    $menu_opt = $LANG_PP['product_list'];
    break;

case 'cart':
case 'viewcart':
    // If a cart ID is supplied, probably coming from a cancelled purchase.
    // Restore cart since the payment was not processed.
    PP_setUrl($_SERVER['request_uri']);
    $cid = PP_getVar($_REQUEST, 'cid');
    if (!empty($cid)) {
        \Paypal\Cart::setFinal($cid, false);
        COM_refresh(PAYPAL_URL. '/index.php?view=cart');
    }
    $menu_opt = $LANG_PP['viewcart'];
    $Cart = \Paypal\Cart::getInstance();
    if ($Cart->hasItems() && $Cart->canView()) {
        $content .= $Cart->getView(0);
    } else {
        COM_setMsg($LANG_PP['cart_empty']);
        COM_refresh(PAYPAL_URL . '/index.php');
        exit;
    }
    break;

case 'checkoutcart':
    echo "DEPRECATED";die;
    $content .= \Paypal\Cart::getInstance()->View(5);
    break;

case 'productlist':
default:
    PP_setUrl($_SERVER['request_uri']);
    $cat_id = isset($_REQUEST['category']) ? (int)$_REQUEST['category'] : 0;
    $content .= \Paypal\ProductList($cat_id);
    $menu_opt = $LANG_PP['product_list'];
    $page_title = $LANG_PP['main_title'];
    break;

case 'apply_gc':
    $C = \Paypal\Currency::getInstance();
    $code = PP_getVar($_GET, 'code');
    $T = PP_getTemplate('apply_gc', 'tpl');
    $T->set_var(array(
        'gc_bal' => $C->format(\Paypal\Coupon::getUserBalance($_USER['uid'])),
        'code' => $code,
    ) );
    $content .= $T->finish($T->parse('output', 'tpl'));
    break;

case 'none':
    // Add nothing, useful if the view is handled by the action above
    break;
}

$display = \Paypal\siteHeader();
$T = PP_getTemplate('paypal_title', 'title');
$T->set_var(array(
    'title' => isset($page_title) ? $page_title : '',
    'is_admin' => plugin_ismoderator_paypal(),
) );
$display .= $T->parse('', 'title');
$display .= $content;
$display .= \Paypal\siteFooter();
echo $display;

?>
