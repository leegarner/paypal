<?php
/**
*   German formal language file, adressing the user as (Sie)
*
*   @author     Lee Garner <lee@leegarner.com>
*   @translated Siegfried Gutschi <sigi AT modellbaukalender DOT info> (Dez 2016)
*   @copyright  Copyright (c) 2009-2016 Lee Garner <lee@leegarner.com>
*   @package    paypal
*   @version    0.5.9
*   @license    http://opensource.org/licenses/gpl-2.0.php
*               GNU Public License v2 or later
*   @filesource
*/

global $_PP_CONF;

/** Global array to hold all plugin-specific configuration items. */
$LANG_PP = array (
'plugin'            => 'Paypal',
'main_title'        => 'Online-Shop',
'admin_title'       => 'Paypal Administration',
'blocktitle'        => 'Produkte',
'cart_blocktitle'   => 'Warenkorb',
'srchtitle'         => 'Produkte',
'products'          => 'Produkte',
'category'          => 'Kategorie',
'featured_product'  => 'Aktions-Produkt',
'popular_product'   => 'Beliebtes-Produkt',
'product_categories' => 'Produkt-Kategorien',
'mnu_paypal'        => 'Online-Shop',
'mnu_admin'         => 'Admin',
'product'           => 'Produkt-Name/SKU',
'qty'               => 'Stück',
'description'       => 'Beschreibung',
'short_description' => 'Kurzbeschreibung',
'keywords'          => 'Schlüsselwörter',
'exp_time_days'     => 'Gültigkeit (Tage)',
'purch_date'        => 'Kaufdatum',
'txn_id'            => 'Txn ID',
'expiration'        => 'Ablauf',
'download'          => 'Download',
'downloadable'      => 'Herunterladbar',
'price'             => 'Preis',
'sale_price'        => 'Verkaufspreis',
'quantity'          => 'Stückzahl',
'item_total'        => 'Artikel Gesamt',
'total'             => 'Gesamt',
'cart_empty'        => 'Ihr Warenkorb ist leer',
'purchase_history'  => 'Bestellungen',
'ipnlog'            => 'IPN-Protokoll',
'new_product'       => 'Neues Produkt',
'new_category'      => 'Neue Kategorie',
'product_list'      => 'Produkte',
'category_list'     => 'Kategorien',
'admin_hdr'         => '<ul><li>Erstellen, löschen und ändern Sie hier Ihre Produkte aus Ihrem Shop.</li><li>Durch anklicken des Produkt-Namen gelangen Sie zur Verkaufs-Statistik</li></ul>',
'admin_hdr_editattr' => '<ul><li>Erstellen oder aktualisieren Sie hier Produk-Optionen wie z.B. Farb-, oder Größen-Optionen.</li></ul>',
'admin_hdr_catlist' => '<ul><li>Bearbeiten Sie Produktkategorien, oder wählen Sie "Neue Kategorie", um eine neue Kategorie zu erstellen.</li><li>Eine Kategorie kann nur gelöscht werden, wenn sie nicht mit Produkten verknüpft ist.</li></ul>',
'admin_hdr_ipnlog'  => '<ul><li>Dies ist eine Liste der empfangenen IPN-Protokolle. (IPN=Instant Payment Notification)</li><li>Klicken Sie auf die ID oder die Txn-ID, um weiter Details anzuzeigen.</li></ul>',
'admin_hdr_other'   => '<ul><li>Hier können Sie zusätzliche, selten genutzte Funktionen ausführen.</li><li>Klicken Sie auf "Alle Schaltflächen zurücksetzen", um alle PayPal-Schaltflächen wiederherzustellen.</li></ul>',
'admin_hdr_history' => '<ul><li>Dies ist eine Liste aller Käufe in der Datenbank.</li><li>Klicken Sie auf einen Link für weitere Informationen zu diesem Kauf</li></ul>',
'admin_hdr_attributes' => '<ul><li>Produkt-Optionen können mit Produkten verknüpft werden.</li><li>Sie können z.B. kleine, mittlere und große Größen anbieten, wobei diese unterschiedlich viel kosten.</li><li>Produkte mit Produkt-Optionen können nicht direkt über die Schaltflächen "Jetzt kaufen" erworben werden.</li><li>Der Warenkorb muss aktiviert sein.</li></ul>',
'admin_hdr_wfadmin' => '<ul><li>Aktivieren, Deaktivieren und Sortieren Sie die Elemente, die vor der Kauf-Bestätigung abgeschlossen sein müssen.</li><li>Elemente des Bestell-Ablaufes können nicht gelöscht werden.</li><li>"Auftrag bestätigen" ist immer das letzte Element im Bestell-Ablauf.</li></ul>',
'admin_hdr_wfstatus' => '<ul><li>Hier können Sie die Optionen des Bestell-Status aktivieren und sortieren</li><li>Weiters können Sie hier angeben, ob der Käufer benachrichtigt wird, wenn ein Status aktiv wird.</li></ul>',
'username'          => 'Benutzer-Name',
'pmt_status'        => 'Zahlungs-Status',
'status'            => 'Status',
'update_status'     => 'Update-Status',
'purchaser'         => 'Käufer',
'gateway'           => 'Zahlungs-Möglichkeit',
'gateways'          => 'Zahlungs-Möglichkeiten',
'workflows'         => 'Bestell-Ablauf/Status',
'ip_addr'           => 'IP-Addresse',
'datetime'          => 'Datum/Uhrzeit',
'verified'          => 'Bestätigt',
'ipn_data'          => 'IPN-Protokolle',
'viewcart'          => 'Warenkorb anzeigen',
'vieworder'         => 'Bestellung bestätigen',
'images'            => 'Bilder',
'cat_image'         => 'Kategorie-Bild',
'click_to_enlarge'  => 'Anklicken zum vergrößern',
'enabled'           => 'Aktiviert',
'disabled'          => 'Deaktiviert',
'featured'          => 'Aktion',
'taxable'           => 'Steuerpflichtig',
'delete'            => 'Löschen',
'thanks_title'      => 'Vielen Dank für Ihre Bestellung!',
'yes'               => 'Ja',
'no'                => 'Nein',
'closed'            => 'Geschlossen',
'true'              => 'Richtig',
'false'             => 'Falsch',
'info'              => 'Information',
'warning'           => 'Warnung',
'error'             => 'Fehler',
'alert'             => 'Alarm',
'invalid_product_id' => 'Eine ungültige Produkt-ID wurde angefordert',
'access_denied_msg' => 'Sie haben keinen Zugriff auf diese Seite. Wenn Sie glauben, dass Sie diese Nachricht irrtümlich erhalten haben, wenden Sie sich bitte an einen Administrator. Alle Versuche, auf diese Seite zuzugreifen, werden protokolliert.',
'access_denied'     => 'Zugriff verweigert',
'select_file'       => 'Datei wählen',
'or_upload_new'     => 'Oder Datei hochladen',
'random_product'    => 'Zufälliges Produkt',
'featured_product'  => 'Aktions-Produkt',
'invalid_form'      => 'Das übermittelte Formular hat fehlende oder ungültige Felder bzw. könnte ein doppelter Datensatz sein.',
'buy_now'           => 'Jetzt kaufen',
'add_to_cart'       => 'In den Warenkorb',
'donate'            => 'Spenden',
'txt_buttons'       => 'Schaltflächen',
'incl_blocks'       => 'In Blöcke einfügen',
'buttons'           => array(
        'buy_now'   => 'Jetzt kaufen',
        'add_cart'  => 'In den Warenkorb',
        'donation'  => 'Spenden',
        'subscribe' => 'Abonnieren',
        'pay_now'   => 'Jetzt zahlen',
        'checkout'  => 'Zur Kasse gehen',
        'external'  => 'Externe Produkte',
    ),
'prod_type'         => 'Produkt-Typ',
'prod_types'        => array(1 => 'Materiell', 2 => 'Herunterladbar', 4 => 'Virtuell', 3 => 'Materiell + Herunterladbar',),
'edit'              => 'Bearbeiten',
'create_category'   => 'Neue Kategorie',
'cat_name'          => 'Kategorie-Name',
'parent_cat'        => 'Über-Kategorie',
'top_cat'           => '-- Top --',
'saveproduct'       => 'Produkt speichern',
'deleteproduct'     => 'Produkt löschen',
'deleteopt'         => 'Optionen löschen',
'savecat'           => 'Kategorie speichern',
'saveopt'           => 'Optionen speichern',
'deletecat'         => 'Kategorie löschen',
'product_id'        => 'Produkt-ID',
'other_func'        => 'Sonstiges',
'q_del_item'        => 'Sind Sie sicher, dass Sie dieses Produkt löschen möchten?',
'clearform'         => 'Zurücksetzen',
'del_item_instr'    => 'Produkte, die keine Käufe haben, können gelöscht werden. Wenn ein Produkt bereits gekauft wurde, kann es nur deaktiviert werden.',
'del_cat_instr'     => 'Kategorien, die Produkte enthalten, können nicht gelöscht werden.',
'delivery_info'     => 'Liefer-Informationen',
'product_info'      => 'Produkt-Information',
'delete_image'      => 'Bild löschen',
'select_image'      => 'Neues Bild wählen',
'weight'            => 'Gewicht',
'no_download_path'  => 'Kein Download-Pfad angegeben',
'sortby'            => 'Sortieren nach',
'name'              => 'Name',
'dt_add'            => 'Hinzugefügt',
'ascending'         => 'Aufsteigend',
'descending'        => 'Absteigend',
'sortdir'           => 'Sortier-Richtung',
'comments'          => 'Kommentare',
'ratings_enabled'   => 'Erlaube Bewertungen',
'no_shipping'       => 'Kein Versand',
'fixed'             => 'Fixpreis',
'pp_profile'        => 'Daten des Zahlungsdienstes verwenden',
'shipping_type'     => 'Versand',
'shipping_amt'      => 'Betrag',
'per_item'          => 'Pro Stück',
'storefront'        => 'Zum Shop',
'options_msg'       => 'Durch das Hinzufügen von Optionen wird verhindert, dass verschlüsselte Schaltflächen erstellt werden.',
'new_attr'          => 'Neue Produkt-Option',
'attr_list'         => 'Produkt-Optionen',
'attr_name'         => 'Auswahl-Option',
'attr_value'        => 'Options-Wert',
'attr_price'        => 'Options-Preis',
'order'             => 'Sortierung',
'err_missing_name'  => 'Produkt-Name fehlt',
'err_missing_desc'  => 'Beschreibung fehlt',
'err_missing_cat'   => 'Kategorie fehlt',
'err_missing_file'  => 'Datei oder Download fehlt',
'err_missing_exp'   => 'Gültigkeitsdauer für Download fehlt',
'err_phys_need_price' => 'Materielle Produkte müssen einen Preis aufweisen',
'missing_fields'    => 'Fehlende Felder',
'no_javascript'     => 'Javascript ist erforderlich, damit diese Seite richtig funktioniert. Ihr Warenkorb wurde nicht richtig aktualisiert, dadurch kann sich Ihre Bestellung verzögern. Es sei denn, Sie aktivieren Javascript in Ihrem Browser.',
'clk_help'      => 'Für Hilfe hier klicken',
'ind_req_fld'   => 'Markiert eine erforderliches Feld',
'required'      => 'Erforderlich',
'ipnlog_id'     => 'IPN Log ID',
'trans_id'      => 'Transaktions-ID',
'paid_by'       => 'Bezahlt von',
'pmt_method'    => 'Zahlungs-Möglichkeit',
'pmt_gross'     => 'Brutto-Betrag',
'billto_info'   => 'Zahlungs-Information',
'shipto_info'   => 'Versand-Information',
'home'          => 'Alle Produkte',
'none'          => 'Kein',
'browse_cat'    => 'Katalog ansehen',
'search_catalog' => 'Katalog durchsuchen',
'by_cat'        => 'Nach Kategorie',
'by_name'       => 'Nach Name',
'search'        => 'Suchen',
'any'           => 'Alle Kategorien',
'customize'     => 'Details',
'fullname'      => 'Name',
'lastname'      => 'Nach-Name',
'company'       => 'Firma',
'address1'      => 'Adress-Zeile 1',
'address2'      => 'Adress-Zeile 2',
'country'       => 'Land',
'city'          => 'Stadt',
'state'         => 'Staat',
'zip'           => 'Postleitzahl',
'name_or_company' => 'Name oder Firma',
'make_def_addr' => 'Standard-Adresse festlegen',
'sel_shipto_addr' => 'Bitte wählen Sie die Liefer-Adresse aus Ihrem Adressbuch aus oder geben Sie eine neue Adresse ein.',
'sel_billto_addr' => 'Bitte wählen Sie die Rechnungs-Adresse aus Ihrem Adressbuch aus oder geben Sie eine neue Adresse ein.',
'checkout'      => 'Bestellen',
'bill_to'       => 'Rechnungs-Adresse',
'ship_to'       => 'Liefer-Adresse',
'submit_order'  => 'Bestellung abschicken',
'orderby'       => 'Bestellung',
'billto'        => 'Rechnungs-Adresse',
'shipto'        => 'Liefer-Adresse',
'gw_notinstalled' => 'Nicht installierte Zahlungs-Möglichkeiten',
'empty_cart'    => 'Warenkorb löschen',
'update_cart'   => 'Warenkorb aktualisieren',
'order_summary' => 'Bestellübersicht',
'order_date'    => 'Bestelldatum',
'order_number'  => 'Bestellnummer',
'new_address'   => 'Neue Adresse',
'shipping'      => 'Versand',
'handling'      => 'Bearbeitung',
'tax'           => 'Steuer',
'or'            => 'oder',
'purch_signup'  => 'Konto erstellen',
'buyer_email'   => 'Verkäufer E-Mail',
'todo_noproducts' => 'Es gibt keine Produkte im Katalog.',
'todo_nogateways' => 'Es stehen keine Zahlungs-Möglichkeiten zur verfügung',
'orderstatus'   => array(
        'pending'   => 'Ausstehend',
        'paid'      => 'Bezahlt',
        'shipped'   => 'Versendet',
        'processing' => 'In Bearbeitung',
        'closed'    => 'Abgeschlossen',
        'refunded'  => 'Rückerstattet',
    ),
'message' => 'Nachricht',
'timestamp' => 'Zeitstempel',
'notify' => 'Benachrichtigen',
'updated_x_orders' => '%d Bestellungen aktualisiert',
'onhand' => 'Aktueller Lagebestand',
'available' => 'Verfügbar',
'track_onhand' => 'Lagerbestand anzeigen',
'continue_shopping' => 'Weiter einkaufen',
'pmt_error' => 'Beim Bearbeiten Ihrer Zahlung ist ein Fehler aufgetreten.',
'pmt_made_via' => 'Zahlung erfolgte mit %s am %s.',
'new_option' => 'Neue Option',
'oversell_action' => 'Wenn Lagerbestand = 0',
'oversell_allow' => 'Produkt anzeigen mit Bestellmöglichkeit',
'oversell_deny' => 'Produkt anzeigen ohne Bestellmöglichkeit',
'oversell_hide' => 'Produkt nicht mehr anzeigen',
'anon_and_empty' => 'Sie können als Gast leider keine Produkte kaufen. Melden Sie sich bitte auf der Seite an um den Shop benutzen zu können.',
'back_to_catalog' => 'Zurück zum Shop',
'list_sort_options' => array(
    //'most_popular' => 'Most Popular',
    'name' => 'Name A-Z',
    'price_l2h' => 'Preis-Aufsteigend',
    'price_h2l' => 'Preis-Absteigend',
    //'top_rated' => 'Top Rated',
    'newest' => 'Neue-Produkte',
    ),
'discount' => 'Rabatt',
'min_purch' => 'Min. Abnahme',
'qty_discounts' => 'Mengenrabatt',
'qty_discounts_avail' => 'Mengenrabatt möglich',
'qty_disc_text' => 'Rabatte werden bei der Kasse berechnet',
'order_instr' => 'Besondere Hinweise',
'copy_attributes' => '<ul><li>Kopieren Sie Produkt-Optionen eines Produktes auf ein anderes Produkt in einer andere Kategorie.</li><li>Vorhandene Produkt-Optionen werden dadurch nicht geändert</li></ul>',
'copy_from' => 'Kopiere von',
'target_prod' => 'Ziel-Produkt',
'target_cat' => 'Ziel-Kategorie',
'custom' => 'Text-Felder',
'custom_instr' => '(trennen mit &quot;|&quot;&nbsp;)',
'visible_to' => 'Sichtbar für',
'from' => 'Von',
'to' => 'Zu',
'terms_and_cond' => 'Geschäftsbedingungen',
'item_history' => 'Verkaufs-Statistik',
'reset' => 'Zurücksetzen',
'datepicker' => 'Datumsauswahl',
'workflows' => 'Bestell-Ablauf',
'statuses' => 'Bestell-Status',
'reports' => 'Berichte',
'reports_avail' => array('orderlist' => 'Bestell-Übersicht', 'paymentlist' => 'Zahlungs-Übersicht'),
'my_orders' => 'Meine Bestellungen',
'no_products_match' => 'No products match your search parameters',
'msg_updated' => 'Item has been updated',
'msg_nochange' => 'Item is unchanged',
'msg_item_added' => 'Item has been added to your cart',
'all' => 'All',
'print' => 'Print',
'resetbuttons' => 'Clear Encrypted Button Cache',
'orderhist_item' => 'View the order history for this item',
'notify_email' => 'Notification Email',
'recipient_email' => 'Recipient Email',
'sender_name' => 'Sender\'s Name',
'apply_gc' => 'Apply Gift Card',
'item_not_found' => 'Item not found',
'dscp_root_cat' => 'This is the root category and cannot be deleted.',
'no_del_item' => 'Product %s has purchase records, can&apos;t delete.',
'no_del_cat' => 'Category %s has related products or sub-categories, can&apos;t delete.',
'forgotten_user' => 'User Forgotten',
'tax_on_x_items' => '%.2f%% Tax on %s item(s)',
'amt_paid_gw' => '%0.2f paid via %s',
'balance' => 'Balance',
'all_items' => 'All items in your shopping cart',
'cart' => 'Cart',
'paid_by_gc' => 'Paid by Gift Card/Coupon',
'amount' => 'Amount',
'buyer' => 'Buyer',
'redeemer' => 'Redeemer',
'couponlist' => 'Coupon Management',
'code' => 'Code',
'coupons' => 'Coupons',
'gc_bal' => 'Gift Card Balance',
'hlp_gw_select' => 'Select your payment method below. You will be able to confirm your order on the next page.',
'confirm_order' => 'Confirm Order',
'coupon_apply_msg0' => 'The coupon amount has been applied to your account.',
'coupon_apply_msg1' => 'This coupon has already been applied.',
'coupon_apply_msg2' => 'There was an error applying this coupon. Contact %s for assistance.',
'see_details' => 'See Details',
'send_giftcards' => 'Send Gift Cards',
'my_account' => 'My Shopping Account',
'purge_cache' => 'Purge Cache',
'confirm_send_gc' => 'Are you sure you want to send gift cards to the selected users and groups?',
'sendgc_header' => 'Select a group and/or individual users to receive gift cards.',
'pmt_total' => 'Payment Total',
'del_existing' => 'Delete Existing?',
'err_gc_amt' => 'Must supply a positive amount for the gift cards.',
'err_gc_nousers' => 'No users specified, or none are in the specified group.',
'enter_gc' => 'Enter Coupon Code (click Update to apply)',
'update' => 'Update',
'apply_gc_title' => 'Apply a Gift Card to Your Account',
'apply_gc_help' => 'Enter the gift card code below and click the &quot;Update&quot; button to apply to your account.',
'apply_gc_email' => 'You may apply the gift card to your account by clicking <a href="%s">here</a>, or by visiting <a href="%s">%s</a> and entering the coupon code manually.<br />' . LB . 'NOTE: Do not apply this code to your account if this is a gift or the recipient will not be able to apply it.',
'subj_email_admin' => $_CONF['site_name'] . ': Order Notification',
'subj_email_user' => $_CONF['site_name'] . ': Purchase Receipt',
);
if (isset($_PP_CONF['ena_ratings']) && $_PP_CONF['ena_ratings']) {
    $LANG_PP['list_sort_options']['top_rated'] = 'Top Rated';
}

