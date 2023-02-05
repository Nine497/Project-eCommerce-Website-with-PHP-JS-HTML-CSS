<?php
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
//echo '<pre>',print_r ($_POST),'<pre>';
$payment_id = $_POST['payment_id'];
$payment_status = $_POST['payment_status'];

$order_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `order_id` FROM `orders` WHERE `payment_id` = $payment_id"))['order_id'];
$update_sql = "UPDATE `product` SET `product_count` = `product_count` - 
(SELECT SUM(`order_count`) FROM `orders` WHERE `order_id` = $order_id)
WHERE `product_id` IN (SELECT `product_id` FROM `orders` WHERE `order_id` = $order_id)";


$sql = "UPDATE `payment` SET `payment_status` = $payment_status WHERE `payment`.`payment_id` = $payment_id";

if (mysqli_query($conn, $sql)) {
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
//echo '<pre>'.print_r($_POST),'<pre>';

?>