<?php

require_once "config/config.php";
require_once "config/localconfig.php";
require_once "library/sharedf.php";

define("INDEX_PROCEDURE", true);

escapeInput();

$controller = "";
if (!isset($_GET["contr"])) {
    header("Location: " . getUrl(DEFAULT_CONTROLLER));
    die();
} else {
    $controller = $_GET["contr"];
}

if (!isset($_GET["action"])) {
    $action = DEFAULT_ACTION;
} else {
    $action = $_GET["action"];
}

//Call modules initializers
//permissions login?
foreach ($cfg_modules as $v) {
    $fname = "modules/" . $v . "/initializer.php";
    if(file_exists($fname)){
    require_once $fname;
    }
}

require_once "modules/" . $controller . "/" . $action . ".php";
