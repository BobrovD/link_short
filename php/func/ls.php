<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 03.10.17
 * Time: 11:17
 */

use Lib\DB as MySQL;

function getUrl($code)
{
    $query = 'SELECT url FROM ls WHERE code = \''.$code.'\'';
    return MySQL\queryAssOne($query);
}

function codeExist($code)
{
    $query = 'SELECT id FROM ls WHERE code = \''.$code.'\'';
    return MySQL\queryAssOne($query);
}

function setUrl($url, $code)
{
    $query = 'INSERT INTO ls (url, code) VALUES (\''.$url.'\', \''.$code.'\')';
    MySQL\query($query);
    return MySQL\lastInsertId();
}

function generateCode($length = 5)
{
    $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
    $numChars = strlen($chars);
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    if (codeExist($code))
        return generateCode($length);
    return $code;
}

function update_code($id, $code)
{
    $query = 'UPDATE ls SET code = \''.$code.'\' WHERE id = \''.$id.'\'';
    return MySQL\query($query);
}