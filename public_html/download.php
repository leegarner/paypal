<?php
/**
*   Download page for files purchased using the paypal plugin.
*   No other files will be accessable via this script.
*   Based on the PayPal Plugin for Geeklog CMS by Vincent Furia.
*
*   @author     Lee Garner <lee@leegarner.com>
*   @author     Vincent Furia <vinny01 AT users DOT sourceforge DOT net>
*   @copyright  Copyright (c) 2009-2018 Lee Garner
*   @copyright  Copyright (c) 2005-2006 Vincent Furia
*   @package    paypal
*   @version    0.6.0
*   @license    http://opensource.org/licenses/gpl-2.0.php
*               GNU Public License v2 or later
*   @filesource
*/

/** Import core glFusion libraries */
require_once('../lib-common.php');

// Sanitize the product ID and token
$id = PP_getVar($_GET, 'id', 'int');
$token = PP_getVar($_GET, 'token');

// Need to have one or the other, prefer token
if (empty($token) && $id == 0) {
    COM_404();
    exit;
}

// Get product by token
// Also check for a product ID
$id = PP_getVar($_REQUEST, 'id', 'int');
if ($id > 0) {
    $id_sql = "item.product_id = '$id' AND ";
} else {
    $id_sql = '';
}
$sql = "SELECT prod.id, prod.file, prod.prod_type
        FROM {$_TABLES['paypal.purchases']} AS item
        LEFT JOIN {$_TABLES['paypal.products']} AS prod
            ON prod.id = item.product_id
        WHERE $id_sql item.token = '$token'
        AND item.expiration > '" . PAYPAL_now()->toUnix() . "'";
//echo $sql;die;
$res = DB_query($sql);
$A = DB_fetchArray($res, false);

//  If a file was found, do the download.
//  Otherwise refresh to the home page and log it.
if (is_array($A) && !empty($A['file'])) {
    $dwnld = new downloader();
    $logfile = $_PP_CONF['logfile'];
    if (!file_exists($logfile)) {
        $fp = fopen($logfile, "w+");
        if (!$fp) {
            COM_errorLog("Failed to create $logfile", 1);
        } else {
            fwrite($fp, "**** Created Logfile ***\n");
        }
    }
    if (file_exists($logfile)) {
        $dwnld->setLogFile($logfile);
        $dwnld->setLogging(true);
    } else {
        $dwnld->setLogginf(false);
    }
    $dwnld->setAllowedExtensions($_PP_CONF['allowedextensions']);
    $dwnld->setPath($_PP_CONF['download_path']);
    $dwnld->downloadFile($A['file']);

    // Check for errors
    if ($dwnld->areErrors()) {
        $errs = $dwnld->printErrors(false);
        COM_errorLog("PAYPAL-DWNLD: {$_USER['username']} tried to download " .
                "the file with id {$id} but for some reason could not",1);
        COM_errorLog("PAYPAL-DWNLD: $errs",1);
        echo COM_refresh($_CONF['site_url']);
    }

    $dwnld->_logItem('Download Success',
            "{$_USER['username']} successfully downloaded "
            . "the file with id {$id}.");
} else {
    COM_errorLog("PAYPAL-DWNLD: {$_USER['username']}/{$_USER['uid']} " .
            "tried to download the file with id {$id} " .
            "but this is not a downloadable file",1);
    echo COM_refresh($_CONF['site_url']. '/index.php?msg=07&plugin=paypal');
}

?>
