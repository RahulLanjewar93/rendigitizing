<?php
session_start();
$email = $_POST['email'];

if(isset($_POST['submit'])) {
    $_SESSION['USER'] = $email;
    header("location:account.php");
    //echo $_POST['submit'];
}
?>
<html>
<body>
<form method="post">
    <input type="text" name="email" />
    <br/>
    <input type="submit" name="submit" value="hello" />

</form>
</body>
</html>
