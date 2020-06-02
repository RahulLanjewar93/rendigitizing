<?php
require_once "edit-php.php";
echo $EmborideryTextSuccessMsg;
echo $EmborideryTextFailedMsg;
$targetSupportingImage = "Uploads/Vector/SupportingImages/" . basename($_FILES['supportingimage']['name']);
                    $supportingImage = $_FILES['supportingimage']['name'];
                    $supportingImageTemp = $_FILES['supportingimage']['tmp_name'];
                    $supportingImagetyType = $_FILES['supportingimage']['type'];
                   echo $targetSupportingImage;
                    if (move_uploaded_file($_FILES['supportingimage']['name'], $targetSupportingImage) && strtolower($supportingImagetyType) == "image/jpg" || strtolower($supportingImagetyType) == "image/jpeg" || strtolower($supportingImagetyType) == "image/png") {
                        echo "Done";
                    } else {
                        echo "Not DOne";
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
                <!-- Embroidery Image -->


                <?php if($category == "Emboridery Image") { ?>
                <div class="col-md-9 profile-area-content p-5">
                    <h1 class="profile-text-area my-3"> Edit Order</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="profile-text-area">Order ID :288328</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="editOrderButtonArea row">
                                <button type="submit" name="embImage" form="editImage"
                                    class="btn order-btn-1 d-block py-2 my-2" style="color: white">Save</button>
                                <a class="btn order-btn-3 d-block py-2 my-2" style="color: white">Discard And Go
                                    Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form id="editImage" method="POST" enctype="multipart/form-data>
                                <div class=" container myaccount-details-area" id="editImage">
                                <h1>Prefetch</h1>
                                <?php while($orderRowTable1 = mysqli_fetch_array($searchOrderFire)) {
                                    echo $orderRowTable1['design_name'];
                                        ?>
                                <table class="myaccount-details-table">
                                    <tr>
                                        <td>
                                            <h5>Your Design</h5>
                                        </td>
                                        <td>
                                            <h6 class="error">Main Image cannot be edited</h6>
                                            <span class="error"><?php echo $DesignImageErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Supporting Design</h5>
                                        </td>
                                        <td>
                                            <input type="file" name="supportingimage" class="input-file">
                                            <span class="error"><?php echo $SupportingImageErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Design Name</h5>
                                        </td>
                                        <td>
                                            <input type="text" name="designname" id=""
                                                value='<?php echo $orderRowTable1['design_name'] ?>' form="editImage">
                                            <span class="error"><?php echo $DesignNameErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>PO Number</h5>
                                        </td>
                                        <td>
                                            <input type="text" name="ponumber" id=""
                                                value='<?php echo $orderRowTable1['ponumber'] ?>' form="editImage">
                                            <span class="error"><?php echo $PoNumberErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Turnaround</h5>
                                        </td>
                                        <td>
                                            <div class="dropdown myaccount-details-phpcontent">
                                                <select name="turnaround" id="turnaround" class="btn dropdown-select"
                                                    form="editImage">
                                                    <option value="<?php echo $orderRowTable1['turnarround'] ?>">
                                                        Selected -><?php echo $orderRowTable1['turnarround'] ?></option>
                                                    <?php while ($turnaroundRows = mysqli_fetch_array($fetchTurnaroundFire)) { ?>
                                                    <option value="<?php echo $turnaroundRows['turnaround'] ?>">
                                                        <?php echo $turnaroundRows['turnaround'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="error"><?php echo $TurnAroundErr ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Dimensions</h5>
                                        </td>
                                        <td>
                                            <div class="row dimensionBox">
                                                <div class="col-md-4">
                                                    <input type="text" placeholder="Width" name="width" id="width"
                                                        value='<?php echo $orderRowTable1['dimension_width'] ?>'
                                                        form="editImage">
                                                    <span class="error"><?php echo $DimensionWidthErr ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" placeholder="Height" name="height" id="height"
                                                        value='<?php echo $orderRowTable1['dimension_height'] ?>'
                                                        form="editImage">
                                                    <span class="error"><?php echo $DimensionHeightErr ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="dimension" id="dimension" class="btn dropdown-select"
                                                        form="editImage">
                                                        <option value="<?php echo $orderRowTable1['dimension'] ?>">
                                                            Selected -> <?php echo $orderRowTable1['dimension'] ?>
                                                        </option>
                                                        <option value="Inches">Inches</option>
                                                        <option value="cm">cm</option>
                                                        <option value="mm">mm</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <?php //} ?>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="container myaccount-change-password" id="emImageDesc">
                                <table>
                                    <tr>
                                        <td>
                                            <h5>Include the background color?</h5>
                                        </td>
                                        <td>
                                            <select name="backgroundcolorinclusion" id="backgroundcolorinclusion"
                                                class="btn dropdown-select" form="editImage">

                                                <option value="<?php echo $orderRowTable1['have_bg_color'] ?>">Selected
                                                    -> <?php echo $orderRowTable1['have_bg_color'] ?></option>
                                                <?php while($includeRows = mysqli_fetch_array($fetchIncludeFire)) { ?>
                                                <option value="<?php echo $includeRows['yes_or_no'] ?>">
                                                    <?php echo $includeRows['yes_or_no'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Stitch</h5>
                                        </td>
                                        <td>
                                            <select name="stitch" id="stitch" class="btn dropdown-select"
                                                form="editImage">
                                                <option value="<?php echo $orderRowTable1['stitch'] ?>">Selected ->
                                                    <?php echo $orderRowTable1['stitch'] ?></option>
                                                <?php while ($stitchRows = mysqli_fetch_array($fetchStitchFire)) { ?>
                                                <option value="<?php echo $stitchRows['stitch'] ?>">
                                                    <?php echo $stitchRows['stitch'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $StitchErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Application</h5>
                                        </td>
                                        <td>
                                            <select name="application" id="application" class="btn dropdown-select"
                                                form="editImage">
                                                <option value="S<?php echo $orderRowTable1['application'] ?>">Selected
                                                    -> <?php echo $orderRowTable1['application'] ?></option>
                                                <?php while ($applicationRows = mysqli_fetch_array($fetchApplicationFire)) { ?>
                                                <option value="<?php echo $applicationRows['application'] ?>">
                                                    <?php echo $applicationRows['application'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $ApplicationErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Fabric</h5>
                                        </td>
                                        <td>
                                            <select name="fabric" id="fabric" class="btn dropdown-select"
                                                form="editImage">
                                                <option value="S<?php echo $orderRowTable1['fabric'] ?>">Selected ->
                                                    <?php echo $orderRowTable1['fabric'] ?></option>
                                                <?php while ($fabricRows = mysqli_fetch_array($fetchFabricFire)) { ?>
                                                <option value="<?php echo $fabricRows['fabric'] ?>">
                                                    <?php echo $fabricRows['fabric'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $FabricErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Thread</h5>
                                        </td>
                                        <td>
                                            <select name="thread" id="thread" class="btn dropdown-select"
                                                form="editImage">
                                                <option value="S<?php echo $orderRowTable1['thread'] ?>">Selected ->
                                                    <?php echo $orderRowTable1['thread'] ?></option>
                                                <?php while ($threadRows = mysqli_fetch_array($fetchThreadFire)) { ?>
                                                <option value="<?php echo $threadRows['thread'] ?>">
                                                    <?php echo $threadRows['thread'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $ThreadErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Applique</h5>
                                        </td>
                                        <td>
                                            <select name="applique" id="applique" class="btn dropdown-select"
                                                form="editImage">
                                                <option value="S<?php echo $orderRowTable1['applique'] ?>">Selected ->
                                                    <?php echo $orderRowTable1['applique'] ?></option>
                                                <?php while ($appliqueRows = mysqli_fetch_array($fetchAppliqueFire)) { ?>
                                                <option value="<?php echo $appliqueRows['applique'] ?>">
                                                    <?php echo $appliqueRows['applique'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Comments</h5>
                                        </td>
                                        <td>
                                            <textarea name="comment" id="comment" cols="40" rows="5" value=''
                                                form="editImage"><?php echo $orderRowTable1['comments'] ?></textarea>
                                            <span class="error"><?php echo $CommentsErr ?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Embroidery Text -->

                <?php } elseif($category == "Emboridery Text") { ?>
                <div class="col-md-9 profile-area-content p-5">
                    <h1 class="profile-text-area my-3"> Edit Order</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="profile-text-area">Order ID :288328</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="editOrderButtonArea row">
                                <button form="editText" name="embText" type="submit"
                                    class="btn order-btn-1 d-block py-2 my-2" style="color: white">Save</button>
                                <a class="btn order-btn-3 d-block py-2 my-2" style="color: white">Discard And Go
                                    Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form id="editText" method="POST">
                                <div class="container myaccount-details-area">
                                    <table class="myaccount-details-table">
                                        <?php while($orderRowTable2 = mysqli_fetch_array($searchOrderFire)){ ?>
                                        <tr>
                                            <td>
                                                <h5>Text</h5>
                                            </td>
                                            <td>
                                                <textarea name="text" id="" cols="30" rows="5"
                                                    placeholder="Enter Text Here"
                                                    form="editText"><?php echo $orderRowTable2['emboridery_text'] ?></textarea>
                                                <span class="error"><?php echo $TextErr ?></span>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Design Name</h5>
                                            </td>
                                            <td>
                                                <input type="text" name="designnametext" id="ponumber"
                                                    value="<?php echo $orderRowTable2['design_name'] ?>"
                                                    form="editText">
                                                <span class="error"><?php echo $DesignNameTextErr ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>PO Number</h5>
                                            </td>
                                            <td>
                                                <input type="text" name="ponumbertext" id="ponumber"
                                                    value="<?php echo $orderRowTable2['ponumber'] ?>" form="editText">
                                                <span class="error"><?php echo $PoNumberTextErr ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Turnaround</h5>
                                            </td>
                                            <td>
                                                <div class="dropdown myaccount-details-phpcontent">
                                                    <select name="turnaroundtext" id="turnaroundtext"
                                                        class="btn dropdown-select" form="editText">

                                                        <option value="<?php echo $orderRowTable2['turnarround'] ?>">
                                                            Selected -> <?php echo $orderRowTable2['turnarround'] ?>
                                                        </option>
                                                        <option value="Select Plan">Select Plan</option>
                                                        <option value="Budget - 24 Hours">Budget - 24 Hours</option>
                                                        <option value="Standard - 12 Hours">Standard - 12 Hours
                                                        </option>
                                                        <option value="Express - 5 hours">Express - 5 hours</option>
                                                    </select>
                                                    <span class="error"><?php echo $TurnAroundTextErr ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Dimensions</h5>
                                            </td>
                                            <td>
                                                <div class="row dimensionBox">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Width" name="widthtext"
                                                            id="widthtext"
                                                            value="<?php echo $orderRowTable2['dimension_width'] ?>"
                                                            form="editText">
                                                        <span class="error"><?php echo $DimensionWidthTextErr ?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Height" name="heighttext"
                                                            id="heighttext"
                                                            value="<?php echo $orderRowTable2['dimension_height'] ?>"
                                                            form="editText">
                                                        <span class="error"><?php echo $DimensionHeightTextErr ?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="dimensiontext" id="dimensiontext"
                                                            class="btn dropdown-select" form="editText">
                                                            <option><?php echo $orderRowTable2['dimension'] ?>Selected
                                                                -> <?php echo $orderRowTable2['dimension'] ?></option>
                                                            <option value="Inches">Inches</option>
                                                            <option value="cm">cm</option>
                                                            <option value="mm">mm</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="container myaccount-change-password" id="emImageDesc">
                                <table>
                                    <tr>
                                        <td>
                                            <h5>Include the background color?</h5>
                                        </td>
                                        <td>
                                            <select name="backgroundcolorinclusiontext" form="editText"
                                                id="backgroundcolorinclusiontext" class="btn dropdown-select">
                                                <option value="<?php echo $orderRowTable2['have_bg_color'] ?>">Selected
                                                    -> <?php echo $orderRowTable2['have_bg_color'] ?></option>
                                                <option value="YES">Yes</option>
                                                <option value="NO">No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Stitch</h5>
                                        </td>
                                        <td>
                                            <select name="stitchtext" id="stitchtext" form="editText"
                                                class="btn dropdown-select">
                                                <option value="<?php echo $orderRowTable2['stitch'] ?>">Selected->
                                                    <?php echo $orderRowTable2['stitch'] ?></option>
                                                <?php while($stitchList = mysqli_fetch_array($fetchStitchFire)){ ?>
                                                <option value="<?php echo $stitchList['stitch'] ?>">
                                                    <?php echo $stitchList['stitch'] ?></option>

                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $StitchTextErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Application</h5>
                                        </td>
                                        <td>
                                            <select name="applicationtext" id="applicationtext" form="editText"
                                                class="btn dropdown-select">
                                                <option value="<?php echo $orderRowTable2['application'] ?>">Selected
                                                    -><?php echo $orderRowTable2['application'] ?></option>
                                                <?php while($applicationList = mysqli_fetch_array($fetchApplicationFire)){ ?>
                                                <option value="<?php echo $applicationList['application'] ?>">
                                                    <?php echo $applicationList['application'] ?></option>

                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $ApplicationTextErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Fabric</h5>
                                        </td>
                                        <td>
                                            <select name="fabrictext" id="fabrictext" form="editText"
                                                class="btn dropdown-select">
                                                <option value="<?php echo $orderRowTable2['fabric'] ?>">Selected ->
                                                    <?php echo $orderRowTable2['fabric'] ?></option>
                                                <?php while($fabricList = mysqli_fetch_array($fetchFabricFire)){ ?>
                                                <option value="<?php echo $fabricList['fabric'] ?>">
                                                    <?php echo $fabricList['fabric'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $FabricTextErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Thread</h5>
                                        </td>
                                        <td>
                                            <select name="threadtext" id="threadtext" form="editText"
                                                class="btn dropdown-select">
                                                <option value="<?php echo $orderRowTable2['thread'] ?>">Selected ->
                                                    <?php echo $orderRowTable2['thread'] ?></option>
                                                <?php while($threadList = mysqli_fetch_array($fetchThreadFire)){ ?>
                                                <option value="<?php echo $threadList['thread'] ?>">
                                                    <?php echo $threadList['thread'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $ThreadTextErr ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Applique</h5>
                                        </td>
                                        <td>
                                            <select name="appliquetext" id="appliquetext" form="editText"
                                                class="btn dropdown-select">
                                                <option value="<?php echo $orderRowTable2['applique'] ?>">Selected ->
                                                    <?php echo $orderRowTable2['applique'] ?></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Comments</h5>
                                        </td>
                                        <td>
                                            <textarea form="editText" name="commenttext" id="commenttext" cols="40"
                                                rows="5"><?php echo $orderRowTable2['comments'] ?></textarea>
                                            <span class="error"><?php echo $CommentsTextErr ?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vector Art -->

                <?php } else if ($category == "Emboridery Vector") { ?>
                <div class="col-md-9 profile-area-content p-5">
                    <h1 class="profile-text-area my-3"> Edit Order</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="profile-text-area">Order ID :288328</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="editOrderButtonArea row">
                                <button type="submit" name="embVector" form="editVector"
                                    class="btn order-btn-1 d-block py-2 my-2" style="color: white">Save</button>
                                <a href="#" class="btn order-btn-3 d-block py-2 my-2" style="color: white">Discard And
                                    Go Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form id="editVector">
                                <div class="container myaccount-details-area" id="emImage">
                                    <table class="myaccount-details-table">
                                        <?php while($orderRowTable3 = mysqli_fetch_array($searchOrderFire)){ ?>
                                        <tr>
                                            <td>
                                                <h5>Your Design</h5>
                                            </td>
                                            <td>
                                                <h6 class="error">Main Image cannot be edited</h6>
                                                <span class="error"><?php echo $DesignImageVectorErr?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Supporting Design</h5>
                                            </td>
                                            <td>
                                                <input type="file" class="input-file" name="editVector">
                                                <span class="error"><?php echo $SupportingImageErr?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Design Name</h5>
                                            </td>
                                            <td>
                                                <input type="text" name="designnamevector" id="designnamevector"
                                                    value="<?php echo $orderRowTable3['design_name'] ?>"
                                                    form="editVector">
                                                <span class="error"><?php echo $DesignNameVectorErr?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>PO Number</h5>
                                            </td>
                                            <td>
                                                <input type="text" name="ponumbervector" id="ponumbervector"
                                                    value="<?php echo $orderRowTable3['ponumber'] ?>" form="editVector">
                                                <span class="error"><?php echo $PoNumberVectorErr?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Turnaround</h5>
                                            </td>
                                            <td>
                                                <div class="dropdown myaccount-details-phpcontent">

                                                    <select name="turnaroundvector" id="turnaroundvector"
                                                        class="btn dropdown-select" form="editVector">
                                                        <option value="<?php echo $orderRowTable3['turnarround'] ?>">
                                                            Selected -> <?php echo $orderRowTable3['turnarround'] ?>
                                                        </option>
                                                        <?php while($turnaroundListva = mysqli_fetch_array($fetchTurnaroundFire)){ ?>
                                                        <option value="<?php echo $turnaroundListva['turnaround'] ?>">
                                                            <?php echo $turnaroundListva['turnaround'] ?></option>

                                                        <?php } ?>
                                                    </select>
                                                    <span class="error"><?php echo $TurnAroundVectorErr?></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Dimensions</h5>
                                            </td>
                                            <td>
                                                <div class="row dimensionBox">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Width" name="widthvector"
                                                            id="widthvector"
                                                            value="<?php echo $orderRowTable3['dimension_width'] ?>"
                                                            form="editVector">
                                                        <span class="error"><?php echo $DimensionWidthVectorErr?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Height" name="heightvector"
                                                            id="heightvector"
                                                            value="<?php echo $orderRowTable3['dimension_height'] ?>"
                                                            form="editVector">
                                                        <span
                                                            class="error"><?php echo $DimensionHeightVectorErr?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="dimensionvector" id="dimensionvector"
                                                            class="btn dropdown-select" form="editVector">
                                                            <option value="<?php echo $orderRowTable3['dimension'] ?>">
                                                                Selected -><?php echo $orderRowTable3['dimension'] ?>
                                                            </option>
                                                            <option value="Inches">Inches</option>
                                                            <option value="cm">cm</option>
                                                            <option value="mm">mm</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="container myaccount-change-password" id="emImageDesc">
                                <table>
                                    <tr>
                                        <td>
                                            <h5>Include the background color?</h5>
                                        </td>
                                        <td>
                                            <select name="backgroundcolorinclusionvector"
                                                id="backgroundcolorinclusionvector" class="btn dropdown-select"
                                                form="editVector">
                                                <option value="<?php echo $orderRowTable3['have_bg_color'] ?>">Selected
                                                    -> <?php echo $orderRowTable3['have_bg_color'] ?></option>

                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Format</h5>
                                        </td>
                                        <td>
                                            <select name="formatvector" id="formatvector" class="btn dropdown-select"
                                                form="editVector">
                                                <option value="<?php echo $orderRowTable3['vector_format'] ?>">Selected
                                                    -><?php echo $orderRowTable3['vector_format'] ?></option>
                                                <option value="Select One">Select One</option>
                                                <option value="svg">svg</option>
                                                <option value=".ai">.ai</option>
                                                <option value=".eps (Illusrator)">.eps (Illusrator)</option>
                                                <option value=".eps (Corel)">.eps (Corel)</option>
                                                <option value=".cdr">.cdr</option>
                                            </select>
                                            <span class="error"><?php echo $FormatVectorErr?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Application</h5>
                                        </td>
                                        <td>
                                            <select name="applicationvector" id="applicationvector"
                                                class="btn dropdown-select" form="editVector">
                                                <option value="<?php echo $orderRowTable3['application'] ?>">Selected ->
                                                    <?php echo $orderRowTable3['application'] ?></option>
                                                <?php while($applicationListva = mysqli_fetch_array($fetchApplicationFire)){ ?>
                                                <option value="<?php echo $applicationListva['application'] ?>">
                                                    <?php echo $applicationListva['application'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error"><?php echo $ApplicationVectorErr?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Printing Process</h5>
                                        </td>
                                        <td>
                                            <select name="printingprocessvector" id="printingprocessvector"
                                                class="btn dropdown-select" form="editVector">
                                                <option value="<?php echo $orderRowTable3['printing_process'] ?>">
                                                    Selected -> <?php echo $orderRowTable3['printing_process'] ?>
                                                </option>
                                                <option value="Select One">Select One</option>
                                                <option value="Spot Colours">Spot Colours</option>
                                                <option value="CMYK (process color)">CMYK (process color)
                                                </option>
                                            </select>
                                            <span class="error"><?php echo $PrintingProcessVectorErr?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Color</h5>
                                        </td>
                                        <td>
                                            <select name="colorvector" id="colorvector" class="btn dropdown-select"
                                                form="editVector">
                                                <option value="<?php echo $orderRowTable3['color'] ?>">Selected ->
                                                    <?php echo $orderRowTable3['color'] ?></option>
                                                <option value="Select One">Select One</option>
                                                <option value="As per part">As per part</option>
                                                <option value="1-color logo">1-color logo</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <span class="error"><?php echo $ColorVectorErr?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Comments</h5>
                                        </td>
                                        <td>
                                            <textarea form="form3" name="commentvector" id="commentvector" cols="40"
                                                rows="5"
                                                form="editVector"><?php echo $orderRowTable3['comments'] ?></textarea>
                                            <span class="error"><?php echo $CommentsVectorErr?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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