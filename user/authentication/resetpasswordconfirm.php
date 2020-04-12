<?php
session_start();
require_once "../../db/connection/conn.php";
require_once "../../functions/functions.php";
if(isset($_SESSION['NEW_PASSWORD']))
{
    $newPassFromLink = $_SESSION['NEW_PASSWORD'];
    $emailFromLink = $_SESSION['EMAIL'];

    $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
    $renewPassword = mysqli_real_escape_string($conn, $_POST['re_new_password']);

    $uppercase = preg_match('@[A-Z]@', $newPassword);
    $lowercase = preg_match('@[a-z]@', $newPassword);
    $number = preg_match('@[0-9]@', $newPassword);
    $specialChars = preg_match('@[^\w]@', $newPassword);

    if(empty($newPassword))
    {
        $newPassErr = "Please enter a password";
    }
    else if(strlen($newPassword)>50)
    {
        $newPassErr = "Password is too long, make it within 50 characters";
    }
    else if(strlen($newPassword)<8)
    {
        $newPassErr = "Password must be at least of 8 characters";
    }
    else if(!$uppercase || !$lowercase || !$number || !$specialChars)
    {
        $newPassErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
    }
    else if($newPassword != $renewPassword)
    {
        $renewPassErr = "Password does not matched";
    }
    else
    {
        $encryptedNewPass = sha1($newPassword);
        $updatePassword = "UPDATE tbl_user SET password = '$encryptedNewPass' WHERE email = '$emailFromLink' AND password = '$newPassFromLink'";
        $updatePasswordFire = mysqli_query($conn, $updatePassword);

        if($updatePasswordFire)
        {
            $updateSuccessMsg = "Password has been changed successfully";
            $_SESSION['PASSWORD_CHANGED_SUCCESS'] = $updateSuccessMsg;
            //redirectSuccess();
            mysqli_error($conn);
            $show = "select password from tbl_user where email='$emailFromLink'";
            $showfire = mysqli_query($conn, $show);
            $row = mysqli_fetch_assoc($showfire);
            echo $row['password'];
        }
        else{
            $updatePasswordFailedMsg = "Password did not changed, Something went wrong";
            $_SESSION['PASSWORD_CHANGED_FAILED'] = $updatePasswordFailedMsg;
            redirectFail();
        }
    }
}
else{
    $_SESSION['NEW_PASSWORD_STATUS'] = "Link has been expired";
    redirectFail();
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
    <link rel="stylesheet" href="../../styleassets/css/main.css" >
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
                            <input type="password" name="new_password" id="new_password" placeholder="New Password" />
                            <span class="error"><?php echo $newPassErr?></span>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_new_password" id="re_new_password" placeholder="Repeat your password" />
                            <span class="error"><?php echo $renewPassErr?></span>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="register" id="register" class="form-submit" value="Register" />
                            <input type="reset" name="Reset" id="reset" class="resetnewpass" value="Reset" />
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