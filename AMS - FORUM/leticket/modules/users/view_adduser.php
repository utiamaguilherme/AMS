<?php
no_direct_access();
?>

<h1>
    Cadastro
</h1>

<?php if ($save != null) { ?>
    <?php
    $cl = ($save == true) ? "bg-green" : "alert";
    ?>
    <div  class="<?php echo $cl; ?>" data-role="panel">
        <?php if ($save) { ?>
            Salvo com sucesso.
        <?php } else { ?>
            Ops, ocorreu um erro ao salvar.
        <?php } ?>
    </div>
<?php } ?>
<form class="form1" method="post" action="<?php eGetUrl("users", "adduser"); ?>">
    <input type="hidden" name="id" value="<?php echo (isset($data["id"])) ? $data["id"] : ""; ?>"/>
<div class="form-group">
    <label>Nome Completo</label>
    <input type="text" name="name" 
           value="<?php echo (isset($data["name"])) ? $data["name"] : ""; ?>"/>
    </div>
    <div class="form-group">
    <label>Username - E-mail</label>
    <input type="text" name="username" 
           value="<?php echo (isset($data["username"])) ? $data["username"] : ""; ?>"/>
    </div>
    <div class="form-group">
    <label>Senha</label>
    <input type="text" name="password" placeholder="Preencha somente se quiser alterar."
           value="<?php echo (isset($data["password"])) ? $data["password"] : ""; ?>"/>
</div>
    
    <?php if(login_getUserGroup()=="admin"){ ?>
    <div class="form-group">
    <label>Acesso</label>
    <select name="usersgroups_id">
        <option value="0">Nenhum</option>
        <?php foreach ($usersgroups as $k => $v) { ?>
            <option value="<?php echo $v["id"]; ?>" 
            <?php
            if ($data["usersgroups_id"] == $v["id"]) {
                echo " selected ";
            }
            ?>
            >
                        <?php echo $v["name"] . ": " . $v["description"]; ?>
            </option>
        <?php } ?>
    </select>
    </div>
     <?php } ?>
    <div class="form-group">
    <input type="submit" value="Salvar" class="button success"/>
    </div>
</form>
