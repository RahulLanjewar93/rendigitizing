<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "rendigitization_db";

$conn = mysqli_connect($host, $user, $pass, $db);
if($conn)
{
    //echo "connection successful";
}
else
{
    //echo "Failed";
    //die();
}