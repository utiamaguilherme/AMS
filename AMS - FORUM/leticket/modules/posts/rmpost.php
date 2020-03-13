<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

no_direct_access();
login_prevent_not_logged();

$m = new Model("posts");
$m->load($_GET["id"]);
$deleted = $m->delete();

require_once "modules/posts/listpost.php";

/*
$v = new View("shared/view_top");
$v->render();

$v = new View("users/view_listpost");
$v->set("data", $data);
$v->render();

$v = new View("shared/view_bot");
$v->render();
*/