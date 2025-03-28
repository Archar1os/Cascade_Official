<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "coffeeshopdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    header("Location: customer_list.php");
    exit();
}

$customer_id = $_GET['id'];

// Fetch customer details
$sql = "SELECT * FROM customer WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Customer not found.");
}

$customer = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];

    $update_sql = "UPDATE customer SET customer_name = ?, customer_address = ? WHERE customer_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $name, $address, $customer_id);

    if ($update_stmt->execute()) {
        header("Location: customer_list.php");
        exit();
    } else {
        echo "Error updating customer: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #222;
            color: rgb(255, 156, 25);
        }
        h1 {
            text-align: center;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        form label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }
        form input {
            width: 95.5%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid rgb(255, 156, 25);
            border-radius: 5px;
            background-color: #444;
            color: white;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color: rgb(255, 156, 25);
            border: none;
            border-radius: 5px;
            font-weight: bold;
            color: #222;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: white;
            color: rgb(255, 156, 25);
        }
        form a {
            color: rgb(255, 156, 25);
            text-decoration: none;
        }
        form a:hover {
            text-decoration: underline;
        }
        .space {
            display: inline-block;
            margin-top:10px ;
            padding: 15px;
        }
    </style>
</head>
<body>
    <h1>Edit Customer</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($customer['customer_name']); ?>" required>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($customer['customer_address']); ?>" required>
        <button type="submit">Update</button>
        <a href="customer.php" class="space">Cancel</a>
    </form>
</body>
</html>
