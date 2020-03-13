<?php
no_direct_access();
$u = login_getUserLogged();
?>




<h2><?php echo $postagem["title"]; ?> &nbsp;&nbsp;<small>Postagem: #<?php echo str_pad($postagem["id"], 5, "0", STR_PAD_LEFT); ?></small></h2>


<hr/>


            <div style="clear:both"></div>
                        <div class="container-full">
                          <?php echo $postagem["description"]; ?>

                 </div> 
        </div>
    </div>

</div>





<hr/>

<h3>
    Comentários
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

<?php if (count($comentario) > 0) { ?>
    <?php foreach ($comentario as $v) { ?>
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
                <?php echo $v["datecreate"]; ?> por <?php echo $v["username"]; ?> (<?php echo $v["users_id"]; ?>)
            </div>
            <div style="font-size: 12px;text-align: right; float:right;">
                <!--<a href="<?php egetUrl("posts", "addcomments", array("id" => $v["id"])); ?>">Editar</a> 
                    &nbsp; &nbsp; -->
                <a href="<?php egetUrl("posts", "rmcomments", array("id" => $v["id"], "tid" => $postagem["id"])); ?>"
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
<?php }     $u = login_getUserLogged(); ?>



<form class="form1" method="post" action="<?php egetUrl("posts", "listcomments", array("tid" => $postagem["id"])) ?>" >
    <input type="hidden" name="post_id" value="<?php echo $postagem["id"]; ?>"/>
    <div class="form-group">
        <label>Comentar</label>

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
