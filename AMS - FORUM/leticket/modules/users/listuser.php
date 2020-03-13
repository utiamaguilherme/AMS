<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

no_direct_access();
login_prevent_not_logged();

$m = new Model("users");
$data = $m->select();
$g = new Model("usersgroups");
$rg = $g->select();
$groups=array();
foreach($rg as $k=>$v){
    $groups[$v["id"]] = $v["name"];
}


$v = new View("shared/view_top");
$v->render();

$v = new View("users/view_listuser");
$v->set("data", $data);
$v->set("groups", $groups);
if(isset($deleted)){
    $v->set("deleted",$deleted);
}
$v->render();

$v = new View("shared/view_bot");
$v->render();