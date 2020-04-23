<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
  session_start();
  require_once "../../db/connection/conn.php";
  if(isset($_SESSION['USER']))
  {
    $userEmail = $_SESSION['USER'];
    $searchInput = $_POST['searchinput'];
    $searchKeyword = mysqli_real_escape_string($conn, $searchInput);
    
    if(isset($_POST['btnsearch']))
    {
        $searchResult = "SELECT * FROM tbl_order WHERE user = '$userEmail' AND category = 'Emboridery Image' AND ( 
        design_name LIKE '%".$searchKeyword."%' OR ponumber LIKE '%".$searchKeyword."%' OR turnarround LIKE '%".$searchKeyword."%' 
        OR stitch LIKE '%".$searchKeyword."%' OR application LIKE '%".$searchKeyword."%' OR fabric LIKE '%".$searchKeyword."%' 
        OR thread LIKE '%".$searchKeyword."%' OR dimension LIKE '%".$searchKeyword."%' OR dimension_width LIKE '%".$searchKeyword."%' 
        OR dimension_height LIKE '%".$searchKeyword."%' OR order_flag LIKE '%".$searchKeyword."%')";

        $searchResultFire = mysqli_query($conn, $searchResult);
    }
      //Pagination
      if(isset($_GET['page']))
      {
          $page = $_GET['page'];
      }
      else
      {
          $page = 1;
      }

      $num_per_page = 05;
      $start_from = ($page-1)*05;
      $fetchei = "SELECT * FROM tbl_order WHERE user = '$userEmail' AND category = 'Emboridery Image' LIMIT $start_from, $num_per_page";
      $fetcheiFire = mysqli_query($conn, $fetchei);
      //echo $userEmail;

      
  }
  else{
      header("location:http://localhost/RenDigitizingUpdated/user/authentication/login.php?nosession=true");
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
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
  <script>
    function openSlideMenu() {

      $("#indexBar").fadeIn(400);
      document.getElementById('indexBar').style.display = 'flex';
      $("#openMenu").fadeOut(400);
      document.getElementById('openMenu').style.display = 'none';
      $("#closeMenu").fadeIn(400);
      document.getElementById('closeMenu').style.display = 'inherit';
      $("#mainContactArea").fadeOut(400);
    }

    function closeSlideMenu() {
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
        <div class="col-md-6 text-left my-auto">
          <span class="slide">
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
        </div>
      </div>
    </div>
  </header>
  <div class="col-md-3 profile-area-sidebar indexnewnavbar p-5 my-2" id="indexBar">
    <a href="account.php">My Acccount</a>
    <a class="current" href="orders.php">My Orders</a>
    <a href="placeorder.php">Place an order</a>
    <a href="../../aboutus.php">About us</a>
    <a href="../../contact.php">Contact Us</a>
  </div>

  <div class="profile-area" id="mainContactArea">
    <div class="container2 mx-5">
      <div class="row row1">
        <div class="col-md-3 profile-area-sidebar p-5">
          <a href="account.php">Account Details</a>
          <a class="current" href="orders.php">My Orders</a>
          <a href="placeorder.php">Place an Order</a>
          <a href="../authentication/logout.php?logout=success&from=orders">Home</a>
        </div>

        <div class="col-md-9 profile-area-content p-5">
          <div class="reach-out-buttons">
            <table class="table table-striped table-items">
              <th>
                <a href="orders.php" class="btn order-btn-1 d-block py-2 primary">Embroidery Images</a>
              </th>
              <th>
                <a href="embroiderytext.php" class="btn order-btn-1 d-block py-2 secondary">Embroidery Text</a>
              </th>
              <th>
                <a href="vectorart.php" class="btn order-btn-1 d-block py-2 tertiary">Vector Art</a>
              </th>
            </table>
          </div>
          <form action="" method="POST" id="searchForm"></form>
          <div class="ongoing-orders" id="ongoing-orders">
            <div class="row">
              <div class="col-md-6">
                <h1 class="profile-text-area">Embroidery Images</h1>
              </div>
              <div class="col-md-6">
                <div class="myOrderSearchArea">
                  <input class="search-text d-inline-block" type="text" name="searchinput"
                    placeholder="Enter product name" form="searchForm">
                  <button class="btn d-inline-block" form="searchForm" name="btnsearch" type="submit">
                    <li class="nav-item border rounded-circle mx-2 search-icon ">
                      <i class="fas fa-search p-2"></i>
                    </li>
                  </button>
                </div>
                <nav aria-label="Page navigation example" class="my-2">
                  <?php
                    $getEIRecords = "SELECT * FROM tbl_order WHERE user = '$userEmail' AND category = 'Emboridery Image'";
                    $getEIRecordsFire = mysqli_query($conn, $getEIRecords);
                    $total_records = mysqli_num_rows($getEIRecordsFire);

                    $total_pages = ceil($total_records/$num_per_page);


                    ?>
                  <ul class="pagination justify-content-end" id="Pagination">
                    <?php
                      if($page>1)
                      { ?>
                    <li class="page-item">
                      <a class="page-link" href="orders.php?page=<?php echo ($page-1) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <?php } ?>
                    <?php
                      for($i=1; $i<$total_pages; $i++)
                      {?>
                    <li class="page-item"><a class="page-link"
                        href="orders.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php
                      if($i>$page)
                      {
                          ?>
                    <li class="page-item">
                      <a class="page-link" href="orders.php?page=<?php echo ($page+1)?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </nav>
              </div>
            </div>
            <?php if(mysqli_num_rows($fetcheiFire) > 0){ ?>
            <table class="table table-striped table-items">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Design Name</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!isset($_POST['btnsearch'])){ while($rows = mysqli_fetch_array($fetcheiFire)){ ?>
                <tr>
                  <td> <img class="table-image py-2"
                      src="Uploads/DesignImages/<?php echo $rows['emboridery_design_image']?>" alt=""> </td>
                  <td><?php echo $rows['design_name'] ?></td>
                  <td> <?php echo $rows['price'] ?> </td>
                  <td> <?php echo $rows['order_flag'] ?> </td>
                  <td>
                    <div class="row order-button-group d-block">
                      <div class="col-md-12">
                        <?php $OrderId = mysqli_real_escape_string($conn, $rows['order_id']); ?>
                        <button class="btn order-btn-1 d-block py-2 my-2" data-toggle="modal" data-target="#viewModal"
                          data-whatever="<?php echo $OrderId?>">View</button>
                        <button class="btn order-btn-3 d-block py-2 my-2" data-toggle="modal" data-target="#cancelModal"
                          data-whatever="<?php echo $OrderId?>">Cancel</button>
                      </div>
                    </div>
                  </td>
                  <div class="d-none">
                  <td> <?php echo $rows['ponumber'] ?> </td>
                  <td> <?php echo $rows['turnarround'] ?> </td>

                  <?php if(!empty($rows['emboridery_supporting_image'])){ ?>

                  <td> <img src="Uploads/SupportingImages/<?php echo $rows['emboridery_supporting_image'] ?>"> </td>

                  <?php } ?>

                  <td> <?php echo $rows['dimension'] ?> </td>
                  <td> <?php echo $rows['dimension_width'] ?> </td>
                  <td> <?php echo $rows['dimension_height'] ?> </td>
                  <td> <?php echo $rows['have_bg_color'] ?> </td>
                  <td> <?php echo $rows['stitch'] ?> </td>
                  <td> <?php echo $rows['application'] ?> </td>
                  <td> <?php echo $rows['thread'] ?> </td>
                  <td> <?php echo $rows['applique'] ?> </td>
                  <td> <?php echo $rows['comments'] ?> </td>
                </tr>
                <?php }
                }else if(mysqli_num_rows($searchResultFire)>0){
                ?>
                <?php while($searchrows = mysqli_fetch_array($searchResultFire)){ ?>
                <tr>
                  <td> <img class="table-image py-2"
                      src="Uploads/DesignImages/<?php echo $searchrows['emboridery_design_image']?>" alt=""> </td>
                  <td><?php echo $searchrows['design_name'] ?></td>
                  <td> <?php echo $searchrows['price'] ?> </td>
                  <td> <?php echo $searchrows['order_flag'] ?> </td>
                  <td>
                    <div class="row order-button-group d-block">
                      <div class="col-md-12">
                        <?php $OrderId = mysqli_real_escape_string($conn, $searchrows['order_id']); ?>
                        <a class="btn order-btn-1 d-block py-2" href="view.php?orderid=<?php echo $OrderId ?>">View</a>
                        <a class="btn order-btn-2 d-block py-2"
                          href="cancel.php?orderid=<?php echo $OrderId ?>">Cancel</a></div>
                    </div>
                  </td>
                </tr>
                <?php } }
                else
                {
                  echo "No order found";
                } ?>
              </tbody>
            </table>
            <?php } else {
              echo "No Orders Found !";
            } ?>
            <nav aria-label="Page navigation example" class="my-2">

              <ul class="pagination justify-content-end" id="Pagination">
                <?php
                      if($page>1)
                      { ?>
                <li class="page-item">
                  <a class="page-link" href="orders.php?page=<?php echo ($page-1) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <?php } ?>
                <?php
                      for($i=1; $i<$total_pages; $i++)
                      {?>
                <li class="page-item"><a class="page-link" href="orders.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
                <?php } ?>
                <?php
                    if($i>$page)
                    {
                ?>
                <li class="page-item">
                  <a class="page-link" href="orders.php?page=<?php echo ($page+1)?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
                <?php } ?>
              </ul>
            </nav>
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
  <script>
    var x = window.matchMedia("(max-width: 800px)");
    if (x.matches) {
      $(".profile-area-content").removeClass("p-5").addClass("py-2 px-2");
      $(".profile-text-area").addClass("my-3");
    }
  </script>
</body>

</html>