<?php

no_direct_access();
login_prevent_not_logged();

$save = null;

$data = null;

if (trim($_get["id"]) != "") {
    $m = new Model("posts");
    $m->load($_get["id"]);
    $data = $m->getAll();
}

function savepost() {
    global $_post;
    global $data;
    
    $data = $_post;
    $m = new Model("posts");
    if ($_post["id"]) {
        if(!$m->load($_post["id"])) return false;
    }
    $m->setAll($_post);
    $u =  login_getUserLogged();
    $m->set("users_id", $u["id"]);
    $r = $m->persist();
    $data = $m->getAll();
    
    return $r;
}

if (trim($_post["title"]) != "") {
    $save = savepost();
    
}

$v = new View("shared/view_top");
$v->render();

$v = new View("posts/view_addpost");
$v->set("save", $save);
$v->set("data", $data);
$v->render();

$v = new View("shared/view_bot");
$v->render();
