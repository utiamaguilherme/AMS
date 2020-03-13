<?php



function user_sendAccessInfoEmail($username){
    
}

/**
 * 
 * @param type $email E-mail do usuário
 * 
 * Verifica se existe o usuário, senão cria.
 * 
 * Se teve que criar, retorna true.
 * 
 */
function user_addIfNotExists($email){
    $u = new Model("users");
    $r = $u->select(array("username"=>$email));
    if(count($r)==0){
        $u->set("username", $email);
        $u->set("usersgroups_id", "2");
        $pwd = bin2hex(openssl_random_pseudo_bytes(4));
        $u->set("password",$pwd);
        $u->persist();
        return true;
       // print_r($u->getAll());
    }
    return false;
    
}