<?php include_once('../authen.php');
include('../../connect.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>การจัดการยี่ห้อสินค้า</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js">
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
  <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Sarabun', sans-serif;
    }
  </style>
</head>
<style>
</style>

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
              <h1>การจัดการยี่ห้อสินค้า</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">แดชบอร์ด</a></li>
                <li class="breadcrumb-item"><a href="index.php">การจัดการยี่ห้อสินค้า</a></li>
                <li class="breadcrumb-item active">เพิ่มยี่ห้อสินค้า</li>
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
            <h3 class="card-title d-inline-block">เพิ่มยี่ห้อสินค้า</h3>
          </div>
          <!-- /.card-header -->
          <form role="form" action="insert.php" method="post" enctype="multipart/form-data" id="formRegister">
            <div class="card-body">
              <div class="form-row">
                <table>

                  <div class="form-group col-md-4">
                    <label for="product_tag_id">รหัสยี่ห้อ</label>
                    <input type="text" class="form-control" id="product_tag_id" name="product_tag_id" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="product_tag_name">ชื่อยี่ห้อ</label>
                    <input type="text" class="form-control" id="product_tag_name" name="product_tag_name" required>
                  </div>
                  <div class="card-footer col-md-12">
                    <a href="index.php" class="btn btn-warning float-left">ย้อนกลับ</a>
                    <input type="submit" name="submit" class="btn btn-primary float-right" value="เพิ่มยี่ห้อสินค้า">
                  </div>
                </table>
              </div>
            </div>
          </form>

          <div class="card-body">
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
  <script src="../../../../node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
  <!--เรียกjquery.validate -->

</body>

</html>
<script>
  //formRegister
  $(document).ready(function () {
    $('#formRegister').validate({
      rules: {
        product_type_name: 'required',
        product_type_id: {
          required: true,
          number: true,
        },
      },
      messages: {
        product_type_name: 'กรุณากรองชื่อประเถทสินค้า',
        product_type_id: {
          number: 'กรอกแต่ตัวเลขเท่านั้น',
          required: 'กรุณากรองรหัสประเภทสินค้า',
        },
      },
      errorElement: 'div',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback')
        error.insertAfter(element)
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid').removeClass('is-valid')
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).addClass('is-valid').removeClass('is-invalid')
      }
    });
  })
</script>