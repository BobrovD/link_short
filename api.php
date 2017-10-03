<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 03.10.17
 * Time: 12:17
 */
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors','On');


require_once $_SERVER['DOCUMENT_ROOT'].'/php/require.php';

switch($_GET['a'])
{
    case 'new_link':
        $result['code'] = generateCode(5);
        $result['id'] = setUrl($_GET['url'], $result['code']);
        echo json_encode($result);
        break;
    case 'update_code':
        update_code($_GET['id'], $_GET['code']);
        break;
    case 'available_code':
        if(!getUrl($_GET['code']))
            echo 'OK';
        break;
    default:
        exit_with_code(400);
        break;
}