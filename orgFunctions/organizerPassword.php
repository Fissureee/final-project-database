<?php
include 'connect.php';

if (isset($_GET['UserID']) && is_numeric($_GET['UserID'])) {
    $userID = $_GET['UserID'];

    // Fetch user details for editing
    $selectQuery = $conn->prepare("SELECT * FROM Users WHERE UserID = ?");
    $selectQuery->execute([$userID]);
    $user = $selectQuery->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, display the password change form
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Change Password</title>
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
                <h1>Change Password</h1>
            </header>

            <form method="post" action="">
                <input type="hidden" name="userID" value="<?php echo $user['UserID']; ?>">

                <label for="oldPassword">Old Password:</label>
                <input type="password" name="oldPassword" required>

                <label for="newPassword">New Password:</label>
                <input type="password" name="newPassword" required>

                <label for="confirmNewPassword">Confirm New Password:</label>
                <input type="password" name="confirmNewPassword" required>

                <button type="submit" name="changePassword">Change Password</button>
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

// Handle form submission to change the password
if (isset($_POST['changePassword'])) {
    $editedUserID = $_POST['userID'];
    $oldPassword = $_POST['oldPassword'];
    $password = $user['Password'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Check if the old password matches the stored password
    if (password_verify($oldPassword, $password)) {
        // Check if the new password and confirmation match
        if ($newPassword === $confirmNewPassword) {
            // Hash and update the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Perform the update for the password
            $updatePasswordQuery = $conn->prepare("UPDATE Users SET Password = ? WHERE UserID = ?");
            $updatePasswordQuery->execute([$hashedPassword, $editedUserID]);

            // Redirect back to the profile page after password change
            header("Location: ../organizer/profile.php");
            exit();
        } else {
            // New password and confirmation do not match
            echo "New password and confirmation do not match.";
        }
    } else {
        // Old password is incorrect
        echo "Old password is incorrect.";
    }
}

// Close the connection
$conn = null;
?>