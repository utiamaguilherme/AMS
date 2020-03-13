<?php
no_direct_access();
?>

<h1>
    Listagem
</h1>

<?php if ($deleted != null) { ?>
    <?php
    $cl = ($deleted == true) ? "box_success" : "box_error";
    ?>
    <div class="<?php echo $cl; ?>">
        <?php if ($deleted) { ?>
            Excluído com sucesso.
        <?php } else { ?>
            Ops, ocorreu um erro ao excluir.
        <?php } ?>
    </div>
<?php } ?>

<table class="table row-border row-hover compact">
    <thead>
    <tr>
        <th class="sortable-column">Username</th>
        <th class="sortable-column">Nome</th>
        
        <th class="sortable-column">Acesso</th>
        <th class="sortable-column">Cadastrado em</th>
        
        <th> &nbsp; </th>
    </tr>
    </thead>
    <?php if(count($data)>0){ ?>
    <tbody>
    <?php foreach($data as $v){ ?>
    
    <tr>
        <td><?php echo $v["username"]; ?></td>
        <td><?php echo $v["name"]; ?></td>
        
        <td><?php echo $groups[$v["usersgroups_id"]]; ?></td>
        <td><?php echo $v["datacad"]; ?></td>
        
        <td><a href="<?php egetUrl("users","adduser", array("id"=>$v["id"])); ?>"><?php eGetImg("icon_edit.png","Editar","16px") ?></a> 
            &nbsp; &nbsp; 
            <a href="<?php egetUrl("users","rmuser", array("id"=>$v["id"])); ?>"
               onclick="return confirm('Deseja excluir  <?php echo $v["username"]; ?>')"
               ><?php eGetImg("icon_remove.png","Excluir","16px") ?></a> </td>
    </tr>
    <?php } ?>
    </tbody>
    <?php }else{ ?>
    <tr><td colspan="0">Sem dados!</td></tr>
    <?php } ?>
</table>


