<?php

no_direct_access();
login_prevent_not_logged();

$us = login_getUserLogged();
if($us["groups_name"] != admin){
    if($us["id"] != $_get["id"] && $us["id"] != $_post["id"]){
        login_gotoNoPermission();
    }
}


$save = null;

$data = null;

if (trim($_get["id"]) != "") {
    $m = new Model("users");
    $m->load($_get["id"]);
    $data = $m->getAll();
}

function saveuser() {
    global $_post;
    global $data;
    
    $data = $_post;
    $m = new Model("users");
    if ($_post["id"]) {
        if(!$m->load($_post["id"])) return false;
    }
    if(trim($_post["password"])==""){
        unset($_post["password"]);
    }
    $m->setAll($_post);
    $r = $m->persist();
    $data = $m->getAll();
    
    return $r;
}

if (trim($_post["username"]) != "") {
    $save = saveuser();
    
}

$m = new Model("usersgroups");
$usersgroups = $m->select();

$v = new View("shared/view_top");
$v->render();

$v = new View("users/view_adduser");
$v->set("save", $save);
unset($data["password"]);
$v->set("data", $data);
$v->set("usersgroups", $usersgroups);
$v->render();

$v = new View("shared/view_bot");
$v->render();
