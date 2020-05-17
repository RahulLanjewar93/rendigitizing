<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once "../../db/connection/conn.php";

if (isset($_SESSION['USER'])) {
    //Search
    $userEmail = $_SESSION['USER'];
    $searchInput = $_POST['searchinput'];
    $searchKeyword = mysqli_real_escape_string($conn, $searchInput);
    
    if (isset($_POST['btnsearch'])) {
        $searchResult = "SELECT * FROM tbl_order WHERE user = '$userEmail' AND category = 'Emboridery Text' AND ( 
      emboridery_text LIKE '%".$searchKeyword."%' OR design_name LIKE '%".$searchKeyword."%' OR ponumber LIKE '%".$searchKeyword."%' OR turnarround LIKE '%".$searchKeyword."%' 
      OR stitch LIKE '%".$searchKeyword."%' OR application LIKE '%".$searchKeyword."%' OR fabric LIKE '%".$searchKeyword."%' 
      OR thread LIKE '%".$searchKeyword."%' OR dimension LIKE '%".$searchKeyword."%' OR dimension_width LIKE '%".$searchKeyword."%' 
      OR dimension_height LIKE '%".$searchKeyword."%' OR order_flag LIKE '%".$searchKeyword."%')";

        $searchResultFire = mysqli_query($conn, $searchResult);
    }
    //Pagination
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $num_per_page = 05;
    $start_from = ($page-1)*05;
    $fetchet = "SELECT * FROM tbl_order WHERE user = '$userEmail' AND category = 'Emboridery Text' LIMIT $start_from, $num_per_page";
    $fetchetFire = mysqli_query($conn, $fetchet);

