<?php
session_start();
include("assets/mysql/database.php");

// Fetch all orders and their associated customer details
$query = "
    SELECT
        orders.orders_id,
        orders.order_number,
        orders.order_date,
        orders.total_amount,
        customer.customer_name,
        customer.customer_address
    FROM orders
    INNER JOIN customer ON orders.customer_id = customer.customer_id
    ORDER BY orders.order_date DESC";

$results = $con->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="ULOGO.png" type="image/x-icon">
    <title>Order Input</title>

    <style>
        body {
            background-color: #f4f4f4;
            padding-top: 50px;
        }
        .banner {
            width:unset;
            height: unset;
            position: unset;
            overflow: unset;
        }
        .input-container {
            width: 50%;
            margin: 100px auto;
            padding: 30px;
            margin: 400px auto;
            height: 50%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .input-container input {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .input-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .input-container button:hover {
            background-color: #45a049;
        }
        body {
        background-image: url('assets/img/order.gif');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        backdrop-filter: blur(3px);
        }
        body {
            background-color: #f4f4f4;
            padding-top: 50px;
        }

        .orders-container {
            width: 35%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            user-select:text;
        }

        .orders-header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<?php include("assets/include/header.php"); ?>

<div class="input-container">
    <h1>View Order Details</h1>
    <form action="order_detail.php" method="GET">
        <input type="text" name="order_number" placeholder="Enter Order Number" required>
        <button type="submit">View Order</button>
    </form>
</div>
<div class="orders-container">
    <div class="orders-header">
        <h1>Orders</h1>
        <p>Below are all the recorded orders with details.</p>
    </div>

    <!-- Orders Table -->
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer Name</th>

            </tr>
        </thead>
        <tbody>
            <?php if ($results->num_rows > 0): ?>
                <?php while ($row = $results->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['order_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>

                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No orders found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- FOOTER -->
<?php include("assets/include/footer.php"); ?>

</body>
</html>
