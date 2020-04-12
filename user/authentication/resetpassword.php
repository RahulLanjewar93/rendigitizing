<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL ^ E_NOTICE);
require_once "../../functions/functions.php";
require_once "../../db/connection/conn.php";
if (!isset($_SESSION['USER'])) {
if (isset($_SESSION['TEMAIL']) && isset($_SESSION['TOKEN'])) {
    if (isset($_GET['email']) && isset($_GET['token']) && $_GET['email'] == $_SESSION['TEMAIL'] && $_GET['token'] == $_SESSION['TOKEN']) {
        if (isset($_POST['submit'])) {
            $email = mysqli_real_escape_string($conn, $_GET['email']);
            $token = mysqli_real_escape_string($conn, $_GET['token']);

            $checkInfo = "SELECT userid FROM tbl_user WHERE email = '$email' AND token = '$token' AND token<>'' AND token_expire > NOW()";
            $checkInfoFire = mysqli_query($conn, $checkInfo);

            if (mysqli_num_rows($checkInfoFire) > 0) {
                //$newPass = generateString();
                $newPass = mysqli_real_escape_string($conn, $_POST['new_password']);
                $renewPass = mysqli_real_escape_string($conn, $_POST['re_new_password']);


                $uppercase = preg_match('@[A-Z]@', $newPass);
                $lowercase = preg_match('@[a-z]@', $newPass);
                $number = preg_match('@[0-9]@', $newPass);
                $specialChars = preg_match('@[^\w]@', $newPass);


                if (empty($newPass)) {
                    $newPassErr = "Please enter a password";
                } else if (strlen($newPass) > 50) {
                    $newPassErr = "Password is too long, make it within 50 characters";
                } else if (strlen($newPass) < 8) {
                    $newPassErr = "Password must be at least of 8 characters";
                } else if (!$uppercase || !$lowercase || !$number || !$specialChars) {
                    $newPassErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
                } else if ($newPass != $renewPass) {
                    $renewPassErr = "Password does not matched";
                } else {
                    $encryptNewPass = sha1($newPass);

                    $updatePassword = "UPDATE tbl_user SET token = '', password = '$encryptNewPass' WHERE email = '$email'";
                    $updatePasswordFire = mysqli_query($conn, $updatePassword);

                    if ($updatePasswordFire) {
                        $_SESSION['PASSWORD_CHANGED_SUCCESS'] = "Password has been changed successfully";
                        redirectSuccess();
                    } else {
                        $_SESSION['PASSWORD_CHANGED_FAILED'] = "Password did not changed, Something went wrong";
                        redirectFail();
                    }

                }
            } else {
                redirectFail();
                $_SESSION['NEW_PASSWORD_STATUS'] = "Link has been expired";
            }
        }
    } else {
        redirectFail();
        $_SESSION['UNAUTHORIZED_ACCESS'] = "Link is manipulated, unauthorised error !!";
    }
}
else{
    redirectFail();
    $_SESSION['NEW_PASSWORD_STATUS'] = "Link has been expired";
}
} else {
    header("location:http://localhost/Rendigitization/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styleassets/css/style.css">
    <link rel="stylesheet" href="../../styleassets/css/main.css">
    <script src="https://kit.fontawesome.com/4851c149c0.js"
            crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4851c149c0.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-left">
                <h2 class="my-md-3 site-title">RenDigitizing</h2>
            </div>
            <div class="col-md-6 text-right">
                <!-- <p class="my-md-4 header-links">
                    <a href="login.php" class="px-2">Sign IN</a>
                    <a href="register.php" class="px-1">Create an Account</a>
                </p> -->
            </div>
        </div>
    </div>
    <style>
        .error {
            color: #FF0000;
        }

        .success {
            color: green;
        }
    </style>
</header>


<div class="main">

    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Reset Password</h2>
                    <form method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="new_password" id="new_password" placeholder="New Password"/>
                            <span class="error"><?php echo $newPassErr ?></span>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_new_password" id="re_new_password"
                                   placeholder="Repeat your password"/>
                            <span class="error"><?php echo $renewPassErr ?></span>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Register"/>
                            <input type="reset" name="Reset" id="reset" class="resetnewpass" value="Reset"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="../../styleassets/images/signup-image.jpg" alt="some image"></figure>
                    <!-- <a href="login.php?ref=fromRegistration" class="signup-image-link">I am already member</a> -->
                </div>
            </div>
        </div>
    </section>


</div>
<footer>
    <div class="footer-dark">
        <div class="container p-2">
            <div class="row">
                <div class="col-md-4">
                    <ul>
                        <li class="list-header">Social</li>
                        <table align="center">
                            <tr>
                                <td><i class="fab fa-instagram"></i></td>
                                <td>
                                    <li class="list-item"><a href="">Instagram</a></li>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fab fa-facebook"></i></td>
                                <td>
                                    <li class="list-item"><a href="">Facebook</a></li>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fab fa-skype"></i></td>
                                <td>
                                    <li class="list-item"><a href="">Skype</a></a></li>
                                </td>
                            </tr>
                        </table>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li class="list-header">Address</li>
                        <li>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis incidunt illo
                                tenetur consequuntur. Magni, ad earum. Obcaecati adipisci incidunt ipsa, provident
                                voluptate id nobis, cumque sed corrupti, itaque ullam praesentium?
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li class="list-header">Usefull links</li>
                        <li class="list-item"><a href="">num1</a></li>
                        <li class="list-item"><a href="">num2</a></li>
                        <li class="list-item"><a href="">num3</a></li>
                        <li class="list-item"><a href="">num4</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- JS -->
<script src="../../styleassets/vendor/jquery/jquery.min.js"></script>
<script src="../../styleassets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

</body>

</html>