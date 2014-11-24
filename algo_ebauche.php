<?php


function price_o_matic($price){
    
    $coef= mt_rand(7,13);
    $coef /= 10;
    $price *= $coef;
    
    return $price;
}


$vodka=10;

echo price_o_matic($vodka);