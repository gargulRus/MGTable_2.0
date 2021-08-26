<?php
//Служебные функции
function dateCorr($date){
    if(!empty($date)){
        return date("d.m.Y", strtotime($date));
    }else{
        return '';
    }
}
?>