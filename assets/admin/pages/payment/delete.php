<?php
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
$payment_id = $_GET['payment_id'];
$sql = "DELETE FROM `payment` WHERE payment_id = $payment_id";

if (mysqli_query($conn, $sql)) {
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