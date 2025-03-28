<?php
session_start();
include("assets/mysql/database.php");

// Confirms kung na-post ang checkout form
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Redirect to the menu or an error page if the form wasn't submitted
    header("Location: menu.php"); // Or header("Location: error.php");
    exit();
}

// Name and other info ni user and kung how much bayaran niya
$name = $_POST['name'];
$address = $_POST['address'];
$payment_method = $_POST['payment_method'];
$total_amount = $_POST['total_amount'];

// Get cart items from the session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // Redirect to the menu or display an error if the cart is empty
    header("Location: menu.php"); // Or header("Location: error.php");
    exit();
}
$cart = $_SESSION['cart'];

// Generate a unique order number (for demonstration purposes)
$order_number = uniqid('ORDER-', true);

// Get current date and time
$order_date = date("Y-m-d H:i:s");
$query = "SELECT 'customer_id' FROM customer";

$results = $con->query($query);
$customer_id = random_int(0, 100);
$customerID = 1;
if (isset($results)){
    while ($row = $results->fetch_assoc() or $customer_id == $customerID) {
        if ($customer_id == $row['customer_id']) {
            $customer_id = random_int(0, 100);
        }
        $customerID = $row['customer_id'];
    }
}

$customer = $con->prepare("INSERT INTO customer (customer_id, customer_name, customer_address) VALUES (?, ?, ?)");
$customer->bind_param("iss",$customer_id, $name, $address);

if ($customer->execute()) {
} else {
}

$query = "SELECT 'orders_id' FROM orders";

$results = $con->query($query);
$orders_id = random_int(1, 100);
if (isset($results)){
    while ($row = $results->fetch_assoc()) {
        if ($orders_id == $row['orders_id']) {
            $orders_id = random_int(0, 100);
        }
    }
}

$orders = $con->prepare("INSERT INTO orders (orders_id, order_number, customer_id, payment_method, total_amount, order_date) VALUES (?, ?, ?, ?, ?, ?)");
$orders->bind_param("isisds",$orders_id, $order_number, $customer_id, $payment_method, $total_amount, $order_date);

// Execute the statement
if ($orders->execute()) {
    // echo "Order successfully stored in the database!";
} else {
    // echo "Error: " . $stmt->error;
}
// Define product prices (Database ito dapat but for demonstration purpose lang ito)
$query = "SELECT * From products";
$results = $con->query($query);
$product_prices = array();
$products_id = array();

$results = $con->query($query);
while ($row = $results->fetch_assoc()) {
    $product_prices[$row['product_name']] = $row['product_price'];
    $products_id[$row['product_name']] = $row['product_id'];
}

$results = $con->query($query);
while ($row = $results->fetch_assoc()) {
    $products_id[$row['product_name']] = $row['product_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="ULOGO.png" type="image/x-icon">
    <title>Cascade - Receipt</title>

    <!-- Additional styles for the receipt page (inline styling muna baka magulo yung sa main css e xD) -->
    <style>
    body {
        background-color: #f4f4f4;
        padding-top: 80px;
    }
    .banner {
            width:unset;
            height: unset;
            position: unset;
            overflow: unset;
        }
    .receipt-container {
        width: 25%;
        min-height: 585px;
        margin: 100px auto;
        padding: 50px 100px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .receipt-header {
        text-align: center;
    }
    .receipt-header * {
        margin: 20px;
    }

    .order-details {
        margin-bottom: 20px;
        text-align: center;
    }

    .order-details h3 {
        margin-top: 0;
    }

    .order-info {
        list-style: none;
        padding: 0;
        display: inline-block;
        text-align: left;
    }

    .order-info li {
        padding: 5px 0;
        margin-top: 10px;
        border-bottom: 1px dotted #eee;
        text-align: left;
    }

    .order-info li:last-child {
        border-bottom: none;
    }

    .shipping-address {
        margin-top: 20px;
    }

    .footer {
    margin-top: auto;
    flex-shrink: 0;
    }
    body {
        background-image: url('assets/img/download.gif');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        backdrop-filter: blur(3px);
    }
    .browse {
        padding: 50px;
        color: rgb(212, 121, 36);
    }
</style>
</head>
<body>
    <!-- HEADER -->
    <?php include("assets/include/header.php");?>
        <div class="receipt-container">
            <div class="receipt-header">
                <h1>Cascade Receipt</h1>
                <p>Order Number: <?php echo $order_number; ?></p>
                <p>Date: <?php echo $order_date; ?></p>
            </div>

            <div class="order-details">
                <h3>Order Details</h3>
                <ul class="order-info">
                    <li>Name: <?php echo htmlspecialchars($name); ?></li>
                    <li>Payment Method: <?php echo htmlspecialchars(str_replace('_', ' ', ucfirst($payment_method))); ?></li>
                    <li>Total Amount: ₱<?php echo number_format($total_amount, 2); ?></li>
                    <?php foreach ($cart as $item_id => $quantity): ?>
                        <li>
                            <?php
                            $products = $con->prepare("INSERT INTO orders_product (orders_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                            $item_name = str_replace('-', ' ', ucfirst($item_id));
                            $item_price = $product_prices[$item_id];
                            $item_total = $item_price * $quantity;

                            $product_id = $products_id[$item_id];

                            echo $item_name . ' (₱' . $item_price . ') x ' . $quantity . ' = ₱' . number_format($item_total, 2);
                            $products->bind_param("iidi", $orders_id, $product_id, $quantity, $item_price);

                            if ($products->execute()) {
                                // echo "Product details successfully saved into the database!";
                            } else {
                                // echo "Error: " . $stmt->error;
                            }
                            ?>
                        </li>
                    <?php endforeach; ?>

                    <?php if ($payment_method == 'cod'): ?>
                        <li>Shipping Address: <?php echo htmlspecialchars($address); ?></li>
                    <?php endif; ?>
                </ul>
                <p class="browse"><a href="mainmenu.php"  class="browse">Want to browse again? Click Here!</a></p>
            </div>
        </div>
		<!-- FOOTER-->
		<?php include("assets/include/footer.php");?>
        
    </div>
    <script>
    window.addEventListener("beforeunload", function () {
        navigator.sendBeacon("clear_session.php");
    });
    </script>
</body>
</html>