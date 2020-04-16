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
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h2 class="my-md-3 site-title">RenDigitizing</h2>
                </div>
                <div class="col-md-6 text-right my-auto">
                    <?php if (isset($userEmail)) { ?>
                    <p class="my-md-4 header-links">
                        <a href="account.php" class="px-2"><?php echo $userEmail ?></a>
                        <a href="../authentication/logout.php" class="px-1">Logout</a>
                        <?php
                } else {
                    ?>
                        <a href="../authentication/login.php" class="px-2">Login</a>
                        <a href="../authentication/register.php" class="px-1">Create an account</a>
                    </p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <div class="profile-area">
        <div class="container2 mx-5">
            <div class="row row1">
                <div class="col-md-3 profile-area-sidebar p-5">
                    <a class="current" href="account.php">Account Details</a>
                    <a href="orders.php">My Orders</a>
                    <a href="placeorder.php">Place an Order</a>
                    <a href="../../index.php">Home</a>
                </div>
                <div class="col-md-9 profile-area-content p-5">
                    <h1 class="profile-text-area">My Account</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="container myaccount-details-area">
                                <h3>General Information</h3>
                                <form>
                                    <table class="myaccount-details-table">
                                        <tr>
                                            <td>
                                                <h5>First Name</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">: php content</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Last Name</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">: php content</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Phone Number</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">: php content</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Email Address</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">: php content</h5>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5>Currency</h5>
                                            </td>
                                            <td>
                                                <div class="dropdown myaccount-details-phpcontent">
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Select Payment Currency</option>
                                                        <option value="">USD</option>
                                                        <option value="">Euro</option>
                                                        <option value="">British Pounds</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Company Name</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">
                                                    <input type="text" name="" id="" minlength="3" maxlength="50"
                                                        pattern="([A-Za-z0-9]+)" required>
                                                </h5>
                                            </td>
                                        </tr>
                                    </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="container myaccount-change-password">
                                <div class="myaccount-details-area">
                                    <table>
                                        <tr>
                                            <td>
                                                <h5>Address</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">
                                                    <input type="text" name="" id="" required minlength="15"
                                                        maxlength="150" pattern="([A-Za-z0-9]+)">
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Postal Code</h5>
                                            </td>
                                            <td>
                                                <h5 class="myaccount-details-phpcontent">
                                                    <input type="number" name="" id="" required
                                                        pattern="([0-9]){6} [0-9]){8}">
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="btn order-btn-1 d-block py-2 m-5" id="btnSave"
                                                    type="submit" value="Save">
                                            </td>
                                        </tr>
                                    </table>
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
                                                    <form id="passwordValidation" data-toggle="validator">
                                                        <tr>
                                                            <td>
                                                                <h5>Old Password</h5>
                                                            </td>
                                                            <td><input type="text" id="old-account-password" required>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>New Password</h5>
                                                            </td>
                                                            <td>
                                                                <input type="password" id="new-account-password"
                                                                    class="pass1" required>
                                                                <progress max="100" value="0" id="strength"></progress>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Confirm New Password</h5>
                                                            </td>
                                                            <td>
                                                                <input type="password" id="confirm-new-account-password"
                                                                    class="pass2" required>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <table class="table table-items">
                                                    <tr>
                                                        <td>
                                                            <span id="demo"></span>
                                                        </td>
                                                        <td>
                                                            <input form="passwordValidation"
                                                                class="btn order-btn-1 d-block p-2 m-3" id="btnSubmit"
                                                                type="submit">
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
</body>

</html>