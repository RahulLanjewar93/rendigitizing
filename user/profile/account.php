<?php

 require_once "../../db/connection/conn.php";
 session_start();
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 //ini_set("display_errors",1);
 if (isset($_SESSION['USER'])) {

    $OldPasswordErr = "";
    $NewPasswordErr = "";
    $ConfirmPasswordErr = "";
    $changeFailedMsg = "";
    $changeSuccessMsg ="";
     //Display user details
     $user = $_SESSION['USER'];
     $getDetails = "SELECT * FROM tbl_user WHERE email = '$user'";
     $getDetailsFire = mysqli_query($conn, $getDetails);
     //$getDetailsRows = mysqli_fetch_assoc($conn, $getDetailsFire);

     /*$fetchOldPassword = "SELECT password FROM tbl_user WHERE email = '$user'";
     $fetchOldPasswordFire = mysqli_query($conn, $fetchOldPassword);
     $OP = mysqli_fetch_array($fetchOldPasswordFire);
     $oldPasswordEncr = sha1($OP['password']);
     echo $OP['password'];*/



     if (isset($_POST['btnpasswordchange'])) {
         $oldPassword = mysqli_real_escape_string($conn, $_POST['old-account-password']); //Need to encrypt
         $newPassword = mysqli_real_escape_string($conn, $_POST['new-account-password']);
         $confPassword = mysqli_real_escape_string($conn, $_POST['confirm-new-account-password']);



         $fetchOldPassword = "SELECT password FROM tbl_user WHERE email = '$user'"; //Already Encrypted
         $fetchOldPasswordFire = mysqli_query($conn, $fetchOldPassword);
         $OP = mysqli_fetch_array($fetchOldPasswordFire);
         //===========================================================
         $oldPasswordEncr = sha1($oldPassword);
         //echo $OP['password'];
         //echo $oldPasswordEncr;


         //$resultRow = mysqli_fetch_assoc($getDetailsFire);



         //Password change code
         $uppercase = preg_match('@[A-Z]@', $newPassword);
         $lowercase = preg_match('@[a-z]@', $newPassword);
         $number = preg_match('@[0-9]@', $newPassword);
         $specialChars = preg_match('@[^\w]@', $newPassword);

         $OldPasswordErr = "";
         $NewPasswordErr = "";
         $ConfirmPasswordErr = "";
         $PasswordErrCount = 0;

         if($OP['password'] != $oldPasswordEncr)
         {
             $OldPasswordErr = "Invalid Old Password !";
             $PasswordErrCount =+ 1;
         }
         if (empty($oldPassword)) {
             $OldPasswordErr = "Enter current password";
             $PasswordErrCount =+ 1;
             echo "1<br/>";
         } if (strlen($oldPassword) > 50) {
             $OldPasswordErr = "Password is too long";
             $PasswordErrCount =+ 1;
             echo "2<br/>";
         } if (strlen($oldPassword) < 8) {
             $OldPasswordErr = "Password is too short";
             $PasswordErrCount =+ 1;
             echo "3<br/>";
         } if (empty($newPassword)) {
             $NewPasswordErr = "Enter new password";
             $PasswordErrCount =+ 1;
             echo "4<br/>";
         } if (strlen($newPassword) > 50) {
             $NewPasswordErr = "Password is too long";
             $PasswordErrCount =+ 1;
             echo "5<br/>";
         } if (strlen($newPassword) < 8) {
             $NewPasswordErr = "Password is too short";
             $PasswordErrCount =+ 1;
             echo "6<br/>";
         } if (!$uppercase && !$lowercase && !$number && !$specialChars) {
             $NewPasswordErr = "Make sure to include uppercase, lowercase, numeric and special characters in password";
             $PasswordErrCount =+ 1;
             echo "7<br/>";
         } if ($newPassword != $confPassword) {
             $confPasswordErr = "Password does not matched";
             $PasswordErrCount =+ 1;
             echo "8<br/>";
         } if($PasswordErrCount == 0)
         {
             $oldEncryptedPassword = sha1($oldPassword);
             $newEncryptedPassword = sha1($newPassword);
             $userEmail = $_SESSION['USER'];
             $updatePassword = "UPDATE tbl_user SET password = '$newEncryptedPassword' WHERE email = '$userEmail' AND password = '$oldEncryptedPassword'";
             $updatePasswordFire = mysqli_query($conn, $updatePassword);

             if($updatePasswordFire)
             {
                 $changeSuccessMsg = "Password has been changed successfully";
                 //echo $changeSuccessMsg;
             }
             else
             {
                 $changeFailedMsg = "Something went wrong";
                 //echo $changeFailedMsg;
             }
         }
         else {
            //echo $PasswordErrCount;

         }
}
     else if(isset($_POST['btnsave'])){
         $Currency = mysqli_real_escape_string($conn, $_POST['currency']);
         $ComapanyName = mysqli_real_escape_string($conn, $_POST['company']);
         $Address = mysqli_real_escape_string($conn, $_POST['address']);
         $PostalCode = mysqli_real_escape_string($conn, $_POST['postalcode']);

         $CurrencyErr = "";
         $CompanyNameErr = "";
         $AddressErr = "";
         $PostalCodeErr = "";
         $ErrorCount = 0;

         if($Currency == "Select Payment Currency")
         {
             $CurrencyErr = "Please select a payment currency";
             $ErrorCount += 1;
         }
         if(empty($ComapanyName))
         {
             $CompanyNameErr = "Please enter your company name";
             $ErrorCount += 1;
         }
         if(strlen($ComapanyName)<2)
         {
             $CompanyNameErr = "Please enter a valid company name";
             $ErrorCount += 1;
         }
         if(strlen($ComapanyName)>50)
         {
             $CompanyNameErr = "Company name is too big";
             $ErrorCount += 1;
         }
         if(empty($Address))
         {
             $AddressErr = "Please enter address";
             $ErrorCount += 1;
         }
         if(strlen($Address)<10)
         {
             $AddressErr = "Address should be at least of 10 characters";
             $ErrorCount += 1;
         }
         if(strlen($Address)>150)
         {
             $AddressErr = "Address is too long, max 150 characters";
             $ErrorCount += 1;
         }
         if(empty($PostalCode))
         {
             $PostalCodeErr = "Please enter postal code";
             $ErrorCount += 1;
         }
         if(strlen($PostalCode)<6 || strlen($PostalCode)>8 && strlen($PostalCode) == 7)
         {
             $PostalCodeErr = "Invalid postal code";
             $ErrorCount += 1;
         }
         if($ErrorCount == 0)
         {
             $DetailsUpdate = "UPDATE tbl_user SET currency = '$Currency', company = '$ComapanyName', address = '$Address', postalcode = '$PostalCode' WHERE email = '$user'";
             $DetailsUpdateFire = mysqli_query($conn, $DetailsUpdate);

             if($DetailsUpdateFire)
             {
                 header("location:account.php?detailsupdate=success");
             }
             else{
                 echo mysqli_error($conn);
             }
         }
         else{
             echo $ErrorCount;
         }
     }
 } else {
     header("location:http://rendigitizing.com/index.php?nosession=true");
 }
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RenDigitizing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styleassets/css/style.css">
    <link rel="stylesheet" href="../../styleassets/css/main.css" type="text/css">
    <script src="https://kit.fontawesome.com/4851c149c0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function () {
                $("#btnSubmit").click(function () {
                    var password = $(".pass1").val();
                    var confirmPassword = $(".pass2").val();

                    if (password != confirmPassword) {
                        document.getElementById("demo").innerHTML = "* Passwords do not match.";
                        return false;
                    }
                    return true;
                });
            }

        );
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
        function openSlideMenu() {
            document.getElementById("profileAreaForNav").style.display = "none";
            $("#indexBar").fadeIn(400);
            document.getElementById('indexBar').style.display = 'flex';
            $("#openMenu").fadeOut(400);
            document.getElementById('openMenu').style.display = 'none';
            $("#closeMenu").fadeIn(400);
            document.getElementById('closeMenu').style.display = 'inherit';
            $("#mainContactArea").fadeOut(400);
            document.getElementsByTagName("BODY")[0].onresize = function () {
                closeSlideMenu()
            };

        }

        function closeSlideMenu() {
            document.getElementById("profileAreaForNav").style.display = "block";
            $("#indexBar").fadeOut(400);
            // document.getElementById('sideBar').style.display = 'none';
            $("#openMenu").fadeIn(400);
            document.getElementById('openMenu').style.display = 'inherit';
            $("#closeMenu").fadeOut(400);
            document.getElementById('closeMenu').style.display = 'none';
            $("#mainContactArea").fadeIn(400);
        }
    </script>
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <span class="slide text-left">
                        <a href="#" class="openmenu" id="openMenu" onclick="openSlideMenu()">
                            <i class="fas fa-bars hamburger"></i>
                        </a>
                        <a href="#" class="closemenu" id="closeMenu" onclick="closeSlideMenu()">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    <h2 class="my-md-3 site-title">
                        <a href="../../index.php">RenDigitizing</a>
                    </h2>
                </div>
                <div class="col-md-6 text-right my-auto">
                    <p class="my-md-4 header-links">
                        <?php if(isset($_SESSION['USER'])){ ?>
                        <a href="account.php?nosession=false&ref=index" class="px-2">
                            <?php echo $_SESSION['USER'] ?>
                        </a>
                        <?php }else{ ?>
                        <a href="../authentication/register.php?nosession=true&ref=index" class="px-2">Create an
                            account</a>
                        <?php } ?>
                        <?php if(isset($_SESSION['USER'])){ ?>
                        <a href="../authentication/logout.php?securelogout=success" class="px-2">Logout
                        </a>
                        <?php }else{ ?>
                        <a href="../authentication/login.php?nosession=true&ref=index" class="px-2">Login</a>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </header>
    <div class="col-md-3 profile-area-sidebar indexnewnavbar p-5 my-2" id="indexBar">
        <a class="current" href="account.php">My Acccount</a>
        <a href="orders.php">My Orders</a>
        <a href="placeorder.php">Place on order</a>
        <a href="../../aboutus.php">About us</a>
        <a href="../../contact.php">Contact Us</a>
    </div>
    <div class="profile-area" id="profileAreaForNav">
        <div class="container2 mx-5">
            <div class="row row1">
                <div class="col-md-3 profile-area-sidebar p-5">
                    <a class="current" href="account.php">Account Details</a>
                    <a href="orders.php">My Orders</a>
                    <a href="placeorder.php">Place an Order</a>
                    <a href="../../index.php?from=myaccount">Home</a>
                </div>
                <div class="col-md-9 profile-area-content p-5">
                    <h1 class="profile-text-area">My Account</h1>
                    <span class="error"><?php echo $OldPasswordErr; ?></span>
                    <span class="error"><?php echo $NewPasswordErr; ?></span>
                    <span class="error"><?php echo $ConfirmPasswordErr; ?></span>
                    <span class="error"><?php echo $changeFailedMsg; ?></span>
                    <span class="success"><?php echo $changeSuccessMsg; ?></span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="container myaccount-details-area">
                                <h3>General Information</h3>
                                <form method="post">
                                    <table class="myaccount-details-table">
                                        <?php while($getDetailsRows = mysqli_fetch_array($getDetailsFire)){ ?>
                                        <tr>
                                            <td>
                                                <h5>First Name</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">:
                                                    <?php echo ucfirst($getDetailsRows['firstname']); ?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Last Name</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">:
                                                    <?php echo ucfirst($getDetailsRows['lastname']); ?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Phone Number</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">:
                                                    <?php echo $getDetailsRows['phone'] ?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Email Address</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">:
                                                    <?php echo $getDetailsRows['email'] ?></h5>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5>Currency</h5>
                                            </td>
                                            <td>
                                                <div class="dropdown myaccount-details-phpcontent">
                                                    <?php if(empty($getDetailsRows['currency'])){ ?>
                                                    <select name="currency" id="currency" class="btn dropdown-select">
                                                        <option value="Select Payment Currency">Select Payment Currency
                                                        </option>
                                                        <option value="USD">USD</option>
                                                        <option value="Euro">Euro</option>
                                                        <option value="British Pounds">British Pounds</option>
                                                    </select>
                                                    <?php }else{ ?>
                                                    <h5 class="myaccount-details-phpcontent">:
                                                        <?php echo $getDetailsRows['currency'] ?></h5>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Company Name</h5>
                                            </td>
                                            <td>
                                                <?php if(empty($getDetailsRows['company'])){ ?>
                                                <h5 class="myaccount-details-phpcontent">
                                                    <input type="text" name="company" id="" minlength="3" maxlength="50"
                                                        pattern="([A-Za-z0-9]+)" required>
                                                </h5>
                                                <?php }else{ ?>
                                                <h5 class="myaccount-details-phpcontent">:
                                                    <?php echo $getDetailsRows['company'] ?></h5>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="myaccount-details-area">
                                <div class="container myaccount-change-password">
                                    <table>
                                        <tr>
                                            <td>
                                                <h5>Address</h5>
                                            </td>
                                            <td>
                                                <?php if(empty($getDetailsRows['address'])){ ?>
                                                <h5 class="myaccount-details-phpcontent">
                                                    <input type="text" name="address" id="" required minlength="10"
                                                        maxlength="150">
                                                </h5>
                                                <?php }else{ ?>
                                                <h5 class="myaccount-details-phpcontent">:
                                                    <?php echo $getDetailsRows['address'] ?></h5>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Postal Code</h5>
                                            </td>
                                            <td><?php if(empty($getDetailsRows['postalcode'])){ ?>

                                                <h5 class="myaccount-details-phpcontent">
                                                    <input type="number" name="postalcode" id="" required
                                                        pattern="([0-9]){6} [0-9]){8}">
                                                </h5>
                                                <?php }else{ ?>
                                                <h5 class="myaccount-details-phpcontent">:
                                                    <?php echo $getDetailsRows['postalcode'] ?></h5>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <?php
                                                if(empty($getDetailsRows['currency'])
                                                    &&
                                                    empty($getDetailsRows['company'])
                                                &&
                                                    empty($getDetailsRows['address'])
                                                &&
                                                    empty($getDetailsRows['postalcode'])){ ?>
                                                <input class="btn order-btn-1 d-block py-2 m-5" id="btnSave"
                                                    type="submit" value="Save" name="btnsave">

                                                <?php }else{
                                                    echo "Details Updated <br/>";
                                                } ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php } ?>
                                    </form>
                                </div>
                                <h3 class="mt-3">Change Password?</h3>

                                <button type="button" class="btn order-btn-1" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    Click Here
                                </button>

                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title profile-text-area" id="exampleModalLongTitle">
                                                    Change Password</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <form id="passwordValidation" data-toggle="validator" method="post">
                                                        <tr>
                                                            <td>
                                                                <h5>Old Password</h5>
                                                            </td>
                                                            <td><input type="password" id="old-account-password"
                                                                    name="old-account-password" required>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>New Password</h5>
                                                            </td>
                                                            <td>
                                                                <input type="password" id="new-account-password"
                                                                    name="new-account-password" class="pass1" required>
                                                                <progress max="100" value="0" id="strength"></progress>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Confirm New Password</h5>
                                                            </td>
                                                            <td>
                                                                <input type="password" id="confirm-new-account-password"
                                                                    name="confirm-new-account-password" class="pass2"
                                                                    required>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <table class="table table-items">
                                                    <tr>
                                                        <td>
                                                            <input form="passwordValidation" name="btnpasswordchange"
                                                                class="btn order-btn-1 d-block p-2 m-3" id="btnSubmit"
                                                                type="submit">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span id="demo"></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <p>Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit. Perferendis incidunt illo tenetur consequuntur.
                                    Magni,
                                    ad earum. Obcaecati adipisci incidunt ipsa,
                                    provident voluptate id nobis,
                                    cumque sed corrupti,
                                    itaque ullam praesentium? </p>
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        var pass = document.getElementById("new-account-password")
        pass.addEventListener('keyup', function () {
            checkPassword(pass.value)
        })

        function checkPassword(password) {
            var strengthBar = document.getElementById("strength")
            var strength = 0;

            if (password.match(/[a-zA-z0-9][a-zA-z0-9]+/)) {
                strength += 1
            }

            if (password.match(/[~<>?]+/)) {
                strength += 1
            }

            if (password.match(/[ !@$%*&*()]+/)) {
                strength += 1
            }

            if (password.length > 5) {
                strength += 1
            }

            switch (strength) {
                case 0:
                    strengthBar.value = 0;
                    break;
                case 1:
                    strengthBar.value = 25;
                    break;
                case 2:
                    strengthBar.value = 50;
                    break;
                case 3:
                    strengthBar.value = 75;
                    break;
                case 4:
                    strengthBar.value = 100;
                    break;
            }
        }
    </script>
    <script>
        var x = window.matchMedia("(max-width: 800px)");
        if (x.matches) {
            $(".profile-area-content").removeClass("p-5").addClass("py-2 px-2");
            $(".profile-text-area").addClass("my-3");
        }
    </script>
</body>

</html>