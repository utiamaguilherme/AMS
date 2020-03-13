<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

unset($_SESSION["name"]);
unset($_SESSION["username"]);
unset($_SESSION["uhash"]);
unset($_SESSION["uid"]);
unset($_SESSION["groups_id"]);
unset($_SESSION["groups_name"]);
header("Location: index.php");