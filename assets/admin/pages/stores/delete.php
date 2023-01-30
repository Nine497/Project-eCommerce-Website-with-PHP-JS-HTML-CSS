<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
    $product_id=$_GET['product_id'];
    $sql="DELETE FROM `product` WHERE product_id = $product_id";
   
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