<?php
/**
 * DATABASE
 */
if (strpos($_SERVER['HTTP_HOST'], "localhost")) {
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_USER", "root");
    define("CONF_DB_PASS", "");
    define("CONF_DB_NAME", "workcontrol");
}else{
    define("CONF_DB_HOST", "tecnologia3ws.mysql.dbaas.com.br");
    define("CONF_DB_USER", "tecnologia3ws");
    define("CONF_DB_PASS", "Mai081051049");
    define("CONF_DB_NAME", "tecnologia3ws");
}

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.3wstecnologia.com.br");
define("CONF_URL_TEST", "https://www.localhost/servicecontrol");

/**
 * SITE
 */
define("CONF_SITE_NAME", "3wstecnologia");
define("CONF_SITE_TITLE", "Desenvolvimento de Software");
define("CONF_SITE_DESC",
    "A 3wstecnologia é uma empresa de desenvolvimento de software e aplicativos movéis");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "3wstecnologia.com.br");
define("CONF_SITE_ADDR_STREET", "");
define("CONF_SITE_ADDR_NUMBER", "");
define("CONF_SITE_ADDR_COMPLEMENT", "");
define("CONF_SITE_ADDR_CITY", "Londrina");
define("CONF_SITE_ADDR_STATE", "PR");
define("CONF_SITE_ADDR_ZIPCODE", "");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "@creator");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@creator");
define("CONF_SOCIAL_FACEBOOK_APP", "5555555555");
define("CONF_SOCIAL_FACEBOOK_PAGE", "pagename");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "author");
define("CONF_SOCIAL_GOOGLE_PAGE", "5555555555");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "5555555555");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "3wstecnologia.com.br");
define("CONF_SOCIAL_WHATSAPP", "@3wstecnologia");
define("CONF_SOCIAL_YOUTUBE_PAGE", "youtube");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "cafeweb");
define("CONF_VIEW_QRCODE", "cafeqrcode");
define("CONF_VIEW_APP", "cafeapp");
define("CONF_VIEW_WORK", "cafework");
define("CONF_VIEW_ADMIN", "cafeadm");
define("CONF_VIEW_CLINICA", "cafeclinica");
define("CONF_VIEW_CLINIC", "cafeclinic");

/**
 * UPLOAD
 */
 
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * Qrcode
 */
define("CONF_QRCODE_URL", "https://www.localhost/industria/"); 
define("CONF_QRCODE_DIR", "storage");
define("CONF_QRCODE_INFO_DIR", "qrcodeinfo");
 define("CONF_QRCODE_SUPPORT_DIR", "qrcodesupport");


/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "email-ssl.com.br");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "contato@3wstecnologia.com.br");
define("CONF_MAIL_PASS", "M@icon081051049");
define("CONF_MAIL_SENDER", ["name" => "3WSTECNOLOGIA", "address" => "contato@3wstecnologia.com.br"]);
define("CONF_MAIL_SUPPORT", "contato@3wstecnologia.com.br");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");
/**
 * PAGAR.ME
 */
define("CONF_PAGARME_MODE", "test");
define("CONF_PAGARME_LIVE", "ak_live_*****");
define("CONF_PAGARME_TEST", "ak_test_*****");
define("CONF_PAGARME_BACK", CONF_URL_BASE . "/pay/callback");