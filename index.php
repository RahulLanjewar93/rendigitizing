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

                document.getElementsByTagName("BODY")[0].onresize = function () {closeSlideMenu()};
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
                    <h2 class="my-md-3 site-title">RenDigitizing</h2>
                </div>
                <div class="col-md-6 text-right my-auto">
                    <p class="my-md-4 header-links">
                        <?php if(isset($_SESSION['USER'])){ ?><a
                            href="user/profile/account.php?nosession=false&ref=index"
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


                    <li class="nav-item">
                        <a class="nav-link" href="user/authentication/login.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
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
        <a href="user/newprofile/account.php">My Acccount</a>
        <a href="user/newprofile/placeorder.php">My Orders</a>
        <a href="about.php">About us</a>
        <a href="contact.php">Contact Us</a>
        <a href="index.php">Home</a>
    </div>

    <div class="index-body-area" id="indexBodyArea">
        <div class="hero-banner">
            <div class="main-shop-area">
                <h3 class="my-2 main-shop-area-title">Best Selling</h3>
                <!-- <div class="row">
          <div class="card-banner">
            <img class="card-img-top" src="/styleassets/images/items/item1.jpg" alt="Card image cap">
            <div class="card-body">
              <h6>Embroidery</h6>
              <h3>Neon</h3>
              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-primary"><i class="fas fa-shopping-basket px-2"></i>Buy
                    Now</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-danger"><i class="fas fa-share px-2"></i>Details</button>
                </div>
              </div>
              <h5>99</h5>
            </div>
          </div>
          <div class="card-banner">
            <img class="card-img-top" src="/styleassets/images/items/item1.jpg" alt="Card image cap">
            <div class="card-body">
              <h6>Embroidery</h6>
              <h3>Neon</h3>
              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-primary"><i class="fas fa-shopping-basket px-2"></i>Buy
                    Now</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-danger"><i class="fas fa-share px-2"></i>Details</button>
                </div>
              </div>
              <h5>99</h5>
            </div>
          </div>
          <div class="card-banner">
            <img class="card-img-top" src="/styleassets/images/items/item1.jpg" alt="Card image cap">
            <div class="card-body">
              <h6>Embroidery</h6>
              <h3>Neon</h3>
              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-primary"><i class="fas fa-shopping-basket px-2"></i>Buy
                    Now</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-danger"><i class="fas fa-share px-2"></i>Details</button>
                </div>
              </div>
              <h5>99</h5>
            </div>
          </div>
          <div class="card-banner">
            <img class="card-img-top" src="/styleassets/images/items/item1.jpg" alt="Card image cap">
            <div class="card-body">
              <h6>Embroidery</h6>
              <h3>Neon</h3>
              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-primary"><i class="fas fa-shopping-basket px-2"></i>Buy
                    Now</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-danger"><i class="fas fa-share px-2"></i>Details</button>
                </div>
              </div>
              <h5>99</h5>
            </div>
          </div>
        </div> -->
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-3 main-shop-card-exception">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product1.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Accessories</p>
                                <h4 class="card-product__title"><a href="single-product.html">Quartz Belt Watch</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3 main-shop-card">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product2.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Beauty</p>
                                <h4 class="card-product__title"><a href="single-product.html">Women Freshwash</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3 main-shop-card">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product3.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Decor</p>
                                <h4 class="card-product__title"><a href="single-product.html">Room Flash Light</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3 main-shop-card">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product4.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Decor</p>
                                <h4 class="card-product__title"><a href="single-product.html">Room Flash Light</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="personalized-buy-area">
            <div class="personalized-text-area">
                <h3>We offer personalized embroidery</h3>
                <button class="btn btn-custom"> <a href="">Know More</a></button>
            </div>
        </div>

        <div class="trending-area">
            <div class="container">
                <div class="trending-area-title py-5 px-4">
                    <h1>Trending Now</h1>
                </div>
            </div>
            <div class="trending-card">
                <div id="carouselExampleIndicators" class="carousel slide trending-card-img-top" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./styleassets/images/banners/banner2.jpg" class="d-block w-100 carosuel-img"
                                alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/styleassets/images/banners/pngtree-chinese-style-classical-morandi-blue-background-image_14740.jpg"
                                class="d-block w-100 carosuel-img" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/styleassets/images/banners/banner2.jpg" class="d-block w-100 carosuel-img"
                                alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro trending-area-title pb-5 px-4">
                    <p>Popular Item in the market</p>
                    <h2>Trending Product</span></h2>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product1.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Accessories</p>
                                <h4 class="card-product__title"><a href="single-product.html">Quartz Belt Watch</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product2.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Beauty</p>
                                <h4 class="card-product__title"><a href="single-product.html">Women Freshwash</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product3.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Decor</p>
                                <h4 class="card-product__title"><a href="single-product.html">Room Flash Light</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product4.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Decor</p>
                                <h4 class="card-product__title"><a href="single-product.html">Room Flash Light</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product5.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Accessories</p>
                                <h4 class="card-product__title"><a href="single-product.html">Man Office Bag</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product6.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Kids Toy</p>
                                <h4 class="card-product__title"><a href="single-product.html">Charging Car</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product7.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Accessories</p>
                                <h4 class="card-product__title"><a href="single-product.html">Blutooth Speaker</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="img/product/product8.png" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>Kids Toy</p>
                                <h4 class="card-product__title"><a href="#">Charging Car</a></h4>
                                <p class="card-product__price">$150.00</p>
                            </div>
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