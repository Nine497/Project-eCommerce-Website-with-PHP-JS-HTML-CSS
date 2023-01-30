<?php
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
//echo '<pre>',print_r ($_POST),'<pre>';
$payment_id = $_POST['payment_id'];
$payment_status = $_POST['payment_status'];
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