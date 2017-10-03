<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 03.10.17
 * Time: 12:07
 */



function exitWithCode($code, $headers = false)
{
    if (is_array($headers)) {
        foreach ($headers as $key => $header) {
            header($key . ': ' . $header);
        }
    }
    http_response_code($code);
    exit();
}


function validateInputData($type, $data)
{
	$pattern = '/^$/';
	switch($type) {
		case 'url' :
			$pattern = '/^((?:http|https):\/\/)?((?:[\w-]+)(?:\.[\w-]+)+)(?:[\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?$/u';
			break;
		case 'code':
			$pattern = '/^[a-zA-Z0-9]{5,100}$/u';
			break;
		case 'int' :
			//или строка с INT или INT
			return (ctype_digit($data) || ((int)$data == $data));
	}
	return preg_match($pattern, $data);
}