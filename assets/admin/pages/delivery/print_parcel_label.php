<?php include '../../connect.php' ?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }

        .container {
            width: 500px;
            height: 230px;
            border: solid black 1px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $sql3 = $conn->query("select * from orders where order_id = '$order_id'");
        $show3 = $sql3->fetch_assoc();
        $sql4 = $conn->query("select * from members where mem_id = '$show3[mem_id]'");
        $show4 = $sql4->fetch_assoc();
    }
    if ($show3['order_shipping'] == '80') {
        $order_shipping = "EMS";
    } else {
        $order_shipping = "ลงทะเบียน";
    }
    ?>
    <div class="container" style="margin-top:100px;">
        <div style="float: left;margin-left:-12px; width: 135px;
            height: 35px;">
            <p style="margin-left:10px;margin-top:5px;">เลขคำสั่งซื้อ :
                <?php echo $order_id; ?>
            </p>
        </div>
        <div style="float: right;margin-right:5px;margin-top:5px;">
            <p>ติดต่อ
                <?php echo $show4['mem_tel']; ?>
            </p>
        </div>
        <div style="clear: both;margin-left:10px;">
            <p>ผู้รับ</p>
        </div>
        <div style="margin-left:50px;">
            <h4>
                <?php echo $show4['mem_fname'] . '   ' . $show4['mem_lname']; ?>
            </h4>
        </div>
        <div style="margin-left:50px;width: 400px;">
            <p>
                <?php echo $show4['mem_address']; ?>
            </p>
        </div>
        <div style="margin-left:370px;">
            <p>(
                <?php echo $order_shipping; ?>)
            </p>
        </div>
    </div>
    <br> <br> <br>
    <div class="container" style="margin-top:100px;">
        <div style="float: left;margin-left:-12px; width: 135px;
            height: 35px;">
            <p style="margin-left:10px;margin-top:5px;">เลขคำสั่งซื้อ :
                <?php echo $order_id; ?>
            </p>
        </div>
        <div style="float: right;margin-right:5px;margin-top:5px;">
            <p>ติดต่อ 0936132613</p>
        </div>
        <div style="clear: both;margin-left:10px;">
            <p>ผู้ส่ง</p>
        </div>
        <div style="margin-left:50px;">
            <h4>WANTHETDEE SHOP</h4>
        </div>
        <div style="margin-left:50px;">
            <p>124 ถนนพลพิชัย อำเภอหาดใหญ่ สงขลา 90110
            </p>
        </div>
        <div>
            <p style="font-size: 12px;margin-top:50px;">*กรณีจัดส่งสินค้าไม่สำเร็จกรุณา ส่งคืนตามที่อยู่ผู้ส่ง</p>
        </div>
        <div style="margin-left:370px;margin-top:-35px;">
            (
            <?php echo $order_shipping; ?>)
        </div>
    </div>
    <br><br><br>
    <div class="d-flex justify-content-center">
        <input type="button" name="Button" value="Print" class="btn btn-primary"
            onclick="javascript:this.style.display='none';window.print();">
    </div>
</body>

</html>