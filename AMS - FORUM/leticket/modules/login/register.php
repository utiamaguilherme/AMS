<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$err=0;
if (trim($_post["username"]) != "") {
    $m = new Model("users");
    $r=$m->select(array("username"=>$_post["username"]));
    if(count($r)>0){
        $err = -1;
    }else{
        $m->set("username",$_post["username"]);
        $m->set("password",$_post["password"]);
        $m->set("name",$_post["name"]);
        $m->set("usersgroups_id",'2');
        if($m->persist()){
            $err = 1;
            $_post["password"] = $m->get("password");
            require_once "modules/login/dologin.php";
            die();
        }
    }
}


$v = new View("shared/view_top");
$v->set("no_header",true);
$v->render();

$v = new View("login/view_register");
$v->set("err",$err);
$v->render();

$v = new View("shared/view_bot");
$v->set("no_header",true);
$v->render();
