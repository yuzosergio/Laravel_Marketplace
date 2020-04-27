<?php

function filterItemsByStoreId(array $items, $storeId){

    return array_filter($items, function($line) use($storeId){
        return $line['store_id'] == $storeId;
    });
}

function formatPriceToDatabase($price){
    //19,90 -> 19.00 ou 1.000,00 -> 1000.00
    return str_replace(['.', ','], ['', '.'], $price); 
}