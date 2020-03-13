<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function getImg($img, $alt=null, $width=null){
    $w = "";
    if($width != null){
        $w=" width=\"".$width."\" ";
    }
    $a = "";
    if($alt != null){
        $a=" alt=\"".$width."\" ";
    }
    return "<img $w $a src='modules/shared/images/".$img."'/>";
}


function eGetImg($img, $alt=null, $width=null){
    echo getImg($img, $alt, $width);
}