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
<form class="form1" method="post" action="<?php eGetUrl("users", "addgroup"); ?>">
    <input type="hidden" name="id" value="<?php echo (isset($data["id"])) ? $data["id"] : ""; ?>"/>
    
    <label>name</label>
    <input type="text" name="name" 
    value="<?php echo (isset($data["name"])) ? $data["name"] : ""; ?>"/><label>description</label>
    <input type="text" name="description" 
    value="<?php echo (isset($data["description"])) ? $data["description"] : ""; ?>"/><label>power</label>
    <input type="text" name="power" 
    value="<?php echo (isset($data["power"])) ? $data["power"] : ""; ?>"/>
    
    <input type="submit" value="Salvar" class="button-green"/>
</form>
