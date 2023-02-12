<?php include_once('../authen.php') ?>
<?php
include_once('../../connect.php');
$sql = "select * from orders";
$res = mysqli_query($conn, $sql);
?>
<style>
  .successa {

    color: #fff;

    background-color: #28a745;
    border-radius: 35px;

    padding: 5px;
  }

  .infos {

    color: #fff;
    background-color: #17a2b8;
    border-radius: 35px;
    border: 1px solid rgba(23, 162, 184, 0.75);
    padding: 5px;

  }
</style>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>การจัดการคำสั่งซื้อ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link rel="stylesheet" href="../../../../node_modules/responsive/responsive.bootstrap4.min.js">
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="../../dist/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="../../dist/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="../../dist/img/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="../../dist/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
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
  <link rel="stylesheet" href="../../plugins/responsive/responsive.bootstrap4.min.css"><!-- responsive-->
  <script src="../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="../../../../node_modules/sweetalert2/dist/sweetalert2.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Sarabun', sans-serif;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar & Main Sidebar Container -->
    <?php include_once('../includes/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>การจัดการคำสั่งซื้อ</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">แดชบอร์ด</a></li>
                <li class="breadcrumb-item active">การจัดการคำสั่งซื้อ</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title d-inline-block">รายการคำสั่งซื้อ</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped w-100 ">
              <thead>
                <tr>
                  <th>รหัสคำสั่งซื้อ</th>
                  <th>รหัสสมาชิก</th>
                  <th>หมายเลขคำสั่งซื้อ</th>
                  <th>ที่อยู่</th>
                  <th>จำนวนสินค้าที่สั่งซื้อ</th>
                  <th>ค่าจัดส่ง</th>
                  <th>รวมราคาสินค้า</th>
                  <th>สถานะคำสั่งซื้อ</th>
                  <th>วันที่</th>
                  <th>ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($res)) { ?>
                  <tr>
                    <td>
                      <?php echo $row['order_id']; ?>
                    </td>
                    <td>
                      <?php echo $row['mem_id']; ?>
                    </td>
                    <td>
                      <?php echo $row['order_number']; ?>
                    </td>
                    <td>
                      <?php echo $row['address']; ?>
                    </td>
                    <td>
                      <?php echo $row['order_count']; ?>
                    </td>
                    <td>
                      <?php echo $row['order_shipping']; ?>
                    </td>
                    <td>
                      <?php echo $row['price_total']; ?>
                    </td>
                    <?php
                    if ($row['order_status'] == 0) {
                      $status = 'รอชำระเงิน';
                    } else if ($row['order_status'] == 1) {
                      $status = 'ตรวจสอบชำระเงิน';
                    } else if ($row['order_status'] == 2) {
                      $status = 'ชำระเงินเรียบร้อย';
                    } else if ($row['order_status'] == 3) {
                      $status = 'จัดส่งเรียบร้อย';
                    } else if ($row['order_status'] == 4) {
                      $status = 'ยกเลิกรายการ';
                    } else if ($row['order_status'] == 5) {
                      $status = 'อยู่ระหว่างการส่งสินค้า';
                    } else if ($row['order_status'] == 6) {
                      $status = 'หลักฐานการโอนเงินผิด';
                    }
                    ?>
                    <td>
                      <?php echo $status ?>
                    </td>
                    <td>
                      <?php echo $row['order_date']; ?>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-danger" onclick="DeleteOrder(<?php echo $row['order_id'] ?>)">
                        <i class="fas fa-trash-alt"></i> ลบ</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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
  <!-- DataTables -->
  <script src="../../../../node_modules/jquery-datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/responsive/dataTables.responsive.min.js"></script> <!-- responsive-->


  <script>
    $(function () {
      $('#dataTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true
      });
    });
  </script>
  <script>
    function DeleteOrder(order_id) {
      Swal.fire({
        title: 'ลบคำสั่งซื้อ !',
        text: "คุณแน่ใจหรือไม่ว่าต้องการลบคำสั่งซื้อนี้ ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่ ฉันแน่ใจ!',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.value) {
          window.location.href = "delete.php?order_id=" + order_id;
        }
      })
    }
  </script>
</body>

</html>