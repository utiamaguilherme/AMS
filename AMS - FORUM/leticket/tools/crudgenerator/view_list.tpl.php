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

<table class="table1">
    <tr>
        [[headers]]
        <th> &nbsp; </th>
    </tr>
    <?php if(count($data)>0){ ?>
    <?php foreach($data as $v){ ?>
    [[row]]
    <?php } ?>
    <?php }else{ ?>
    <tr><td colspan="0">Sem dados!</td></tr>
    <?php } ?>
</table>


