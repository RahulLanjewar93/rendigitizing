<?php
session_start();
require_once "db/connection/conn.php";
$nosession = "";
if(isset($_SESSION['USER']))
{
    $userEmail = $_SESSION['USER'];
    $nosession = "false";
    
}
else{
    $nosession = "true";
    session_unset();
    
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
    <link rel="stylesheet" href="styleassets/css/style1.css">
    <link rel="stylesheet" href="styleassets/css/main.css" type="text/css">

    <script src="https://kit.fontawesome.com/4851c149c0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>


    <script>
        // $(document).ready(function () {


        //     var textWrapper1 = document.querySelector('.hero-subtitle1');
        //     textWrapper1.innerHTML = textWrapper1.textContent.replace(/\S/g, "<span class='letter'>$&</span>");


        //     anime.timeline({})
        //         .add({

        //             targets: '.hero-subtitle1 .letter',
        //             opacity: [0, 1],
        //             easing: "easeInOutQuad",
        //             duration: 3400,
        //             delay: (el, i) => 150 * (i + 1)

        //         });

        //     var textWrapper = document.querySelector('.hero-subtitle2');
        //     textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");


        //     anime.timeline({})
        //         .add({

        //             targets: '.hero-subtitle2 .letter',
        //             opacity: [0, 1],
        //             easing: "easeInOutQuad",
        //             duration: 3400,
        //             delay: (el, i) => 150 * (i + 1)

        //         });

        //     $('div.hero-subtitle').fadeOut(6000);
        //     setTimeout(function () {
        //         $('div.item-body').fadeIn(3000).removeClass('hidden');
        //     }, 5000);
        // });
    </script>
    <script>
        function openSlideMenu() {

            $("#indexBar").fadeIn(400);
            document.getElementById('indexBar').style.display = 'flex';
            $("#openMenu").fadeOut(400);
            document.getElementById('openMenu').style.display = 'none';
            $("#closeMenu").fadeIn(400);
            document.getElementById('closeMenu').style.display = 'inherit';
            $("#indexBodyArea").fadeOut(400);

            document.getElementsByTagName("BODY")[0].onresize = function () {
                closeSlideMenu()
            };
        }

        function closeSlideMenu() {
            $("#indexBar").fadeOut(400);
            // document.getElementById('sideBar').style.display = 'none';
            $("#openMenu").fadeIn(400);
            document.getElementById('openMenu').style.display = 'inherit';
            $("#closeMenu").fadeOut(400);
            document.getElementById('closeMenu').style.display = 'none';
            $("#indexBodyArea").fadeIn(400);
        }
    </script>
</head>

<body>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left my-auto">
                    <span class="slide text-left">
                        <a href="#" class="openmenu" id="openMenu" onclick="openSlideMenu()">
                            <i class="fas fa-bars hamburger"></i>
                        </a>
                        <a href="#" class="closemenu" id="closeMenu" onclick="closeSlideMenu()">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>

                    <h2 class="my-md-3 site-title">
                        <a href="index.php">RenDigitizing</a>
                    </h2>


                </div>
                <div class="col-md-6 text-right my-auto">
                    <p class="my-md-4 header-links">
                        <?php if(isset($_SESSION['USER'])){ ?>
                        <a href="user/profile/account.php?nosession=false&ref=index"
                            class="px-2"><?php echo $_SESSION['USER'] ?></a><?php }else{ ?><a
                            href="user/authentication/register.php?nosession=true&ref=index" class="px-2">Create an
                            account</a><?php } ?>
                        <?php if(isset($_SESSION['USER'])){ ?><a
                            href="user/authentication/logout.php?securelogout=success"
                            class="px-2">Logout</a><?php }else{ ?><a
                            href="user/authentication/login.php?nosession=true&ref=index"
                            class="px-2">Login</a><?php } ?>

                    </p>
                </div>
            </div>
        </div>
</header>

    <div class="container-fluid p-0 subNavbarHide">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fas fa-bars fa-1x"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?nosession=<?php echo $nosession ?>&home=refreshed">Home
                            <span class="sr-only">(current)</span></a>
                    </li>

                    <?php if(isset($userEmail)){ ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="user/profile/account.php?nosession=false&ref=index">My Account<span
                                class="sr-only">(current)</span></a>
                    </li>

                    <?php } ?>


                    <?php if(isset($userEmail)){ ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="user/profile/orders.php?nosession=false&ref=index">My Orders<span
                                class="sr-only">(current)</span></a>
                    </li>

                    <?php } ?>

                    <?php if(isset($userEmail)){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user/profile/placeorder.php?nosession=false&ref=index">Place an
                            order</a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user/authentication/login.php">Place an order</a>
                    </li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php?nosession=<?php echo $nosession ?>">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="navbar-nav1">
                <input class="search-text" type="text" placeholder="Enter product name">
                <button class="btn">
                    <li class="nav-item border rounded-circle mx-2 search-icon">
                        <i class="fas fa-search p-2"></i>
                    </li>
                </button>
            </div>
        </nav>
    </div>

    <div class="col-md-3 profile-area-sidebar indexnewnavbar p-5 my-2" id="indexBar">
        <a href="index.php">Home</a>
        <a href="user/profile/account.php">My Acccount</a>
        <a href="user/profile/placeorder.php">My Orders</a>
        <a class="current" href="about.php">About us</a>
        <a href="contact.php">Contact Us</a>
    </div>

    <h1 align="center" class="p-5 m-5">Still needs to be developed</h1>

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