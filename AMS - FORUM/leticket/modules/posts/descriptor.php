<?php

/*
 * TODO: Ajustar menus pelo nível de acesso.
 */

return array(
		"menuname" => "Posts",
		"submenus" => array(
			"Adicionar Posts"=>"addpost",
			"Listar Posts"=>"listpost",
			/*"Grupos e Permissões"=>"listgroup",*/
		),
    "cron"=>array("postscron.php")
	);
