<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 03.10.17
 * Time: 11:05
 */


namespace Lib\DB;

use Defines;

$connection = null;

function query($query)
{
    $connection = getConnection();
    return mysqli_query($connection, $query);
}

//associative result
function queryAss($query, $result_type = MYSQLI_ASSOC)
{
    $mysqli_result = query($query);
    $result = [];
    while ($row = mysqli_fetch_array($mysqli_result, $result_type)) {
        $result[] = $row;
    }
    return $result;
}

function queryAssRow($query, $result_type = MYSQLI_ASSOC)
{
    return queryAss($query, $result_type)[0];
}

function queryAssOne($query)
{
    return queryAssRow($query, $result_type = MYSQLI_NUM)[0];
}

function lastInsertId()
{
    return mysqli_insert_id(getConnection());
}

function getConnection()
{
    global $connection;
    //если соединение не установлено
    if ($connection === null) {
        //то коннектимся к базе и записываем в $connections
        $connection = connect();
    }
    return $connection;
}

//подключимся к master серверу, а если он лежит, то к slave
function connect()
{
	$connection = mysqli_connect(
        Defines\MySQL\Connection::SERVER,
        Defines\MySQL\Connection::USER,
        Defines\MySQL\Connection::PASSWORD,
        Defines\MySQL\Connection::DATABASE
    );
    mysqli_set_charset($connection, 'utf8');
    return $connection;
}

//чистим за собой
function closeConnections()
{
    global $connection;
    mysqli_close($connection);
}