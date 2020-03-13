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
<?php } ?>
<form class="form1" method="post" action="<?php eGetUrl("posts", "addcomments"); ?>">
    <input type="hidden" name="id" value="<?php echo (isset($data["id"])) ? $data["id"] : ""; ?>"/>
    
    <label>content</label>
    <input type="text" name="content" 
    value="<?php echo (isset($data["content"])) ? $data["content"] : ""; ?>"/>
    
    <input type="submit" value="Salvar" class="button-green"/>
</form>
