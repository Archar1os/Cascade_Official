<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200..800&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@363&family=Holtwood+One+SC&family=IM+Fell+DW+Pica:ital@0;1&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="icon" href="ULOGO.png" type="image/x-icon" />
    <title>Cascade Café - Login</title>

    <style>
        body {
            background-color: white;
        }
        .banner {
            width:unset;
            height: unset;
            position: unset;
            overflow: unset;
        }
        .login-container {
            min-height: 100%;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 50px;
            width: 25%;
            text-align: center;
            margin: 50px auto;
        }
        .login-container h1 {
            color: #333;
            margin-bottom: 20px;
            font-family: 'Oswald', sans-serif;
        }
        input[type="text"], input[type="password"] {
            width: 75%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #333;
            color:rgb(255, 156, 25);
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 80%;
            font-family: 'Changa', sans-serif;
        }
        button:hover {
            background-color: #ca8f42;
            color:white;
        }
        .login-container{
            height: 50%;
        }
        .login-container p {
            padding: 10px;
        }
        .space {
            padding: 250px 50px;
        }
        body {
        background-image: url('assets/img/login.gif');
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
    <!-- Login Form -->
    <div class="space">
        <div class="login-container">
            <h1>Login</h1>
            <form method="POST" action="login.php" autocomplete="off">
                <input type="text" name="username" placeholder="Username" autocomplete="off" required>
                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <button type="submit">Sign In</button>
                <p><a href="signup.php">Sign Up?</a></p>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Database credentials
                $servername = "localhost";
                $db_username = "root";
                $db_password = "";
                $dbname = "coffeeshopdb";

                // Create connection
                $conn = new mysqli("localhost", "root", "", "coffeeshopdb");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Get user input
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Query the database
                $sql = "SELECT password FROM users WHERE username=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Verify password
                    if (password_verify($password, $row['password'])) {
                        echo "<p>Login successful! Welcome, " . htmlspecialchars($username) . ".</p>";
                        echo "<script>
                                location.replace('admin/index.php');
                            </script>";
                    } else {
                        echo "<p>Invalid password. Please try again.</p>";
                    }
                } else {
                    echo "<p>User not found. Please try again.</p>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
		<!-- FOOTER-->
		<?php include("assets/include/footer.php");?>
</body>
</html>