$LANG_PP_EMAIL = array(
'coupon_1' => 'You have received a gift card. Click on the link below to redeem it.',
'coupon_id' => 'Gift Card',
'coupon_subject' => 'You have a gift card!',
);

$LANG_PP_HELP = array(
'notify_email' => 'Enter an optional email address to receive the notification of this order. Your own email address will be used if this is empty.',
'hlp_cat_delete' => 'Only unused categories may be deleted',
'hlp_prod_delete' => 'Only products that have never been puchased may be deleted',
);

$LANG_MYACCOUNT['pe_paypal'] = 'Shopping';

/** Message indicating plugin version is up to date */
$PLG_paypal_MESSAGE03 = 'Fehler beim Abrufen der aktuellen Versionsnummer';
$PLG_paypal_MESSAGE04 = 'Fehler beim Durchführen des Plugin-Aktualisierung';
$PLG_paypal_MESSAGE05 = 'Fehler beim Aktualisieren der Plugin-Versionsnummer';
$PLG_paypal_MESSAGE06 = 'Plugin ist bereits auf dem aktuellen Stand';
$PLG_paypal_MESSAGE07 = 'Ungültiger Download-Token gegeben';

/** Language strings for the plugin configuration section */
$LANG_configsections['paypal'] = array(
    'label' => 'PayPal',
    'title' => 'PayPal-Konfiguration'
);

