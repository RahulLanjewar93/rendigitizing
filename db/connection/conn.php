<?php
$host = "localhost";
$user = "pranav12_root";
$pass = "Rishav@1234";
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