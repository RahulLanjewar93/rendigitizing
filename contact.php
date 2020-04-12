<?php
session_start();
ini_set('display_errors',1);
// Report all errors except E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);
require_once "db/connection/conn.php";
require_once "functions/functions.php";

if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $company = mysqli_real_escape_string($conn, $_POST['company']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $ip_address = getUserIpAddr();
        $indianDateTime = getIndianDateTime();

        if (empty($name)) {
            $nameErr = "Please provide your name";
        } else if (strlen($name) > 50) {
            $nameErr = "Name is too long";
        } else if (strlen($name) <= 2) {
            $nameErr = "Name is too small";
        } else if (empty($email)) {
            $emailErr = "Please provide an email";
        } else if (strlen($email) > 100) {
            $emailErr = "Email is too long";
        } else if (strlen($email) <= 8) {
            $emailErr = "Email is too small";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email address";
        } else if (empty($phone)) {
            $phoneErr = "Please provide phone number";
        } else if (strlen($phone) > 10) {
            $phoneErr = "Phone number must be 10 digit";
        } else if (strlen($phone) < 10) {
            $phoneErr = "Phone number must at least of 10 digit";
        } else if (empty($company)) {
            $companyErr = "Please provide comapny name";
        } else if (strlen($company) > 50) {
            $companyErr = "Company name is too long";
        } else if (strlen($company) < 1) {
            $companyErr = "Comapny name must be at least 2 digits";
        } else if (empty($message)) {
            $messageErr = "Please enter your message";
        } else if (strlen($message) > 150) {
            $messageErr = "Message is too long";
        } else if (strlen($message) < 20) {
            $messageErr = "Message must be at least 20 characters";
        } else {
            if (isset($_SESSION['USER'])) {
                $registeredUser = "YES, User : " . $_SESSION['USER'];
                $addContactUs = "INSERT INTO tbl_contactus (name, email, phone, company, message, ip_address, is_registered, created_at) VALUES ('$name', '$email', '$phone', '$company', '$message','$ip_address', '$registeredUser', '$indianDateTime')";
                $addContactUsFire = mysqli_query($conn, $addContactUs);
                if ($addContactUsFire) {
                    $successMsg = "Your message has been recorded successfully";
                } else {
                    $errMsg = "Unable to process your request";
                }
            } else {
                $registeredUser = "NO";
                $addContactUs = "INSERT INTO tbl_contactus (name, email, phone, company, message, ip_address, is_registered, created_at) VALUES ('$name', '$email', '$phone', '$company', '$message','$ip_address', '$registeredUser', '$indianDateTime')";
                $addContactUsFire = mysqli_query($conn, $addContactUs);
                if ($addContactUsFire) {
                    $successMsg = "Your message has been recorded successfully";
                } else {
                    $errMsg = "Unable to process your request";
                }
            }


        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RenDigitizing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styleassets/css/main.css">
    <script src="https://kit.fontawesome.com/4851c149c0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
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
                <p class="my-md-4 header-links">
                    <?php if (isset($_SESSION['USER'])) { ?><a href="user/authentication/logout.php"
                                                               class="px-2">Logout</a><?php } else { ?><a
                            href="user/authentication/login.php" class="px-2">Login</a><?php } ?>
                    <?php if (isset($_SESSION['USER'])) { ?><a href="user/authentication/profile.php"
                                                               class="px-2"><?php echo $_SESSION['USER'] ?></a><?php } else { ?>
                        <a href="user/authentication/register.php" class="px-2">Create an account</a><?php } ?>

                </p>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/authentication/login.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact Us</a>
                </li>
            </ul>
        </div>

        <div class="navbar-nav">
            <li class="nav-item border rounded-circle mx-2 search-icon">
                <i class="fas fa-search p-2"></i>
            </li>
        </div>
    </nav>
</div>

<div class="main-contact-area">
    <div class="container contact-table">
        <div class="contact-text-area">
            <h1>Get in touch</h1> <br>
            <h3>Need some info? <br> Feel free to contact</h3>
        </div>
        <div class="row body-contact-area">
            <div class="col-md-9 feedback-form-area">
                <div class="container">
                    <div class="row feedback-form-title">
                        <h3 class="my-5">Send us a message</h3><i class="far fa-envelope my-5"></i>
                    </div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Your Name</label> <br>
                                <input type="text" name="name" id="name" onkeypress="return (event.charCode > 64 &&
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                                       value='<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>'> <br>
                                <span class="error"><?php echo $nameErr ?></span>
                                <br/>
                                <label for="">Phone</label> <br>
                                <input type="text" name="phone" id="phone" maxlength="10"
                                       value='<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>'> <br>
                                <span class="error"><?php echo $phoneErr ?></span>
                                <br/>
                                <label for="">Describe your message</label> <br>
                                <textarea type="text" name="message" id="message" class="form-description" rows="10"
                                          cols="10"><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
                                <br/>
                                <span class="error"><?php echo $messageErr ?></span>
                                <br/>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email Address</label> <br>
                                <input type="email" name="email"
                                       value='<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>'> <br>
                                <span class="error"><?php echo $emailErr ?></span>
                                <br/>
                                <label for="">Company</label> <br>
                                <input type="text" name="company" id="company"
                                       value='<?php echo isset($_POST['company']) ? $_POST['company'] : ''; ?>'><br/>
                                <span class="error"><?php echo $companyErr ?></span>
                                <br/>
                            </div>
                        </div>
                        <br/>
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>Submit
                        </button>
                    </form>
                    <br/>
                    <br/>
                    <span class="success">
                    <?php echo $successMsg ?></span>
                    <span class="error">
                        <?php echo $errMsg; ?></span>

                </div>
            </div>
            <div class="col-md-3 address-area">
                <div class="container my-5">
                    <h3>Contact Information</h3> <br>
                    <table class="address-table">
                        <tr>
                            <td><i class="fas fa-map"></i></td>
                            <td>Address here</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-mail-bulk"></i></td>
                            <td>Mail</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-phone-alt"></i></td>
                            <td>Phone</td>
                        </tr>
                        <tr>
                            <td><i class="fab fa-instagram"></i><i class="fab fa-facebook"></i><i
                                        class="fab fa-skype"></i></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
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


    <div class="footer-light p-2">
        <h3 align='center'>Copyright all right Reserved</h3>
    </div>
</footer>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
</body>

</html>