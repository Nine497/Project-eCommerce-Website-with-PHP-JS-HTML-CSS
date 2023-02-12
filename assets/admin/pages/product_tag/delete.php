<?php
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
$product_tag_id = $_GET['product_tag_id'];
$sql = "DELETE FROM `product_tag` WHERE product_tag_id = $product_tag_id";

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