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
    
    <h2>Login</h2>
    
    <?php if($errlogin){ ?>
    <div class="box_error">Ops, usuário ou senha inválidos.</div>  
    <?php } ?>
    
    <form class="form1" method="post" action="<?php egetUrl("login","dologin"); ?>">
        <label>Email</label>
        <input type="text" name="username"/>
        <label>Password</label>
        <input type="password" name="password"/>
        <div style="text-align: right">
        <a href="<?php egetUrl("login","recoverpass"); ?>">Recuperar a senha</a><br/>
        </div>
        <input type="submit" value="Entrar" class="button-green"/>
    </form>
    
    
    
</div>
    <a href="<?php egetUrl("login","register"); ?>">Criar uma conta</a>
    
    </div>