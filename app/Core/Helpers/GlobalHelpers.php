<?php


namespace App\Core\Helpers;


class GlobalHelpers
{
    public static function sanitize_autonum($num){
        return str_replace(',','',str_replace('₱','',$num));
    }
}