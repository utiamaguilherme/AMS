<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

no_direct_access();
login_prevent_not_logged();

$m = new Model("posts");
$data = $m->query_ar("select posts.id, title, description, datecreate, username from posts INNER JOIN users ON users.id = posts.users_id;");


$v = new View("shared/view_top");
$v->render();

$v = new View("posts/view_listpost");
$v->set("data", $data);
if(isset($deleted)){
    $v->set("deleted",$deleted);
}
$v->render();

$v = new View("shared/view_bot");
$v->render();