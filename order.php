<?php error_reporting(~E_ALL); ?>

<?php require_once('php/connect.php');
include('includes/function.php') ?>
<?php

$mem_id = $_SESSION['mem_id'];
$datetime = date("Y-m-d H:i:s");
if ($_REQUEST['data'] == 'confirm') {
    $order = date('dmyHis');
    $mem_address = $_REQUEST['mem_address'];
    $shipping = $_REQUEST['shipping'];
    $summy = $_SESSION['summy'];
    $sql = "SELECT SUM(cart.order_count) AS order_count FROM `cart` WHERE cart.mem_id = $mem_id;";
    $count = mysqli_query($conn, $sql);
    $order_count1 = mysqli_fetch_array($count);
    $order_count = $order_count1['order_count'];

    if (!isset($shipping) || $shipping == "") {
        echo '<script>';
        echo "window.location='order.php?do=emptyshipping';";
        echo '</script>';
    } else {
        // Start a transaction
        mysqli_begin_transaction($conn);

        // Delete from cart
        $conn->query("DELETE FROM cart WHERE mem_id = '$mem_id'");

        // Insert into orders
        $sql = "INSERT INTO `orders`(`order_id`, `order_number`, `mem_id`, `address`, `order_shipping`, `price_total`, `order_status`, `order_date`, `order_count`) VALUES ('', '$order', '$mem_id', '$mem_address', '$shipping', '$summy', '0', '$datetime', '$order_count')";
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            mysqli_rollback($conn);
            echo "Error: " . mysqli_error($conn);
            echo "<br>";
            echo "SQL: " . $sql;
        } else {
            // Insert into order_detail
            $sql2 = "INSERT INTO `order_detail`(`order_detail_id`, `order_number`, `product_id`, `product_price`, `order_count`) VALUES ('','$order','$_SESSION[product_id]','$_SESSION[product_price]', '$order_count')";
            $resins = mysqli_query($conn, $sql2);
            if (!$resins) {
                mysqli_rollback($conn);
                mysqli_commit($conn);
                echo '<script>';
                echo "window.location='order.php?do=failed';";
                echo '</script>';
            } else {
                mysqli_commit($conn);
                echo '<script>';
                echo "window.location='orderhistory.php?do=success';";
                echo '</script>';
            }
        }
    }
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
        margin-top: 11px;
    }

    .table-responsive {
        display: table;
    }
</style>

