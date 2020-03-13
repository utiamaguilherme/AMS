<?php

/*
 * TODO: Ajustar menus pelo nível de acesso.
 */

return array(
		"menuname" => "Tickets",
		"submenus" => array(
			"Adicionar Ticket"=>"addticket",
			"Listar Tickets"=>"listticket",
			/*"Grupos e Permissões"=>"listgroup",*/
		),
    "cron"=>array("ticketscron.php")
	);
