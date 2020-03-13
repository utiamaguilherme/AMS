<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$errlogin = false;
if (trim($_post["username"]) != "") {
    
    $m = new Model("users");
    //$r = $m->select(array("username"=>$_post["username"], "password"=>$_post["password"]));
    $uname = $_post["username"];
    $pass = $_post["password"];
    $r = $m->query_ar("select u.id,u.username,password,usersgroups_id,g.name,u.name as uname from users as u, usersgroups as g where username=\"$uname\" and password=\"$pass\" and u.usersgroups_id = g.id");
    print_r($r);
    
    //echo "select u.id,u.username as username,u.password as password,usersgroups_id,g.name from users as u, usersgroups as g where username=\"$uname\" and password=\"$pass\" and u.usersgroups_id = g.id";
    if(count($r) == 1){
        $_SESSION["uid"]=$r[0]["id"];
        $_SESSION["username"]=$r[0]["username"];
        $_SESSION["name"]=$r[0]["uname"];
        $_SESSION["ugroupid"] = $r[0]["usersgroups_id"];
        $_SESSION["ugroup"] = $r[0]["name"];
        $_SESSION["uhash"]=md5($r[0]["username"]."__".$r[0]["password"]);
        //print_r($r[0]);
        header("Location: index.php");
        die();
    }
    $errlogin = true;
}

$v = new View("shared/view_top");
$v->set("no_header",true);
$v->render();

$v = new View("login/view_dologin");
$v->set("errlogin",$errlogin);
$v->render();

$v = new View("shared/view_bot");
$v->set("no_header",true);
$v->render();
