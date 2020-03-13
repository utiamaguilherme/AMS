<?php
no_direct_access();
$u = login_getUserLogged();
?>



<?php if ($u["groups_name"] == "admin") { ?>
    <div style="float:right">
        <a href="<?php egetUrl("tickets", "addticket", array("id" => $ticket["id"])); ?>">
            <img src="modules/shared/images/icon_edit.png" width="16px" alt="Editar"/>
        </a> 
    </div>
<?php } ?>
<h2><?php echo $ticket["title"]; ?> &nbsp;&nbsp;<small>Ticket: #<?php echo str_pad($ticket["cod"], 5, "0", STR_PAD_LEFT); ?></small></h2>


<hr/>

<div class="grid">
    <div class="row">
        <div class="cell-md-8">


            <table class="table table-border cell-border">
                <tr>
                    <th>
                        Status:
                    </th>
                    <td>
                        <?php echo $ticket["status"]; ?>
                    </td>
                    <th>
                        Criado em:
                    </th>
                    <td>
                        <?php echo $ticket["datacad"]; ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Criado por:
                    </th>
                    <td>
                        <?php echo $ticket["name"]; ?> (<?php echo $ticket["username"]; ?>)
                    </td>
                    <th>
                        Categoria
                    </th>
                    <td>
                        <?php echo $ticket["ticketcategories_id"]; ?>
                    </td>
                </tr>
            </table>

            <h3>Descrição</h3>

            <p style="font-family: 'Lucida Console', Monaco, monospace;">
                <?php echo str_replace("\n", "<br/>", $ticket["description"]); ?>
            </p>


        </div>
        <div class="cell-md-4">

            <div class="container-full">
            <h5>Usuários nesse ticket:</h5>

            <?php if (count($users) > 0) { ?>
                <?php foreach ($users as $u) { ?>
                    <div style="
                         float:left;
                         padding:3px;
                         background-color:rgb(20,20,80);
                         color:white;
                         margin-right:5px;
                         margin-bottom:5px;
                         /* border-radius: 500px;*/
                         " >
                             <?php echo $u["username"] ?>
                        &nbsp;
                        &nbsp;
                        <div style="
                             float:right;
                             /*border-radius: 500px;*/
                             ">
                            <a href="<?php egetUrl("tickets", "listanswer", array("tid" => $ticket["id"], "rmutid" => $u["id"])); ?>">x</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
</div>
            <div style="clear:both"></div>
                        <div class="container-full">

            <form class="form1" action="<?php egetUrl("tickets", "listanswer", array("tid" => $ticket["id"])) ?>" method="post">
                <div class="form-group">
                    <input type="text" name="usermail" placeholder="E-mail do usuário..."/>
                    <small class="text-muted">Ao inserir o e-mail de um usuário, 
                        um aviso será enviado para o e-mail dele automaticamente.</small>
                </div>
                 <div class="form-group">
                <input class="button" type="submit" value="Adicionar Usuário"/>
                </div>
            </form>
                 </div> 
        </div>
    </div>

</div>





<hr/>

<h3>
    Respostas
</h3>

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

<?php if (count($data) > 0) { ?>
    <?php foreach ($data as $v) { ?>
        <div style="
             padding:15px;
             margin-left:20px;
             margin-top:10px;
             margin-bottom:10px;
             border:solid 1px rgb(200,200,200);
             background-color: rgb(240,240,240);
             font-size: 15px;
             font-family: 'Lucida Console', Monaco, monospace;
             ">

            <div style="font-size: 12px;text-align: right; float:left; font-weight: bold">
                <?php echo $v["datecreate"]; ?> por <?php echo $v["uname"]; ?> (<?php echo $v["username"]; ?>)
            </div>
            <div style="font-size: 12px;text-align: right; float:right;">
                <!--<a href="<?php egetUrl("tickets", "addanswer", array("id" => $v["id"])); ?>">Editar</a> 
                    &nbsp; &nbsp; -->
                <a href="<?php egetUrl("tickets", "rmanswer", array("id" => $v["id"], "tid" => $ticket["id"])); ?>"
                   onclick="return confirm('Deseja excluir  <?php echo $v["content"]; ?>')"
                   >Excluir</a>
            </div>

            <div style="clear:both"></div>
            <hr/>
            <?php echo str_replace("\n", "<br/>", $v["content"]); ?>

            <br/>
            <br/>

        </div>
    <?php } ?>

<?php } ?>






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



<form class="form1" method="post" action="<?php echo getUrl("tickets", "listanswer", array("tid" => $ticket["id"])) . "#bottom"; ?>">
    <input type="hidden" name="tickets_id" value="<?php echo $ticket["id"]; ?>"/>
    <input type="hidden" name="id" value="<?php echo (isset($data["id"])) ? $data["id"] : ""; ?>"/>
    
    <div class="form-group">
        <label>Resposta</label>

        <textarea data-role="textarea" data-auto-size="true" 
                  data-clear-button="false"
                  style="font-family: 'Lucida Console', Monaco, monospace;" 
                  rows="5" placeholder="Coloque aqui uma resposta..." name="content"></textarea>

    </div>
    <div class="form-group">
        <input type="submit" value="Salvar" class="button success"/>
    </div>
</form>
<a name="bottom" id="bottom"></a>

<br/>
<br/>
<br/>
<br/>
