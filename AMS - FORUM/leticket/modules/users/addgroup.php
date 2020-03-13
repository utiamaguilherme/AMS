<?php

no_direct_access();
login_prevent_not_logged();

$save = null;

$data = null;

if (trim($_get["id"]) != "") {
    $m = new Model("usersgroups");
    $m->load($_get["id"]);
    $data = $m->getAll();
}

function saveuser() {
    global $_post;
    global $data;
    
    $data = $_post;
    $m = new Model("usersgroups");
    if ($_post["id"]) {
        if(!$m->load($_post["id"])) return false;
    }
    $m->setAll($_post);
    $r = $m->persist();
    $data = $m->getAll();
    
    return $r;
}

if (trim($_post["name"]) != "") {
    $save = saveuser();
    
}

$v = new View("shared/view_top");
$v->render();

$v = new View("users/view_addgroup");
$v->set("save", $save);
$v->set("data", $data);
$v->render();

$v = new View("shared/view_bot");
$v->render();
