<?php
/*
 * Author : Rishav Mandal (TE-IT)
 * Date : 13/03/2020
*/
session_start();
require_once "../../PHPMailer/PHPMailer.php";
require_once "../../PHPMailer/SMTP.php";
require_once "../../PHPMailer/Exception.php";
require_once "../../functions/functions.php";
// Report all errors except E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);
require_once "../../db/connection/conn.php";
if (!isset($_SESSION['USER'])) {
    if (isset($_POST['send'])) {
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']));


        if (empty($email)) {
            $emailErr = "Please enter email";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email";
        } else if (strlen($email) > 100) {
            $emailErr = "Email is too long";
        } else if (strlen($email) < 8) {
            $emailErr = "Email must be with 8 to 100 characters";
        } else {
            $checkEmail = "SELECT userid FROM tbl_user WHERE email = '$email'";
            $checkEmailFire = mysqli_query($conn, $checkEmail);

            if (mysqli_num_rows($checkEmailFire) > 0) {
                $token = generateString();

                $updateToken = "UPDATE tbl_user SET token = '$token', token_expire = DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE email = '$email'";
                $updateTokenFire = mysqli_query($conn, $updateToken);

                if ($updateTokenFire) {

                    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                    $mail->IsSMTP();
                    $mail->SMTPSecure = 'tls';
                    $mail->Host = "smtp.gmail.com";
                    $mail->Post = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'rendigitizing.info@gmail.com'; // Replace with company email
                    $mail->Password = 'Qwerty@1234'; //Replace with email password
                    $mail->setFrom("rendigitizing.info@gmail.com"); //Replace with company email

                    $mail->addAddress($email);
                    $mail->Subject = "Password Reset Link";
                    $mail->isHTML(true);
                    $mail->Body = "
                <p>Hi, <br/>In order to reset your email, please click the link below: </p>
                <br/>
                <a href='http://localhost/RenDigitizingUpdated/user/authentication/resetpassword.php?email=$email&token=$token' class='btn btn-success' style='text-decoration: none'>http://localhost/RenDigitizingUpdated/user/authentication/resetpassword.php?email=$email&token=$token</a>
                <br>
                Kind Regard,<br/>
                Company Name
                ";
                    $_SESSION['TEMAIL'] = $email;
                    $_SESSION['TOKEN'] = $token;
                    if ($mail->send()) {
                        $emailsendMsg = "<b>Password Reset Link Sent !!</b> <br />
                    Please check your mailbox";
                    } else {
                        $emailsendMsgErr = "<b>Something went wrong</b>";
                    }

                } else {
                    echo mysqli_error($conn);
                }
            } else {
                $emailNotExistenceErr = "This email is not registered";
            }
        }
    }
} else {
    header("location:http://localhost/RendigitizingUpdated/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../styleassets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <!-- <link rel="stylesheet" href="../../styleassets/css/style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styleassets/css/style.css">
    <link rel="stylesheet" href="../../styleassets/css/main.css">
    <script src="https://kit.fontawesome.com/4851c149c0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <style>
        .error {
            color: #FF0000;
        }

        .success {
            color: green;
        }
    </style>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-left">
                <h2 class="my-md-3 site-title">RenDigitizing</h2>
            </div>
            <div class="col-md-6 text-right">
                <p class="my-md-4 header-links">
                    <a href="../RenDigitizing/user/authentication/login.php" class="px-2">Sign IN</a>
                    <a href="../RenDigitizing/user/authentication/register.php" class="px-1">Create an Account</a>
                </p>
            </div>
        </div>
    </div>
</header>

<div class="main">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="../../styleassets/images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="register.php?ref=fromLogin" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Password Reset</h2>
                    <span class="error"><?php echo "<b>" . $emailNotExistenceErr . "</b>" ?></span>
                    <span class="success"><?php echo "<b>" . $emailsendMsg . "</b>" ?></span>
                    <span class="error"><?php echo "<b>" . $emailsendMsgErr . "</b>" ?></span>
                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email material-icons-name"></i></label>
                            <input type="email" name="email" id="email" placeholder="Email" required
                                   value='<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>'/>
                            <span class="error"><?php echo $emailErr ?></span>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="send" id="send" class="form-submit"
                                   value="Send Reset Link"/>
                        </div>
                    </form>
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

    <!-- JS -->
    <script src="../../styleassets/vendor/jquery/jquery.min.js"></script>
    <script src="../../styleassets/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>