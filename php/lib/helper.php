<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 03.10.17
 * Time: 12:07
 */



function exit_with_code($code, $headers = false){
    if(is_array($headers)) {
        foreach ($headers as $key => $header) {
            header($key . ': ' . $header);
        }
    }
    http_response_code($code);
    exit();
}