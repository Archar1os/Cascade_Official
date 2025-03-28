<?php
$conn = new mysqli("localhost", "root", "", "coffeeshopdb");

// Get product details by ID
$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE product_id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        *{
            transition: all 0.3s ease;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #333;
            color: rgb(255, 156, 25);
        }
        h1 {
            text-align: center;
            color:rgb(255, 156, 25);
            padding: 50px;
            background-color: #333;
        }
        form {
            max-width: 49.59%;
            margin: 0 auto;
            padding: 20px;
            color: #333;
            background-color: rgb(255, 156, 25);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        input, textarea, select, button {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #333;
            border-radius: 5px;
            font-size: 16px;
            background-color: #333;
            color: rgb(255, 156, 25);
        }
        input,textarea {
            width: 98%;
        }
        select {
            width: 910px;
        }
        button {
            background-color: #333;
            color: rgb(255, 156, 25);
            cursor: pointer;
            border: none;
            width: 910px;
            padding: 20px;
        }

        button:hover {
            background-color: rgb(49, 28, 0);
            color: white;
        }
        .go_back {
            text-align: center;
            margin: 20px auto;
            display:block;
            align-items: center;
            text-decoration: none;
            padding: 10px;
            width:100px;
            color: rgb(255, 156, 25);
            border-radius: 5px;
            background-color: #333;
        }
        .go_back:hover{
            background-color: rgb(49, 28, 0);
            color: white;
        }
    </style>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="update_product.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>

        <label for="product_desc">Product Description:</label>
        <textarea id="product_desc" name="product_desc" rows="4" required><?php echo $product['product_desc']; ?></textarea>

        <label for="product_category">Product Category:</label>
        <select id="product_category" name="product_category" required>
            <option value="Best_Seller" <?php echo $product['product_category'] == 'Best_Seller' ? 'selected' : ''; ?>>Best Seller</option>
            <option value="Coffee" <?php echo $product['product_category'] == 'Coffee' ? 'selected' : ''; ?>>Coffee</option>
            <option value="Matcha" <?php echo $product['product_category'] == 'Matcha' ? 'selected' : ''; ?>>Matcha</option>
            <option value="Fruit_Drinks" <?php echo $product['product_category'] == 'Fruit_Drinks' ? 'selected' : ''; ?>>Fruit Drinks</option>
            <option value="Snacks" <?php echo $product['product_category'] == 'Snacks' ? 'selected' : ''; ?>>Snacks</option>
        </select>

        <label for="product_price">Product Price:</label>
        <input type="number" id="product_price" name="product_price" step="0.01" value="<?php echo $product['product_price']; ?>" required>

        <button type="submit">Update Product</button>
        <a href="index.php" class="go_back">Go back</a>
        </form>
</body>
</html>

<?php
$conn->close();
?>
