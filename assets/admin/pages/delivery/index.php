<?php include_once('../authen.php') ?>
<?php
include_once('../../../../includes/function.php');
include_once('../../connect.php');
$sql = "SELECT orders.order_id, members.mem_id, CONCAT(members.mem_fname, ' ', members.mem_lname) AS mem_name, 
        orders.order_number, orders.address, orders.order_count, orders.price_total, orders.order_date, orders.order_status, 
        order_detail.product_id, order_detail.product_price, order_detail.order_count_detail
        FROM orders
        INNER JOIN members ON orders.mem_id = members.mem_id
        INNER JOIN order_detail ON orders.order_number = order_detail.order_number
        WHERE orders.order_status NOT IN (1, 4, 6)";

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
  <title>Payment Management</title>
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
</head>

<body class="hold-transition sidebar-mini">
  <?php
  if (isset($_GET['do'])) {
    if ($_GET['do'] == 'updated_success') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "อัพเดทสำเร็จ",
            icon: "success",
            text: "การอัพเดทข้อมูลสถานะคำสั่งซื้อสำเร็จ",
            type: "success"
        })        
        setTimeout(function(){
          window.history.pushState({}, "", window.location.href.split("?")[0]);
      }, 1000);
        </script>';
    } else if ($_GET['do'] == 'updated_failed') {
      echo '<script type="text/javascript">
        Swal.fire({
            title: "อัพเดทwไม่สำเร็จ",
            icon: "error",
            text: "การอัพเดทข้อมูลสถานะคำสั่งซื้อไม่สำเร็จ โปรดลองใหม่อีกครั้ง",
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
              <h1>Delivery Management</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Delivery Management</li>
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
            <h3 class="card-title d-inline-block">Delivery List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped w-100 ">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>order_id</th>
                  <th>mem_id</th>
                  <th>mem_name</th>
                  <th>order_number</th>
                  <th>Address</th>
                  <th>order_count</th>
                  <th>order_status</th>
                  <th>order_date</th>
                  <th>MORE</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                $displayedOrderNumbers = array();
                while ($row = mysqli_fetch_array($res)) {
                  if (in_array($row['order_number'], $displayedOrderNumbers)) {
                    continue;
                  }
                  $displayedOrderNumbers[] = $row['order_number'];
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
                  <tr>
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php echo $row['order_id']; ?>
                    </td>
                    <td>
                      <?php echo $row['mem_id']; ?>
                    </td>
                    <td>
                      <?php echo $row['mem_name']; ?>
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
                      <?php echo $status; ?>
                    </td>
                    <td>
                      <?php echo $row['order_date']; ?>
                    </td>
                    <td>
                      <a data-toggle="modal" data-target="#status<?php echo $row['order_id']; ?>">
                        <button name="" type="button" class="btn btn-sm btn-warning text-white"><i class='fas fa-edit'>
                          </i>Update</button>
                      </a>
                      <a class="btn btn-sm btn-danger text-white" onclick="deletePayment(<?php echo $row['order_id'] ?>)">
                        <i class="fas fa-trash-alt"></i> Delete</a>
                    </td>
                  </tr>

                  <div class="modal fade" id="status<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Delivery Status</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="status-form" method="post" action="update.php">
                            <div class="form-group">
                              <?php
                              $sql3 = $conn->query("select * from orders where order_id = '$row[order_id]'");
                              $show3 = $sql3->fetch_assoc();
                              $sql4 = $conn->query("select * from members where mem_id = '$show3[mem_id]'");
                              $show4 = $sql4->fetch_assoc();
                              ?>
                              <div class="row">
                                <div class="col-4">
                                  <label class="form-label text-muted font-weight-bold">Order ID:</label>
                                </div>
                                <div class="col-7">
                                  <p class="bg-secondary p-2">
                                    <?php echo $show3['order_id']; ?>
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4">
                                  <label class="form-label text-muted font-weight-bold">Member ID:</label>
                                </div>
                                <div class="col-7">
                                  <p class="bg-secondary p-2">
                                    <?php echo $show4['mem_id']; ?>
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4">
                                  <label class="form-label text-muted font-weight-bold"> Mem Full Name:</label>
                                </div>
                                <div class="col-7">
                                  <p class="bg-secondary p-2">
                                    <?php echo $show4['mem_fname'] . " " . $show4['mem_lname']; ?>
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4">
                                  <label class="form-label text-muted font-weight-bold">Order Number:</label>
                                </div>
                                <div class="col-7">
                                  <p class="bg-secondary p-2">
                                    <?php echo $show3['order_number']; ?>
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4">
                                  <label class="form-label text-muted font-weight-bold">Address:</label>
                                </div>
                                <div class="col-7">
                                  <p class="bg-secondary p-2">
                                    <?php echo $show3['address']; ?>
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4">
                                  <label class="form-label text-muted font-weight-bold">Order Count:</label>
                                </div>
                                <div class="col-7">
                                  <p class="bg-secondary p-2">
                                    <?php echo $show3['order_count']; ?>
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4">
                                  <label class="form-label text-muted font-weight-bold">Order Status:</label>
                                </div>
                                <div class="col-7">
                                  <p class="bg-secondary p-2">
                                    <?php echo $status; ?>
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4">
                                  <label class="form-label text-muted font-weight-bold">Order Date:</label>
                                </div>
                                <div class="col-7">
                                  <p class="bg-secondary p-2">
                                    <?php echo $show3['order_date']; ?>
                                  </p>
                                </div>
                              </div>
                              <input type="hidden" name="order_number" value="<?php echo $show3['order_number']; ?>">
                              <input type="hidden" name="order_id" value="<?php echo $show3['order_id']; ?>">
                            </div>
                            <div class="form-group">
                              <label>อัพเดทสถานะ :</label>
                              <select name="status" class="form-control">
                                <option value="2" <?php if ($show3['order_status'] == "2") {
                                  echo 'selected';
                                } ?>>
                                  ชำระเงินเรียบร้อย</option>
                                <option value="5" <?php if ($show3['order_status'] == "5") {
                                  echo 'selected';
                                } ?>>
                                  อยู่ระหว่างการส่งสินค้า</option>
                                <option value="3" <?php if ($show3['order_status'] == "3") {
                                  echo 'selected';
                                } ?>>
                                  จัดส่งเรียบร้อย</option>
                              </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button id="confirm-status" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php $i++;
                } ?>
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
    document.getElementById("confirm-status").addEventListener("click", async function (event) {
      event.preventDefault();
      // Open the Sweet Alert
      const result = await Swal.fire({
        title: "ยืนยันการอัพเดทนี้?",
        text: "คุณแน่ใจหรือไม่ว่าต้องอัพเดทสถานะ ของคำสั่งซื้อนี้",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "ใช่, ฉันแน่ใจ!",
        cancelButtonText: "ไม่, ยกเลิก!"
      });
      if (result.isConfirmed) {
        // The user clicked the "Confirm" button
        document.getElementById("status-form").submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // The user clicked the "Cancel" button
        // Do nothing
      }
    });
  </script>

</body>

</html>