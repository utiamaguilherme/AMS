<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function generateCRUD($modulename, $suffix, $table, $fields, $checkfield){
    
    //Generate C and U
    $c = file_get_contents("add.tpl.php");
    $c = str_replace("[[modulename]]", $modulename, $c);
    $c = str_replace("[[suffix]]", $suffix, $c);
    $c = str_replace("[[table]]", $table, $c);
    $c = str_replace("[[checkfield]]", $checkfield, $c);
    
    $f = fopen("temp/add".$suffix.".php","w");
    fwrite($f, $c);
    fclose($f);
    
    $tpl_field= '<label>[[field]]</label>
    <input type="text" name="[[field]]" 
    value="<?php echo (isset($data["[[field]]"])) ? $data["[[field]]"] : ""; ?>"/>';
    
    $html_fields = "";
    foreach($fields as $v){
        $fi = str_replace("[[field]]", $v, $tpl_field);
        $html_fields = $html_fields.$fi;
    }   
    
    $c = file_get_contents("view_add.tpl.php");
    $c = str_replace("[[modulename]]", $modulename, $c);
    $c = str_replace("[[suffix]]", $suffix, $c);
    $c = str_replace("[[fields]]", $html_fields, $c);
    
    $f = fopen("temp/view_add".$suffix.".php","w");
    fwrite($f, $c);
    fclose($f);
    ////////////////////////////////////
    //
    //Generate R
    $tpl_header="<th>[[field]]</th>";
    $html_header = "";
    foreach($fields as $v){
        $fi = str_replace("[[field]]", $v, $tpl_header);
        $html_header = $html_header.$fi."\n        ";
    }
    
    
    
    $tpl_row="";
    $tpl_cel='<td><?php echo $v["[[field]]"]; ?></td>';
    $tpl_buttons = '<td><a href="<?php egetUrl("[[modulename]]","add[[suffix]]", array("id"=>$v["id"])); ?>">Editar</a> 
            &nbsp; &nbsp; 
            <a href="<?php egetUrl("[[modulename]]","rm[[suffix]]", array("id"=>$v["id"])); ?>"
               onclick="return confirm(\'Deseja excluir  <?php echo $v["[[checkfield]]"]; ?>\')"
               >Excluir</a> </td>';
    $tpl_buttons = str_replace("[[suffix]]", $suffix, $tpl_buttons);
    $tpl_buttons = str_replace("[[checkfield]]", $checkfield, $tpl_buttons);
    $tpl_buttons = str_replace("[[modulename]]", $modulename, $tpl_buttons);
    
    foreach($fields as $v){
        $fi = str_replace("[[field]]", $v, $tpl_cel);
        $tpl_row = $tpl_row.$fi."\n        ";
    }
    $tpl_row="<tr>"."\n        ".$tpl_row."\n        ".$tpl_buttons."\n    </tr>";
    
    $c = file_get_contents("view_list.tpl.php");
    $c = str_replace("[[headers]]", $html_header, $c);
    $c = str_replace("[[row]]", $tpl_row, $c);
    
    $f = fopen("temp/view_list".$suffix.".php","w");
    fwrite($f, $c);
    fclose($f);
    
    
    $c = file_get_contents("list.tpl.php");
    
    $c = str_replace("[[suffix]]", $suffix, $c);
    $c = str_replace("[[table]]", $table, $c);
    $c = str_replace("[[modulename]]", $modulename, $c);
    
    
    $f = fopen("temp/list".$suffix.".php","w");
    fwrite($f, $c);
    fclose($f);
    
    ////////////////////////////////////
    //
    //Generate D
    $c = file_get_contents("rm.tpl.php");
    $c = str_replace("[[suffix]]", $suffix, $c);
    $c = str_replace("[[table]]", $table, $c);
    $c = str_replace("[[modulename]]", $modulename, $c);
    
    
    $f = fopen("temp/rm".$suffix.".php","w");
    fwrite($f, $c);
    fclose($f);
    
    
}

//generateCRUD("users", "user", "users", array("username", "password", "datacad"), "username");
//generateCRUD("users", "group", "usersgroups", array("name", "description", "power"), "name");
//generateCRUD("posts","post","posts",array("title","description"), "title");
//generateCRUD("posts","comments","comments",array("content"), "content");