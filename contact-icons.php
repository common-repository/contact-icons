<?php
/*
Plugin Name: Contact Icons
Plugin URI: http://wp.megablago.ru/wordpress-plugins/contact-icons
Description: Icons for your contact information: email, icq, skype, mobile, mts, beeline, life, kyivstar
Author: Yuri Lysenko
Version: 1.0.0
Author URI: http://wp.megablago.ru
License: A "Slug" license name e.g. GPL2
*/



function icon($n) {
  $n .= ".gif"; // TODO: if no gif-file, then try to find .png, .jpg ...
  return '<img style="border: 0; padding: 0; margin: 0; vertical-align: middle;" src="'.
    trailingslashit(WP_PLUGIN_URL).dirname(plugin_basename( __FILE__ )).'/i/16/'.$n.'" alt="" />';
}


function phones($s){
  $operators = array(
    '38039' => "goldentelecom",
    '38050' => "mts",
    '38063' => "life",
    '38066' => "mts",
    '38067' => "kyivstar",
    '38068' => "beeline",
    '38091' => "ukrtelecom",
    '38092' => "peoplenet",
    '38093' => "life",    
    '38094' => "intertelecom",
    '38095' => "mts",
    '38096' => "kyivstar",
    '38097' => "kyivstar",
    '38098' => "kyivstar",
    '38099' => "mts",

    '7903' => "beeline",
    '7905' => "beeline",
    '7906' => "beeline",
    '7909' => "beeline",
    '791' => "mts",
    '792' => "mts",
    '7930' => "mts",
    '7931' => "mts",
    '7932' => "mts",
    '7933' => "mts",
    '7934' => "mts",
    '7936' => "mts",
    '7937' => "mts",
    '7938' => "mts",
    '7960' => "beeline",
    '7961' => "beeline",
    '7962' => "beeline",
    '7963' => "beeline",
    '7964' => "beeline",
    '7965' => "beeline",
    '7966' => "beeline",
    '7967' => "beeline",
    '7968' => "beeline",
    '7980' => "mts",
    '7981' => "mts",
    '7982' => "mts",
    '7983' => "mts",
    '7984' => "mts",
    '7985' => "mts",
    '7987' => "mts",
    '7988' => "mts",
    '7989' => "mts",
    '7997' => "megafon",

    '7700' => "dalacom",
    '7701' => "kcell",
    '7702' => "kcell",
    '7775' => "kcell",
    '7705' => "beeline",
    '7777' => "beeline",

  );

  $d="[\- \.\(\)]*";
  foreach($operators as $code => $name) {
    $patterns[] = '/\+'.implode($d, str_split($code)).'/';
    $replacements[] = icon($name).'\0';
  }
  return preg_replace($patterns, $replacements, $s);
}


function emails($s){
  return preg_replace('/(\<a[ ]+.*href[ ]*=[ ]*[\'\"]?mailto:[^\'\"]*[\'\"]?[ ]*\>)([^\<]*)(\<\/a\>)/i', '\1'.icon('email').'\2\3', $s);
}

function ci_tag_icon_replace($content, $evt = NULL) {
  global $id, $post;

  $files = array_diff(scandir(dirname(__FILE__ )."/i/16/"), array('..', '.'));
  foreach($files as $key => $value)  {
    $i=pathinfo($value);
    $files[$key]=$i['filename'];
  }

  $s = phones($content);
  $s = emails($s);
  return $s;
}
//if (!is_admin()) 
add_filter('the_content', 'ci_tag_icon_replace');



?>