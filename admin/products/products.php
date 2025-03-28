<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "coffeeshopdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <style>
        *{
            transition: all 0.3s ease;
            text-decoration:none;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #222;
            color: rgb(255, 156, 25);
        }
        h1 {
            text-align: center;
            color:rgb(255, 156, 25);
            padding: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #333;
        }
        table th, table td {
            border: 1px solid rgb(255, 156, 25);
            padding: 20px ;
            text-align: center;
        }
        table th {
            background-color: #333;
            color: rgb(255, 156, 25);
        }
        table tr:nth-child(even) {
            background-color: #333;
        }
        table tr:hover {
            color: #333;
            background-color: rgb(255, 156, 25);
        }
        table tr:hover td{
            border: 1px solid #333;
        }
        table tr:hover td a{
            background-color: #333;
            color:rgb(255, 156, 25);
        }
        .action-buttons a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 4px;
            font-weight: bold;
        }
        .edit-btn {
            background-color:rgb(255, 156, 25);
            display: block;
            position: relative;
            top: -2px;
            transition: all 0.3s;
        }
        .delete-btn {
            background-color:rgb(255, 156, 25);
            display: block;
            position: relative;
            top: 5px;
            transition: all 0.3s;
        }
        .add-btn {
            background-color: rgb(255, 156, 25);
            display: block;
            position: relative;
            padding: 20px;
            top: -11px;
            color: #333;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .add-btn:hover{
            background-color: #333;
            color:rgb(255, 156, 25);
        }
        .a:hover {
            transform: scale(1.2);
        }
        .go_back {
            position: absolute;
            top: 20px;
            background-color: rgb(255, 156, 25);
            padding: 20px;
            border-radius: 5px;
            left: 20px;
        }
        .go_back a {
            color: #333;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Cascade's Products List</h1>
    <p class="go_back"><a href="../index.php">Go Back</a></p>
    <a href="add_product.php" class="add-btn">Add Product</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['product_desc']; ?></td>
                <td><?php echo $row['product_category']; ?></td>
                <td><?php echo number_format($row['product_price'], 2); ?></td>
                <td class="action-buttons">
                    <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class="edit-btn">Edit</a>
                    <a href="delete_product.php?id=<?php echo $row['product_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
