<?php
    require_once "../../db/connection/conn.php";
    //$_REQUEST['orderId']; //aisa kuch ayega
    if($_POST['orderId'])
    {
    $OrderId = mysqli_real_escape_string($conn, $_POST['orderId']);
    $cancelOrder = "UPDATE tbl_order SET order_flag = 'CANCELLED' WHERE order_id = '$OrderId'";
    // Samjha ?
    // ha run kar
    $cancelOrderFire = mysqli_query($conn, $cancelOrder);
    if($cancelOrderFire)
    {
        //idar se response kaise bhejega ?
    }
    else{
        echo mysqli_error($conn);//jo bhib echo karega wo ajax ko jayega
        //dekhne de
    }
}
else
{
    echo "Invalid request";
}
?>