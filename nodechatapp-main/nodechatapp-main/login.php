<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'chat';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: index.html?username=$username");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

$conn->close();

?>


<!DOCTYPE html>
<html>
<head>
    <title>CHATCORD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: orange;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: lightgray;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 3px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }

        button[type="submit"] {
            display: block;
            margin: 0 auto;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: orange;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #333;
        }

        .error {
            color: red;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Login to Chatcord!</h1>
    
    <?php if(isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post">
        <div>
            <label>Username:</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password">
        </div>
        <button type="submit" name="register">Login</button>
        <a href="register.php">Don't have an account? Create one here</a>
    </form>
    <br>
    
</body>
</html>


