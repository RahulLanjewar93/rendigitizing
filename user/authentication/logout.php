<?php
session_start();
unset($_SESSION['USER']);
session_unset();
header("location:http://rendigitizing.com/user/authentication/login.php");