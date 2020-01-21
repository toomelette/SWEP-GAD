<?php


function process_url($url){
    $url = str_replace('http://', '', $url);
    $url = str_replace('/', '_', $url);
    return $url;

}