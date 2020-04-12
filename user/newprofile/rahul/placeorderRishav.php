<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// error_reporting(E_ALL ^ E_NOTICE);
require_once "../../functions/functions.php";
require_once "../../db/connection/conn.php";

if (isset($_SESSION['USER'])) 
{
    $userEmail = $_SESSION['USER'];

    //Turnaround
    $fetchTurnaround = "SELECT turnaround FROM tbl_turnaround";
    $fetchTurnaroundFire = mysqli_query($conn, $fetchTurnaround);

    //Stitch
    $fetchStitch = "SELECT stitch FROM tbl_stitch";
    $fetchStitchFire = mysqli_query($conn, $fetchStitch);

    //Application
    $fetchApplication = "SELECT application FROM tbl_application";
    $fetchApplicationFire = mysqli_query($conn, $fetchApplication);

    //Fabric
    $fetchFabric = "SELECT fabric FROM tbl_fabric";
    $fetchFabricFire = mysqli_query($conn, $fetchFabric);

    //Including Color
    $fetchInclude = "SELECT yes_or_no FROM tbl_including_backgroundcolor";
    $fetchIncludeFire = mysqli_query($conn, $fetchInclude);

    //Thread
    $fetchThread = "SELECT thread FROM tbl_thread";
    $fetchThreadFire = mysqli_query($conn, $fetchThread);

    //Applique
    $fetchApplique = "SELECT applique FROM tbl_applique";
    $fetchAppliqueFire = mysqli_query($conn, $fetchApplique);

    $DesignImageErr = "";
    $SupportingImageErr = "";
    $DesignNameErr ="";
    $TurnAroundErr = "";
    $DimensionHeightErr = "";
    $DimensionWidthErr = "";
    $PoNumberErr = "";
    $ErrorCounter = 0;

    //Placing order
    if (isset($_POST['placeorderemimages'])) 
    {

        $DesignName = mysqli_real_escape_string($conn, $_POST['designname']);
        $PoNumber = mysqli_real_escape_string($conn, $_POST['ponumber']);
        $TurnAround = mysqli_real_escape_string($conn, $_POST['turnaround']);
        $DimensionWidth = mysqli_real_escape_string($conn, $_POST['width']);
        $DimensionHeight = mysqli_real_escape_string($conn, $_POST['height']);
        $Dimension = mysqli_real_escape_string($conn, $_POST['dimension']);
        $IsBGColorInclude = mysqli_real_escape_string($conn, $_POST['backgroundcolorinclusion']);
        $Stitch = mysqli_real_escape_string($conn, $_POST['stitch']);
        $Application = mysqli_real_escape_string($conn, $_POST['application']);
        $Fabric = mysqli_real_escape_string($conn, $_POST['fabric']);
        $Thread = mysqli_real_escape_string($conn, $_POST['thread']);
        $Applique = mysqli_real_escape_string($conn, $_POST['applique']);
        $Comments = mysqli_real_escape_string($conn, $_POST['comment']);


        if ($_FILES['designimage']['size'] == 0) 
        {
            $DesignImageErr = "Please upload one image";
            $ErrorCounter += 1;
        }
        if (empty($DesignName)) 
        {
            $DesignNameErr = "Please enter a design name";
            $ErrorCounter += 1;
        } 
        if (strlen($DesignName) > 100) 
        {
            $DesignNameErr = "Design name is too long, make it within 100 characters";
            $ErrorCounter += 1;
        } 
        if (strlen($DesignName) <= 2) 
        {
            $DesignNameErr = "Design name must be at least of 3 characters";
            $ErrorCounter += 1;
        } 
        if (empty($PoNumber)) 
        {
            $PoNumberErr = "Please enter PO Number";
            $ErrorCounter += 1;
        } 
        if (strlen($PoNumber) > 10) 
        {
            $PoNumberErr = "PO Number must be within 10 digits";
            $ErrorCounter += 1;
        } 
        if (strlen($PoNumber) < 10) 
        {
            $PoNumberErr = "PO Number must be at least 10 digits";
            $ErrorCounter += 1;
        } 
        if ($TurnAround == "Select Plan") 
        {
            $TurnAroundErr = "Please select a plan";
            $ErrorCounter += 1;
        } 
        if (empty($DimensionWidth)) 
        {
            $DimensionWidthErr = "Please enter dimension width";
            // $ErrorCounter += 1;
        } 
        if (!is_numeric($DimensionWidth)) 
        {
            $DimensionWidthErr = "Digits allowed only";
            // $ErrorCounter += 1;
        } 
        if (empty($DimensionHeight)) 
        {
            $DimensionHeightErr = "Please enter dimension height";
            // $ErrorCounter += 1;
        } 
        if (!is_numeric($DimensionHeight)) 
        {
            $DimensionHeightErr = "Digits allowed only";
            // $ErrorCounter += 1;
        } 
        if ($Stitch == "Select Stitch") 
        {
            $StitchErr = "Please select a stitch";
            $ErrorCounter += 1;
        } 
        if ($Application == "Select One") 
        {
            $ApplicationErr = "Please select application";
            $ErrorCounter += 1;
        } 
        if ($Thread == "Select One") 
        {
            $ThreadErr = "Please select a thread";
            $ErrorCounter += 1;
        } 
        if (empty($Comments)) 
        {
            $CommentsErr = "Please enter some comment";
            $ErrorCounter += 1;
        } 
        if (strlen($Comments) > 150) 
        {
            $CommentsErr = "Too long comment, make it within 150 characters";
            $ErrorCounter += 1;
        } 
        if (strlen($Comments) < 10) 
        {
            $CommentsErr = "Please enter at least 10 characters comment";
            $ErrorCounter += 1;
        }  
        
        if ($ErrorCounter == 0)
        {

            //Main Image

            $targetDesignImage = "Uploads/designimages/".basename($_FILES['designimage']['name']);
            $mainImage = $_FILES['designimage']['name'];

            if (move_uploaded_file($_FILES['designimage']['name'],$targetDesignImage)) 
            {
                $Mainmsg = "Main Image Uploaded Successfully";
            }
            else 
            {
                $Mainmsg = "some error while uploading Main Image";
            }

            //Supporting Image
            $targetSupportingImage = "../../Uploads/supportingimages/".basename($_FILES['supportingimage']['name']);
            $supportingImage = $_FILES['supportingimage']['name'];
            if (move_uploaded_file($_FILES['supportingimage']['name'],$targetSupportingImage)) 
            {
                $Supportingmsg = "Image Uploaded Successfully";
            }
            else 
            {
                $Supportingmsg = "some error while uploading";
            }

            echo $Mainmsg;
            echo $Supportingmsg;

            $datetime = getIndianDateTime();
            $userIP = getUserIpAddr();

            //Date time

            function getIndianDateTime()
            {
                date_default_timezone_set('Asia/Kolkata');
                $datetime = date('d/m/Y h:i:s:a', time());
                return $datetime;
            }

            //User ip
            function getUserIpAddr()
            {
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    //ip from share internet
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    //ip pass from proxy
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                return $ip;
            }

            //Price calculation

            $ImageCategory = 10;
            if ($TurnAround == "Budget - 24 Hours") {
                $TurnAroundPrice = 5;
            } else if ($TurnAround == "Standard - 12 Hours") {
                $TurnAroundPrice = 10;
            } else if ($TurnAround == "Express - 5 hours") {
                $TurnAroundPrice = 15;
            }
            if($Application == "Chest Front")
            {
                $ApplicationPrice = 5;
            }
            else if($Application == "Puff")
            {
                $ApplicationPrice = 10;
            }
            else if($Application == "Left Chest & Cap Combo")
            {
                $ApplicationPrice = 15;
            }
            else if($Application == "Left Chest")
            {
                $ApplicationPrice = 20;
            }
            else if($Application == "Jacket Back")
            {
                $ApplicationPrice = 25;
            }
            else if($Application == "Cap")
            {
                $ApplicationPrice = 30;
            }
            $FinalPrice = $TurnAroundPrice + $ApplicationPrice;


            $InsertImageEmboridery = "INSERT INTO tbl_order
            (
            emboridery_design_image,
            emboridery_supporting_image,
            design_name,
            category,
            ponumber,
            turnarround,
            dimension,
            dimension_width,
            dimension_height,
            have_bg_color,
            stitch,
            application,
            fabric,
            thread,
            applique,
            comments,
            price,
            order_flag,
            order_at,
            user,
            user_ip
            )
            VALUES
            (
            '$mainImage',
            '$supportingImage',
            '$DesignName',
            'Emboridery Image',
            '$PoNumber',
            '$TurnAround',
            '$Dimension',
            '$DimensionWidth',
            '$DimensionHeight',
            '$IsBGColorInclude',
            '$Stitch',
            '$Application',
            '$Fabric',
            '$Thread',
            '$Applique',
            '$Comments',
            $FinalPrice,
            'NEW',
            '$datetime',
            '$userEmail',
            '$userIP'
            )";
            
            $InsertImageEmborideryFire = mysqli_query($conn, $InsertImageEmboridery);

            //Test

            // if (empty($PoNumber))
            // {
            //     echo "PO Empty";
            // }
            // else
            // {
            //     echo "Data exist";
            // }

            // echo $FolderDesignImage;
            // echo $FolderSupportingImage;
            // echo $DesignName;
            // echo "EmborideryImage";
            // echo $PoNumber;
            // echo $TurnAround;
            // echo $Dimension;
            // echo $DimensionWidth;
            // echo $DimensionHeight;
            // echo $IsBGColorInclude;
            // echo $Stitch;
            // echo $Application;
            // echo $Fabric;
            // echo $Thread;
            // echo $Applique;
            // echo $Comments;
            // echo $FinalPrice;
            // echo "NEW";
            // echo $datetime;
            // echo $userEmail;
            // echo $userIP;

            if($InsertImageEmborideryFire)
            {
                $orderSuccessMsg = "Order has been placed successfully";
                echo $orderSuccessMsg;
            }
            else {
                echo mysqli_error($conn);
            }
        }
        else {

            echo $ErrorCounter.'<br>';

            echo "Please Fix errors";
        }
    }
}
else if (isset($_POST['placeorderemtext'])) 
{
} 
else if (isset($_POST['placeordervectorart'])) 
{
}
else 
{
    header("location:http://localhost/RenDigitizingUpdated/user/authentication/login.php");
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
    <style>
        .error {
            color: #FF0000;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h2 class="my-md-3 site-title">RenDigitizing</h2>
                </div>
                <div class="col-md-6 text-right">
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
                    <a href="dashboard.php">Dashboard</a>
                    <a class="current" href="placeorder.php">Place an Order</a>
                    <a href="orders.php">My Orders</a>
                    <a href="account.php">Account Details</a>
                    <a href="../../index.php">Home</a>
                </div>
                <div class="col-md-9 profile-area-content p-5">
                    <div class="reach-out-buttons">
                        <table class="table table-striped table-items">
                            <th>
                                <input class="btn order-btn-1" type="button" value="Emboridery Images" name="btnchoice">
                            </th>
                            <th>
                                <input class="btn order-btn-2" type="button" value="Embroidery Text" name="btnchoice">
                            </th>
                            <th>
                                <input class="btn order-btn-3" type="button" value="Vector Art" name="btnchoice">
                            </th>
                        </table>
                    </div>


                    <!--Forms-->
                    <div id="emimages">
                        <form method="post" name="emimages" id="form1" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="btn order-btn-1 py-2 my-3 " type="button" value="Image Details"
                                        name="btnImage">
                                    <div class="container myaccount-details-area">
                                        <h1 class="profile-text-area">Image Details</h1>
                                        <table class="myaccount-details-table">
                                            <tr>
                                                <td>
                                                    <h5>Your Design</h5>
                                                </td>
                                                <td>
                                                    <input type="file" name="designimage" class="input-file">
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
                                                        value='<?php echo isset($_POST['designname']) ? $_POST['designname'] : ''; ?>'>
                                                    <span class="error"><?php echo $DesignNameErr ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>PO Number</h5>
                                                </td>
                                                <td>
                                                    <input type="text" name="ponumber" id=""
                                                        value='<?php echo isset($_POST['ponumber']) ? $_POST['ponumber'] : ''; ?>'>
                                                    <span class="error"><?php echo $PoNumberErr ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Turnaround</h5>
                                                </td>
                                                <td>
                                                    <div class="dropdown myaccount-details-phpcontent">
                                                        <select name="turnaround" id="turnaround"
                                                            class="btn dropdown-select">
                                                            <?php while ($turnaroundRows = mysqli_fetch_array($fetchTurnaroundFire)) { ?>
                                                            <option value="<?php echo $turnaroundRows['turnaround'] ?>">
                                                                <?php echo $turnaroundRows['turnaround'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="error"><?php echo $TurnAroundErr ?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <input class="btn order-btn-2 py-2 my-3" type="button" value="Image Description"
                                        name="btnImage">
                                    <div class="container myaccount-change-password">
                                        <h1 class="profile-text-area">Image Description</h1>
                                        <table>

                                            <tr>
                                                <td>
                                                    <h5>Dimensions</h5>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Width" name="width"
                                                                id="width"
                                                                value='<?php echo isset($_POST['width']) ? $_POST['width'] : ''; ?>'>
                                                            <span class="error"><?php echo $DimensionWidthErr ?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Height" name="height"
                                                                id="height"
                                                                value='<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>'>
                                                            <span class="error"><?php echo $DimensionHeightErr ?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="dimension" id="dimension"
                                                                class="btn dropdown-select">
                                                                <option value="Inches">Inches</option>
                                                                <option value="cm">cm</option>
                                                                <option value="mm">mm</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Include the background color?</h5>
                                                </td>
                                                <td>
                                                    <select name="backgroundcolorinclusion"
                                                        id="backgroundcolorinclusion" class="btn dropdown-select">
                                                        <?php while ($includeRows = mysqli_fetch_array($fetchIncludeFire)) { ?>
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
                                                    <select name="stitch" id="stitch" class="btn dropdown-select">
                                                        <?php while ($stitchRows = mysqli_fetch_array($fetchStitchFire)) { ?>
                                                        <option value="<?php echo $stitchRows['stitch'] ?>">
                                                            <?php echo $stitchRows['stitch'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Application</h5>
                                                </td>
                                                <td>
                                                    <select name="application" id="application"
                                                        class="btn dropdown-select">
                                                        <?php while ($applicationRows = mysqli_fetch_array($fetchApplicationFire)) { ?>
                                                        <option value="<?php echo $applicationRows['application'] ?>">
                                                            <?php echo $applicationRows['application'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Fabric</h5>
                                                </td>
                                                <td>
                                                    <select name="fabric" id="fabric" class="btn dropdown-select">
                                                        <?php while ($fabricRows = mysqli_fetch_array($fetchFabricFire)) { ?>
                                                        <option value="<?php echo $fabricRows['fabric'] ?>">
                                                            <?php echo $fabricRows['fabric'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Thread</h5>
                                                </td>
                                                <td>
                                                    <select name="thread" id="thread" class="btn dropdown-select">
                                                        <?php while ($threadRows = mysqli_fetch_array($fetchThreadFire)) { ?>
                                                        <option value="<?php echo $threadRows['thread'] ?>">
                                                            <?php echo $threadRows['thread'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Applique</h5>
                                                </td>
                                                <td>
                                                    <select name="applique" id="applique" class="btn dropdown-select">
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
                                                    <textarea name="comment" id="comment" cols="40" rows="5"
                                                        value='<?php echo isset($_POST['comment']) ? $_POST['comment'] : ''; ?>'></textarea>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 ">

                                    <input class="btn order-btn-1 d-block py-2 my-3" id="btnQuote" type="submit"
                                        name="getquoteemimjages" value="Get Quote">
                                    <input class="btn order-btn-2 d-block py-2 my-3" id="btnPlaceOrder" type="submit"
                                        name="placeorderemimages" formmethod="post" value="Place Order">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="emtext">
                        <form action="" name="emtext" id="form2">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="btn order-btn-1py-2 my-3" type="button" value="Text Detail"
                                        name="btnText">
                                    <div class="container myaccount-details-area" id="emText">
                                        <h1 class="profile-text-area">Text Details</h1>
                                        <table class="myaccount-details-table">
                                            <tr>
                                                <td>
                                                    <h5>Text</h5>
                                                </td>
                                                <td>
                                                    <textarea name="" id="" cols="30" rows="5"
                                                        placeholder="Enter Text Here"></textarea>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Design Name</h5>
                                                </td>
                                                <td>
                                                    <input type="text" name="" id="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>PO Number</h5>
                                                </td>
                                                <td>
                                                    <input type="text" name="" id="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Turnaround</h5>
                                                </td>
                                                <td>
                                                    <div class="dropdown myaccount-details-phpcontent">
                                                        <select name="" id="" class="btn dropdown-select">
                                                            <option value="">Select Plan</option>
                                                            <option value="">Budget - 24 Hours</option>
                                                            <option value="">Standard - 12 Hours</option>
                                                            <option value="">Express - 5 hours</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <input class="btn order-btn-2 py-2 my-3" type="button" value="Text Description"
                                        name="btnText">
                                    <div class="container myaccount-change-password" id="emDescription">
                                        <h1 class="profile-text-area">Text Description</h1>
                                        <table>

                                            <tr>
                                                <td>
                                                    <h5>Dimensions</h5>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Width" name="" id="">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Height" name="" id="">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="" id="" class="btn dropdown-select">
                                                                <option value="">Inches</option>
                                                                <option value="">cm</option>
                                                                <option value="">mm</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Include the background color?</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Chose one option</option>
                                                        <option value="">Yes</option>
                                                        <option value="">No</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Stitch</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Melco OFM</option>
                                                        <option value="">Toyota 100</option>
                                                        <option value="">Wilcom EMB</option>
                                                        <option value="">Tajima DST</option>
                                                        <option value="">Pulse PSF</option>
                                                        <option value="">Melco Exp</option>
                                                        <option value="">Compucon XXX</option>
                                                        <option value="">Pfaff PCS</option>
                                                        <option value="">Brother PES</option>
                                                        <option value="">Husqvarna HUS</option>
                                                        <option value="">Barudan DSB</option>
                                                        <option value="">ZSK</option>
                                                        <option value="">DSZ</option>
                                                        <option value="">PCM</option>
                                                        <option value="">SEW</option>
                                                        <option value="">CSD</option>
                                                        <option value="">Jef</option>
                                                        <option value="">CND</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Application</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Select One</option>
                                                        <option value="">Chest Front</option>
                                                        <option value="">Puff</option>
                                                        <option value="">Left Chest & Cap Combo</option>
                                                        <option value="">Left Chest</option>
                                                        <option value="">Jacket Back</option>
                                                        <option value="">Cap</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Fabric</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Select One</option>
                                                        <option value="">Cotton / Twill</option>
                                                        <option value="">Wool</option>
                                                        <option value="">Football Shirts</option>
                                                        <option value="">Fleece</option>
                                                        <option value="">Towel / Terry Cloth</option>
                                                        <option value="">Traditional(jersey,pique.etc)</option>
                                                        <option value="">Lycra / Spandex trees</option>
                                                        <option value="">Leather</option>
                                                        <option value="">Other</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Thread</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Select One</option>
                                                        <option value="">Ackeman Isacord 40</option>
                                                        <option value="">Ackeman Isacord 30</option>
                                                        <option value="">Medira Classic Rayon #40</option>
                                                        <option value="">Medira Classic Rayon #60</option>
                                                        <option value="">Medira Classic Rayon #30</option>
                                                        <option value="">Polyneon #40</option>
                                                        <option value="">Polyneon #60</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Applique</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Select One</option>
                                                        <option value="">Yes</option>
                                                        <option value="">No</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Comments</h5>
                                                </td>
                                                <td>
                                                    <textarea name="" id="" cols="40" rows="5"></textarea>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <input class="btn order-btn-1 d-block py-2 my-3" id="btnQuote" type="submit"
                                        name="getquoteemtext" value="Get Quote">
                                    <input class="btn order-btn-2 d-block py-2 my-3" id="btnPlaceOrder" type="submit"
                                        name="placeorderemtext" value="Place Order">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="vectorart">
                        <form action="" name="vectorart" id="form3">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="btn order-btn-1 py-2 my-3" type="button" value="Vector Detail"
                                        name="btnVector">
                                    <div class="container myaccount-details-area" id="vectorDetails">
                                        <h1 class="profile-text-area">Vector Details</h1>
                                        <table class="myaccount-details-table">
                                            <tr>
                                                <td>
                                                    <h5>Your Design</h5>
                                                </td>
                                                <td>
                                                    <input type="file" class="input-file">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Supporting Design</h5>
                                                </td>
                                                <td>
                                                    <input type="file" class="input-file">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Design Name</h5>
                                                </td>
                                                <td>
                                                    <input type="text" name="" id="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>PO Number</h5>
                                                </td>
                                                <td>
                                                    <input type="text" name="" id="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Turnaround</h5>
                                                </td>
                                                <td>
                                                    <div class="dropdown myaccount-details-phpcontent">
                                                        <select name="" id="" class="btn dropdown-select">
                                                            <option value="">Select Plan</option>
                                                            <option value="">Budget - 24 Hours</option>
                                                            <option value="">Standard - 12 Hours</option>
                                                            <option value="">Express - 5 hours</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <input class="btn order-btn-2 py-2 my-3" type="button" value="Vector Description"
                                        name="btnVector">
                                    <div class="container myaccount-change-password" id="vectorDescription">
                                        <h1 class="profile-text-area">Vector Description</h1>
                                        <table>

                                            <tr>
                                                <td>
                                                    <h5>Dimensions</h5>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Width" name="" id="">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Height" name="" id="">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="" id="" class="btn dropdown-select">
                                                                <option value="">Inches</option>
                                                                <option value="">cm</option>
                                                                <option value="">mm</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Include the background color?</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Chose one option</option>
                                                        <option value="">Yes</option>
                                                        <option value="">No</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Format</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">svg</option>
                                                        <option value="">.ai</option>
                                                        <option value="">.eps (Illusrator)</option>
                                                        <option value="">.eps (Corel)</option>
                                                        <option value="">.cdr</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Application</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Select One</option>
                                                        <option value="">Vector Art</option>
                                                        <option value="">Silkscreen</option>
                                                        <option value="">DTG</option>
                                                        <option value="">Vinyl (Cad cut)</option>
                                                        <option value="">Vinyl (Hairline border)</option>
                                                        <option value="">Sandblasting</option>
                                                        <option value="">Laser engraving</option>
                                                        <option value="">Lapel pins/emblems</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Printing Process</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">Spot Colours</option>
                                                        <option value="">CMYK (process color)</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Color</h5>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="btn dropdown-select">
                                                        <option value="">As per part</option>
                                                        <option value="">1-color logo</option>
                                                        <option value="">Other</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Comments</h5>
                                                </td>
                                                <td>
                                                    <textarea name="" id="" cols="40" rows="5"></textarea>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <input class="btn order-btn-1 d-block py-2 my-3" id="btnQuote" type="submit"
                                        name="getquotevectorart" value="Get Quote">
                                    <input class="btn order-btn-2 d-block py-2 my-3" id="btnPlaceOrder" type="submit"
                                        name="placeordervectorart" value="Place Order">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--Forms End-->
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis incidunt
                                    illo
                                    tenetur consequuntur. Magni, ad earum. Obcaecati adipisci incidunt ipsa,
                                    provident
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
    <script type="text/javascript">
        $(function () {
            $("input[name=btnchoice]").click(function () {
                if ($(this).val() == "Emboridery Images") {
                    $("#emimages").fadeIn(800);
                    $("#emtext").fadeOut(400);
                    $("#vectorart").fadeOut(400);
                } else if ($(this).val() == "Embroidery Text") {
                    $("#emimages").fadeOut(400);
                    $("#emtext").fadeIn(800);
                    $("#vectorart").fadeOut(400);
                } else {
                    $("#emimages").fadeOut(400);
                    $("#emtext").fadeOut(400);
                    $("#vectorart").fadeIn(800);
                }
            });

            $("input[name=btnImage]").click(function () {
                if ($(this).val() == "Image Details") {
                    $(".myaccount-details-area").show();
                    $(".myaccount-change-password").hide();
                } else if ($(this).val() == "Image Description") {
                    $(".myaccount-details-area").hide();
                    $(".myaccount-change-password").show();
                } else {
                    $(".myaccount-details-area").hide();
                    $(".myaccount-change-password").hide();
                }
            });

            $("input[name=btnText]").click(function () {
                if ($(this).val() == "Text Detail") {
                    $("#emText").show();
                    $("#emDescription").hide();
                } else if ($(this).val() == "Text Description") {
                    $("#emText").hide();
                    $("#emDescription").show();
                } else {
                    $("#emText").hide();
                    $("#emDescription").hide();
                }
            });

            $("input[name=btnVector]").click(function () {
                if ($(this).val() == "Vector Detail") {
                    $("#vectorDetails").show();
                    $("#vectorDescription").hide();
                } else if ($(this).val() == "Vector Description") {
                    $("#vectorDetails").hide();
                    $("#vectorDescription").show();
                } else {
                    $("#vectorDetails").hide();
                    $("#vectorDescription").hide();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>