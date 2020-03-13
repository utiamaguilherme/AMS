<?php
/*
function url_get_contents ($Url) {
    if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
*/
//echo url_get_contents ("http://www.blbean.com/suporte/index.php?contr=guestservice&action=crontask");


//**************** NOVO

require_once "config/config.php";
require_once "config/localconfig.php";
require_once "library/sharedf.php";



define("INDEX_PROCEDURE", true);
escapeInput();

//Call modules crons

foreach ($cfg_modules as $v) {
    $fname = "modules/" . $v . "/descriptor.php";
    if(file_exists($fname)){
		$d = require_once $fname;
		if(in_array('cron', $d)){
			echo "Running cron: [".$fname."] -----------<br/>\n";
			require_once $d["cron"];
			echo "End cron: [".$fname."]----------------<br/>\n";
		}
    }
}

