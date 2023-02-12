<?php include_once('../authen.php') ?>
<?php
include_once('../../connect.php');
$sql = "select * from product_tag";
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
  <title>การจัดการยี่ห้อสินค้า</title>
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
  <?php
  if (isset($_GET['do'])) {
    if ($_GET['do'] == 'add_success') {
      echo '<script type="text/javascript">
        Swal.fire({
          title: "สำเร็จ !",
          icon: "success",
          text: "เพิ่มยี่ห้อสินค้าสำเร็จ !",
          type: "success"
        });
        setTimeout(function () {
          window.history.pushState({}, "", window.location.href.split("?")[0]);
        }, 1000);
  </script>';
    } else if ($_GET['do'] == 'add_failed') {
      echo '
  <script type="text/javascript">
        Swal.fire({
          title: "เกิดข้อผิดพลาด!",
          icon: "error",
          text: "เกิดข้อผิดพลาดในการเพิ่มยี่ห้อ โปรดลองใหม่อีกครั้ง",
          type: "error"
        });
        setTimeout(function () {
          window.history.pushState({}, "", window.location.href.split("?")[0]);
        }, 1000);
  </script>';
    } else if ($_GET['do'] == 'delete_success') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "ลบสำเร็จ",
            icon: "success",
            text: "การลบข้อมูลยี่ห้อสินค้าสำเร็จ",
            type: "success"
        })        
        setTimeout(function(){
          window.history.pushState({}, "", window.location.href.split("?")[0]);
      }, 1000);
        </script>';
    } else if ($_GET['do'] == 'delete_failed') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "ลบข้อมูลไม่สำเร็จ",
            icon: "error",
            text: "การลบข้อมูลยี่ห้อสินค้าไม่สำเร็จ โปรดลองใหม่อีกครั้ง",
            type: "error"
        })        
        setTimeout(function(){
          window.history.pushState({}, "", window.location.href.split("?")[0]);
      }, 1000);
        </script>';
    } else if ($_GET['do'] == 'update_success') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "แก้ไขสำเร็จ",
            icon: "success",
            text: "การแก้ไขข้อมูลยี่ห้อสินค้าสำเร็จ",
            type: "success"
        })        
        setTimeout(function(){
          window.history.pushState({}, "", window.location.href.split("?")[0]);
      }, 1000);
        </script>';
    } else if ($_GET['do'] == 'update_failed') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "แก้ไขข้อมูลไม่สำเร็จ",
            icon: "error",
            text: "การแก้ไขข้อมูลยี่ห้อสินค้าไม่สำเร็จ โปรดลองใหม่อีกครั้ง",
            type: "error"
        })        
        setTimeout(function(){
          window.history.pushState({}, "", window.location.href.split("?")[0]);
      }, 1000);
        </script>';
    }
  }
  ?>
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
                <li class="breadcrumb-item active">การจัดการยี่ห้อสินค้า</li>
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
            <h3 class="card-title d-inline-block">รายการยี่ห้อสินค้า</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped w-100 ">
              <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>รหัสยี่ห้อ</th>
                  <th>ชื่อยี่ห้อ</th>
                  <th>วันที่</th>
                  <th><a href="form_insert.php" class="btn btn-info"><i class="fas fa-plus-square"></i> เพิ่มยี่ห้อ</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                while ($row = mysqli_fetch_array($res)) { ?>
                  <tr>
                    <td>
                      <?php echo $i;
                      $i++ ?>
                    </td>
                    <td>
                      <?php echo $row['product_tag_id']; ?>
                    </td>
                    <td>
                      <?php echo $row['product_tag_name']; ?>
                    </td>
                    <td>
                      <?php echo $row['product_tag_date']; ?>
                    </td>
                    <td>
                      <a href="form-edit.php?product_tag_id=<?php echo $row['product_tag_id']; ?>"
                        class="btn btn-sm btn-warning text-white">
                        <i class="fas fa-edit"></i> แก้ไข
                      </a>
                      <a class="btn btn-sm btn-danger" onclick="Droptag(<?php echo $row['product_tag_id'] ?>)">
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
    function Droptag(product_tag_id) {
      Swal.fire({
        title: 'คุณแน่ใจไหม?',
        text: "คุณต้องการลบยี่ห้อสินค้านี้ !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่ ลบมัน!',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.value) {
          window.location = "delete.php?product_tag_id=" + product_tag_id;
        }
      })
    };
  </script>
</body>

</html>