<?php error_reporting(~E_NOTICE); ?>
<?php include("php/connect.php"); ?>
<?php
if (!isset($_POST['product_id'])) {
    die("Product id not provided.");
} else {
    $product_id = $_POST['product_id'];
    $sql = "SELECT * FROM product WHERE `product_id` = '$product_id'";
}
$res = mysqli_query($conn, $sql);
if (!$res) {
    die("Query to the database failed." . mysqli_error($conn));
}

if (mysqli_num_rows($res) == 0) {
    die("No data found.");
}

$details = mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!--เรียกbootstrap -->
    <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css">
    <!--เรียกfontawesome -->
    <link rel="stylesheet" href="node_modules/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-B8l+ZLKQFQ2NvS72WGoX8tfN1cVdIj4vMQ/BJx8BzLjN/PQ0m6HWUQ9IOgOhO+U" crossorigin="anonymous">
    <title>Stores</title>
</head>
<style>
    body {
        background-color: white;
    }
</style>

<body>
    <?php
    require_once 'config.php';
    include('includes/navbar.php') ?>
    <!-- The Modal -->
    <br><br><br><br><br>
    <div class="container">
        <h2 class="text-center">Product Details</h2>
        <br><br>
        <div class="row">
            <div class="col-md-5">
                <img src="assets/image/store/<?php echo $details['product_image']; ?>" alt="Product Image"
                    class="img-fluid">
            </div>
            <div class="col-md-7">
                <h3>
                    <?php echo $details['product_name']; ?>
                </h3>
                <p>
                    <?php echo $details['product_detail']; ?>
                </p><br><br>
                <h4>Price: $
                    <?php echo $details['product_price']; ?>
                </h4>
                <p>เหลือจำนวน
                    <?php echo $details['product_count']; ?> ชิ้น
                </p><br><br>
                <form action="includes/addcart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $details['product_id']; ?>">
                    <div class="form-group">
                        <label for="count">จำนวน:</label>
                        <input type="number" name="count" id="count" value="1" class="form-control" style="width:100px"
                            required max="<?php echo $details['product_count']; ?>" min="1">
                    </div>
                    <?php if ($details['product_count'] != 0) {
                        echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-primary" disabled>สินค้าหมด</button>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br>
    <?php include('includes/footer.php'); ?>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <!--เรียกjquery -->
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <!--เรียกpopper -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--เรียกbootstrap.min.js -->
    <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
    <!--เรียกjquery.validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
</body>

</html>