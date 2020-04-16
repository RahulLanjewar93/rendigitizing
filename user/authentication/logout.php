<?php
session_start();
unset($_SESSION['USER']);
session_unset();
header("location:http://localhost/rendigitizingupdated/user/authentication/login.php");