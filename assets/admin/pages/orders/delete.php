<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
    $order_id=$_GET['order_id'];
    $sql="DELETE FROM `orders` WHERE order_id = $order_id";
   
    if (mysqli_query($conn, $sql)) {
        echo '<script> alert("ลบข้อมูลเสร็จสิ้น!")</script>'; 
        header('Refresh:0; url=index.php');
        echo '<script>';
        echo "window.location='index.php?do=success';";
        echo '</script>';
	} else {
        echo "Error deleting record: " . mysqli_error($connect);
        header('Refresh:0; url=index.php');
        echo '<script>';
        echo "window.location='index.php?do=failed';";
        echo '</script>';
	}
	mysqli_close($conn);
?>