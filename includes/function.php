<?php

function sanitize($data) {
	return $data;
}

function real_ip()
{
    $ip = 'undefined';
    if (isset($_SERVER))
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif (isset($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else
    {
        $ip = getenv('REMOTE_ADDR');
        if (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
        elseif (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
    }
    $ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
    return $ip;
}