<body>
    <?php
    if ($_REQUEST['data'] == 'cancel') {
        $conn->query("DELETE FROM cart WHERE mem_id = '$mem_id'");
        echo '<script>';
        echo 'Swal.fire({';
        echo 'title: "ยกเลิกรายการทั้งหมดสำเร็จ",';
        echo 'icon: "success",';
        echo '});';
        echo 'setTimeout(function(){ window.location.href="index.php"; }, 2000);';
        echo '</script>';
    }
    ?>
    <?php
    if (isset($_SESSION['mem_id']) == "") {
        echo '<script type="text/javascript">
        Swal.fire({
            title: "กรุณาเข้าสู่ระบบก่อน",
            text: "คุณต้องเข้าสู่ระบบก่อน",
            type: "error"
        })        
        </script>';
    }
    ?>
    <?php

    $sql1 = "SELECT * FROM `cart`,`product`,`members`  WHERE cart.product_id=product.product_id AND cart.mem_id=$mem_id AND members.mem_id =$mem_id";
    $result1 = mysqli_query($conn, $sql1);
    $sqlsum = "SELECT *, SUM(cart.product_price * cart.order_count) AS summy FROM `cart`,`product` WHERE cart.product_id=product.product_id AND cart.mem_id=$mem_id";


    $resultsum = mysqli_query($conn, $sqlsum);
    $rowsum = mysqli_fetch_array($resultsum);

    $_SESSION['summy'] = $rowsum['summy'];
    require_once 'config.php';
    include('includes/navbar.php');
    ?>
    <!-- The Modal -->
    <br><br><br><br>
    <div class="container" style="background-color:white;">
        <br>
        <h3>
            <center>
                <?php echo $confirm ?>
        </h3><br>
        <form class="form-horizontal" id="myform1" onsubmit="return orderConfirmed" name="form" action="?data=confirm"
            method="post" enctype="multipart/form-data">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>
                            <?php echo $image; ?>
                        </th>
                        <th>
                            <?php echo $nameproduct; ?>
                        </th>
                        <th>
                            <?php echo $price; ?>
                        </th>
                        <th>
                            <?php echo $date; ?>
                        </th>

                    </tr>
                    <?php $i = 1;
                    while ($rows = mysqli_fetch_array($result1)) { ?>
                        <tr>
                            <?php
                            //$products_prices=$_SESSION['product_price'];
                            // $productsx_prices = array($_SESSION['product_price']);?>
                            <td>
                                <?php echo $i; ?>
                            </td>
                            <td style="width:100px"><img src="assets/image/store/<?php echo $rows['product_image'] ?>"
                                    style="width:100px"></td>
                            <td>
                                <?php echo $rows['product_name'];
                                $mem_address = $rows['mem_address']; ?>
                            </td>
                            <td>
                                <?php echo number_format($rowsum['summy'], 2) ?>
                            </td>
                            <td>
                                <?php echo $rows['cart_date'] ?>
                            </td>
                            <?php
                            $_SESSION['product_id'] = $rows['product_id'];
                            $_SESSION['product_price'] = $rows['product_price']; ?>
                        </tr>

                        <?php $i++;
                    } ?>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <td colspan="5" style="padding-bottom: 4px;padding-top: 4px;">
                            <div style="font-size:18px; margin-left:610px">
                                <?php echo $totalprice ?>：
                                <?php echo number_format($rowsum['summy'], 2);
                                echo " " . $baht ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="padding-bottom: 4px;padding-top: 4px;">
                            <div style="font-size:18px;margin-left:590px">
                                <?php echo $discountall ?> ：0.00
                                <?php echo $baht ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="padding-bottom: 4px;padding-top: 4px;">
                            <div style="font-size:18px;margin-left:330px;color:green">
                                <?php echo $allprice ?>: <a style="color:red">
                                    <?php echo $notshipping ?>
                                </a>
                                <?php echo number_format($rowsum['summy'], 2);
                                echo " " . $baht ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>

                <label class="mem_address">
                    <h5>
                        <?php echo $address ?>
                    </h5>
                </label>
                <div class="input-group-text"></div>
                <textarea name="mem_address" rows="3" class="form-control"><?php echo $mem_address ?></textarea>
            </div>
            <br>
            <h5>
                <?php echo $deliverytype ?>
            </h5>
            <br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="shipping" id="shipping" value="50" required>
                <label class="form-check-label" for="shipping">
                    <?php echo $r50; ?>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                <input class="form-check-input" type="radio" name="shipping" id="shipping" value="80" required>
                <label class="form-check-label" for="shipping">
                    <?php echo $e80; ?>
                </label>
            </div>


            <div class="text-right">
                <button class="btn btn-info btn-grad btn-xl" id="confirm-order-button">ยืนยันการสั่งซื้อ</button>&nbsp;
                <button type="button" class="btn btn-danger btn-grad" id="cancel-order">ยกเลิกรายการทั้งหมด</button>
            </div>

            <br>
        </form>
    </div>

    <?php

    include('includes/footer.php'); ?>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <!--เรียกjquery -->
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <!--เรียกpopper -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--เรียกbootstrap.min.js -->
    <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
    <!--เรียกjquery.validate -->
    <script>
        document.getElementById("confirm-order-button").addEventListener("click", async function (event) {
            event.preventDefault();
            // Open the Sweet Alert
            const result = await Swal.fire({
                title: "ยืนยันการสั่งซื้อนี้?",
                text: "คุณแน่ใจหรือไม่ว่าต้องการยืนยันคำสั่งซื้อนี้",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ใช่, ฉันแน่ใจ!",
                cancelButtonText: "ไม่, ยกเลิก!"
            });
            if (result.isConfirmed) {
                // The user clicked the "Confirm" button
                orderConfirmed = true;
                document.getElementById("myform1").submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // The user clicked the "Cancel" button
                // Do nothing
            }
        });

    </script>



    <script>
        document.getElementById("cancel-order").addEventListener("click", function () {
            Swal.fire({
                title: 'ยกเลิกรายการทั้งหมด',
                text: "คุณแน่ใจหรือไม่ว่าต้องการยกเลิกรายการ?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ฉันแน่ใจ!',
                cancelButtonText: 'ไม่, ฉันไม่แน่ใจ'
            }).then((result) => {
                if (result.value) {
                    window.location = '?data=cancel';
                }
            })
        });
    </script>

    <script>
        document.getElementById("myform1").onsubmit = function () {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            this.classList.add("was-validated");
        };
    </script>
</body>

</html>