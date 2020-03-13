<?php

no_direct_access();
login_prevent_not_logged();

$save = null;

$data = null;

if (trim($_get["id"]) != "") {
    $m = new Model("[[table]]");
    $m->load($_get["id"]);
    $data = $m->getAll();
}

function save[[suffix]]() {
    global $_post;
    global $data;
    
    $data = $_post;
    $m = new Model("[[table]]");
    if ($_post["id"]) {
        if(!$m->load($_post["id"])) return false;
    }
    $m->setAll($_post);
    $r = $m->persist();
    $data = $m->getAll();
    
    return $r;
}

if (trim($_post["[[checkfield]]"]) != "") {
    $save = save[[suffix]]();
    
}

$v = new View("shared/view_top");
$v->render();

$v = new View("[[modulename]]/view_add[[suffix]]");
$v->set("save", $save);
$v->set("data", $data);
$v->render();

$v = new View("shared/view_bot");
$v->render();
