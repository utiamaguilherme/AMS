<?php

no_direct_access();
login_prevent_not_logged();

$save = null;
$data = null;

/*
if (trim($_get["id"]) != "") {
    $m = new Model("answers");
    $m->load($_get["id"]);
    $data = $m->getAll();
}
 * */



function saveanswer() {
    global $_post;
    global $data;
    
    $data = $_post;
    $m = new Model("answers");
    if (trim($_post["id"])!="") {
        if(!$m->load($_post["id"])) return false;
    }else{        
        
    }
    $m->setAll($_post);
    
    $u = login_getUserLogged();
        
        $m->set("users_id", $u["id"]);
        
    $r = $m->persist();
    $data = $m->getAll();
    
    return $r;
}



if (trim($_post["content"]) != "") {
    $save = saveanswer();
    /*
    //send e-mail for all, except the answer onwer.
    $u = login_getUserLogged();
    $tm = new Model("tickets");
    $tm->load($_get["tid"]);
    $ticket = $tm->getAll();
    $um = new Model("users");
    $users = $um->query_ar("(select u.id, u.username from users as u, tickets as t, tickets_users as tu"
        . " where tu.users_id = u.id and tu.tickets_id = t.id and t.id = ".$_get["tid"].") "
            . "UNION ("
            . "select u.id, u.username from users as u where u.id='".$ticket["creator_users_id"]."')");
    
    
    
    
    
    $to_ar = array();
    foreach($users as $k=>$v){
        if($v["id"] != $u["id"]){
            array_push($to_ar, $v["username"]);
        }
    }
    if($u["username"] != RECEIVED_TICKET_EMAIL){
    if(!in_array(RECEIVED_TICKET_EMAIL,$to_ar)){
        array_push($to_ar,RECEIVED_TICKET_EMAIL);
        
    }
    }
    
    $subject="Nova Resposta em #".$ticket["cod"];
    
    $v = new View('tickets/answeremail.tpl', MODE_BYREPLACE);
    $v->set("name",$u["name"]);
    $v->set("username",$u["username"]);
    $v->set("ticket_name",$ticket["title"]);
    
    $v->set("SYS_URL",SYS_URL);
    $e = explode("[[E-MAIL_BREAK]]",$v->getrender());
    
    $con = str_replace("\n", "<br/>", $_post["content"]);
    $e[0] = str_replace("[[answer]]", $con, $e[0]);
    $e[1] = str_replace("[[answer]]", $_post["content"], $e[1]);
    
    //html/plain $_post["content"]
    
    sendHtmlEmail($to_ar, $subject, $e[0], $e[1]);
     * 
     */
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