<?php

 session_start();
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 error_reporting(E_ALL ^ E_NOTICE);
 require_once "../../functions/functions.php";
 require_once "../../db/connection/conn.php";
 $datetime = getIndianDateTime();
 $userIP = getUserIpAddr();
 $userEmail = $_SESSION['USER'];
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

             $targetDesignImage = "Uploads/DesignImages/" . basename($_FILES['designimage']['name']);
             $mainImage = $_FILES['designimage']['name'];
             $mainImageTemp = $_FILES['designimage']['tmp_name'];
             $mainImageType = $_FILES['designimage']['type'];

             if (move_uploaded_file($_FILES['designimage']['name'], $targetDesignImage) && strtolower($mainImageType) == "image/jpg" || strtolower($mainImageType) == "image/jpeg" || strtolower($mainImageType) == "image/png") {
                 //$Mainmsg = "Main Image Uploaded Successfully";
                 //Supporting Image
                 $targetSupportingImage = "Uploads/SupportingImages/" . basename($_FILES['supportingimage']['name']);
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
                     //echo $orderSuccessMsg;
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
 else
 {
     header("location:http://localhost/RenDigitizing/user/authentication/login.php");
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
    <script>
        function openSlideMenu() {

            $("#sideBar").fadeIn(400);
            document.getElementById('sideBar').style.display = 'inherit';
            $("#openMenu").fadeOut(400);
            document.getElementById('openMenu').style.display = 'none';
            $("#closeMenu").fadeIn(400);
            document.getElementById('closeMenu').style.display = 'inherit';
            $("#profileAreaContent").fadeOut(400);
        }

        function closeSlideMenu() {
            $("#sideBar").fadeOut(400);
            // document.getElementById('sideBar').style.display = 'none';
            $("#openMenu").fadeIn(400);
            document.getElementById('openMenu').style.display = 'inherit';
            $("#closeMenu").fadeOut(400);
            document.getElementById('closeMenu').style.display = 'none';
            $("#profileAreaContent").fadeIn(400);
        }
    </script>
</head>

<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-left  my-auto">
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
            <div class="col-md-3 profile-area-sidebar p-5" id="sideBar">
                <a href="dashboard.php">Dashboard</a>
                <a href="placeorder.php">Place an Order</a>
                <a href="orders.php">My Orders</a>
                <a href="account.php">Account Details</a>
                <a href="../../index.php">Home</a>
            </div>

            <div class="col-md-9 profile-area-content p-5" id="profileAreaContent">
                <div class="reach-out-buttons">
                    <table class="table table-striped table-items">
                        <th>
                            <input class="btn order-btn-1 btn-mobile" type="button" value="Emboridery Images"
                                   name="btnchoice">
                        </th>
                        <th>
                            <input class="btn order-btn-2 btn-mobile" type="button" value="Embroidery Text"
                                   name="btnchoice">
                        </th>
                        <th>
                            <input class="btn order-btn-3 btn-mobile" type="button" value="Vector Art"
                                   name="btnchoice">
                        </th>
                    </table>
                    <span class="error"><?php echo $Error ?></span>
                    <span class="success"><?php echo $orderSuccessMsg ?></span>
                    <span class="success"><?php echo $EmborideryTextSuccessMsg ?></span>
                    <span class="error"><?php echo $EmborideryTextFailedMsg ?></span>
                </div>


                <!--Forms-->
                <div id="emimages">
                    <form method="post" name="emimages" id="form1" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="btn order-btn-1 py-2 my-3 btn-mobile" type="button"
                                       value="Image Details" name="btnImage">
                                <div class="container myaccount-details-area need2hide">
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
                                <input class="btn order-btn-2 py-2 my-3 btn-mobile" type="button"
                                       value="Image Description" name="btnImage">
                                <div class="container myaccount-change-password need2hide">
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
                                                <span class="error"><?php echo $StitchErr ?></span>
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
                                                <span class="error"><?php echo $ApplicationErr ?></span>
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
                                                <span class="error"><?php echo $FabricErr ?></span>
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
                                                <span class="error"><?php echo $ThreadErr ?></span>
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
                                                <span class="error"><?php echo $CommentsErr ?></span>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 ">

                                <input class="btn order-btn-1 d-block py-2 my-3 btn-mobile" id="btnQuote"
                                       type="submit" name="getquoteemimjages" value="Get Quote">
                                <input class="btn order-btn-2 d-block py-2 my-3 btn-mobile" id="btnPlaceOrder"
                                       type="submit" name="placeorderemimages" formmethod="post" value="Place Order">
                            </div>
                        </div>
                    </form>
                </div>
                <div id="emtext">
                    <form name="emtext" id="form2" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="btn order-btn-1 py-2 my-3" type="button" value="Text Detail"
                                       name="btnText">
                                <div class="container myaccount-details-area need2hide" id="emText">
                                    <h1 class="profile-text-area">Text Details</h1>
                                    <table class="myaccount-details-table">
                                        <tr>
                                            <td>
                                                <h5>Text</h5>
                                            </td>
                                            <td>
                                                    <textarea name="text" id="" cols="30" rows="5"
                                                              placeholder="Enter Text Here"></textarea>
                                                <span class="error"><?php echo $TextErr ?></span>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Design Name</h5>
                                            </td>
                                            <td>
                                                <input type="text" name="designnametext" id="ponumber">
                                                <span class="error"><?php echo $DesignNameTextErr ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>PO Number</h5>
                                            </td>
                                            <td>
                                                <input type="text" name="ponumbertext" id="ponumber">
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
                                                            class="btn dropdown-select">

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
                                    </table>
                                </div>
                                <input class="btn order-btn-2 py-2 my-3" type="button" value="Text Description"
                                       name="btnText">
                                <div class="container myaccount-change-password need2hide" id="emDescription">
                                    <h1 class="profile-text-area">Text Description</h1>
                                    <table>

                                        <tr>
                                            <td>
                                                <h5>Dimensions</h5>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Width" name="widthtext"
                                                               id="widthtext">
                                                        <span
                                                            class="error"><?php echo $DimensionWidthTextErr ?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Height" name="heighttext"
                                                               id="heighttext">
                                                        <span
                                                            class="error"><?php echo $DimensionHeightTextErr ?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="dimensiontext" id="dimensiontext"
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
                                                <select name="backgroundcolorinclusiontext"
                                                        id="backgroundcolorinclusiontext" class="btn dropdown-select">
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
                                                <select name="stitchtext" id="stitchtext"
                                                        class="btn dropdown-select">
                                                    <option value="Select One">Select One</option>
                                                    <option value="Melco OFM">Melco OFM</option>
                                                    <option value="Toyota 100">Toyota 100</option>
                                                    <option value="Wilcom EMB">Wilcom EMB</option>
                                                    <option value="Tajima DST">Tajima DST</option>
                                                    <option value="Pulse PSF">Pulse PSF</option>
                                                    <option value="Melco Exp">Melco Exp</option>
                                                    <option value="Compucon XXX">Compucon XXX</option>
                                                    <option value="Pfaff PCS">Pfaff PCS</option>
                                                    <option value="Brother PES">Brother PES</option>
                                                    <option value="Husqvarna HUS">Husqvarna HUS</option>
                                                    <option value="Barudan DSB">Barudan DSB</option>
                                                    <option value="ZSK">ZSK</option>
                                                    <option value="DSZ">DSZ</option>
                                                    <option value="PCM">PCM</option>
                                                    <option value="SEW">SEW</option>
                                                    <option value="CSD">CSD</option>
                                                    <option value="Jef">Jef</option>
                                                    <option value="CND">CND</option>
                                                </select>
                                                <span class="error"><?php echo $StitchTextErr ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Application</h5>
                                            </td>
                                            <td>
                                                <select name="applicationtext" id="applicationtext"
                                                        class="btn dropdown-select">
                                                    <option value="Select One">Select One</option>
                                                    <option value="Chest Front">Chest Front</option>
                                                    <option value="Puff">Puff</option>
                                                    <option value="Left Chest & Cap Combo">Left Chest & Cap Combo
                                                    </option>
                                                    <option value="Left Chest">Left Chest</option>
                                                    <option value="Jacket Back">Jacket Back</option>
                                                    <option value="Cap">Cap</option>
                                                </select>
                                                <span class="error"><?php echo $ApplicationTextErr ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Fabric</h5>
                                            </td>
                                            <td>
                                                <select name="fabrictext" id="fabrictext"
                                                        class="btn dropdown-select">
                                                    <option value="Select One">Select One</option>
                                                    <option value="Cotton / Twill">Cotton / Twill</option>
                                                    <option value="Wool">Wool</option>
                                                    <option value="Football Shirts">Football Shirts</option>
                                                    <option value="Fleece">Fleece</option>
                                                    <option value="Towel / Terry Cloth">Towel / Terry Cloth</option>
                                                    <option value="Traditional(jersey,pique.etc)">
                                                        Traditional(jersey,pique.etc)
                                                    </option>
                                                    <option value="Lycra / Spandex trees">Lycra / Spandex trees
                                                    </option>
                                                    <option value="Leather">Leather</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <span class="error"><?php echo $FabricTextErr ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Thread</h5>
                                            </td>
                                            <td>
                                                <select name="threadtext" id="threadtext"
                                                        class="btn dropdown-select">
                                                    <option value="Select One">Select One</option>
                                                    <option value="Ackeman Isacord 40">Ackeman Isacord 40</option>
                                                    <option value="Ackeman Isacord 30">Ackeman Isacord 30</option>
                                                    <option value="Medira Classic Rayon #40">Medira Classic Rayon
                                                        #40
                                                    </option>
                                                    <option value="Medira Classic Rayon #60">Medira Classic Rayon
                                                        #60
                                                    </option>
                                                    <option value="Medira Classic Rayon #30">Medira Classic Rayon
                                                        #30
                                                    </option>
                                                    <option value="Polyneon #40">Polyneon #40</option>
                                                    <option value="Polyneon #60">Polyneon #60</option>
                                                </select>
                                                <span class="error"><?php echo $ThreadTextErr ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Applique</h5>
                                            </td>
                                            <td>
                                                <select name="appliquetext" id="appliquetext"
                                                        class="btn dropdown-select">

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
                                                    <textarea form="form2" name="commenttext" id="commenttext" cols="40"
                                                              rows="5"></textarea>
                                                <span class="error"><?php echo $CommentsTextErr ?></span>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <input class="btn order-btn-1 d-block py-2 my-3" id="btnQuote" type="submit"
                                       name="getquoteemtext" value="Get Quote">
                                <input class="btn order-btn-2 d-block py-2 my-3" id="btnPlaceOrderText"
                                       type="submit" formmethod="post" name="placeorderemtext" value="Place Order">
                            </div>
                        </div>
                    </form>
                </div>
                <div id="vectorart">
                    <form name="vectorart" id="form3" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="btn order-btn-1 py-2 my-3" type="button" value="Vector Detail"
                                       name="btnVector">
                                <div class="container myaccount-details-area need2hide" id="vectorDetails">
                                    <h1 class="profile-text-area">Vector Details</h1>
                                    <table class="myaccount-details-table">
                                        <tr>
                                            <td>
                                                <h5>Your Design</h5>
                                            </td>
                                            <td>
                                                <input type="file" class="input-file" name="imagedesignvector">
                                                <span class="error"><?php echo $DesignImageVectorErr?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Supporting Design</h5>
                                            </td>
                                            <td>
                                                <input type="file" class="input-file" name="imagesupportingvector">
                                                <span class="error"><?php echo $SupportingImageErr?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Design Name</h5>
                                            </td>
                                            <td>
                                                <input type="text" name="designnamevector" id="designnamevector">
                                                <span class="error"><?php echo $DesignNameVectorErr?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>PO Number</h5>
                                            </td>
                                            <td>
                                                <input type="text" name="ponumbervector" id="ponumbervector">
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
                                                            class="btn dropdown-select">
                                                        <option value="Select Plan">Select Plan</option>
                                                        <option value="Budget - 24 Hours">Budget - 24 Hours</option>
                                                        <option value="Standard - 12 Hours">Standard - 12 Hours
                                                        </option>
                                                        <option value="Express - 5 hours">Express - 5 hours</option>
                                                    </select>
                                                    <span class="error"><?php echo $TurnAroundVectorErr?></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <input class="btn order-btn-2 py-2 my-3" type="button" value="Vector Description"
                                       name="btnVector">
                                <div class="container myaccount-change-password need2hide" id="vectorDescription">
                                    <h1 class="profile-text-area">Vector Description</h1>
                                    <table>

                                        <tr>
                                            <td>
                                                <h5>Dimensions</h5>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Width" name="widthvector"
                                                               id="widthvector">
                                                        <span
                                                            class="error"><?php echo $DimensionWidthVectorErr?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Height" name="heightvector"
                                                               id="heightvector">
                                                        <span
                                                            class="error"><?php echo $DimensionHeightVectorErr?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="dimensionvector" id="dimensionvector"
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
                                                <select name="backgroundcolorinclusionvector"
                                                        id="backgroundcolorinclusionvector" class="btn dropdown-select">

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
                                                <select name="formatvector" id="formatvector"
                                                        class="btn dropdown-select">
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
                                                        class="btn dropdown-select">
                                                    <option value="Select One">Select One</option>
                                                    <option value="Vector Art">Vector Art</option>
                                                    <option value="Silkscreen">Silkscreen</option>
                                                    <option value="DTG">DTG</option>
                                                    <option value="Vinyl (Cad cut)">Vinyl (Cad cut)</option>
                                                    <option value="Vinyl (Hairline border)">Vinyl (Hairline border)
                                                    </option>
                                                    <option value="Sandblasting">Sandblasting</option>
                                                    <option value="Laser engraving">Laser engraving</option>
                                                    <option value="Laser engraving">Lapel pins/emblems</option>
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
                                                        class="btn dropdown-select">
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
                                                <select name="colorvector" id="colorvector"
                                                        class="btn dropdown-select">
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
                                                    <textarea form="form3" name="commentvector" id="commentvector"
                                                              cols="40" rows="5"></textarea>
                                                <span class="error"><?php echo $CommentsVectorErr?></span>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <input class="btn order-btn-1 d-block py-2 my-3" id="btnQuote" type="submit"
                                       name="getquotevectorart" value="Get Quote">
                                <input class="btn order-btn-2 d-block py-2 my-3" id="btnPlaceOrdervector"
                                       type="submit" formmethod="post" name="placeordervectorart" value="Place Order">
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