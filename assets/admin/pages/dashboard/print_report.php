<?php include_once('../../connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <title>Print Report</title>
</head>

<body>
    <?php
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    if (!$startDate) {
        echo '<script>';
        echo "window.location='index.php?do=startdate_failed';";
        echo '</script>';
    }
    if (!$endDate) {
        $endDate = new DateTime();
        $endDate = $endDate->format('Y-m-d H:i:s');
    }
    if ($startDate >= $endDate) {
        echo '<script>';
        echo "window.location='index.php?do=startdate-end-date_failed';";
        echo '</script>';
    } else {
        $query = "SELECT p.payment_price, p.payment_bank, p.mem_id, p.order_id, p.payment_date ,o.order_count
FROM payment p
JOIN orders o ON p.order_id = o.order_id
WHERE p.payment_status = 'ชำระเรียบร้อย' AND p.payment_date BETWEEN '$startDate' AND '$endDate'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $totalPaymentPrice = 0;
        $totalOrderCount = 0;

        foreach ($data as $row) {
            $totalPaymentPrice += $row['payment_price'];
            $totalOrderCount += $row['order_count'];
        }
        mysqli_close($conn);
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Report</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            body {
                font-family: 'Sarabun', sans-serif;
            }

            th,
            td {
                border: 1px solid black;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
                text-align: left;
            }

            th,
            td {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <h2 class="text-center my-3">WanThetDee Shop</h2>
        <h3 class="text-center my-3"> Report </h3>
        <p class="text-center">Report between <strong>วันที่
                <?php
                $startDate1 = new DateTime($startDate);
                $endDate1 = new DateTime($endDate);
                $thai_month_arr = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                $startMonth = intval($startDate1->format('m'));
                echo $startDate1->format('d') . " " . $thai_month_arr[$startMonth] . " " . $startDate1->format('Y');
                ?>
            </strong> ถึง <strong> วันที่
                <?php
                $endMonth = intval($endDate1->format('m'));
                echo $endDate1->format('d') . " " . $thai_month_arr[$endMonth] . " " . $endDate1->format('Y');
                ?>
            </strong></p>

        <div class="container" style="width:100%;">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ลำดับ</th>
                        <th>Order ID</th>
                        <th>Member ID</th>
                        <th>Payment Bank</th>
                        <th>Payment Date</th>
                        <th>Order Count</th>
                        <th>Payment Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if (count($data) > 0) { ?>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td>
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <?php echo $row['order_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['mem_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['payment_bank']; ?>
                                </td>
                                <td>
                                    <?php
                                    $paymentDate = new DateTime($row['payment_date']);
                                    echo $paymentDate->format('d/m/Y');
                                    ?>
                                </td>
                                <td>
                                    <?php echo $row['order_count']; ?>
                                </td>
                                <td>
                                    <?php echo number_format($row['payment_price'], 2, '.', ','); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" align="center">Data not found</td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-success">
                    <tr>
                        <td colspan="5">รวม</td>
                        <td>
                            <?php echo $totalOrderCount; ?>
                        </td>
                        <td>
                            <?php echo number_format($totalPaymentPrice, 2, '.', ','); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="d-flex justify-content-center">
                <input type="button" name="Button" value="Print" class="btn btn-primary"
                    onclick="javascript:this.style.display='none';window.print();">
            </div>
        </div>
    </body>



</body>

</html>