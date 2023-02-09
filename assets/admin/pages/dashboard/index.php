<?php include_once('../authen.php');
include_once('../../connect.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
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

</head>

<body class="hold-transition sidebar-mini">
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
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Dashboard</li>
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
                      <p>All Members</p>
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
                      <p>All News</p>
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
                      <p>All Product</p>
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
                      <p>Total income</p>
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
                  <p>All Product sold</p>
                </div>
                <div class="icon">
                  <i class="far fa-credit-card"></i>
                </div>
              </div>
              <div class="small-box bg-info">
                <div class="inner">
                  <form>
                    <div class="form-group" style="width: 200px;">
                      <label for="monthSelect">Select Month:</label>
                      <select class="form-control" id="monthSelect">
                        <option value="1" selected>January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                    </div>
                  </form>
                  <h4 id="totalPrice">Select a month to display the total payment</h4>
                  <p>Payment in month</p>
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
                  <p>All Payment</p>
                </div>
                <div class="icon">
                  <i class="far fa-credit-card"></i></i>
                </div>
              </div>
              <div class="small-box bg-success">
                <div class="inner">
                  <?php
                  $query = "SELECT COUNT(*) as count FROM payment where payment_status = 'ชำระเรียบร้อย'";
                  $result = mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  $count = $row['count'];
                  ?>
                  <h3>
                    <?php echo $count; ?>
                  </h3>
                  <p>Payment cases success</p>
                </div>
                <div class="icon">
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="small-box bg-secondary">
                <div class="inner">
                  <?php
                  $query = "SELECT COUNT(*) as count FROM payment where payment_status = 'ตรวจสอบ'";
                  $result = mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  $count = $row['count'];
                  ?>
                  <h3>
                    <?php echo $count; ?>
                  </h3>
                  <p>Payment cases waiting for confirmation</p>
                </div>
                <div class="icon">
                  <i class="fa fa-hourglass-half"></i>
                </div>
              </div>
              <div class="small-box bg-danger">
                <div class="inner">
                  <?php
                  $query = "SELECT COUNT(*) as count FROM payment where payment_status = 'หลักฐานการโอนเงินผิด'";
                  $result = mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  $count = $row['count'];
                  ?>
                  <h3>
                    <?php echo $count; ?>
                  </h3>
                  <p>Payment cases cancel</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-slash"></i>
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
  <script>
    const monthSelect = document.querySelector("#monthSelect");
    const totalPrice = document.querySelector("#totalPrice");

    monthSelect.addEventListener("change", function () {
      // Replace this with your PHP code that retrieves the total price for the selected month
      const selectedMonth = monthSelect.value;

      // Make an AJAX call to retrieve the total price for the selected month
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "get_month_price.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          totalPrice.innerHTML = this.responseText;
        }
      };
      xhr.send("month=" + selectedMonth);
    });
  </script>


</body>

</html>