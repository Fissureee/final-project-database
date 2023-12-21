<?php
include '../functions/connect.php';
session_start(); // Start the session

// Handle login form submission
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the user's credentials and role
    $loginQuery = $conn->prepare("SELECT * FROM Users WHERE UserName = ? AND Password = ?");
    $loginQuery->execute([$username, $password]);
    $user = $loginQuery->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Successful login for admin, set user details in the session
        $_SESSION['user_id'] = $user['UserID'];
        $_SESSION['user_name'] = $user['UserName'];
        $_SESSION['user_role'] = $user['UserRole'];

        // Redirect to the dashboard or any other authenticated page
        if ($user['UserRole'] == 'admin') {
            header("Location: ../dashboard/dashboard_home.php");
        } else {
            header("Location: ../organizer/home.php");
        }

        exit();
    } else {
        // Invalid credentials or not an admin, show an error message or redirect to the login page
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 1em;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #333;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header>
        <h1>Login</h1>
    </header>

    <!-- Login form -->
    <form method="post" action="">
        <?php if (isset($error)): ?>
            <p style="color: red;">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

</body>

</html>