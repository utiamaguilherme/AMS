<?php
require_once "modules/shared/build_menu.php";

$user = login_getUserLogged();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
        <link href="https://cdn.metroui.org.ua/v4/css/metro-icons.css" rel="stylesheet">
        <script src="modules/shared/js/sortable.js"></script>
        <title><?php echo "Ticket" ?></title>
    </head>
    <body>
        <div class="container">
            
 <?php if (!isset($no_header)) { ?>

            
            <header class="app-bar-expand-md pos-relative" data-role="appbar">
                <a href="#" class="brand no-hover">
                    <!--<span class="mif-github mif-2x"></span>-->
                    BlackBean Suporte
                </a>
                <ul class="app-bar-menu">
                <!--<li><a href="#">Home</a></li>-->
                 <?php foreach ($menu as $k => $v) { ?>

                        <?php if (isset($v["submenus"])) { ?>
                            
                            <li>
                                <a href="#" class="dropdown-toggle"><?php echo $v["menuname"]; ?></a>
                                <ul class="d-menu" data-role="dropdown">
                            <?php foreach ($v["submenus"] as $m => $n) { ?>
                                
                                <li><a href="<?php echo $n; ?>"><?php echo $m; ?></a></li>
                            <?php } ?>
                                </ul>
                    </li>
                        <?php } else { ?>
                            
                            <li><a href="<?php echo $v["link"]; ?>"><?php echo $v["menuname"]; ?></a></li>
                        <?php } ?>
                    <?php } ?>

                
                    
                </ul>
                <div class="app-bar-container ml-auto order-3 order-md-4">
                    <a href="#" class="app-bar-item"><span class="mif-bell"></span></a>
                    

                    <!--
                    <div class="app-bar-container">
                        <a class="app-bar-item dropdown-toggle marker-light" href="#"><span class="mif-plus"></span></a>
                        <ul class="d-menu place-right" data-role="dropdown" style="display: none;">
                            <li><a href="">New repository</a></li>
                            <li><a href="">Import repository</a></li>
                            <li><a href="">New gist</a></li>
                            <li><a href="">New organization</a></li>
                            <li class="divider"></li>
                            <li><a href="">New issue</a></li>
                        </ul>
                    </div>
                    -->

                    <div class="app-bar-container">
                        <a class="app-bar-item dropdown-toggle marker-light pl-1 pr-5" href="#">
                            <!--<img class="rounded" data-role="gravatar" data-email="sergey@pimenov.com.ua" 
                                 data-size="25" src="//www.gravatar.com/avatar/75d0f7104baad47ed0e96649b905d9bf?size=25&amp;d=404">
                        -->
                       <?php echo $user["username"]; ?> - <?php echo $user["name"]; ?>
                            </a>
                        <ul class="v-menu place-right" data-role="dropdown" style="display: none;">
                            <!--<li><a href="">Signed as <strong>olton</strong></a></li>
                            <li class="divider"></li>-->
                            <li><a href="<?php egetUrl("users", "adduser", array("id" => $user["id"])); ?>">Your profile</a></li>
                            <!--
                            <li><a href="">Your stars</a></li>
                            <li><a href="">Your gists</a></li>
                            -->
                            <li class="divider"></li>
                            <!--
                            <li><a href="">Help</a></li>
                            <li><a href="">Settings</a></li>
                            -->
                            <li><a href="<?php egetUrl("login", "logoff"); ?>">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </header>
              
            


                

               

              
                    
                <?php } ?>
