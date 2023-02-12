<style>
  /* Tags sale red*/
  .shopping-mall-tag {
    border-top-right-radius: .1875rem;
    border-bottom-right-radius: .1875rem;
    padding: 2px 6px;
    position: absolute;
    left: -4px;
    top: 6px;
    background-color: rgb(208, 1, 27);
    color: #fff;
  }

  .shopping-mall-tag::before {
    content: '';
    background-color: rgb(208, 1, 27);
    position: absolute;
    left: 0;
    bottom: -.1875rem;
    border-bottom: .1875rem solid currentColor;
    border-right: .1875rem solid transparent;
  }

  /* ----------------------- */
  /* Tags sale greenew*/
  .shopping-mall-tagn {
    border-top-right-radius: .1875rem;
    border-bottom-right-radius: .1875rem;
    padding: 2px 6px;
    position: absolute;
    left: -4px;
    top: 35px;
    background-color: rgb(44, 169, 3);
    color: #fff;
  }

  .shopping-mall-tagn::before {
    content: '';
    background-color: rgb(44, 169, 3);
    position: absolute;
    left: 0;
    bottom: -.1875rem;
    border-bottom: .1875rem solid currentColor;
    border-right: .1875rem solid transparent;
  }

  /* ----------------------- */
  .fonts {
    font-size: 23px;
  }

  .card {
    width: 300px;
    height: 500px;
  }

  .box {
    line-height: 14pt;
    height: 56pt;
    overflow: hidden;
  }

  .modal-xl {
    max-width: 850px !important;
  }

  .imgm {
    max-width: 100%;
    width: 300px;
  }

  .imgd {
    max-width: 100%;
    width: 95px;
  }

  .display-5 {
    font-size: 25px;
  }

  .card-5 {
    box-shadow: 0 19px 38px rgba(0, 0, 0, 0.30), 0 15px 12px rgba(0, 0, 0, 0.22);
  }
</style>

<?php
include_once('./php/connect.php');
$sql = "SELECT * FROM product ORDER BY product_id DESC LIMIT 3";
$res = mysqli_query($conn, $sql);
?>
<!-- Show Shop -->
<div class="container"><br>
  <h3>
    <center>สินค้าเข้าใหม่</center>
  </h3><br>
  <div id="result">
    <div class="row">
      <?php while ($row = mysqli_fetch_array($res)) { ?>
        <div class="col-sm-4 mt-3">
          <div class="card shadow-sm" style="width: 330px; height:480px;">
            <img src="assets/image/store/<?php echo $row["product_image"] ?>" class="card-img-top" alt="Product image"
              style="height:280px; width:330px">
            <div class="card-body" style="  position: relative;">
              <h5 class="card-title text-primary">
                <?php echo $row["product_name"]; ?>
              </h5>
              <p class="card-text text-secondary">
                <?php echo (strlen($row["product_detail"]) > 40) ? substr($row["product_detail"], 0, 37) . '...' : $row["product_detail"]; ?>
              </p>

              <p class="card-text text-success">
                <?php echo number_format($row['product_price'], 2) ?>บาท
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <form action="details_product.php" method="post" style="  position: absolute;bottom: 10px;right: 10px;">
                  <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
                  <button type="submit" value="Show Details" class="btn btn-danger btn-sm" style="font-size: 0.8em;">
                    เพิ่มไปยังรถเข็น <i class="fas fa-shopping-cart fa-1x"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
          <br><br><br>
        </div>
      <?php } ?>
      <!--- /col-md4 --->
    </div>
    <!-- /model -->
  </div>
  <!--- /card-deck--->
</div>
<!--- /row--->
</div>
<!--- /result--->
</div>