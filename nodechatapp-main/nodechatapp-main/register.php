<?php
// connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'chat';

$conn = new mysqli($host, $user, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // sanitize input values
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    
    
    // insert user details into database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// close database connection
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
            background-color: #555;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #333;
        }

        a:hover {
            text-decoration: underline;
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
    <h1>Register to Chatcord!</h1>
    
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
        <button type="submit" name="register">Register</button>
        <a href="login.php">Already have an account? Login here</a>
    </form>
    <br>
    
</body>
</html>
