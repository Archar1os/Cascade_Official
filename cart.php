<?php
include("assets/mysql/database.php");
session_start();

if (isset($_GET['remove_item'])) {
    $item_to_remove = $_GET['remove_item'];
    unset($_SESSION['cart'][$item_to_remove]);
    header("Location: cart.php");
    exit();
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $empty_cart_message = "Your cart is currently empty.  <a href='menu.php' class='browse'>Browse the menu</a> to add items.";
} else {
    $cart = $_SESSION['cart'];
    $query = "SELECT * From products";
    $results = $con->query($query);
    $product_prices = array();
    while ($row = $results->fetch_assoc()) {
        $product_prices[$row["product_name"]] = $row["product_price"];
    }
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
    <title>Cascade - Cart</title>

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
        .browse {
            color: rgb(75, 35, 7);
        }
        .cart-container {
            width: 70%;
            min-height: 585px;
            margin: 100px auto;
            padding: 50px 100px;
            background-color:rgba(245, 245, 245, 0.5);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

        .cart-summary {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 100px;
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
            border-bottom: 2.5px dotted darkgray;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-items li:last-child {
            border-bottom: none;
        }

        .total-amount {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 10px;
        }

        .proceed-to-checkout {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .cart-container {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .proceed-to-checkout {
            background-color: #333;
            color: rgb(255, 156, 25);
            border: none;
            border-radius: 4px;
            margin: 10px;
            cursor: pointer;
            font-family: 'Changa', sans-serif;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .proceed-to-checkout:hover {
            background-color: #ca8f42; 
            color: white;
        }
        .remove-button {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.8em;
        }

        .remove-button:hover {
            background-color: #c9302c;
        }
        .cart-container h1, .cart-container h3, .cart-container li, .cart-container a, .total-amount{
            padding: 8px;
        }

        body {
        background-image: url('assets/img/smit.gif');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        backdrop-filter: blur(3px);
        }

        .cart-container h1
        {
        font-size: 2.5rem;
        font-weight: bold;
        color: rgb(255, 146, 68); /* Dark brown */
        text-align: center;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        font-family: 'Poppins', sans-serif;
        padding: 10px;
        border-bottom: 3px solid rgb(255, 146, 68);
        display: block;
        }
        .empty-cart-message
        {
            font-size: 1.2rem;
            color: #8B4513;
            text-align: center;
            font-style: italic;
            margin-top: 20px;
        }
        .order_p{
            padding: 10px;
            position:absolute;
            top: 125px;
            right: 10px;
            color: white;
        }
        .order_details {
            margin-left: 10px;
            padding: 8px;
            background-color: #333;
            border-radius: 5px;
            color: rgb(255, 156, 25);
            transition: all 0.3s ease;
        }
        .order_details:hover {
            background-color: rgb(255, 156, 25);
            color:#333;
        }
    </style>
</head>
<body>
<?php include("assets/include/header.php");?>

        <div class="cart-container">
            <h1>Your Cart</h1>

            <?php if (isset($empty_cart_message)): ?>
                <p class="empty-cart-message"><?php echo $empty_cart_message; ?></p>
            <?php else: ?>

                <div class="cart-summary">
                    <h3>Order Summary</h3>
                    <ul class="cart-items">
                        <?php foreach ($cart as $item_id => $quantity): ?>
                            <li>
                            <?php
                                $item_name = str_replace('_', ' ', ucfirst($item_id));
                                $item_price = $product_prices[$item_id];
                                $item_total = $item_price * $quantity;
                                echo $item_name . ' (₱' . $item_price . ') x ' . $quantity . ' = ₱' . number_format($item_total, 2);
                                ?>
                                <a href="cart.php?remove_item=<?php echo $item_id; ?>" class="remove-button">Remove</a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="total-amount">Subtotal: ₱<?php echo number_format($subtotal, 2); ?></div>
                    <a href="checkout.php" class="proceed-to-checkout">Proceed to Checkout</a>
                </div>

            <?php endif; ?>
        </div>
        <p class="order_p">See Previous Orders?<a href="order_detail.php" class="order_details">Click Here</a></p>
		<!-- FOOTER-->
		<?php include("assets/include/footer.php");?>
    </div>
</body>
</html>