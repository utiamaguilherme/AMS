<?php

no_direct_access();
login_prevent_not_logged();

$save = null;

$data = null;

if (trim($_get["id"]) != "") {
    $m = new Model("tickets");
    $m->load($_get["id"]);
    $data = $m->getAll();
    if (trim($data["creator_users_id"]) != "") {
        $u = new Model("users");
        $u->load($data["creator_users_id"]);
        $data["username"] = $u->get("username");
    }
}

$ticket_onwer = '';
$must_send_email = false;

function saveticket() {
    global $_post;
    global $data;
    global $ticket_onwer;
    global $must_send_email;
    echo "save";
    $changeStatus=false;
    $data = $_post;
    $m = new Model("tickets");
    if (isset($_post["id"]) && $_post["id"]!="") {
        if (!$m->load($_post["id"])) {            
            return false;
        }
        if($_post["status"] != $m->get("status")){
            $changeStatus=true;
            
        }
    } else {
        $must_send_email = true;
    }
    
    


    $m->setAll($_post);
    if ($_post["status"] == "") {
        $m->set("status", "Em Aberto");
    }

    //if (trim($_post["id"]) == "") {
    $u = login_getUserLogged();

    if ($u["groups_name"] != 'admin') {
        if (trim($_post["id"]) == "") {
            $u = login_getUserLogged();
            $m->set("creator_users_id", $u["id"]);
            $ticket_onwer = $u["username"];
        }
    } else {
        $mu = new Model("users");
        $ru = $mu->select(array("username" => $_post["username"]));
        if (count($ru) == 0) {

            return false;
        }
        
        $m->set("creator_users_id", $ru[0]["id"]);
        $ticket_onwer = $ru[0]["username"];
    }
    //}
    $r = $m->persist();
    $data = $m->getAll();
    $data["username"] = $_post["username"];
    
    if($changeStatus){
        $m = new Model("answers");
        $m->set("content","O status desse ticket foi alterado para **".$data["status"]."**");
        $m->set("tickets_id", $data["id"]);
        $m->set("users_id", $u["id"]);
        $m->persist();
    }

    return $r;
}

if (trim($_post["title"]) != "") {
    $save = saveticket();
    if ($save) {
        //send e-mail for notice
       if($must_send_email){

        $to_ar = array(RECEIVED_TICKET_EMAIL);
        $subject = "Novo Ticket cadastrado.";
        $v = new View('tickets/addticketmail.tpl', MODE_BYREPLACE);
        $u= login_getUserLogged();
        $v->set("name", $u["name"]);
        $v->set("username", $u["username"]);
        $v->set("ticket_name", $_post["title"]);

        $v->set("SYS_URL", SYS_URL);
        $e = explode("[[E-MAIL_BREAK]]", $v->getrender());
        sendHtmlEmail($to_ar, $subject, $e[0], $e[1]);
       }

        header("Location: " . getUrl("tickets", "listanswer", array("tid" => $data["id"])));
        die();
    }
}

$v = new View("shared/view_top");
$v->render();

$v = new View("tickets/view_addticket");
$v->set("save", $save);
$v->set("data", $data);
$v->render();

$v = new View("shared/view_bot");
$v->render();
