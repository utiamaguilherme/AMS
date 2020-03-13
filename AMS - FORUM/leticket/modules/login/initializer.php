<?php

session_start();

/*
$group = "__guest";

if(isset($_SESSION["username"]) && trim($_SESSION["username"]) != ""){
    
}
*/



function login_prevent_not_logged(){
    if(isset($_SESSION["username"]) && trim($_SESSION["username"]) != ""){
        $m = new Model("users");
        $m->load($_SESSION["uid"]);
        $cod = md5($m->get("username")."__".$m->get("password")); 
       
        if($cod == $_SESSION["uhash"]){
            return true;
        }
    }
    
    header("Location: ". getUrl("login", "dologin"));
    die();
}

function login_gotoNoPermission(){
    echo "No permission";
        die();
}

function login_onlyfor($usergroup){
    /*
    $m = new Model("usersgroups");
    $m->select(array("name"=>$usergroup));
    $id = $m->get("id");
     * 
     */
    if($_SESSION["ugroup"] !== $usergroup){
        login_gotoNoPermission();
    }
}

/**
 * A function to get details of the logged user.
 * id, username, name, groups_id and groups_name
 */
function login_getUserLogged(){
    return array(
        "id"=>$_SESSION["uid"],
        "username"=>$_SESSION["username"],
        "name"=>$_SESSION["name"],
        "groups_id"=>$_SESSION["ugroupid"],
        "groups_name"=>$_SESSION["ugroup"]
    );
}

/**
 * 
 * Retorna o nível de acesso do usuário:
 * admin ou user
 */
function login_getUserGroup(){
    return $_SESSION["groups_name"];
}

/**
 * 
 * NOT IMPLEMENTED
 * 
 * @param type $usergroup
 * 
 * 
 */
function login_onlyForAndAbove($usergroup){
    
}