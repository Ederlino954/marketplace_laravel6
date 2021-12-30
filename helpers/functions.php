<?php

function filterItemsByStoreId(array $items, $storeId)
{
    return array_filter($items, function($line) use($storeId){
        return $line['store_id'] == $storeId;
    });
}

function formatPriceToDatabase($price)
{
    // 19,90 -> 19.90 ou 1.111,11 -> 1111,11
    return str_replace(['.', ','],['', '.'], $price);
}


