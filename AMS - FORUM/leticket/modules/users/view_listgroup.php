<?php
no_direct_access();
?>

<h1>
    Listagem
</h1>

<a class="button-green" href="<?php egetUrl("users","addgroup"); ?>">Novo Grupo</a>
<a class="button-green" href="<?php egetUrl("users","addgroup"); ?>">Novo Grupo</a>

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

<table class="table1">
    <tr>
        <th>name</th>
        <th>description</th>
        <th>power</th>
        
        <th> &nbsp; </th>
    </tr>
    <?php if(count($data)>0){ ?>
    <?php foreach($data as $v){ ?>
    <tr>
        <td><?php echo $v["name"]; ?></td>
        <td><?php echo $v["description"]; ?></td>
        <td><?php echo $v["power"]; ?></td>
        
        <td><a href="<?php egetUrl("users","addgroup", array("id"=>$v["id"])); ?>">Editar</a> 
            &nbsp; &nbsp; 
            <a href="<?php egetUrl("users","rmgroup", array("id"=>$v["id"])); ?>"
               onclick="return confirm('Deseja excluir  <?php echo $v["name"]; ?>')"
               >Excluir</a> </td>
    </tr>
    <?php } ?>
    <?php }else{ ?>
    <tr><td colspan="0">Sem dados!</td></tr>
    <?php } ?>
</table>


