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
    
    <h2>Criar uma conta</h2>
    
    <?php if($err==-1){ ?>
    <div class="box_error">Ops, esse usuário já existe.</div>  
    <?php } ?>
    
    <form class="form1" method="post" action="<?php egetUrl("login","register"); ?>">
        <label>Nome Completo</label>
        <input type="text" name="name"/>
        <label>Email</label>
        <input type="text" name="username"/>
        <label>Senha</label>
        <input type="password" name="password"/>
        <div style="text-align: right">
        <a href="<?php egetUrl("login","recoverpass"); ?>">Recuperar a senha</a><br/>
        <a href="<?php egetUrl("login","dologin"); ?>">Ir para Login</a><br/>
        </div>
        <input type="submit" value="Entrar" class="button-green"/>
    </form>
    
    
</div>
    </div>