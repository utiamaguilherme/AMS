<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

no_direct_access();
login_prevent_not_logged();

require_once "modules/tickets/addanswer.php";
require_once "modules/tickets/addusertoticket.php";

$m = new Model("answers");
//$data = array();
//$data = $m->select(array("tickets_id"=>$_get["tid"]),"datecreate ASC");
$sq = "select a.id, a.content, a.datecreate, u.username, u.name as uname from answers as a, users as u "
        ." where tickets_id=\"".$_get["tid"]."\" and a.users_id = u.id "
        ." order by datecreate ASC";
$data = $m->query_ar($sq);

$t = new Model("tickets");
$ticket = $t->query_ar("select t.id, t.title, t.description, t.datacad, t.status, "
        . "t.ticketcategories_id, t.creator_users_id, t.cod, u.name, u.username "
        . "from tickets as t, users as u "
        . "where t.creator_users_id = u.id and t.id = ".$_get["tid"]." ");
$ticket = $ticket[0];

$u = new Model("users");
$users = $u->query_ar("select tu.id, u.username from users as u, tickets as t, tickets_users as tu"
        . " where tu.users_id = u.id and tu.tickets_id = t.id and t.id = ".$_get["tid"]." ");


$v = new View("shared/view_top");
$v->render();

$v = new View("tickets/view_listanswer");
$v->set("data", $data);
$v->set("ticket",$ticket);
$v->set("users", $users);
if(isset($deleted)){
    $v->set("deleted",$deleted);
}
$v->render();


$v = new View("shared/view_bot");
$v->render();