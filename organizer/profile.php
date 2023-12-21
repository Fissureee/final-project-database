<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    $userID = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];

    // Check if the user is not authenticated
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page
        header("Location: login.php?error");
        exit();
    }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/dashboard_home.css">
    <title>Dashboard</title>
</head>

<body>
    <nav class="navbar">
        <ul>
            <li>
                <a href="home.php">Home</a>
            </li>
            <li>
                <a href="venues.php">Venues</a>
            </li>
            <li>
                <a href="profile.php" style="background-color: black; color: white;">Profile</a>
            </li>
            <li>
                <a href="../functions/logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="content">
        <div class="container">
            <div class="table-container">
                <?php
                require '../orgFunctions/read.php';
                OrganizerProfile($userID);
                ?>
                <a href="../orgFunctions/organizerProfile.php?UserID=<?php echo $userID; ?>" class="action edit">Edit
                    Profile</a>
                <a href="../orgFunctions/organizerPassword.php?UserID=<?php echo $userID; ?>"
                    class="action delete">Change
                    Password</a>
            </div>
        </div>
    </div>


</body>

</html>