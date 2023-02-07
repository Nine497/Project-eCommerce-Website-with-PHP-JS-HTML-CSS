<?php
include_once('../authen.php');
include_once('../../connect.php');

if (isset($_POST['status'])) {
    $order_number = $_POST['order_number'];
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $update_query = "UPDATE orders SET order_status = '$status' WHERE order_number = '$order_number' AND order_id = '$order_id'";
    if (mysqli_query($conn, $update_query)) {
        echo '<script>';
        header("Refresh:0");
        echo "window.location='index.php?do=updated_success';";
        echo '</script>';
    } else {
        header('Refresh:0');
        echo '<script>';
        echo "window.location='index.php?do=updated_failed';";
        echo '</script>';
    }

}
?>