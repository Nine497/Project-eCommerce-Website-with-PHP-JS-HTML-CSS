<?php error_reporting(~E_ALL); ?>

<?php require_once('php/connect.php');
include('includes/function.php');
include('config.php');
?>
<?php

//ยกเลิกรายการ
if ($_REQUEST['data'] == 'delete') {

    $sql = $conn->query("update orders set order_status = 4 where order_id = '$_REQUEST[order_id]'");
    Chk_Update($sql, 'ยกเลิกรายการเรียบร้อย');

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!--เรียกbootstrap -->
    <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css">
    <!--เรียกfontawesome -->
    <link rel="stylesheet" href="node_modules/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <title>WanThetDee Shop</title>
</head>
<style>
    body {
        background-color: #a9a8a863;
        color: black;


    }

    .container {
        background-color: white;
        color: black;
    }
</style>

<body>
    <?php
    if (isset($_GET['do'])) {
        if ($_GET['do'] == 'success') {
            echo '<script type="text/javascript">
            Swal.fire({
                title: "ทำการสั่งซื้อเรียบร้อย",
                icon: "success",
                text: "กรุณารอการตรวจสอบการชำระเงิน",
                type: "success"
            });
            setTimeout(function(){
                window.history.pushState({}, "", window.location.href.split("?")[0]);
              }, 1000);
              </script>';
        } else if ($_GET['do'] == 'cancel_success') {
            echo '<script type="text/javascript">
            Swal.fire({
                title: "ยกเลิกการสั่งซื้อเรียบร้อย",
                icon: "success",
                text: "ระบบได้ยกเลิกการสั่งซื้อของคุณเรียบร้อย",
                type: "success"
            });
            setTimeout(function(){
                window.history.pushState({}, "", window.location.href.split("?")[0]);
              }, 1000);
              </script>';
        } else if ($_GET['do'] == 'cancel_failed') {
            echo '<script type="text/javascript">
            Swal.fire({
                title: "ยกเลิกการสั่งซื้อไม่สำเร็จ",
                icon: "error",
                text: "ระบบไม่สามารถยกเลิกการสั่งซื้อของคุณได้ กรุณาลองใหม่อีกครั่ง",
                type: "error"
            });
            setTimeout(function(){
                window.history.pushState({}, "", window.location.href.split("?")[0]);
              }, 1000);
              </script>';
        }
    }
    ?>
    <br><br><br><br>
    <div class="container">
        <div class="table-responsive">
            <br>
            <h3>
                <center>
                    <?php echo $orderhistory; ?>
            </h3><br>
            <table class="table table-striped table-bordered table-hover" id="table_example">
                <tr>
                    <th>#</th>
                    <th>หมายเลขออเดอร์</th>
                    <th>ชื่อ</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>สถานะ</th>
                    <th>คำสั่งซื้อสินค้า</th>
                    <th>แจ้งชำระเงิน</th>
                    <th>ยกเลิก</th>
                </tr>
                <?php
                $sql = $conn->query("select * from orders where Mem_ID = '$_SESSION[mem_id]'");
                $i = 1;
                while ($show = $sql->fetch_assoc()) {
                    
                    if ($show['order_status'] == 0) {
                        $status = '<span class=text-wrning>รอชำระเงิน</span>';
                    } else if ($show['order_status'] == 1) {
                        $status = '<span class=text-warning>ตรวจสอบชำระเงิน</span>';
                    } else if ($show['order_status'] == 2) {
                        $status = '<span class=text-success>ชำระเงินเรียบร้อย</span>';
                    } else if ($show['order_status'] == 3) {
                        $status = '<span class=text-primary>จัดส่งเรียบร้อย</span>';
                    } else if ($show['order_status'] == 4) {
                        $status = '<span class=text-danger>ยกเลิกรายการ</span>';
                    } else if ($show['order_status'] == 5) {
                        $status = '<span class=text-info>อยู่ระหว่างการส่งสินค้า</span>';
                    } else if ($show['order_status'] == 6) {
                        $status = '<span class=text-danger>หลักฐานการโอนเงินผิด</span>';
                      }
                    ?>
                    <tr>
                        <td style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                            <div align="center">
                                <?php echo $i++; ?>
                            </div>
                        </td>
                        <td style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                            <div align="center">
                                <?php echo $show['order_number']; ?>
                            </div>
                        </td>
                        <td style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                            <div align="center">
                                <?php echo $_SESSION['mem_fname'] . " " . $_SESSION['mem_lname']; ?>
                            </div>
                        </td>
                        <td style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                            <div align="center">
                                <?php echo $show['order_date']; ?>
                            </div>
                        </td>
                        <td style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                            <div align="center">
                                <?php echo $status; ?>
                            </div>
                        </td>
                        <td style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                            <div align="center"><a
                                    href="print_payment.php?order_number=<?php echo $show['order_number']; ?>"
                                    target="_blank" class="btn btn-primary">คำสั่งซื้อสินค้า</a></div>
                        </td>
                        <td style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                            <div align="center">
                                <?php if ($show['order_status'] == 0 or $show['order_status'] == 1) { ?>
                                    <button type="button" <?php if ($show['order_status'] != 0) {
                                        echo 'disabled';
                                    } ?>
                                        onclick="window.location.href = 'payment.php?order_id=<?php echo $show['order_id']; ?>'"
                                        class="btn btn-success">ชำระเงิน</button>
                                <?php } else {
                                    echo '-';
                                } ?>
                            </div>
                        </td>
                        <td style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                            <div align="center">
                                <button type="button" <?php if ($show['order_status'] != 0) {
                                    echo 'disabled';
                                } ?>
                                    onclick="deleteOrder(<?php echo $show['order_id']; ?>)"
                                    class="btn btn-danger">ยกเลิกรายการ</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </table>

        </div>
    </div>


    <?php
    require_once 'config.php';
    include('includes/navbar.php') ?>

    <br><br> <br><br>
    <?php
    include('includes/footer.php');

    ?>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <!--เรียกjquery -->
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <!--เรียกpopper -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--เรียกbootstrap.min.js -->
    <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
    <!--เรียกjquery.validate -->
</body>

</html>

<script>
    function deleteOrder(order_id) {
        Swal.fire({
            title: 'ยกเลิกคำสั่งสั่งซื้อ',
            icon: 'question',
            text: "คุณแน่ใจหรือไม่ว่าต้องการยกเลิกคำสั่งสั่งซื้อนี้ ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่ ฉันแน่ใจ!',
            cancelButtonText: 'ไม่ ฉันไม่แน่ใจ'
        }).then((result) => {
            if (result.value) {
                window.location.href = "includes/cancelOrder.php?order_id=" + order_id;
            }
        })
    }
</script>