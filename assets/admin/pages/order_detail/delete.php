<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
    $order_detail_id=$_GET['order_detail_id'];
    $sql="DELETE FROM `order_detail` WHERE order_detail_id = $order_detail_id";
   
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