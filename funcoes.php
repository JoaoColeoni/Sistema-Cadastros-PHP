<?php

function mascara($mask,$str)
{
    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;
}

function formataData($date)
{
    $date = explode('-',$date);
    $date = $date[2].'/'.$date[1].'/'.$date[0];
    return $date;
}

?>