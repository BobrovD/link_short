<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 03.10.17
 * Time: 11:05
 */

namespace MySQL;
use defines;

$connection = null;

function query($query)
{
    $connection = get_connection();
    return mysqli_query($connection, $query);
}

//associative result
function query_ass($query, $result_type = MYSQLI_ASSOC)
{
    $mysqli_result = query($query);
    $result = [];
    while ($row = mysqli_fetch_array($mysqli_result, $result_type)) {
        $result[] = $row;
    }
    return $result;
}

function query_ass_row($query, $result_type = MYSQLI_ASSOC)
{
    return query_ass($query, $result_type)[0];
}

function query_ass_one($query)
{
    return query_ass_row($query, $result_type = MYSQLI_NUM)[0];
}

function last_insert_id()
{
    return mysqli_insert_id(get_connection());
}

function get_connection()
{
    global $connection;
    //если соединение не установлено
    if($connection === null)
    {
        //то коннектимся к базе и записываем в $connections
        $connection = connect();
    }
    return $connection;
}

//подключимся к master серверу, а если он лежит, то к slave
function connect()
{
    $connection = mysqli_connect(defines\MySQL::CONNECTION['server'], defines\MySQL::CONNECTION['user'],
        defines\MySQL::CONNECTION['password'], defines\MySQL::CONNECTION['database']);
    mysqli_set_charset($connection, 'utf8');
    return $connection;
}

//чистим за собой
function close_connections()
{
    global $connection;
    mysqli_close($connection);
}