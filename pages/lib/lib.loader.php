<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */


//load class
require_once 'pages/lib/HTMLPurifier/HTMLPurifier.auto.php';


//load lib settings
$HTML_PURIFIER_CONFIG = HTMLPurifier_Config::createDefault();
$HTML_PURIFIER_CONFIG->set('URI.AllowedSchemes',
    array(
        'http' => true,
        'https' => true,
        'mailto' => true,
        'ftp' => true,
        'nntp' => true,
        'news' => true,
        'data' => true,
        'market' => true,
    ));
//$HTML_PURIFIER_CONFIG->set('HTML.Allowed', 'u,p,b,i,span[style],p,strong,em,li,ul,ol,div[align],br,img');
//$HTML_PURIFIER_CONFIG->set('HTML.AllowedAttributes', 'src, height, width, alt');

//load apis
$HTML_PURIFIER = new HTMLPurifier($HTML_PURIFIER_CONFIG);