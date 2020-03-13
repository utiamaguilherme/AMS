<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<br/>
<br/>
<br/>
<br/>
<br/>

<div style="text-align: center;">
    <h1><?php echo COMPANY_NAME; ?></h1>


<div style="
     margin:0px auto;
     border:1px solid rgb(200,200,200);
     background-color: rgb(230,230,230);
     width:250px;
     padding:20px;
     text-align: left;
     ">
    
    <h2>Recuperação de Senha</h2>
    
    <?php if($errlogin){ ?>
    <div class="box_error">Ops, usuário inválido.</div>  
    <?php } ?>
    
    <?php if(!$success){ ?>
    <form class="form1" method="post" action="<?php egetUrl("login","recoverpass"); ?>">
        <label>Username</label>
        <input type="text" name="username"/>
        
        <input type="submit" value="Recuperar" class="button-green"/>
    </form>
    <?php }else{ ?>
    <div class="box_success">
        <b>Sucesso!</b><br/>
        Um e-mail foi enviado para você com suas informações de login.<br/>
        Confira também sua caixa de Lixo Eletrônico e Spam.
    </div>
    <a href="index.php">Ir para login</a>
    <?php } ?>
    
</div>
    </div>