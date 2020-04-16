<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "pranav12_rendigitizing_db";

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