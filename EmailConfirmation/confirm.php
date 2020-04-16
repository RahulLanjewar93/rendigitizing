<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once "../db/connection/conn.php";
function redirectSuccess()
{
    header("location:http://rendigitizing.com/user/authentication/login.php?verification=success");
    exit();
}
function redirectFail()
{
    header("location:http://rendigitizing.com/user/authentication/login.php?verification=fail");
    exit();
}
if(!isset($_GET['email']) && !isset($_GET['token']))
{
    redirect();
}
else{
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    $validation = "SELECT userid FROM tbl_user WHERE email = '$email' AND token = '$token' AND isemailconfirm = 'NO'";
    $validationFire = mysqli_query($conn, $validation);

    if(mysqli_num_rows($validationFire) > 0)
    {
        $updateEmailConfirmation = "UPDATE tbl_user SET isemailconfirm = 'YES' , user_status = 'ACTIVE', token = '' WHERE email = '$email'";
        $updateEmailConfirmationFire = mysqli_query($conn, $updateEmailConfirmation);
        if($updateEmailConfirmationFire) {
            $_SESSION['EMAIL_CONFIRMATION_STATUS_SUCCESS'] = "Email has been confirmed successfully";
            redirectSuccess();
            exit();
        }
        else{
            echo "Verification failed";
        }
    }
    else{
        //echo "This link is expired or email verification done already";
        $_SESSION['EMAIL_CONFIRMATION_STATUS_FAIL'] = "Email is verified already or Verification link has been expired";
        redirectFail();
    }
}