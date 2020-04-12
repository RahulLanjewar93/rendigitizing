<!DOCTYPE html>
<html lang="en">

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
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h2 class="my-md-3 site-title">RenDigitizing</h2>
                </div>
                <div class="col-md-6 text-right">
                    <!-- <p class="my-md-4 header-links">
                        <a href="../RenDigitizing/user/authentication/login.php" class="px-2">Sign IN</a>
                        <a href="../RenDigitizing/user/authentication/register.php" class="px-1">Create an Account</a>
                    </p> -->
                </div>
            </div>
        </div>
    </header>



    <div class="profile-area">
        <div class="container2 m-5">
            <div class="row row1">
                <div class="col-md-3 profile-area-sidebar p-5">
                    <h1>My Account</h1>
                    <a class="current" href="orders.php">My Orders</a>
                    <a href="account.php">Account Details</a>
                    <a href="../../index.php">Logout</a>
                </div>
                <div class="col-md-9 profile-area-content p-5">
                    <h1 class="profile-text-area">My orders</h1>
                    <table class="table table-striped table-items">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Estimated Delivery</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <img class="table-image py-2" src="../../styleassets/images/items/item1.jpg" alt=""> </td>
                                <td>Embroidery</td>
                                <td> 1 </td>
                                <td> 250 </td>
                                <td> In Transit </td>
                                <td> 26 Jan </td>
                                <td>
                                <div class="row order-button-group d-block">
                                  <div class="col-md-12">
                                  <button class="btn order-btn-1 d-block py-2">View</button>
                                  <button class="btn order-btn-2 d-block py-2">Edit</button></div>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <img class="table-image py-2" src="../../styleassets/images/items/item1.jpg" alt=""> </td>
                                <td> Embroidery </td>
                                <td> 1 </td>
                                <td> 250 </td>
                                <td> In Transit </td>
                                <td> 26 Jan </td>
                                <td>
                                <div class="row order-button-group d-block">
                                  <div class="col-md-12">
                                  <button class="btn order-btn-1 d-block py-2">View</button>
                                  <button class="btn order-btn-2 d-block py-2">Edit</button></div>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <img class="table-image py-2" src="../../styleassets/images/items/item1.jpg" alt=""> </td>
                                <td> Embroidery </td>
                                <td> 1 </td>
                                <td> 250 </td>
                                <td> In Transit </td>
                                <td> 26 Jan </td>
                                <td>
                                <div class="row order-button-group d-block">
                                  <div class="col-md-12">
                                  <button class="btn order-btn-1 d-block py-2">View</button>
                                  <button class="btn order-btn-2 d-block py-2">Edit</button></div>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <img class="table-image py-2" src="../../styleassets/images/items/item1.jpg" alt=""> </td>
                                <td> Embroidery </td>
                                <td> 1 </td>
                                <td> 250 </td>
                                <td> In Transit </td>
                                <td> 26 Jan </td>
                                <td>
                                <div class="row order-button-group d-block">
                                  <div class="col-md-12">
                                  <button class="btn order-btn-1 d-block py-2">View</button>
                                  <button class="btn order-btn-2 d-block py-2">Edit</button></div>
                                </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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