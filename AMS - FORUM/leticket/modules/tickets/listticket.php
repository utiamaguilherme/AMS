<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

no_direct_access();
login_prevent_not_logged();

$m = new Model("tickets");
//$data = $m->select();

$u = login_getUserLogged();
$data=array();
if($u["groups_name"] == 'admin'){
$data = $m->query("select t.id, t.title, t.datacad, t.status, ticketcategories_id, t.cod, "
        . "u.name, u.username from tickets as t, users as u "
        . "where t.creator_users_id=u.id order by datacad DESC");
}else{
    $data = $m->query("(select t.id, t.title, t.datacad, t.status, ticketcategories_id, t.cod, "
        . "u.name, u.username from tickets as t, users as u, users as u2, tickets_users as tu "
        . "where t.creator_users_id=u.id "
            . "and tu.users_id = u2.id and tu.tickets_id = t.id and u2.id = ".$u["id"]
            .") UNION ("
            . "select t.id, t.title, t.datacad, t.status, ticketcategories_id, t.cod, "
        . "u.name, u.username from tickets as t, users as u "
        . "where t.creator_users_id=u.id and u.id=".$u["id"].") order by datacad DESC");
}


$v = new View("shared/view_top");
$v->render();

$v = new View("tickets/view_listticket");
$v->set("data", $data);
if(isset($deleted)){
    $v->set("deleted",$deleted);
}
$v->render();

$v = new View("shared/view_bot");
$v->render();