<?php
/*
 * Author : Rishav Mandal (TE-IT)
 * Date : 11/03/2020
*/
session_start();
if(!isset($_SESSION['USER'])) {
    require_once "../../PHPMailer/PHPMailer.php";
    require_once "../../PHPMailer/SMTP.php";
    require_once "../../PHPMailer/Exception.php";
    function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    $userIP = getUserIpAddr();
// Report all errors except E_NOTICE
    error_reporting(E_ALL ^ E_NOTICE);
    date_default_timezone_set('Asia/Kolkata');
    $datetime = date('d/m/Y h:i:s:a', time());

    require_once "../../db/connection/conn.php";
    if (isset($_POST['register'])) {
        $firstName = mysqli_real_escape_string($conn, $_POST['fname']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
        $repass = mysqli_real_escape_string($conn, $_POST['re_pass']);


        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number = preg_match('@[0-9]@', $pass);
        $specialChars = preg_match('@[^\w]@', $pass);

        //Checking Email Existence in database
        $checkEmail = "SELECT email FROM tbl_user WHERE email = '$email'";
        $checkEmailFire = mysqli_query($conn, $checkEmail);

        //Checking Phone Number Existence in database
        $checkPhone = "SELECT phone FROM tbl_user WHERE phone='$phone'";
        $checkPhoneFire = mysqli_query($conn, $checkPhone);


        if (empty($firstName)) {
            $firstNameErr = "Please enter First Name";
        } else if (strlen($firstName) > 50) {
            $firstNameErr = "First Name must me within 50 characters";
        } else if (strlen($firstName) < 3) {
            $firstNameErr = "First Name can not be less than 3 characters";
        } else if (empty($lastName)) {
            $lastNameErr = "Please enter Last Name";
        } else if (strlen($lastName) > 50) {
            $lastNameErr = "Last name must be within 50 characters";
        } else if (strlen($lastName) < 3) {
            $lastNameErr = "Last Name can not be less than 3 characters";
        } else if (empty($email)) {
            $emailErr = "Please enter Email";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email address";
        } else if (strlen($email) > 100) {
            $emailErr = "Email must be within 100 characters";
        } else if (strlen($email) < 8) {
            $emailErr = "Email must be at least 8 characters";
        } else if (empty($phone)) {
            $phoneErr = "Please enter phone number";
        } else if (strlen($phone) > 10) {
            $phoneErr = "Must be 10 digit";
        } else if (strlen($phone) < 10) {
            $phoneErr = "Must be 10 digit";
        } else if (!is_numeric($phone)) {
            $phoneErr = "Invalid phone number";
        } else if (empty($pass)) {
            $passErr = "Please enter Password";
        } else if (strlen($pass) > 80) {
            $passErr = "Password is too big, minimize it";
        } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
            $passErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
        } else if (empty($repass)) {
            $repassErr = "Please confirm your password";
        } else if ($pass != $repass) {
            $repassErr = "Password does not matched";
        } else if (mysqli_num_rows($checkEmailFire) > 0) {
            $emailErr = "This email is already registered";
        } else if (mysqli_num_rows($checkPhoneFire) > 0) {
            $phoneErr = "This phone is already registered";
        } else if (!isset($_POST['remember-me'])) {
            $termsErr = "Please read and agree our terms and conditions";
        } else {
            //Generate token
            $token = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890";
            $token = str_shuffle($token);
            $token = substr($token, 0, 10);


            $encryptedPass = sha1($pass);
            $tnc = "YES";
            $registerQuery = "INSERT INTO tbl_user (firstname, lastname, email, phone, password, isemailconfirm, token, is_tnc_agreed, user_ip_address, user_status, created_at) VALUES ('$firstName','$lastName', '$email', '$phone', '$encryptedPass', 'NO', '$token', '$tnc', '$userIP', 'PENDING', '$datetime')";
            $registerQueryFire = mysqli_query($conn, $registerQuery);
            if ($registerQueryFire) {
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                $mail->IsSMTP();
                $mail->SMTPSecure = 'tls';
                $mail->Host = "mail.rendigitizing.com";
                $mail->Post = 465;
                $mail->SMTPAuth = true;
                $mail->Username = 'rendigitizing.help@rendigitizing.com'; //Replace your comapany email
                $mail->Password = 'Rishav@1234';// Replace your email password
                $mail->setFrom("rendigitizing.help@rendigitizing.com"); // Replace with company email

                $mail->addAddress($email, $firstName . " " . $lastName);
                $mail->Subject = "Please verify your email address";
                $mail->isHTML(true);
                $mail->Body = "
                <p>Please click the button to verify your email address</p>
                <br/>
                <a href='http://rendigitizing.com/EmailConfirmation/confirm.php?email=$email&token=$token' class='btn btn-success' style='text-decoration: none'>Verify Email</a>
                ";
                if ($mail->send()) {
                    $emailsendMsg = "<b>Registration Successfull !!</b> <br />
                    Email Verification link has been sent to your email address";
                } else {
                    $emailsendMsgErr = "<b>Something went wrong</b>";
                }

                //header("location:http://localhost/RenDigitization/OTP/auth/verification.php?confirmed=no");

            }
        }
    }
}
else{
    header("location:http://rendigitizing.com/user/authentication/login.php?nosession=true");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registration</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../styleassets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <!-- <link rel="stylesheet" href="../../styleassets/css/style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styleassets/css/style.css">
    <link rel="stylesheet" href="../../styleassets/css/main.css" <script src="https://kit.fontawesome.com/4851c149c0.js"
        crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4851c149c0.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $("#phone").keypress(function (e) {
                var keyCode = e.which;
                /*
                8 - (backspace)
                32 - (space)
                48-57 - (0-9)Numbers
                */
                if ((keyCode != 8 || keyCode == 32) && (keyCode < 48 || keyCode > 57)) {
                    return false;
                }
            });


            $("#phone").keypress(function (e) {
                var keyCode = e.which;

                /*
                48-57 - (0-9)Numbers
                65-90 - (A-Z)
                97-122 - (a-z)
                8 - (backspace)
                32 - (space)
                */
                // Not allow special
                if (!((keyCode >= 48 && keyCode <= 57) ||
                        (keyCode >= 65 && keyCode <= 90) ||
                        (keyCode >= 97 && keyCode <= 122)) &&
                    keyCode != 8 && keyCode != 32) {
                    e.preventDefault();
                }
            });
        });
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <style>
        .error {
            color: #FF0000;
        }

        .success {
            color: green;
        }
    </style>
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

        <!-- Sign up form -->
        <section class="signup">
            <div class="container1">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Registration</h2>
                        <span class="success"><?php echo $emailsendMsg ?></span>
                        <span class="error"><?php echo $emailsendMsgErr ?></span>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fname" id="fname" placeholder="First Name" onkeypress="return (event.charCode > 64 &&
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                                    value='<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''; ?>' />
                                <span class="error"><?php echo $firstNameErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="lname" id="lname" placeholder="Last Name" onkeypress="return (event.charCode > 64 &&
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                                    value='<?php echo isset($_POST['lname']) ? $_POST['lname'] : ''; ?>' />
                                <span class="error"><?php echo $lastNameErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"
                                    value='<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>' />
                                <span class="error"><?php echo $emailErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Phone" maxlength="10"
                                    value='<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>' />
                                <span class="error"><?php echo $phoneErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"
                                    value='<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>' />
                                <span class="error"><?php echo $passErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"
                                    value='<?php echo isset($_POST['re_pass']) ? $_POST['re_pass'] : ''; ?>' />
                                <span class="error"><?php echo $repassErr ?></span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>I accept all
                                    terms in <a href="../../userdocumentation/tnc/tnc.html">Terms and Conditions.</a>
                                </label>
                                <span class="error"><?php echo $termsErr ?></span>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="register" id="register" class="form-submit"
                                    value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../../styleassets/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php?ref=fromRegistration" class="signup-image-link">I am already member</a>
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