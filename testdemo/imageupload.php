<?php
error_reporting(0);
require_once "../db/connection/conn.php";

if (isset($_POST['submit'])) {

    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
        $Image_Name = $_FILES['images']['name'][$i];
        $Image_Tmp_Name = $_FILES['images']['tmp_name'][$i];
        $Image_Type = $_FILES['images']['type'][$i];
        $Image_Size = $_FILES['images']['size'][$i];
        $Folder = "Uploads/";
        $ImageCount = count($_FILES['images']['name'][$i]);
        echo $ImageCount;
        $caption = mysqli_real_escape_string($conn, $_POST['caption']);

        if ($ImageCount <= 5) {
            if (strtolower($Image_Type) == "image/jpg" || strtolower($Image_Type) == "image/jpeg" || strtolower($Image_Type)
                == "image/png") {
                if ($Image_Size < 1000000) {
                    $Folder = $Folder . $Image_Name;
                    $Upload = "INSERT INTO tbl_images (image_caption, image_path) VALUES ('$caption','$Folder')";
                    $UploadFire = mysqli_query($conn, $Upload);

                    if ($UploadFire) {
                        move_uploaded_file($Image_Tmp_Name, $Folder);
                        $UploadSuccessMessage = "<div style='font-weight:bold; border: 1px; padding: 10px; box-shadow: 5px 10px 18px #888888; color: green;'>Image(s) has been uploaded successfully !</div>";

                    } else {
                        $UploadErrorMessage = "<div style='font-weight:bold; border: 1px; padding: 10px; box-shadow: 5px 10px 18px #888888; color: red;'>Image Uploading Failed ! !</div>";

                    }
                } else {
                    echo "Image is too big";

                }
            } else {
                $InvalidImageError = "<div style='font-weight:bold; border: 1px; padding: 10px; box-shadow: 5px 10px 18px #888888; color: red;'>Invalid Image Selected! !</div>";
            }
        }
        else if($ImageCount == -1)
        {
            $ImageCountMinErr = "Select at least 1 image file";
        }
        else{
            $ImageCountMaxErr = "Max 5 images only";
        }
    }
}
?>

<html>
<head>

</head>
<body>
<?php echo $UploadSuccessMessage; echo $UploadErrorMessage; echo $ImageCountMaxErr; echo $ImageCountMinErr?>
<form method="post" enctype="multipart/form-data">
    <input type="text" placeholder="caption" name="caption"/>
    <br/>
    <br/>
    <input type="file" name="images[]" multiple required>
    <br/>
    <br/>
    <button type="submit" name="submit" id="submit">Upload</button>
    <br/>
</form>
<table border="2">
    <thead>
    <tr>
        <th>Caption</th>
        <th>Image</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    $showImages = "SELECT * FROM tbl_images";
    $showImagesFire = mysqli_query($conn, $showImages);
    while($row = mysqli_fetch_array($showImagesFire))
    {
    ?>
    <tr>
        <td><?php echo $row['image_caption'] ?></td>
        <td><img src="<?php echo $row['image_path'] ?>" style="height: 100px; width: 100px;"></td>
    </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