/** Language strings for the field names in the config section */
$LANG_confignames['paypal'] = array(
    'currency'      => 'Währung',
    'anon_buy'      => 'Gäste können kaufen',
    'purch_email_user' => 'Bestätigung an Benutzer senden',
    'purch_email_user_attach' => 'Anhänge an Benutzer mitsenden',
    'purch_email_anon' => 'Bestätigung an Gäste senden',
    'purch_email_anon_attach' => 'Anhänge an Gäste mitsenden',
    'prod_per_page' => 'Max. Produkte pro Seite',
    'order'         => 'Standart-Sortierung',
    'menuitem'      => 'Im Hauptmenü eintragen',
    'cat_columns'   => 'Kategorie Spalten',
    'max_images'    => 'Max. Anzahl Produktbilder',
    'image_dir'     => 'Pfad zu den Bildern',
    'max_thumb_size' => 'Max. Thumbnail-Größe (px)',
    'img_max_width' => 'Max. Bild-Breite (px)',
    'img_max_height' => 'Max. Bild-Höhe (px)',
    'max_image_size' => 'Max. Bild-Größe (Bytes)',
    'max_file_size' => 'Max. Größe für Downloads in MB',
    'download_path' => 'Pfad zu den Downloads',
    'commentsupport' => 'Kommentar-Funktion',
    'tmpdir'        => 'Temporäres Verzeichnis',
    'ena_comments'  => 'Kommentare aktivieren',
    'ena_ratings'   => 'Bewertungen aktivieren',
    'anon_can_rate' => 'Gäste können bewerten',
    'displayblocks'  => 'Blöcke anzeigen',
    'debug_ipn'     => 'IPN für Fehlersuche',
    'debug'         => 'Fehler-Protokoll',
    'purch_email_admin' => 'Kaufbenachrichtigung an Admin',
    'def_enabled'   => 'Produkt ist verfügbar',
    'def_featured'  => 'Produkt als Aktion',
    'def_taxable'   => 'Produkt ist Steuerpflichtig',
    'def_track_onhand' => 'Lagerbestand anzeigen',
    'def_oversell'  => 'Wenn Lagerbestand = 0',
    'blk_random_limit' => 'Produkte im Zufall-Block Stk.',
    'blk_featured_limit' => 'Produkte im Aktion-Block Stk.',
    'blk_popular_limit' => 'Produkte im Beliebtest-Block Stk.',
    'def_expiration'    => 'Standardverfalltage für Downloads',
    'admin_email_addr' => 'Administrator E-Mail Adresse',
    'get_street' => 'Straße',
    'get_city'  => 'Ort',
    'get_state' => 'Staat',
    'get_postal' => 'Postleitzahl',
    'get_country' => 'Land',
    'ena_cart' => 'Warenkorb aktivieren',
    'weight_unit' => 'Gewichts-Einheit',
    'shop_name' => 'Shop Name',
    'shop_addr' => 'Shop Adresse',
    'shop_phone' => 'Shop Phone',
    'shop_email' => 'Shop E-Mail',
    'product_tpl_ver' => 'Vorlage Produkt-Ansicht',
    'list_tpl_ver' => 'Vorlage Produk-Liste',
    'cache_max_age' => 'Block-Zwischenspeicher (Sek.)',
    'tc_link' => 'Link zu Geschäftsbedingungen',
    'show_plugins' => 'Include plugin products in catalog?',
    'gc_enabled'    => 'Enable Gift Cards',
    'gc_exp_days'   => 'Default Gift Card Expiration (days)',
    'tax_rate'      => 'Tax Rate',
    'gc_letters'    => 'Use Letters',
    'gc_numbers'    => 'Use Numbers',
    'gc_symbols'    => 'Use Symbols',
    'gc_prefix'     => 'Use Prefix',
    'gc_suffix'     => 'Use Suffix',
    'gc_length'     => 'Code Length',
    'gc_mask'       => 'Code Mask',
);

