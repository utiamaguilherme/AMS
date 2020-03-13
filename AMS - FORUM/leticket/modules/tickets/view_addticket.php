<?php
no_direct_access();

$u = login_getUserLogged();
?>

<h1>
    Adicionar Ticket
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
<form class="form1" method="post" action="<?php eGetUrl("tickets", "addticket"); ?>">
    <input type="hidden" name="id" value="<?php echo (isset($data["id"])) ? $data["id"] : ""; ?>"/>


    <div class="form-group">
        <label>Assunto</label>
        <input type="text" name="title" 
               value="<?php echo (isset($data["title"])) ? $data["title"] : ""; ?>"/>
    </div>


    <div class="row">
        
        <div class="cell-md-4">
            <div class="form-group">
                <label>Categoria</label>
                <?php
                $options = array("Novo Recurso", "Melhoria", "Defeito", "Outro");
                ?>
                <select data-role="select" name="ticketcategories_id">

                    <?php foreach ($options as $v) { ?>
                        <option value="<?php echo $v; ?>" 
                        <?php
                        if ($data["ticketcategories_id"] == $v) {
                            echo " selected ";
                        }
                        ?>
                                >
                                    <?php echo $v; ?>
                        </option>
                    <?php } ?>
                </select> 
            </div>
        </div>
        <div class="cell-md-4">
            <?php if ($u["groups_name"] == 'admin') { ?>
                <div class="form-group">
                    <label>Criado por</label>
                    <input type="text" name="username" value="<?php echo (isset($data["username"])) ? $data["username"] : ""; ?>" />
                </div>
            <?php } ?>
        </div>
        <div class="cell-md-4">
            <?php if ($u["groups_name"] == 'admin') { ?>
        
        <div class="form-group">
            <label>Status</label>
            <?php
            $options = array("Em Aberto", "Em Andamento", "Concluído", "Cancelado");
            ?>
            <select data-role="select" name="status">

                <?php foreach ($options as $v) { ?>
                    <option value="<?php echo $v; ?>" 
                    <?php
                    if ($data["status"] == $v) {
                        echo " selected ";
                    }
                    ?>
                            >
                                <?php echo $v; ?>
                    </option>
                <?php } ?>
            </select>    
        </div>
    <?php } ?>
        </div>
    </div>

    <?php
    /*
      <input type="text" name="ticketcategories_id"
      value="<?php echo (isset($data["ticketcategories_id"])) ? $data["ticketcategories_id"] : ""; ?>"/>
     * 
     */
    ?>
    <div class="form-group">
        <label>Descrição</label>
        <textarea data-role="textarea" rows="7" name="description"><?php echo (isset($data["description"])) ? $data["description"] : ""; ?></textarea>
    </div>


    

    <div class="form-group">
        <input type="submit" value="Salvar" class="button success"/>
    </div>
</form>
