<?php
/*
 * Author : Rishav Mandal (TE-IT)
 * Date : 12/03/2020
*/
session_start();
//ini_set('display_errors',1);
unset($_SESSION['TOKEN']);
unset($_SESSION['TEMAIL']);
// Report all errors except E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);
require_once "../../db/connection/conn.php";
require_once "../../functions/functions.php";
if(!isset($_SESSION['USER'])) {
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
                        $token = generateString(256);
                        header("location:http://rendigitizing.com/index.php?userauth=$token");
                    } else {
                        //echo "Go verify email";
                        $confirmationMsgErr = "Please verify email address to get login access";
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
        }

    }
}
else{
    header("location:http://rendigitizing.com/index.php?nosession=false");
    //ini_set('display_errors',1);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../styleassets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styleassets/css/style.css">
    <link rel="stylesheet" href="../../styleassets/css/main.css">
    <!-- <link rel="stylesheet" href="/styleassets/css/main.css"> -->
    <script src="https://kit.fontawesome.com/4851c149c0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/4851c149c0.js" crossorigin="anonymous"></script>
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

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h2 class="my-md-3 site-title">RenDigitizing</h2>
                </div>
                <div class="col-md-6 text-right">
                    <!--<p class="my-md-4 header-links">-->
                    <!--    <a href="login.php" class="px-2">Sign IN</a>-->
                    <!--    <a href="register.php" class="px-1">Create an Account</a>-->
                    <!--</p>-->
                </div>
            </div>
        </div>
    </header>
    <!--<div class="container-fluid p-0">-->
    <!--    <nav class="navbar navbar-expand-lg navbar-light bg-light">-->
    <!--        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"-->
    <!--            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"-->
    <!--            aria-label="Toggle navigation">-->
    <!--            <span><i class="fas fa-bars fa-1x"></i></span>-->
    <!--        </button>-->
    <!--        <div class="navbar-collapse collapse" id="navbarSupportedContent">-->
    <!--            <ul class="navbar-nav mr-auto">-->
    <!--                <li class="nav-item active">-->
    <!--                    <a class="nav-link" href="../../index.html">Home <span class="sr-only">(current)</span></a>-->
    <!--                </li>-->
    <!--                <li class="nav-item">-->
    <!--                    <a class="nav-link" href="/user/authentication/login.php">Shop</a>-->
    <!--                </li>-->
    <!--                <li class="nav-item">-->
    <!--                    <a class="nav-link" href="#">About Us</a>-->
    <!--                </li>-->
    <!--                <li class="nav-item">-->
    <!--                    <a class="nav-link" href="contact.html">Contact Us</a>-->
    <!--                </li>-->
    <!--            </ul>-->
    <!--        </div>-->

    <!--        <div class="navbar-nav">-->
    <!--            <li class="nav-item border rounded-circle mx-2 search-icon">-->
    <!--                <i class="fas fa-search p-2"></i>-->
    <!--            </li>-->
    <!--        </div>-->
    <!--    </nav>-->
    <!--</div>-->
    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container1">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="../../styleassets/images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="register.php?ref=fromLogin" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">User Login</h2>
                        <span class="error"><?php echo $loginErr ?></span>
                        <span
                            class="success"><?php echo "<b>".$_SESSION['EMAIL_CONFIRMATION_STATUS_SUCCESS']."</b>"?><?php unset($_SESSION['EMAIL_CONFIRMATION_STATUS_SUCCESS']); ?></span>
                        <span
                            class="error"><?php echo "<b>".$_SESSION['EMAIL_CONFIRMATION_STATUS_FAIL']."</b>"?><?php unset($_SESSION['EMAIL_CONFIRMATION_STATUS_FAIL']); ?></span>
                        <span class="error"><?php echo "<b>".$confirmationMsgErr."</b>"?></span>
                        <span
                            class="success"><?php echo $_SESSION['NEW_PASSWORD'] ?><?php unset($_SESSION['NEW_PASSWORD']) ?></span>
                        <span
                            class="error"><?php echo "<b>".$_SESSION['NEW_PASSWORD_STATUS']."</b>" ?><?php unset($_SESSION['NEW_PASSWORD_STATUS']) ?></span>
                        <span
                            class="error"><?php echo "<b>".$_SESSION['UNAUTHORIZED_ACCESS']."</b>" ?><?php unset($_SESSION['UNAUTHORIZED_ACCESS']) ?></span>
                        <span
                            class="error"><?php echo $userStatusErr ?></span>
                        <span
                                class="success"><b><?php echo $_SESSION['PASSWORD_CHANGED_SUCCESS']; unset($_SESSION['PASSWORD_CHANGED_SUCCESS']); ?></b>
                        </span>
                        <span class="error"><b><?php echo $_SESSION['PASSWORD_CHANGED_FAILED']; unset($_SESSION['PASSWORD_CHANGED_FAILED']); ?></b>
                        </span>


                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email" required
                                    value='<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>' />
                                <span class="error"><?php echo $emailErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"
                                    value='<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>' />
                                <span class="error"><?php echo $passErr ?></span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember
                                    me</label>
                            </div>
                            <div class="form-group">
                                <span><a href="forgetpassword.php">Forgotten password ? Click here</a> </span>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="login" id="signin" class="form-submit" value="Log in" />
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
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
        <script src="../../styleassets/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
</body>

</html>