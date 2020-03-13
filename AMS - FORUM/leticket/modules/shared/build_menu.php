<?php

//function getMenu(){
global $cfg_modules;
  $menu = array();
  foreach($cfg_modules as $v){
    $desc = require_once "modules/".$v."/descriptor.php";
    if(isset($desc["menuname"])){
      if(isset($desc["submenus"])){
        $subs = array();
        foreach($desc["submenus"] as $m=>$n){
          $subs[$m] = getUrl($v, $n);
        }
        $menu[$v] = array("menuname"=>$desc["menuname"], "submenus"=>$subs);
      }else{
        $menu[$v] = array("menuname"=>$desc["menuname"], "link"=>getUrl($v));

      }
    }
  }
//}
