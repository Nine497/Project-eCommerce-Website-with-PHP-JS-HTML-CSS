<?php include_once('../authen.php');
include_once('../../connect.php');

$order_id = $_GET['order_id'];
$sql1 = "SELECT `order_number` FROM  `orders` WHERE order_id = $order_id";
$result = mysqli_query($conn, $sql1);

if (!$result) {
        echo '<script>';
        echo "window.location='index.php?do=delete_failed';";
        echo '</script>';
        mysqli_close($conn);
        exit;
}

$order_number = mysqli_fetch_assoc($result)['order_number'];
mysqli_free_result($result);

$sql2 = "DELETE FROM `order_detail` WHERE order_number = $order_number";
$delete1 = mysqli_query($conn, $sql2);

if (!$delete1) {
        echo '<script>';
        echo "window.location='index.php?do=delete_failed';";
        echo '</script>';
        mysqli_close($conn);
        exit;
}

$sql3 = "DELETE FROM `orders` WHERE order_id = $order_id";
$delete2 = mysqli_query($conn, $sql3);

if ($delete2) {
        echo '<script>';
        echo "window.location='index.php?do=delete_success';";
        echo '</script>';
} else {
        echo '<script>';
        echo "window.location='index.php?do=delete_failed';";
        echo '</script>';
}
mysqli_close($conn);
?>