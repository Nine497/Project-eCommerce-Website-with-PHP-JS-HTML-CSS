<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./node_modules/css/style.css">
<script src="../node_modules/sweetalert2/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
<!-- Footer -->
<footer class="page-footer font-small teal pt-4 bg-light text-black">

  <!-- Footer Text -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3 center">

        <!-- Content -->
        <h5 class="text-uppercase text-black font-weight-bold ">
          <?php echo $Service ?>
        </h5>
        <ul class="text-dark">
          <li>
            <?php echo $Freeshipping ?>
          </li>
          <li>
            <?php echo $Support24hr ?>
          </li>
          <li>
            <?php echo $CashonDelivery ?>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-6 mb-md-0 mb-3">

        <!-- Content -->
        <h5 class="text-uppercase font-weight-bold text-black">
          <?php echo $Contact ?>
        </h5>
        <ul class="text-dark">
          <li>
            <?php echo $faddress ?>
          </li>
          <li>
            <?php echo $femail ?>
          </li>
          <li>
            <?php echo $ftel ?>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Text -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 bg-light text-dark font-weight-bold">© 2023 Copyright:
    <a class="text-dark"> Sumat & Ratapumin</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->