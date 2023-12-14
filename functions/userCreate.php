<?php
include 'connect.php';

// Handle form submission to add a new user
if (isset($_POST['addUser'])) {
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $newFirstName = $_POST['firstName'];
    $newLastName = $_POST['lastName'];
    $newEmail = $_POST['email'];
    $newPhoneNumber = $_POST['phoneNumber'];
    $newUserRole = $_POST['userRole'];

    // Perform the insertion
    $insertQuery = $conn->prepare("INSERT INTO Users (UserName, Password, FirstName, LastName, Email, PhoneNumber, UserRole) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insertQuery->execute([$newUsername, $newPassword, $newFirstName, $newLastName, $newEmail, $newPhoneNumber, $newUserRole]);

    // Redirect back to index.php after insertion
    header("Location: ../dashboard/dashboard_users.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
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

        input,
        select {
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
        <h1>Add User</h1>
    </header>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" name="phoneNumber" required>

        <label for="userRole">User Role:</label>
        <select name="userRole" required>
            <option value="admin">Admin</option>
            <option value="organizer">Organizer</option>
        </select>

        <button type="submit" name="addUser">Add User</button>
    </form>


</body>

</html>