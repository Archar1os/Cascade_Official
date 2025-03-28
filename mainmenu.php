<?php
include("assets/mysql/database.php");
session_start(); // Start the session at the very top

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Function to add item to cart
function addToCart($item_id, $quantity = 1) {
    if (isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id] += $quantity; // Increase quantity if item already exists
    } else {
        $_SESSION['cart'][$item_id] = $quantity; // Add item to cart with quantity
    }
}

// // Handle "Add to Cart" action
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
//     $item_id = $_POST['item_id'];
//     addToCart($item_id);
//     echo "<script>alert('The item has been added to your cart!');</script>"; // Temporary feedback
// }
$message = ""; // Initialize an empty message
if ($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    addToCart($item_id);
    $message = "The item has been added to your cart!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="ULOGO.png" type="image/x-icon">
    <!-- H1 FONT FOR MENU -->
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&family=Girassol&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <!-- P FONT FOR MENU2ND -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    <!-- Font for side text -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Satisfy&display=swap" rel="stylesheet">
    <title>Cascade - Main Menu</title>
	<style>
        .banner {
            width:unset;
            height: unset;
            position: unset;
            overflow: unset;
        }
        .custom-alert {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 16px;
            z-index: 1000;
            transform: translateY(250%);
        }
        .custom-alert.show {
            display: block;
        }
    </style>
</head>
<body>
    <?php include("assets/include/header.php");?>
        <div class="content2">
            <div class="menu2-intro">
                <h1>TRY OUR BEST SELLERS</h1>
            </div>
        </div>
        <div class="background_fixed">
            <img src="assets/img/menu2nd background.gif" alt="background image">
        </div>
        <div class="menu2-nav">
            <ul>
                <li><a href="#coffee-section">COFFEE</a></li>
                <li><a href="#matcha-section">MATCHA</a></li>
                <li><a href="#FD-section">FRUIT DRINKS</a></li>
                <li><a href="#snacks-section">SNACKS</a></li>
            </ul>
        </div>
    </div>

    <!-- TRY OUR BEST SELLERS -->
    <section class="coffee" id="no_back">
        <div class="coffee-items">
        <?php
            $query = "SELECT * FROM products WHERE product_category='Best_Seller'";
            $result = $con->query($query);
            while ($row = $result->fetch_array()) {
                if (isset($row["product_name"])){
                    $product_name = $row["product_name"];
                    $product_desc = $row["product_desc"];
                    $product_price = (double)$row["product_price"];
                }
                echo "<div class='item' id='itemFix'>
                    <h3>$product_name</h3>
                    <p id='itemFix_P'>$product_desc</p>
                    <p>₱$product_price</p>
                    <form method='post'>
                        <input type='hidden' name='item_id' value='{$product_name}'>
                        <button type='submit' name='add_to_cart' class='add-to-cart-button'>Add to Cart</button>
                    </form>
                </div>";
            }
            ?>
        </div>
    </section>
    <!-- COFFEE -->
    <section class="coffee" id="coffee-section">
        <div class="coffee-intro">
            <h2>Coffee</h2>
            <p>Explore our selection of rich and aromatic coffees.</p>
        </div>
        <div class="coffee-items">
            <?php
            $query = "SELECT * From products where product_category='Coffee'";
            $result = $con->query($query);
            while ($row = $result->fetch_array()) {
                $product_name = $row["product_name"];
                $product_desc = $row["product_desc"];
                $product_price = (double)$row["product_price"];
                echo "<div class='item'>
                    <h3>$product_name</h3>
                    <p id='itemFix_PCoffee'>$product_desc</p>
                    <p>₱$product_price</p>
                    <form method='post'>
                        <input type='hidden' name='item_id' value='{$product_name}'>
                        <button type='submit' name='add_to_cart' class='add-to-cart-button'>Add to Cart</button>
                    </form>
                </div>";
            }
            ?>
        </div>
    </section>

    <!-- MATCHA -->
    <section class="coffee" id="matcha-section">
        <div class="coffee-intro">
            <h2>Matcha</h2>
            <p>Explore our selection of rich and aromatic Matchas.</p>
        </div>
        <div class="coffee-items">
            <?php
            $query = "SELECT * From products where product_category='Matcha'";
            $result = $con->query($query);
            if ($result) {
                while ($row = $result->fetch_array()) {
                    $product_name = $row["product_name"];
                    $product_desc = $row["product_desc"];
                    $product_price = (double)$row["product_price"];
                    echo "<div class='item'>
                        <h3>$product_name</h3>
                        <p id='itemFix_PCoffee'>$product_desc</p>
                        <p>₱$product_price</p>
                        <form method='post'>
                            <input type='hidden' name='item_id' value='{$product_name}'>
                            <button type='submit' name='add_to_cart' class='add-to-cart-button'>Add to Cart</button>
                        </form>
                    </div>";
                }
            } else {
                echo "<p>Error fetching matcha items</p>";
            }
            ?>
        </div>
    </section>

    <!-- FRUIT DRINKS -->
    <section class="coffee" id="FD-section">
        <div class="coffee-intro">
            <h2>Fruit Drinks</h2>
            <p>Explore our selection of thick and cold Fruit Drinks.</p>
        </div>
        <div class="coffee-items">
            <?php
            $query = "SELECT * From products where product_category='Fruit_Drinks'";
            $result = $con->query($query);
            if ($result) {
                while ($row = $result->fetch_array()) {
                    $product_name = $row["product_name"];
                    $product_desc = $row["product_desc"];
                    $product_price = (double)$row["product_price"];
                    echo "<div class='item'>
                        <h3>$product_name</h3>
                        <p id='itemFix_PCoffee'>$product_desc</p>
                        <p>₱$product_price</p>
                        <form method='post'>
                            <input type='hidden' name='item_id' value='{$product_name}'>
                            <button type='submit' name='add_to_cart' class='add-to-cart-button'>Add to Cart</button>
                        </form>
                    </div>";
                }
            } else {
                echo "<p>Error fetching fruit drink items</p>";
            }
            ?>
        </div>
    </section>

    <!-- SNACKS -->
    <section class="coffee" id="snacks-section">
        <div class="coffee-intro">
            <h2>SNACKS</h2>
            <p>Explore our selection delicious and price saving snacks!</p>
        </div>
        <div class="coffee-items">
            <?php
            $query = "SELECT * From products where product_category='Snacks'";
            $result = $con->query($query);
            if ($result) {
                while ($row = $result->fetch_array()) {
                    $product_name = $row["product_name"];
                    $product_desc = $row["product_desc"];
                    $product_price = (double)$row["product_price"];
                    echo "<div class='item'>
                        <h3>$product_name</h3>
                        <p id='itemFix_PCoffee'>$product_desc</p>
                        <p>₱$product_price</p>
                        <form method='post'>
                            <input type='hidden' name='item_id' value='{$product_name}'>
                            <button type='submit' name='add_to_cart' class='add-to-cart-button'>Add to Cart</button>
                        </form>
                    </div>";
                }
            } else {
                echo "<p>Error fetching snack items</p>";
            }
            ?>
        </div>
    </section>
		<!-- FOOTER-->
		<?php include("assets/include/footer.php");?>
<!-- Custom notification -->
<div id="customAlert" class="custom-alert">
    <?php echo htmlspecialchars($message); ?>
</div>

<script>
    // Get the PHP message from the page
    const alertBox = document.getElementById("customAlert");
    if (alertBox.innerText.trim() !== "") {
        alertBox.classList.add("show"); // Show the alert if there's a message
        setTimeout(() => {
            alertBox.classList.remove("show"); // Hide the alert after 3 seconds
        }, 3000);
    }
</script>
</body>
</html>
