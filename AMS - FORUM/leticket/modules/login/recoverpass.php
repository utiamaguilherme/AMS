<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$errlogin = false;
$success = false;
if (trim($_post["username"]) != "") {
    
    $m = new Model("users");
    //$r = $m->select(array("username"=>$_post["username"], "password"=>$_post["password"]));
    $uname = $_post["username"];
    
    $r = $m->select(array("username"=>$uname));
    
    //$r = $m->query_ar("select u.id,u.username,password,usersgroups_id,g.name,u.name as uname from users as u, usersgroups as g where username=\"$uname\" and password=\"$pass\" and u.usersgroups_id = g.id");
    //print_r($r);
    
    //echo "select u.id,u.username as username,u.password as password,usersgroups_id,g.name from users as u, usersgroups as g where username=\"$uname\" and password=\"$pass\" and u.usersgroups_id = g.id";
    if(count($r) == 1){
        $pass = $r[0]["password"];
        //envia email
        $v = new View('login/passrecover.tpl', MODE_BYREPLACE);
        $v->set("username", $uname);
        $v->set("password", $pass);
        $v->set("companyname", COMPANY_NAME);
        $v->set("SYS_URL", SYS_URL);
        $e = $v->getrender();
        $e = explode("[[E-MAIL_BREAK]]", $e);
        
        $to_ar = array($uname);
        $subject = "Recuperação de Senha";
        
        $success = sendHtmlEmail($to_ar, $subject,$e[0], $e[1]);
    }else{
        $errlogin = true;
    }
    
}

$v = new View("shared/view_top");
$v->set("no_header",true);
$v->render();

$v = new View("login/view_recoverpass");
$v->set("errlogin",$errlogin);
$v->set("success",$success);
$v->render();

$v = new View("shared/view_bot");
$v->set("no_header",true);
$v->render();
