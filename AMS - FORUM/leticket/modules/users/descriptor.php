<?php

/*
 * TODO: Ajustar menus pelo nível de acesso.
 */

$us = login_getUserLogged();


if($us["groups_name"] == 'admin'){
    


return array(
		"menuname" => "Usuários",
		"submenus" => array(
			"Adicionar Usuário"=>"adduser",
			"Listar Usuários"=>"listuser",
			/*"Grupos e Permissões"=>"listgroup",*/
		)
	);
}else{
    return array();
}