/*if(mysqli_num_rows($fetchetFire)>1)
{
    //
}
else{
    $eiOrderEmptyMessage = "No orders availabe right now";
}*/
} else {
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
            <?php if (isset($_SESSION['USER'])) { ?>
            <a href="account.php?nosession=false&ref=index" class="px-2">
              <?php echo $_SESSION['USER'] ?>
            </a>
            <?php } else { ?>
            <a href="../authentication/register.php?nosession=true&ref=index" class="px-2">Create an
              account</a>
            <?php } ?>
            <?php if (isset($_SESSION['USER'])) { ?>
            <a href="../authentication/logout.php?securelogout=success" class="px-2">Logout
            </a>
            <?php } else { ?>
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
                <h1 class="profile-text-area">Embroidery Text</h1>
              </div>
              <div class="col-md-6">
                <div class="myOrderSearchArea">
                  <input class="search-text d-inline-block" name="searchinput" type="text" form="searchForm"
                    placeholder="Enter product name">
                  <button class="btn d-inline-block" form="searchForm" type="submit" name="btnsearch">
                    <li class="nav-item border rounded-circle mx-2 search-icon ">
                      <i class="fas fa-search p-2"></i>
                    </li>
                  </button>
                </div>
                <nav aria-label="Page navigation example" class="my-2">
                  <?php
                      $getETRecords = "SELECT * FROM tbl_order WHERE category = 'Emboridery Text'";
                      $getETRecordsFire = mysqli_query($conn, $getETRecords);
                      $total_records = mysqli_num_rows($getETRecordsFire);

                      $total_pages = ceil($total_records/$num_per_page);


                      ?>

                  <ul class="pagination justify-content-end" id="Pagination">
                    <?php
                          if ($page>1) { ?>
                    <li class="page-item">
                      <a class="page-link" href="embroiderytext.php?page=<?php echo($page-1) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <?php } ?>
                    <?php
                          for ($i=1; $i<$total_pages; $i++) {?>
                    <li class="page-item"><a class="page-link"
                        href="embroiderytext.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php
                          if ($i>$page) {
                              ?>
                    <li class="page-item">
                      <a class="page-link" href="embroiderytext.php?page=<?php echo($page+1)?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                    <?php
                          } ?>
                  </ul>
                </nav>
              </div>
            </div>
            <?php
            if (mysqli_num_rows($fetchetFire) > 0) {
                ?>
            <table class="table table-striped table-items">
              <thead>
                <tr>
                  <th>Text</th>
                  <th>Design Name</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!isset($_POST['btnsearch'])) {
                    while ($rows = mysqli_fetch_array($fetchetFire)) {
                ?>
                <tr>
                  <td><?php echo $rows['emboridery_text'] ?></td>
                  <td> <?php echo $rows['design_name'] ?> </td>
                  <td> <?php echo $rows['price'] ?> </td>
                  <td> <?php echo $rows['order_flag'] ?> </td>
                  <td class="d-none"> <?php echo $rows['ponumber'] ?> </td>
                  <td class="d-none"> <?php echo $rows['turnarround'] ?> </td>
                  <td class="d-none"> <?php echo $rows['dimension'] ?> </td>
                  <td class="d-none"> <?php echo $rows['dimension_width'] ?> </td>
                  <td class="d-none"> <?php echo $rows['dimension_height'] ?> </td>
                  <td class="d-none"> <?php echo $rows['have_bg_color'] ?> </td>
                  <td class="d-none"> <?php echo $rows['stitch'] ?> </td>
                  <td class="d-none"> <?php echo $rows['application'] ?> </td>
                  <td class="d-none"> <?php echo $rows['fabric'] ?> </td>
                  <td class="d-none"> <?php echo $rows['thread'] ?> </td>
                  <td class="d-none"> <?php echo $rows['applique'] ?> </td>
                  <td class="d-none"> <?php echo $rows['comments'] ?> </td>
                  <td class="d-none"> <?php echo $rows['order_at'] ?> </td>
                  <td class="d-none orderId"> <?php echo $rows['order_id'] ?> </td>
                  <td>
                    <div class="row order-button-group d-fblock">
                      <div class="col-md-12">
                        <?php $OrderId = mysqli_real_escape_string($conn, $rows['order_id']); ?>
                        <button class="btn order-btn-1 d-block py-2 my-2 viewButton" data-toggle="modal"
                          data-target="#viewModal" data-whatever="<?php echo $OrderId?>">View</button>

                          <a href="edit.php?cat=et&id=<?php echo $rows['order_id'] ?>" class="btn order-btn-2 d-block py-2 my-2 primary" style="color: white">Edit</a>

                          <?php if($rows['order_flag'] != "CANCELLED"){ ?>
                        <button class="btn order-btn-3 d-block py-2 my-2 cancelButton" data-toggle="modal"
                          data-target="#cancelModal" data-whatever="<?php echo $OrderId?>">Cancel</button>
                          <?php
                          } else{ ?>
                          <button class="btn order-btn-3 d-block py-2 my-2 disabled">CANCELLED</button>
                          <?php } ?>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
                    }
                } elseif (mysqli_num_rows($searchResultFire)>0) {
                    while ($searchRows = mysqli_fetch_array($searchResultFire)) {
                        ?>
                <tr>

                  <td><?php echo $searchRows['emboridery_text'] ?></td>
                  <td> <?php echo $searchRows['design_name'] ?> </td>
                  <td> <?php echo $searchRows['price'] ?> </td>
                  <td> <?php echo $searchRows['order_flag'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['ponumber'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['turnarround'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['dimension'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['dimension_width'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['dimension_height'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['have_bg_color'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['stitch'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['application'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['fabric'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['thread'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['applique'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['comments'] ?> </td>
                  <td class="d-none"> <?php echo $searchRows['order_at'] ?> </td>
                  <td class="d-none orderId"> <?php echo $searchRows['order_id'] ?> </td>
                  <td>
                    <div class="row order-button-group d-block">
                    <div class="col-md-12">
                        <?php $OrderId = mysqli_real_escape_string($conn, $searchRows['order_id']); ?>
                        <button class="btn order-btn-1 d-block py-2 my-2 viewButton" data-toggle="modal"
                          data-target="#viewModal" data-whatever="<?php echo $OrderId?>">View</button>
                          
                          <a href="edit.php?cat=et&id=<?php echo $searchRows['order_id'] ?>" class="btn order-btn-2 d-block py-2 my-2 primary" style="color: white">Edit</a>

                          <?php if($searchRows['order_flag'] != "CANCELLED"){ ?>
                        <button class="btn order-btn-3 d-block py-2 my-2 cancelButton" data-toggle="modal"
                          data-target="#cancelModal" data-whatever="<?php echo $OrderId?>">Cancel</button>
                        <?php
                        } else{ ?>
                        <button class="btn order-btn-3 d-block py-2 my-2 disabled">CANCELLED</button>
                         <?php } ?>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
                    }
                } else {
                    echo "No orders found";
                } ?>
              </tbody>
            </table>
            <?php
            } else {
                echo "No Records found";
            } ?>

            <!-- Modal Area -->

            <!-- viewModal -->
            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modalParent" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title profile-text-area" id="viewHeaderModalLabel">
                      Viewing Details For Order id:
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="order-button-group">
                      <div class="row">
                        <table class="table table-striped table-items" id="modalTable">
                          <tbody>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Embroidery Text</h5>
                              </td>
                              <td id="modalText"></td>
                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Design Name</h5>
                              </td>
                              <td id="modalName"></td>
                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Price</h5>
                              </td>
                              <td id="modalPrice"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Status</h5>
                              </td>
                              <td id="modalOrderFlag"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">PO Number</h5>
                              </td>
                              <td id="modalPoNumber"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Turn Around</h5>
                              </td>
                              <td id="modalTurnAround"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Dimension(Units)</h5>
                              </td>
                              <td id="modalDimension"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Width</h5>
                              </td>
                              <td id="modalDimensionWidth"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Height</h5>
                              </td>
                              <td id="modalDimensionHeight"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Background Color</h5>
                              </td>
                              <td id="modalHaveBgColor"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Stitch</h5>
                              </td>
                              <td id="modalStitch"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Application</h5>
                              </td>
                              <td id="modalApplication"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Fabric</h5>
                              </td>
                              <td id="modalFabric"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Thread</h5>
                              </td>
                              <td id="modalThread"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Applique</h5>
                              </td>
                              <td id="modalApplique"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Comments</h5>
                              </td>
                              <td id="modalComments"></td>

                            </tr>
                            <tr>
                              <td>
                                <h5 class="profile-text-area">Time of order</h5>
                              </td>
                              <td id="modalOrderAt"></td>

                            </tr>

                            <tr>
                              <td>
                                <h5 class="profile-text-area">Order ID</h5>
                              </td>
                              <td id="modalOrderId"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <h5 class="profile-text-area noticeArea">Notice : Something Something</h5>
                  </div>
                </div>
              </div>
            </div>

            <!-- cancelModal -->
            <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title profile-text-area" id="cancelHeaderModalLabel">Are you sure you want to
                      cancel
                      your order?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="order-button-group">
                      <div class="row">
                        <div class="col-md-6">
                          <button type="button" class="btn btn-secondary order-btn-3 py-2 my-2"
                            id="confirmDeleteOrderButton">Yes</button>
                        </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-primary order-btn-1 py-2 my-2" data-dismiss="modal"
                            aria-label="Close">No</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <h5 class="profile-text-area noticeArea">Notice : Something Something</h5>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bootstrap Alert -->
            <!-- <div class="alert alert-success in" role="alert">
              <h5 class="profile-text-area">
                Order deleted Successfully
              </h5>
              <span id="failedDelete"></span>
            </div> -->

            <nav aria-label="Page navigation example" class="my-2">

              <ul class="pagination justify-content-end" id="Pagination">
                <?php
                      if ($page>1) { ?>
                <li class="page-item">
                  <a class="page-link" href="embroiderytext.php?page=<?php echo($page-1) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <?php } ?>
                <?php
                      for ($i=1; $i<$total_pages; $i++) {?>
                <li class="page-item"><a class="page-link"
                    href="embroiderytext.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php } ?>
                <?php
                      if ($i>$page) {
                          ?>
                <li class="page-item">
                  <a class="page-link" href="embroiderytext.php?page=<?php echo($page+1)?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
                <?php
                      } ?>
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
    $('.viewButton').on('click', function () {

      $('#viewModal').modal('show');
      var tr = $(this).closest('tr');
      var data = tr.children("td").map(function () {
        return $(this).text();
      }).get();

      console.log(data);

      $('#modalText').html(data[0]); //iska numbering change karna hoga wapas
      $('#modalName').html(data[1]);
      $('#modalPrice').html(data[2]);
      $('#modalOrderFlag').html(data[3]);
      $('#modalPoNumber').html(data[4]);
      $('#modalTurnAround').html(data[5]);
      $('#modalDimension').html(data[6]);
      $('#modalDimensionWidth').html(data[7]);
      $('#modalDimensionHeight').html(data[8]);
      $('#modalHaveBgColor').html(data[9]);
      $('#modalStitch').html(data[10]);
      $('#modalApplication').html(data[11]);
      $('#modalFabric').html(data[12]);
      $('#modalThread').html(data[13]);
      $('#modalApplique').html(data[14]);
      $('#modalComments').html(data[15]);
      $('#modalOrderAt').html(data[16]);
      $('#modalOrderId').html(data[17]);

      document.getElementById("viewHeaderModalLabel").innerHTML = "Viewing order details for " + data[17];
    });

    function cancelOrder(orderId) {

    };

    $('.cancelButton').on('click', function () {

      $('#cancelModal').modal('show');
      var tr = $(this).closest('tr');
      var data = tr.children("td.orderId").map(function () {
        return $(this).text();
      }).get();
      console.log(data);
      cancelOrder(data[0]);

      $('#confirmDeleteOrderButton').on('click', function () {
        var orderId = data[0];
        $.ajax({
          url: "cancelorder.php",
          type: "POST",
          data: {
            "orderId": orderId
          },
          success: function (response) {
            location.reload(true);
            $("#deletedOrderText").html("Order" + orderId + "Deleted Successfully");


          }
        });
      });
    });
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