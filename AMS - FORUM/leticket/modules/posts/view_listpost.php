<?php
no_direct_access();

$u = login_getUserLogged();
?>

<h1>
    Tickets
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

<table class="table row-border row-hover compact" id="tickettable">
    <thead>
    <tr>
        <th class="sortable-column" style="cursor:pointer" onclick="sortTable(0,'tickettable')">COD</th>
        <th >Assunto</th>
        
        <th class="sortable-column" style="cursor:pointer" onclick="sortTable(2,'tickettable')">Criado em</th>
        <th class="sortable-column" style="cursor:pointer" onclick="sortTable(3,'tickettable')">Criado por</th>
        <th class="sortable-column" style="cursor:pointer" onclick="sortTable(4,'tickettable')">Status</th>
        <th class="sortable-column" style="cursor:pointer" onclick="sortTable(5,'tickettable')">Tipo</th>
        <?php if($u["groups_name"]=="admin"){ ?>
        <th> &nbsp; </th>
        <?php } ?>
    </tr>
    </thead>
    <?php if(count($data)>0){ ?>
    <tbody>
    <?php foreach($data as $v){ ?>
    <tr>
        <td><?php echo str_pad($v["id"], 5, "0", STR_PAD_LEFT); ?></td>
        <td><a href="<?php egetUrl("posts","listcomments",array("tid"=>$v["id"])) ?>"><?php echo $v["title"]; ?></a></td>
        
        <td><?php echo $v["datacad"]; ?></td>
        <td><?php echo $v["username"]; ?></td>
        
        <?php if($u["groups_name"]=="admin"){ ?>
        <td style="text-align:right">
            
            <a class="button" role="button" href="<?php egetUrl("posts","addpost", array("id"=>$v["id"])); ?>">
                <span class="mif-pencil"></span>
            </a> 
            &nbsp; &nbsp; 
            <a class="button" role="button" href="<?php egetUrl("posts","rmpost", array("id"=>$v["id"])); ?>"
               onclick="return confirm('Deseja excluir  <?php echo $v["title"]; ?>')"
               ><span class="mif-bin"></span></a> </td>
        <?php } ?>
    </tr>
    <?php } ?>
    </tbody>
    <?php }else{ ?>
    <tr><td colspan="0">Sem dados!</td></tr>
    <?php } ?>
</table>


