<?php
session_start();
include("assets/mysql/database.php");

// Check if an order number was provided
if (!isset($_GET['order_number'])) {
    header("Location: order_input.php"); // Redirect back to the input page if no number is provided
    exit();
}

$order_number = $_GET['order_number'];

// Fetch order and customer details using order_number
$order_query = "
    SELECT 
        orders.order_number, 
        orders.order_date, 
        orders.total_amount, 
        customer.customer_name, 
        customer.customer_address, 
        orders.payment_method 
    FROM orders
    INNER JOIN customer ON orders.customer_id = customer.customer_id
    WHERE orders.order_number = ?";
$order_stmt = $con->prepare($order_query);
$order_stmt->bind_param("s", $order_number);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

if ($order_result->num_rows === 0) {
    die("Order not found. Please check the Order Number and try again.");
}

$order = $order_result->fetch_assoc();

// Fetch the items in the order using order_number
$item_query = "
    SELECT 
        products.product_name, 
        orders_product.quantity, 
        orders_product.price 
    FROM orders_product
    INNER JOIN products ON orders_product.product_id = products.product_id
    INNER JOIN orders ON orders_product.orders_id = orders.orders_id
    WHERE orders.order_number = ?";
$item_stmt = $con->prepare($item_query);
$item_stmt->bind_param("s", $order_number);
$item_stmt->execute();
$items_result = $item_stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="ULOGO.png" type="image/x-icon">
    <title>Order Details</title>

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
        .order-container {
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            height: 80%;
            margin: 250px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .order-info, .order-items {
            margin: 20px 0;
        }

        .order-info h3, .order-items h3 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
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
        body {
        background-image: url('assets/img/orderdetail.gif');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        backdrop-filter: blur(3px);
        }
    </style>
</head>
<body>

<!-- HEADER -->
<?php include("assets/include/header.php");?>

<div class="order-container">
    <div class="order-header">
        <h1>Order Details</h1>
        <p>Order Number: <?php echo htmlspecialchars($order['order_number']); ?></p>
        <p>Date: <?php echo htmlspecialchars($order['order_date']); ?></p>
    </div>

    <div class="order-info">
        <h3>Customer Information</h3>
        <p>Name: <?php echo htmlspecialchars($order['customer_name']); ?></p>
        <p>Address: <?php echo htmlspecialchars($order['customer_address']); ?></p>
        <p>Payment Method: <?php echo htmlspecialchars(str_replace('_', ' ', ucfirst($order['payment_method']))); ?></p>
    </div>

    <div class="order-items">
        <h3>Order Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $items_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>₱<?php echo number_format($item['price'], 2); ?></td>
                        <td>₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="order-total">
        <h3>Total Amount: ₱<?php echo number_format($order['total_amount'], 2); ?></h3>
    </div>
</div>

<!-- FOOTER -->
<?php include("assets/include/footer.php");?>

</body>
</html>