/** Language strings for the subgroup names in the config section */
$LANG_configsubgroups['paypal'] = array(
    'sg_main' => 'Haupteinstellungen',
    'sg_shop'   => 'Shop-Informationen',
    'sg_gc'     => 'Gift Cards',
);

/** Language strings for the field set names in the config section */
$LANG_fs['paypal'] = array(
    'fs_main'   => 'Allgemein',
    'fs_images' => 'Bilder',
    'fs_paths'  => 'Bilder & Pfade',
    'fs_encbtn' => 'Temp.-Ordner',
    'fs_prod_defaults' => 'Produkt-Standarts',
    'fs_blocks' => 'Blöcke',
    'fs_debug'  => 'Fehlersuche',
    'fs_addresses' => 'Adress-Standart',
    'fs_shop'   => 'Shop-Details',
    'fs_gc'     => 'Gift Card Configuration',
    'fs_gc_format' => 'Gift Card Format',
);

/**
*   Language strings for the selection option names in the config section.
*
*   Item 4 is also used in functions.inc to provide a currency selector.
*/
$LANG_configselects['paypal'] = array(
    0 => array('Ja' => 1, 'Nein' => 0),
    1 => array('Ja' => TRUE, 'Nein' => FALSE),
    2 => array('Ja' => 1, 'Nein' => 0),
    3 => array('Nie' => 0, 'Immer' => 1, 'Benutzer' => 2),
    4 => array('USD - US Dollar' => 'USD',
				'AUD - Australische Dollar' => 'AUD',
				'CAD - Canadische Dollar' => 'CAD',
				'EUR - Euro' => 'EUR',
				'GBP - Britische Pfund' => 'GBP',
				'JPY - Japanische Yen' => 'JPY',
				'NZD - Neuseeländische Dollar' => 'NZD',
				'CHF - Schweizer Franken' => 'CHF',
				'HKD - Hong Kong Dollar' => 'HKD',
				'SGD - Singapur Dollar' => 'SGD',
				'SEK - Schwedische Krone' => 'SEK',
				'DKK - Dänische Krone' => 'DKK',
				'PLN - Polnischer Zloty' => 'PLN',
				'NOK - Norwegische Krone' => 'NOK',
				'HUF - Ungarischer Forint' => 'HUF',
				'CZK - Tschechische Krone' => 'CZK',
				'ILS - Israelische Schekel' => 'ILS',
				'MXN - Mexikanischer Peso' => 'MXN',
				'PHP - Philippinischer Peso' => 'PHP',
				'TWD - Neuer Taiwan-Dollar' => 'TWD',
				'THB - Thai Baht' => 'THB',
    ),
    5 => array('Name' => 'name', 'Preis' => 'price', 'Produkt-ID' => 'id'),
    6 => array('Immer' => 2, 'Materielle Produkte' => 1, 'Nie' => 0),
    12 => array('Kein Zugriff' => 0, 'Nur-Lesen' => 2, 'Lesen und Schreiben' => 3),
    13 => array('Keine Blöcke' => 0, 'Linke Blöcke' => 1, 'Rechte Blöcke' => 2, 'Linke & Rechte Blöcke' => 3),
    14 => array('Nicht verfügbar' => 0, 'Optional' => 1, 'Erforderlich' => 2),
    15 => array('Pfund' => 'lbs', 'Kilogramm' => 'kgs'),
    16 => array('Anzeigen mit Bestellmöglichkeit' => 0, 'Anzeigen ohne Bestellmöglichkeit' => 1, 'Nicht mehr anzeigen' => 2),
    17 => array('Upper-case' => 1, 'Lower-case' => 2, 'Mixed-case' => 3, 'None' => 0),
);


?>
