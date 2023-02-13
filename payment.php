<?php //error_reporting(~E_ALL);?>

<?php

require_once('php/connect.php');
include('includes/function.php') ?>
<?php

if ($_REQUEST['data'] == 'payment') {
  $payment_price = $_SESSION['totalsum'];
  $file = strrchr($_FILES['file']['name'], "."); //ตัดนามสกุลไฟล์เก็บไว้
  $filename = (Date("dmy_His") . $file); //ตั้งเป็น วันที่_เวลา.นามสกุล
  $folder = "assets/image/payments/"; // path folder
  $width = 0; // ความกว้างของภาพ
  $height = 0; // ความยาวของภาพ
  Upload_File($filename, $folder, $width, $height);
  $sql1 = $conn->query("INSERT INTO `payment` set `payment_id`= '', `order_id`='$_REQUEST[order_id]', `mem_id`= '$_SESSION[mem_id]', `payment_file`='$filename', `payment_price`='$payment_price', `payment_bank`='$_REQUEST[payment_bank]', `payment_Detail`='$_REQUEST[payment_Detail]', `payment_date`='$_REQUEST[payment_date]', `payment_time`='$_REQUEST[payment_time]', `payment_status`='ตรวจสอบ'");
  Chk_Insert($sql1, 'รอตรวจสอบชำระเงิน', 'orderhistory.php');

  $sql = $conn->query("update orders set order_status = '1' where order_id = '$_REQUEST[order_id]'");

  if ($sql) {
    echo '<script>';
    echo "window.location='orderhistory.php?do=success';";
    echo '</script>';
  } else {
    echo '<script>';
    echo "window.location='orderhistory.php?do=failed';";
    echo '</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> <!--เรียกbootstrap -->
  <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css"> <!--เรียกfontawesome -->
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

  if (isset($_SESSION['mem_id']) == "") {
    echo '<script> alert("กรุณาเข้าสู่ระบบก่อน")</script>';
    header('Refresh:0; url=../index.php');
  }

  $sql = $conn->query("SELECT * FROM orders WHERE order_id = '$_REQUEST[order_id]'");
  $show = $sql->fetch_assoc();
  $payment_price = $show['price_total'];
  ?>
  <?php

  require_once 'config.php';
  include('includes/navbar.php');
  ?>
  <!-- The Modal -->
  <br><br><br><br>
  <div class="container" style="background-color:white;">
    <br>
    <h3>
      <center>
        <?php echo "การชำระเงิน" ?>
      </center>
    </h3><br>

    <form name="form1" id="form1" action="?data=payment" method="post" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="order_number">เลขที่คำสั่งซื้อ</label>
          <input type="hidden" class="form-control" id="order_id" name="order_id"
            value="<?php echo $show['order_id'] ?>" readonly>
          <input type="text" class="form-control" id="order_number" value="<?php echo $show['order_number'] ?>"
            readonly>
        </div>
        <div class="form-group col-md-6">
          <label for="fullname">ชื่อ - นามสกุล</label>
          <input type="text" class="form-control" id="fullname"
            value="<?php echo $_SESSION['mem_fname'] . " " . $_SESSION['mem_lname'] ?>" readonly>
        </div>
        <div class="form-group col-md-6">
          <label for="pricetotal">จำนวนเงินที่ต้องชำระ</label>
          <?php
          $totalshipping = $show['order_shipping'];
          $totalsum = $totalshipping + $show['price_total'];
          $_SESSION['totalsum'] = $totalsum;
          ?>
          <input type="text" class="form-control" id="pricetotal" name="pricetotal"
            value="<?php echo number_format($totalsum, 2); ?>" readonly>
        </div>
        <div class="form-group col-md-6">
          <label for="payment_price">จำนวนเงินที่โอน (จำเป็นต้องใส่)</label>
          <input type="text" class="form-control" id="payment_price" name="payment_price" onchange="formatPrice(this)"
            value="0.00" required>
        </div>
        <div class="form-group col-md-6">
          <label for="payment_bank">โอนเข้าธนาคาร</label>
          <select class="form-control" id="payment_bank" name="payment_bank">
            <option value="Thai Bank">ธนาคารไทยพาณิชย์ (xxx)</option>
            <option value="Bangkok Bank">ธนาคารกรุงเทพ (xxx)</option>
            <option value="Krungsri Bank">ธนาคารกสิกร (xxx)</option>
            <option value="Krungthai Bank">ธนาคารกรุงไทย (xxx)</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="file">หลักฐานการโอน (จำเป็นต้องใส่)</label>
          <input type="file" class="form-control" id="file" name="file" required>
        </div>
        <div class="form-group col-md-6">
          <label for="payment_date">วันที่โอน (จำเป็นต้องใส่)</label>
          <input type="date" class="form-control" id="payment_date" name="payment_date" required>
        </div>
        <div class="form-group col-md-6">
          <label for="payment_time">เวลาที่โอน (จำเป็นต้องใส่)</label>
          <input name="payment_time" type="time" class="form-control" required>
        </div>
        <div class="form-group col-md-12">
          <label for="payment_Detail">ข้อมูลเพิ่มเติม (ใส่หรือไม่ใส่ก็ได้)</label>
          <textarea name="payment_Detail" class="form-control" rows="5"></textarea>
        </div>

        <div class="modal-footer">
          <button id="confirm_payment" class="btn btn-primary btn-grad">ยืนยันชำระเงิน</button>
          <a href="orderhistory.php" class="btn btn-danger btn-grad" data-dismiss="modal">ยกเลิก</a>
        </div>
      </div>
    </form>
  </div>

  <?php

  include('includes/footer.php'); ?>
  <script src="node_modules/jquery/dist/jquery.min.js"></script><!--เรียกjquery -->
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script><!--เรียกpopper -->
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script><!--เรียกbootstrap.min.js -->
  <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script><!--เรียกjquery.validate -->
</body>

</html>
<script>
  async function validateForm() {
    const form = document.getElementById("form1");
    const formElements = Array.from(form.elements);

    // Validate the file extension
    const file = form.elements.file.value;
    const fileExtension = /\.(jpg|png)$/i;
    if (!fileExtension.test(file)) {
      await Swal.fire({
        title: "เกิดข้อผิดพลาด !",
        icon: "error",
        text: "กรุณาอัพโหลดไฟล์ .jpg หรือ .png เท่านั้น!",
        type: "error",
        confirmButtonText: "OK"
      });
      return false;
    }
    // Validate the payment price
    const paymentPrice = parseFloat(form.elements.payment_price.value.replace(/,/g, ''));
    const totalPrice = parseFloat(form.elements.pricetotal.value.replace(/,/g, ''));
    if (isNaN(paymentPrice) || paymentPrice <= 0) {
      await Swal.fire({
        title: "เกิดข้อผิดพลาด !",
        icon: "error",
        text: "จำนวนเงินที่โอนไม่ถูกต้อง !",
        type: "error",
        confirmButtonText: "ตกลง"
      });
      return false;
    }
    if (paymentPrice !== totalPrice) {
      await Swal.fire({
        title: "เกิดข้อผิดพลาด !",
        icon: "error",
        text: "จำนวนเงินที่โอนไม่ถูกต้อง !",
        type: "error",
        confirmButtonText: "ตกลง"
      });
      return false;
    }

    // Check for empty fields
    const requiredFields = ['payment_price', 'file', 'payment_date', 'payment_time'];
    const emptyFields = formElements.some(element => {
      if (requiredFields.includes(element.name) && !element.value) {
        return true;
      }
      return false;
    });

    if (emptyFields) {
      await Swal.fire({
        title: "เกิดข้อผิดพลาด !",
        icon: "error",
        text: "กรุณากรอกข้อมูลให้ครบถ้วนก่อนยืนยันการชำระเงิน !",
        type: "error",
        confirmButtonText: "ตกลง"
      });
      return false;
    }

    // Confirm the payment
    const result = await Swal.fire({
      title: "ยืนยันการชำระเงิน?",
      icon: "question",
      text: "คุณแน่ใจหรือไม่ว่าต้องการยืนยันการชำระเงินนี้ ?",
      type: "question",
      showCancelButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก"
    });
    if (result.isConfirmed) {
      form.submit();
    }
  }

  document.getElementById("confirm_payment").addEventListener("click", event => {
    event.preventDefault();
    validateForm();
  });

  function addCommas(nStr) {
    nStr += '';
    const x = nStr.split('.');
    let x1 = x[0];
    const x2 = x.length > 1 ? '.' + x[1] : '';
    const rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
  }

  function formatPrice(element) {
    const num = parseFloat(element.value);
    element.value = addCommas(num.toFixed(2));
  }
</script>