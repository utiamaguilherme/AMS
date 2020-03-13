<?php

no_direct_access();
login_prevent_not_logged();

$saveusertoticket = null;
$data = null;

/*
if (trim($_get["id"]) != "") {
    $m = new Model("answers");
    $m->load($_get["id"]);
    $data = $m->getAll();
}
 * */



function saveusertoticket() {
    global $_post;
    global $_get;
    global $data;
    
    $mu = new Model("users");
    $ru =$mu->select(array("username"=>$_post["usermail"])); 
    if(count($ru) == 0){
        //return false;
        user_addIfNotExists($_post["usermail"]);
        $ru =$mu->select(array("username"=>$_post["usermail"])); 
        if(count($ru) == 0){
            return false;
        }
    }
   
    $m = new Model("tickets_users");
    $m->set("tickets_id",$_get["tid"]);
    $m->set("users_id", $ru[0]["id"]);
    if($m->persist()){
        return true;
    }
    
    
    return false;
}

if (trim($_post["usermail"]) != "") {
    $saveusertoticket = saveusertoticket();  
}

if(trim($_get["rmutid"])){
    $m = new Model("tickets_users");
    $m->load($_get["rmutid"]);
    $m->delete();
}

/*
$v = new View("shared/view_top");
$v->render();

$v = new View("tickets/view_addanswer");
 
$v->set("save", $save);
$v->set("data", $data);
$v->render();

$v = new View("shared/view_bot");
$v->render();
*/