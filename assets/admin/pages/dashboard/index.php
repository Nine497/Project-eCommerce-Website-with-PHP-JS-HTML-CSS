<?php include_once('../authen.php');
include_once('../../connect.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>แดชบอร์ด</title>
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="../../dist/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="../../dist/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="../../dist/img/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="../../dist/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

  <script src="../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="../../../../node_modules/sweetalert2/dist/sweetalert2.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Sarabun', sans-serif;
    }

    #printBtn:hover {
      box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.75);
      transform: translateY(5px);
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <?php
  if (isset($_GET['do'])) {
    if ($_GET['do'] == 'startdate_failed') {
      echo '<script type="text/javascript">
        Swal.fire({
          title: "เกิดข้อผิดพลาด ",
          icon: "error",
          text: "กรุณาเลือก วัน/เดือน/ปี เริ่มต้น !",
          type: "error"
        });
        setTimeout(function () {
          window.history.pushState({}, "", window.location.href.split("?")[0]);
        }, 1000);
  </script>';
    } else if ($_GET['do'] == 'startdate-end-date_failed') {
      echo '
  <script type="text/javascript">
        Swal.fire({
          title: "เกิดข้อผิดพลาด!",
          icon: "error",
          text: "กรุณาเลือก วัน/เดือน/ปี ให้ถูกต้อง !",
          type: "error"
        });
        setTimeout(function () {
          window.history.pushState({}, "", window.location.href.split("?")[0]);
        }, 1000);
  </script>';
    }
  }
  ?>
  <div class="wrapper">

    <!-- Navbar -->
    <?php include_once('../includes/sidebar.php') ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">แดชบอร์ด</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">แดชบอร์ด</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">


              <div class="row">
                <div class="col-lg-6 col-6">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>
                        <?php $sql = "SELECT COUNT(*) as summember FROM `members`";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);
                        ?>
                        <?php echo $row['summember'] ?>
                      </h3>
                      <p>สมาชิกทั้งหมด</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-6">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <?php $sql1 = "SELECT COUNT(*) as sumnews FROM news";
                      $res1 = mysqli_query($conn, $sql1);
                      $row1 = mysqli_fetch_array($res1);
                      ?>
                      <h3>
                        <?php echo $row1['sumnews'] ?>
                      </h3>
                      <p>ข่าวสารทั้งหมด</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-newspaper"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-6">
                  <div class="small-box bg-primary">
                    <div class="inner">
                      <?php $sql2 = "SELECT COUNT(*) as sumstore FROM product";
                      $res2 = mysqli_query($conn, $sql2);
                      $row2 = mysqli_fetch_array($res2);
                      ?>
                      <h3>
                        <?php echo $row2['sumstore'] ?>
                      </h3>
                      <p>สินค้าทั้งหมด</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-shopping-cart"></i>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 col-6">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <?php
                      $total_payment = 0;
                      $query = "SELECT payment_price FROM payment";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_array($result)) {
                        $payment_price = str_replace(",", "", $row['payment_price']);
                        $total_payment += floatval($payment_price);
                      }
                      ?>
                      <h3>
                        <?php echo number_format($total_payment, 0, '', ','); ?> ฿
                      </h3>
                      <p>รายได้ทั้งหมด</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-cash"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>
                    <?php
                    $result_Product_sold = 0;
                    $query = "SELECT order_count FROM orders where order_status NOT IN (0, 1)";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                      $result_Product_sold += $row['order_count'];
                    }
                    echo $result_Product_sold;
                    ?>
                  </h3>
                  <p>สินค้าที่ขายไปแล้วทั้งหมด</p>
                </div>
                <div class="icon">
                  <i class="far fa-credit-card"></i>
                </div>
              </div>
              <div class="small-box bg-info">
                <div class="inner">
                  <form action="print_report.php" method="post">
                    <div class="form-group d-flex" style="width: 400px;">
                      <div style="margin-right: 20px;">
                        <label for="startDate">เริ่มวันที่ :</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                      </div>
                      <div>
                        <label for="endDate">สิ้นสุดวันที่ :</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                      </div>
                    </div>
                    <button id="printBtn" class="btn btn-warning"
                      style="box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75); width: 150px; transition: all 0.3s;">
                      พิมพ์รายงาน <i class="fas fa-print"></i>
                    </button>
                  </form>
                  <br>
                  <h4 id="totalPrice">เลือกช่วงวันที่เพื่อแสดงรายงาน</h4>
                </div>
                <div class="icon">
                  <i class="fa fa-calendar-check"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-5">
              <div class="small-box bg-warning">
                <div class="inner">
                  <?php $sql3 = "SELECT COUNT(*) as sumpayment FROM payment";
                  $res3 = mysqli_query($conn, $sql3);
                  $row3 = mysqli_fetch_array($res3);
                  ?>
                  <h3>
                    <?php echo $row3['sumpayment'] ?>
                  </h3>
                  <p>รายการชำระเงินทั้งหมด</p>
                </div>
                <div class="icon">
                  <i class="far fa-credit-card"></i></i>
                </div>
              </div>
            </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- footer -->
    <?php include_once('../includes/footer.php') ?>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SlimScroll -->
  <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>


</body>

</html>