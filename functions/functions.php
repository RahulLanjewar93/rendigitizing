<?php

function generateString($len = 10)
{
    $token = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0, $len);

    return $token;
}
function redirectSuccess()
{
    header("location:http://localhost/RenDigitizingUpdated/user/authentication/login.php?resetpassword=success");
    exit();
}
function redirectFail()
{
    header("location:http://localhost/RenDigitizingUpdated/user/authentication/login.php?resetpassword=fail");
    exit();
}
function getUserIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function getIndianDateTime()
{
    date_default_timezone_set('Asia/Kolkata');
    $datetime = date('d/m/Y h:i:s:a', time());
    return $datetime;
}
function redirectResetPasswordConfirm()
{
    header("location:http://localhost/RenDigitizingUpdated/user/authentication/resetpasswordconfirm.php?fromresetlink=true");
    exit();
}
