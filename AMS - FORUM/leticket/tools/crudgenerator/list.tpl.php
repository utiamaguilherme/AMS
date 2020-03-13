<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

no_direct_access();
login_prevent_not_logged();

$m = new Model("[[table]]");
$data = $m->select();


$v = new View("shared/view_top");
$v->render();

$v = new View("[[modulename]]/view_list[[suffix]]");
$v->set("data", $data);
if(isset($deleted)){
    $v->set("deleted",$deleted);
}
$v->render();

$v = new View("shared/view_bot");
$v->render();