<?php

function converterMoedaMysql($val){
    $recebeValor = $val;
    $converterValor = str_replace('.','',$recebeValor);
    $converterValor = str_replace(',','.',$converterValor);
    return $converterValor;
}