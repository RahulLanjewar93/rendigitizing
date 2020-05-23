<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_NOTICE);
require_once "../../functions/functions.php";
require_once "../../db/connection/conn.php";
$datetime = getIndianDateTime();
$userIP = getUserIpAddr();
$userEmail = $_SESSION['USER'];
if (isset($_SESSION['USER']))
{
    $category = mysqli_real_escape_string($conn, $_GET['cat']);
  $orderId = mysqli_real_escape_string($conn, $_GET['id']);

  $searchOrder = "SELECT * FROM tbl_order WHERE category='$category' AND order_id=$orderId AND user='$userEmail'";
  $searchOrderFire = mysqli_query($conn, $searchOrder);

  

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

    //Image
    $DesignImageErr = "";
    $SupportingImageErr = "";
    $DesignNameErr = "";
    $TurnAroundErr = "";
    $DimensionHeightErr = "";
    $DimensionWidthErr = "";
    $PoNumberErr = "";
    $ErrorCounter = 0;

    //Text
    $DesignNameTextErr = "";
    $TurnAroundTextErr = "";
    $DimensionHeightTextErr = "";
    $DimensionWidthTextErr = "";
    $PoNumberTextErr = "";
    $CommentsTextErr = "";
    $ErrorTextCounter = 0;

    //Vector
    $DesignVectorImageErr = "";
    $DesignNameVectorErr = "";
    $TurnAroundVectorErr = "";
    $DimensionHeightVectorErr = "";
    $DimensionWidthVectorErr = "";
    $PoNumberVectorErr = "";
    $CommentsVectorErr = "";
    $FormatVectorErr = "";
    $PrintingProcessVectorErr = "";
    $ColorVectorErr = "";
    $ErrorVectorCounter = 0;

    //Intialization
    $Error = "";
    $orderSuccessMsg = "";
    $EmborideryTextSuccessMsg = "";
    $EmborideryTextFailedMsg = "";



    //Placing order Image
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


        if ($_FILES['designimage']['size'] == 0) {
            $DesignImageErr = "Please upload one image";
            $ErrorCounter += 1;
        }
        if (empty($DesignName)) {
            $DesignNameErr = "Please enter a design name";
            $ErrorCounter += 1;
        }
        if (strlen($DesignName) > 100) {
            $DesignNameErr = "Design name is too long, make it within 100 characters";
            $ErrorCounter += 1;
        }
        if (strlen($DesignName) <= 2) {
            $DesignNameErr = "Design name must be at least of 3 characters";
            $ErrorCounter += 1;
        }
        if (empty($PoNumber)) {
            $PoNumberErr = "Please enter PO Number";
            $ErrorCounter += 1;
        }
        if (strlen($PoNumber) > 10) {
            $PoNumberErr = "PO Number must be within 10 digits";
            $ErrorCounter += 1;
        }
        if (strlen($PoNumber) < 10) {
            $PoNumberErr = "PO Number must be at least 10 digits";
            $ErrorCounter += 1;
        }
        if ($TurnAround == "Select Plan") {
            $TurnAroundErr = "Please select a plan";
            $ErrorCounter += 1;
        }
        if (empty($DimensionWidth)) {
            $DimensionWidthErr = "Please enter dimension width";
            $ErrorCounter += 1;
        }
        if (!is_numeric($DimensionWidth)) {
            $DimensionWidthErr = "Digits allowed only";
            $ErrorCounter += 1;
        }
        if (empty($DimensionHeight)) {
            $DimensionHeightErr = "Please enter dimension height";
            $ErrorCounter += 1;
        }
        if (!is_numeric($DimensionHeight)) {
            $DimensionHeightErr = "Digits allowed only";
            $ErrorCounter += 1;
        }
        if ($Stitch == "Select Stitch") {
            $StitchErr = "Please select a stitch";
            $ErrorCounter += 1;
        }
        if ($Application == "Select One") {
            $ApplicationErr = "Please select application";
            $ErrorCounter += 1;
        }
        if ($Thread == "Select One") {
            $ThreadErr = "Please select a thread";
            $ErrorCounter += 1;
        }
        if (empty($Comments)) {
            $CommentsErr = "Please enter some comment";
            $ErrorCounter += 1;
        }
        if (strlen($Comments) > 150) {
            $CommentsErr = "Too long comment, make it within 150 characters";
            $ErrorCounter += 1;
        }
        if (strlen($Comments) < 10) {
            $CommentsErr = "Please enter at least 10 characters comment";
            $ErrorCounter += 1;
        }
        if ($Fabric == "Select One") {
            $FabricErr = "Please select fabric";
            $ErrorCounter += 1;
        }

        if ($ErrorCounter == 0) {

            //Main Image

            $targetDesignImage = "Uploads/designimages/" . basename($_FILES['designimage']['name']);
            $mainImage = $_FILES['designimage']['name'];
            $mainImageTemp = $_FILES['designimage']['tmp_name'];
            $mainImageType = $_FILES['designimage']['type'];

            if (move_uploaded_file($_FILES['designimage']['name'], $targetDesignImage) && strtolower($mainImageType) == "image/jpg" || strtolower($mainImageType) == "image/jpeg" || strtolower($mainImageType) == "image/png") {
                //$Mainmsg = "Main Image Uploaded Successfully";
                //Supporting Image
                $targetSupportingImage = "Uploads/supportingimages/" . basename($_FILES['supportingimage']['name']);
                $supportingImage = $_FILES['supportingimage']['name'];
                $supportingImageTemp = $_FILES['supportingimage']['tmp_name'];
                $supportingImagetyType = $_FILES['supportingimage']['type'];
                if (move_uploaded_file($_FILES['supportingimage']['name'], $targetSupportingImage) && strtolower($supportingImagetyType) == "image/jpg" || strtolower($supportingImagetyType) == "image/jpeg" || strtolower($supportingImagetyType) == "image/png") {
                    //$Supportingmsg = "Image Uploaded Successfully";
                } else {
                    //$Supportingmsg = "Invalid Image";
                }

                //echo $Mainmsg;
                //echo $Supportingmsg;


                //Price calculation

                $ImageCategory = 10;
                if ($TurnAround == "Budget - 24 Hours") {
                    $TurnAroundPrice = 5;
                }  if ($TurnAround == "Standard - 12 Hours") {
                    $TurnAroundPrice = 10;
                }  if ($TurnAround == "Express - 5 hours") {
                    $TurnAroundPrice = 15;
                }

                if ($Application == "Chest Front") {
                    $ApplicationPrice = 5;
                }  if ($Application == "Puff") {
                    $ApplicationPrice = 10;
                }  if ($Application == "Left Chest & Cap Combo") {
                    $ApplicationPrice = 15;
                }  if ($Application == "Left Chest") {
                    $ApplicationPrice = 20;
                }  if ($Application == "Jacket Back") {
                    $ApplicationPrice = 25;
                }  if ($Application == "Cap") {
                    $ApplicationPrice = 30;
                }
                $FinalPrice = $ImageCategory + $TurnAroundPrice + $ApplicationPrice;


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


                if ($InsertImageEmborideryFire) {
                    move_uploaded_file($mainImageTemp, $targetDesignImage);
                    move_uploaded_file($supportingImageTemp, $targetSupportingImage);
                    $orderSuccessMsg = "Order has been placed successfully";
                    //echo $orderSuccessMsg;
                } else {
                    echo mysqli_error($conn);
                }
            } else {

                $ErrorNo = $ErrorCounter;

                $Error = "Please Fix errors";
            }
        } else {
            $Mainmsg = "Invalid Image";
        }


    }
    else if (isset($_POST['placeorderemtext']))
    {
        $Text = mysqli_real_escape_string($conn, $_POST['text']);
        $DesignNameText = mysqli_real_escape_string($conn, $_POST['designnametext']);
        $PoNumberText = mysqli_real_escape_string($conn, $_POST['ponumbertext']);
        $TurnAroundText = mysqli_real_escape_string($conn, $_POST['turnaroundtext']);
        $DimensionText = mysqli_real_escape_string($conn, $_POST['dimensiontext']);
        $DimensionWidthText = mysqli_real_escape_string($conn, $_POST['widthtext']);
        $DimensionHeightText = mysqli_real_escape_string($conn, $_POST['heighttext']);
        $DimensionText = mysqli_real_escape_string($conn, $_POST['dimensiontext']);
        $IsBGColorIncludeText = mysqli_real_escape_string($conn, $_POST['backgroundcolorinclusiontext']);
        $StitchText = mysqli_real_escape_string($conn, $_POST['stitchtext']);
        $ApplicationText = mysqli_real_escape_string($conn, $_POST['applicationtext']);
        $FabricText = mysqli_real_escape_string($conn, $_POST['fabrictext']);
        $ThreadText = mysqli_real_escape_string($conn, $_POST['threadtext']);
        $AppliqueText = mysqli_real_escape_string($conn, $_POST['appliquetext']);
        $CommentsText = mysqli_real_escape_string($conn, $_POST['commenttext']);

        if (empty($Text)) {
            $TextErr = "Please enter text";
            $ErrorTextCounter += 1;
        }
        if (empty($DesignNameText)) {
            $DesignNameTextErr = "Please enter a design name";
            $ErrorTextCounter += 1;
        }
        if (strlen($DesignNameText) > 100) {
            $DesignNameTextErr = "Design name is too long, make it within 100 characters";
            $ErrorTextCounter += 1;
        }
        if (strlen($DesignNameText) <= 2) {
            $DesignNameTextErr = "Design name must be at least of 3 characters";
            $ErrorTextCounter += 1;
        }
        if (empty($PoNumberText)) {
            $PoNumberTextErr = "Please enter PO Number";
            $ErrorTextCounter += 1;
        }
        if (strlen($PoNumberText) > 10) {
            $PoNumberTextErr = "PO Number must be within 10 digits";
            $ErrorTextCounter += 1;
        }
        if (strlen($PoNumberText) < 10) {
            $PoNumberTextErr = "PO Number must be at least 10 digits";
            $ErrorTextCounter += 1;
        }
        if ($TurnAroundText == "Select Plan") {
            $TurnAroundTextErr = "Please select a plan";
            $ErrorTextCounter += 1;
        }
        if (empty($DimensionWidthText)) {
            $DimensionWidthTextErr = "Please enter dimension width";
            $ErrorTextCounter += 1;
        }
        if (!is_numeric($DimensionWidthText)) {
            $DimensionWidthTextErr = "Digits allowed only";
            $ErrorTextCounter += 1;
        }
        if (empty($DimensionHeightText)) {
            $DimensionHeightTextErr = "Please enter dimension height";
            $ErrorTextCounter += 1;
        }
        if (!is_numeric($DimensionHeightText)) {
            $DimensionHeightTextErr = "Digits allowed only";
            $ErrorTextCounter += 1;
        }
        if ($StitchText == "Select One") {
            $StitchTextErr = "Please select a stitch";
            $ErrorTextCounter += 1;
        }
        if ($ApplicationText == "Select One") {
            $ApplicationTextErr = "Please select application";
            $ErrorTextCounter += 1;
        }
        if ($ThreadText == "Select One") {
            $ThreadTextErr = "Please select a thread";
            $ErrorTextCounter += 1;
        }
        if (empty($CommentsText)) {
            $CommentsTextErr = "Please enter some comment";
            $ErrorTextCounter += 1;
        }
        if (strlen($CommentsText) > 150) {
            $CommentsTextErr = "Too long comment, make it within 150 characters";
            $ErrorTextCounter += 1;
        }
        if (strlen($CommentsText) < 10) {
            $CommentsTextErr = "Please enter at least 10 characters comment";
            $ErrorTextCounter += 1;
        }
        if ($FabricText == "Select One") {
            $FabricTextErr = "Please select fabric";
            $ErrorTextCounter += 1;
        }

        if ($ErrorTextCounter == 0) {
            $TextCategory = 10;
            if ($TurnAroundText == "Budget - 24 Hours") {
                $TurnAroundPriceText = 5;
            }  if ($TurnAroundText == "Standard - 12 Hours") {
                $TurnAroundPriceText = 10;
            }  if ($TurnAroundText == "Express - 5 hours") {
                $TurnAroundPriceText = 15;
            }

            if ($ApplicationText == "Chest Front") {
                $ApplicationPriceText = 5;
            }  if ($ApplicationText == "Puff") {
                $ApplicationPriceText = 10;
            }  if ($ApplicationText == "Left Chest & Cap Combo") {
                $ApplicationPriceText = 15;
            }  if ($ApplicationText == "Left Chest") {
                $ApplicationPriceText = 20;
            }  if ($ApplicationText == "Jacket Back") {
                $ApplicationPriceText = 25;
            }  if ($ApplicationText == "Cap") {
                $ApplicationPriceText = 30;
            }
            $FinalPriceText = $TextCategory + $TurnAroundPriceText + $ApplicationPriceText;


            $InsertTextEmboridery = "INSERT INTO tbl_order
            (
            emboridery_text,
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
            '$Text',
            '$DesignNameText',
            'Emboridery Text',
            '$PoNumberText',
            '$TurnAroundText',
            '$DimensionText',
            '$DimensionWidthText',
            '$DimensionHeightText',
            '$IsBGColorIncludeText',
            '$StitchText',
            '$ApplicationText',
            '$FabricText',
            '$ThreadText',
            '$AppliqueText',
            '$CommentsText',
            $FinalPriceText,
            'NEW',
            '$datetime',
            '$userEmail',
            '$userIP'
            )";

            $InsertTextEmborideryFire = mysqli_query($conn, $InsertTextEmboridery);

            if ($InsertTextEmborideryFire) {
                $EmborideryTextSuccessMsg = "Emboridery Text Order has been placed, Total amount : ".$FinalPriceText;
            } else {
                $EmborideryTextFailedMsg = "Something went wrong";
            }
        }
        else {
            //echo $ErrorTextCounter;
        }


    }
    else if (isset($_POST['placeordervectorart'])) {
        //$DesignImageVector = mysqli_real_escape_string($conn,$_POST['imagedesignvector']);
        //$SupportingImageVector = mysqli_real_escape_string($conn,$_POST['imagesupportingvector']);
        $DesignNameVector = mysqli_real_escape_string($conn, $_POST['designnamevector']);
        $PoNumberVector = mysqli_real_escape_string($conn, $_POST['ponumbervector']);
        $TurnAroundVector = mysqli_real_escape_string($conn, $_POST['turnaroundvector']);
        $DimensionVector = mysqli_real_escape_string($conn, $_POST['dimensionvector']);
        $DimensionWidthVector = mysqli_real_escape_string($conn, $_POST['widthvector']);
        $DimensionHeightVector = mysqli_real_escape_string($conn, $_POST['heightvector']);
        $DimensionVector = mysqli_real_escape_string($conn, $_POST['dimensionvector']);
        $IsBGColorIncludeVector = mysqli_real_escape_string($conn, $_POST['backgroundcolorinclusionvector']);
        $ApplicationVector = mysqli_real_escape_string($conn, $_POST['applicationvector']);
        $CommentsVector = mysqli_real_escape_string($conn, $_POST['commentvector']);
        $FormatVector = mysqli_real_escape_string($conn,$_POST['formatvector']);
        $ColorVector = mysqli_real_escape_string($conn,$_POST['colorvector']);
        $PrintingProcessVector = mysqli_real_escape_string($conn,$_POST['printingprocessvector']);

        if ($_FILES['imagedesignvector']['size'] == 0) {
            $DesignImageVectorErr = "Please upload one image";
            $ErrorVectorCounter += 1;
        }
        if (empty($DesignNameVector)) {
            $DesignNameVectorErr = "Please enter a design name";
            $ErrorVectorCounter += 1;
        }
        if (strlen($DesignNameVector) > 100) {
            $DesignNameVectorErr = "Design name is too long, make it within 100 characters";
            $ErrorVectorCounter += 1;
        }
        if (strlen($DesignNameVector) <= 2) {
            $DesignNameVectorErr = "Design name must be at least of 3 characters";
            $ErrorVectorCounter += 1;
        }
        if (empty($PoNumberVector)) {
            $PoNumberVectorErr = "Please enter PO Number";
            $ErrorVectorCounter += 1;
        }
        if (strlen($PoNumberVector) > 10) {
            $PoNumberVectorErr = "PO Number must be within 10 digits";
            $ErrorVectorCounter += 1;
        }
        if (strlen($PoNumberVector) < 10) {
            $PoNumberVectorErr = "PO Number must be at least 10 digits";
            $ErrorVectorCounter += 1;
        }
        if ($TurnAroundVector == "Select Plan") {
            $TurnAroundVectorErr = "Please select a plan";
            $ErrorVectorCounter += 1;
        }
        if (empty($DimensionWidthVector)) {
            $DimensionWidthVectorErr = "Please enter dimension width";
            $ErrorVectorCounter += 1;
        }
        if (!is_numeric($DimensionWidthVector)) {
            $DimensionWidthVectorErr = "Digits allowed only";
            $ErrorVectorCounter += 1;
        }
        if (empty($DimensionHeightVector)) {
            $DimensionHeightVectorErr = "Please enter dimension height";
            $ErrorVectorCounter += 1;
        }
        if (!is_numeric($DimensionHeightVector)) {
            $DimensionHeightVectorErr = "Digits allowed only";
            $ErrorVectorCounter += 1;
        }
        if ($ApplicationVector == "Select One") {
            $ApplicationVectorErr = "Please select application";
            $ErrorVectorCounter += 1;
        }
        if (empty($CommentsVector)) {
            $CommentsVectorErr = "Please enter some comment";
            $ErrorVectorCounter += 1;
        }
        if (strlen($CommentsVector) > 150) {
            $CommentsVectorErr = "Too long comment, make it within 150 characters";
            $ErrorVectorCounter += 1;
        }
        if (strlen($CommentsVector) < 10) {
            $CommentsVectorErr = "Please enter at least 10 characters comment";
            $ErrorVectorCounter += 1;
        }
        if ($FormatVector == "Select One") {
            $FormatVectorErr = "Please select a vector format";
            $ErrorVectorCounter += 1;
        }
        if ($ColorVector == "Select One") {
            $ColorVectorErr = "Please select color format";
            $ErrorVectorCounter += 1;
        }
        if ($PrintingProcessVector == "Select One") {
            $PrintingProcessVectorErr = "Please select a printing process";
            $ErrorVectorCounter += 1;
        }
        if ($ErrorVectorCounter == 0) {

            $targetDesignImage = "Uploads/Vector/DesignImages/" . basename($_FILES['imagedesignvector']['name']);
            $mainImage = $_FILES['imagedesignvector']['name'];
            $mainImageTemp = $_FILES['imagedesignvector']['tmp_name'];
            $mainImageType = $_FILES['imagedesignvector']['type'];

            if (move_uploaded_file($_FILES['imagesupportingvector']['name'], $targetDesignImage) && strtolower($mainImageType) == "image/jpg" || strtolower($mainImageType) == "image/png" || strtolower($mainImageType) == "image/jpeg") {
                //$Mainmsg = "Main Image Uploaded Successfully";
                //Supporting Image
                $targetSupportingImage = "Uploads/Vector/SupportingImages/" . basename($_FILES['imagesupportingvector']['name']);
                $supportingImage = $_FILES['imagesupportingvector']['name'];
                $supportingImageTemp = $_FILES['imagesupportingvector']['tmp_name'];
                $supportingImagetyType = $_FILES['imagesupportingvector']['type'];
                if (move_uploaded_file($_FILES['imagesupportingvector']['name'], $targetSupportingImage) && strtolower($supportingImagetyType) == "image/jpg" || strtolower($supportingImagetyType) == "image/jpeg" || strtolower($supportingImagetyType) == "image/png") {
                    //$Supportingmsg = "Image Uploaded Successfully";
                } else {
                    //$Supportingmsg = "Invalid Image";
                }

                $VectorCategory = 10;
                if ($TurnAroundVector == "Budget - 24 Hours") {
                    $TurnAroundVectorPrice = 5;
                }
                if ($TurnAroundVector == "Standard - 12 Hours") {
                    $TurnAroundVectorPrice = 10;
                }
                if ($TurnAroundVector == "Express - 5 hours") {
                    $TurnAroundVectorPrice = 15;
                }

                if ($ApplicationVector == "Vector Art") {
                    $ApplicationVectorPrice = 5;
                }
                if ($ApplicationVector == "Silkscreen") {
                    $ApplicationVectorPrice = 10;
                }
                if ($ApplicationVector == "DTG") {
                    $ApplicationVectorPrice = 15;
                }
                if ($ApplicationVector == "Vinyl (Cad cut)") {
                    $ApplicationVectorPrice = 20;
                }
                if ($ApplicationVector == "Vinyl (Hairline border)") {
                    $ApplicationVectorPrice = 25;
                }
                if ($ApplicationVector == "Sandblasting" || $ApplicationVector == "Laser engraving" || $ApplicationVector == "Laser pins/emblems") {
                    $ApplicationVectorPrice = 30;
                }
                $FinalPriceVector = $VectorCategory + $TurnAroundVectorPrice + $ApplicationVectorPrice;


                $VectorEmboridery = "INSERT INTO tbl_order
            (
            emboridery_vector_design_image,
            emboridery_vector_supporting_image,
            design_name,
            ponumber,
            turnarround,
            category,
            dimension_width,
            dimension_height,
            dimension,
            have_bg_color,
            vector_format,
            application,
            printing_process,
            color,
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
            '$DesignNameVector',
            '$PoNumberVector',
            '$TurnAroundVector',
            'Emboridery Vector',
            '$DimensionWidthVector',
            '$DimensionHeightVector',
            '$DimensionVector',
            '$IsBGColorIncludeVector',
            '$FormatVector',
            '$ApplicationVector',
            '$PrintingProcessVector',
            '$ColorVector',
            '$CommentsVector',
            $FinalPriceVector,
            'NEW',
            '$datetime',
            '$userEmail',
            '$userIP'
            )";

                $VectorEmborideryFire = mysqli_query($conn, $VectorEmboridery);


                if ($VectorEmborideryFire) {
                    move_uploaded_file($mainImageTemp, $targetDesignImage);
                    move_uploaded_file($supportingImageTemp, $targetSupportingImage);
                    $orderSuccessMsg = "Order has been placed successfully";
                    echo $orderSuccessMsg;
                } else {
                    echo mysqli_error($conn);
                }


            }
        }
        else {
            //echo $ErrorVectorCounter;
        }
    }
}
    else {
        header("location:http://localhost/RenDigitizingUpdated/user/authentication/login.php");

}
?>