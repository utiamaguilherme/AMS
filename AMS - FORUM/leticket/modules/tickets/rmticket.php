<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

no_direct_access();
//login_prevent_not_logged();
login_onlyfor("admin");

$m = new Model("tickets");
$m->query("delete from tickets_users where tickets_id='".$_get["id"]."'");
$m->query("delete from answers where tickets_id='".$_get["id"]."'");

$m->load($_get["id"]);

$deleted = $m->delete();

require_once "modules/tickets/listticket.php";

/*
$v = new View("shared/view_top");
$v->render();

$v = new View("users/view_listticket");
$v->set("data", $data);
$v->render();

$v = new View("shared/view_bot");
$v->render();
*/