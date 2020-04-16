<?php
/*
 * Author : Rishav Mandal (TE-IT)
 * Date : 12/03/2020
*/
session_start();
// Report all errors except E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);
require_once "../../db/connection/conn.php";
if (!isset($_SESSION['USER'])) {
    if (isset($_POST['login'])) {
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);


        if (empty($email)) {
            $emailErr = "Please enter email";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email";
        } else if (strlen($email) > 100) {
            $emailErr = "Email is too long";
        } else if (strlen($email) < 8) {
            $emailErr = "Email must be with 8 to 100 characters";
        } else if (empty($pass)) {
            $passErr = "Please enter password";
        } else if (strlen($pass) > 80) {
            $passErr = "Password is too long";
        } else if (strlen($pass) < 8) {
            $passErr = "Password must be at least 8 character long";
        } else {
            $encryptedPass = sha1($pass);
            $verifyLogin = "SELECT email, password, user_status FROM tbl_user WHERE email='$email' AND password='$encryptedPass'";
            $verifyLoginFire = mysqli_query($conn, $verifyLogin);
            $userStatus = mysqli_fetch_assoc($verifyLoginFire);


            if (mysqli_num_rows($verifyLoginFire) > 0) {

                if ($userStatus['user_status'] == "ACTIVE") {

                    $emailConfirmationCheck = "SELECT isemailconfirm FROM tbl_user WHERE email = '$email' AND isemailconfirm = 'YES'";
                    $emailConfirmationCheckFire = mysqli_query($conn, $emailConfirmationCheck);

                    if (mysqli_num_rows($emailConfirmationCheckFire) > 0) {
                        $_SESSION['USER'] = $email;
                        header("location:http://rendigitizing.com/index.php");
                    }

                } else {
                    //echo "Go verify email";
                    $confirmationMsgErr = "Please verify email address to get login access";
                }
            }
        }
    } else {

        $userStatusErr = "User is blocked by admin,<br/>Please contact admin to get access back";
    }
    //Remember Me Implementation
    if (!empty($_POST["remember-me"])) {
        setcookie("email", $_POST["email"], time() + 3600);
        setcookie("password", $_POST["pass"], time() + 3600);
    } else {
        setcookie("email", "");
        setcookie("pass", "");
    }
} else {
    $loginErr = "Invalid Email or Password";
}

else{
    header("location:http://rendigitizing.com/index.php?nosession=false");
}

?>