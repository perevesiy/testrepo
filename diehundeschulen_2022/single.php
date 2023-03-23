<?php


if(strpos($_SERVER['REQUEST_URI'], '/hundeschule/')!==false){
        get_template_part('single-hund');
    }else{
        get_template_part('single-regular');
    }