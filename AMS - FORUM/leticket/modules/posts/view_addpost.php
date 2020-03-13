<?php 
no_direct_access();
?>

<h1>
    Cadastro
</h1>

<?php if ($save != null) { ?>
    <?php
    $cl = ($save == true) ? "box_success" : "box_error";
    ?>
    <div class="<?php echo $cl; ?>">
        <?php if ($save) { ?>
            Salvo com sucesso.
        <?php } else { ?>
            Ops, ocorreu um erro ao salvar.
        <?php } ?>
    </div>
<?php }
else { ?>
<form class="form1" method="post" action="<?php eGetUrl("posts", "addpost"); ?>">
    <input type="hidden" name="id" value="<?php echo (isset($data["id"])) ? $data["id"] : ""; ?>"/>
    
    <label>title</label>
    <input type="text" name="title" 
    value="<?php echo (isset($data["title"])) ? $data["title"] : ""; ?>"/><label>description</label>
    <input type="text" name="description" 
    value="<?php echo (isset($data["description"])) ? $data["description"] : ""; ?>"/>
    
    <input type="submit" value="Salvar" class="button-green"/>
</form>
<?php }?>