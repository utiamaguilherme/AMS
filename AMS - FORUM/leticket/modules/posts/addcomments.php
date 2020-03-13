<?php

no_direct_access();
login_prevent_not_logged();

$save = null;

$data = null;

if (trim($_get["id"]) != "") {
    $m = new Model("comments");
    $m->load($_get["id"]);
    $data = $m->getAll();
}

function savecomments() {
  global $_post;
    global $data;
    
    $data = $_post;
    $m = new Model("comments");
    if (trim($_post["id"])!="") {
        if(!$m->load($_post["id"])) return false;
    }else{        
        
    }
    $m->setAll($_post);
    
    $u = login_getUserLogged();
        
        $m->set("users_id", $u["id"]);
        
    $r = $m->persist();
    $data = $m->getAll();
    
    return $r;
}

if (trim($_post["content"]) != "") {
    $save = savecomments();
    
}

