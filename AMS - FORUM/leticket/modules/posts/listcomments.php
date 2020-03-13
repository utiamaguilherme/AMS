<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

no_direct_access();
login_prevent_not_logged();

require_once "modules/posts/addcomments.php";

$idpostagem = $_get['tid'];
$c = new Model("comments");
//$data = array();
//$data = $m->select(array("tickets_id"=>$_get["tid"]),"datecreate ASC");
$sq = "select comments.id, content, users.username, comments.users_id, datecreate from comments INNER JOIN users ON users.id = comments.users_id where post_id = ". $idpostagem;
$comentario = $c->query_ar($sq);



$p = new Model("posts");
$post= $p->query_ar("select id, title, description, datecreate from posts where id = $idpostagem");

$postagem = $post[0];



$v = new View("shared/view_top");
$v->render();

$v = new View("posts/view_listcomments");
$v->set("comentario", $comentario);
$v->set("postagem",$postagem);

if(isset($deleted)){
    $v->set("deleted",$deleted);
}
$v->render();

$v = new View("shared/view_bot");
$v->render();