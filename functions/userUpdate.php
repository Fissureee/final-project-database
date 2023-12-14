<?php
include 'connect.php';

if (isset($_GET['UserID']) && is_numeric($_GET['UserID'])) {
    $userID = $_GET['UserID'];

    // Fetch user details for editing
    $selectQuery = $conn->prepare("SELECT * FROM Users WHERE UserID = ?");
    $selectQuery->execute([$userID]);
    $user = $selectQuery->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, display the edit form
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit User</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }

                header {
                    color: black;
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
                <h1>Edit User</h1>
            </header>

            <form method="post" action="">
                <input type="hidden" name="userID" value="<?php echo $user['UserID']; ?>">

                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo $user['UserName']; ?>" required>

                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" value="<?php echo $user['FirstName']; ?>">

                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" value="<?php echo $user['LastName']; ?>">

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $user['Email']; ?>">

                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" name="phoneNumber" value="<?php echo $user['PhoneNumber']; ?>">

                <label for="role">User Role:</label>
                <select name="role" required>
                    <option value="admin" <?php echo ($user['UserRole'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="organizer" <?php echo ($user['UserRole'] == 'organizer') ? 'selected' : ''; ?>>Organizer
                    </option>
                </select>

                <button type="submit" name="editUser">Save Changes</button>
            </form>

            <?php
    } else {
        // User not found
        echo "User not found.";
    }
} else {
    // Invalid or missing UserID parameter
    echo "Invalid request.";
}

// Handle form submission to edit user details
if (isset($_POST['editUser'])) {
    $editedUserID = $_POST['userID'];
    $editedUsername = $_POST['username'];
    $editedFirstName = $_POST['firstName'];
    $editedLastName = $_POST['lastName'];
    $editedEmail = $_POST['email'];
    $editedPhoneNumber = $_POST['phoneNumber'];
    $editedUserRole = $_POST['role'];

    // Perform the update
    $updateQuery = $conn->prepare("UPDATE Users SET UserName = ?, FirstName = ?, LastName = ?, Email = ?, PhoneNumber = ?, UserRole = ? WHERE UserID = ?");
    $updateQuery->execute([$editedUsername, $editedFirstName, $editedLastName, $editedEmail, $editedPhoneNumber, $editedUserRole, $editedUserID]);

    // Redirect back to index.php after update
    header("Location: ../dashboard/dashboard_users.php");
    exit();
}

// Close the connection
$conn = null;
?>