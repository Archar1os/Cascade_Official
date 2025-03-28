<?php
session_start();
include("assets/mysql/database.php");
// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $empty_cart_message = "Your cart is currently empty.  <a href='menu.php'>Browse the menu</a> to add items.";
} else {
    $cart = $_SESSION['cart'];

    $query = "SELECT * From products";
    $results = $con->query($query);
    $product_prices = array();
    while ($row = $results->fetch_assoc()) {
        $product_prices[$row['product_name']] = $row['product_price'];
    }

    // Calculate subtotal
    $subtotal = 0;
    foreach ($cart as $item_id => $quantity) {
        if (isset($product_prices[$item_id])) {
            $subtotal += $product_prices[$item_id] * $quantity;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="ULOGO.png" type="image/x-icon">
    <title>Cascade - Checkout</title>

    <!-- Additional styles for the checkout page (inline styling muna baka magulo yung sa main css e xD) -->
    <style>
        body {
            background-color: #f4f4f4;
        }
        .banner {
            width:unset;
            height: unset;
            position: unset;
            overflow: unset;
        }
        .checkout-container {
            width: 70%;
            min-height: 585px;
            margin: 100px auto;
            padding: 50px 100px;
            background-color: #fff;
            border-radius: 8px;
            background-color:rgba(245, 245, 245, 0.5);
        }
        .checkout-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color:rgb(255, 146, 68); /* Dark brown */
            text-align: center;

            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            font-family: 'Poppins', sans-serif;
            padding: 10px;
            border-bottom: 3px solid rgb(255, 146, 68);
            display: block;

        }
        .checkout-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .checkout-form input, .checkout-form select, .checkout-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .checkout-form select {
            height: 35px;
        }

        .cart-summary {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 4px;
            background-color: white;
        }

        .cart-summary h3 {
            margin-top: 0;
        }

        .cart-items {
            list-style: none;
            padding: 0;
        }

        .cart-items li {
            padding: 5px 0;
            border-bottom: 1px dotted #eee;
        }

        .cart-items li:last-child {
            border-bottom: none;
        }

        .total-amount {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 10px;
        }

        .button-checkout {
            background-color: #333;
            color: rgb(255, 156, 25);
            padding: 20px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1.5rem;
            font-family: 'Changa', sans-serif;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            box-sizing: border-box;
        }

        .button-checkout:hover {
            background-color: #ca8f42;
            color: white;
        }

        body {
            padding-top: 80px;
            background-image: url('assets/img/checkoutbg.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }


    </style>
</head>
<body>
    <!-- HEADER -->
    <?php include("assets/include/header.php");?>
        <div class="checkout-container">
            <h1>Checkout</h1>

            <?php if (isset($empty_cart_message)): ?>
                <p><?php echo $empty_cart_message; ?></p>
            <?php else: ?>

                <div class="cart-summary">
                    <h3>Order Summary</h3>
                    <ul class="cart-items">
                        <?php foreach ($cart as $item_id => $quantity): ?>
                            <li>
                                <?php
                                // Get the item name (replace with database lookup if applicable)
                                $item_name = str_replace('_', ' ', ucfirst($item_id)); // e.g., "Americano"
                                $item_price = $product_prices[$item_id];
                                $item_total = $item_price * $quantity;
                                echo $item_name . ' (₱' . $item_price . ') x ' . $quantity . ' = ₱' . number_format($item_total, 2);
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="total-amount">Subtotal: ₱<?php echo number_format($subtotal, 2); ?></div>
                </div>

                <form class="checkout-form" action="receipt.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>

                    <label for="payment_method">Mode of Payment:</label>
                    <select id="payment_method" name="payment_method">
                        <option value="COD">Cash on Delivery</option>
                        <option value="credit_card">Credit Card (Not Implemented)</option>
                    </select>

                    <input type="hidden" name="total_amount" value="<?php echo $subtotal; ?>">

                    <button type="submit" class="button-checkout">Confirm Order</button>
                </form>
            <?php endif; ?>
        </div>
		<!-- FOOTER-->
		<?php include("assets/include/footer.php");?>
    </div>
</body>
</html>