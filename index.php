<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 03.10.17
 * Time: 10:57
 */
//error_reporting(E_ALL | E_STRICT);   // включаем замечания у кого они выключены
//ini_set('display_errors','On');		// ну уж что бы точно вы увидели результат


require_once $_SERVER['DOCUMENT_ROOT'].'/php/require.php';

if($_SERVER['REQUEST_URI'] !== '/'){
    $code = substr($_SERVER['REQUEST_URI'], 1);
    if($url = get_url($code)){
        if(strpos($url, 'http') === false)
            $url = 'http://'.$url;
        $headers['Location'] = $url;
        exit_with_code(302, $headers);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Сокращатель ссылок</title>
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://yastatic.net/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/func.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
</head>

<body>

<div class="wrapper">

    <header class="header">
        <div class="url_container">
            <div class="label">URL: </div>
            <input class="url_input" id="url" type="text" />
            <img id="get_code" src="/img/redir.png" />
        </div>
        <div class="link_container" id="link_container">
            <div class="new_link" title="copy" id="link"></div>
            <div class="label" id="label">http://178.62.73.173/</div>
            <input type="text" id="link_code" data-baseval="" onchange="javascript:on_change_input(this);" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" data-active="false" class="code" />
            <img id="link_button" data-action="edit" src="/img/edit.png" />
        </div>
    </header>

    <main class="content">
    </main>

</div>

</body>
</html>