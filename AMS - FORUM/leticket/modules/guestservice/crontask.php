<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 * Essas tarefas cron devem rodar a cada 5min
 * 
 */

/******************** ENVIA E-MAIL PARA CADA RESPOSTA *************************/
/**
 * 
 * id,content,users_id,datecreate,title,status,cod,author,author_name,emails
 * 
 SELECT
  a.id,
  a.content,
  a.users_id,
  a.datecreate,
  t.title,
  t.status,
  t.cod,
  u2.username as author,
  u2.name as author_name,
 GROUP_CONCAT(u.username SEPARATOR ',') as emails
FROM
  tickets AS t,
  answers AS a,
  users AS u,
  users AS u2,
  tickets_users AS tu
WHERE
  a.tickets_id = t.id AND
  (
    (tu.users_id = u.id AND tu.tickets_id = t.id)
    OR
    (t.creator_users_id = u.id AND tu.users_id = '' AND tu.tickets_id = '') 
  )
  AND a.emailsent = 0 
  AND NOT(u.id = a.users_id)
  AND u2.id = a.users_id
GROUP BY a.content

 */

echo "------- Email de cada resposta ---------";

$am = new Model("answerstosend");
$an = $am->select();
if(count($an)>0){
foreach($an as $k=>$r){
    $subject="Nova Resposta em #".$r["cod"];
    
    $v = new View('tickets/answeremail.tpl', MODE_BYREPLACE);
    $v->set("name",$r["author_name"]);
    $v->set("username",$r["author"]);
    $v->set("ticket_name",$r["title"]);
    
    $v->set("SYS_URL",SYS_URL);
    $e = explode("[[E-MAIL_BREAK]]",$v->getrender());
    
    $con = str_replace("\n", "<br/>", $r["content"]);
    $e[0] = str_replace("[[answer]]", $con, $e[0]);
    $e[1] = str_replace("[[answer]]", $r["content"], $e[1]);
    
    //html/plain $_post["content"]
    $to_ar = explode(',',$r["emails"]);
    
    
    if(sendHtmlEmail($to_ar, $subject, $e[0], $e[1])){
        $a = new Model('answers');
        $a->load($r["id"]);
        $a->set("emailsent",'1');
        $a->persist();
        
    }
   
}
}

/****** ENVIA E-MAIL INFORMANDO AO USUÁRIO QUE ESTÁ CADASTRADO NUM TICKET ******/

/**
 * 
SELECT
  t.cod,
  t.title,
  t.id as tid,
  u.username,
  u.name,
  u.id as uid,
  tu.id AS tuid
FROM
  tickets AS t,
  tickets_users AS tu,
  users AS u
WHERE
  (
    tu.users_id = u.id AND tu.tickets_id = t.id
  ) OR(
    t.creator_users_id = u.id AND tu.users_id = '' AND tu.tickets_id = '' AND NOT(t.emailsentto = t.creator_users_id)
  ) AND tu.emailsent = 0
 * 
 */
echo "------- Email de ticket criado ---------";

$urm = new Model('usersrelatedtoticket');
$ur = $urm->select();

if(count($ur)>0){
foreach($ur as $k=>$r){
    $subject="Colaboração no Ticket #".$r["cod"].": ". substr($r["title"], 0, 100);
    $v = new View('tickets/emailaddusertoticket.tpl', MODE_BYREPLACE);
    $v->set("name",$r["name"]);
    $v->set("username",$r["username"]);
    $v->set("title",$r["title"]);
    $v->set("cod",$r["cod"]);
    
    $v->set("SYS_URL",SYS_URL);
    $e = explode("[[E-MAIL_BREAK]]",$v->getrender());
    

    
    //html/plain $_post["content"]
    $to_ar = array($r["username"]);
    
    
    if(sendHtmlEmail($to_ar, $subject, $e[0], $e[1])){
        $a = new Model('tickets_users');
        if($r["tuid"] != "abcdef"){
            $a->query("update tickets_users set emailsent=1 where id='".$r["tuid"]."'");
        }else{
            $a->query("update tickets set emailsentto='".$r["uid"]."' where id='".$r["tid"]."'");
        }
    }
}
}