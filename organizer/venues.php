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
                <a href="venues.php" style="background-color: black; color: white;">Venues</a>
            </li>
            <li>
                <a href="profile.php">Profile</a>
            </li>
            <li>
                <a href="../functions/logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="content">
        <form method="get">
            <label for="searchTerm">Search Term:</label>
            <input type="text" name="searchTerm">

            <label for="category">Category:</label>
            <select name="category">
                <option value="name">Name</option>
                <option value="location">Location</option>
                <option value="capacity">Capacity</option>
            </select>

            <button type="submit" name="search">Search</button>
        </form>
        <div class="container">
            <div class="table-container">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
                    $search = $_GET['searchTerm'];
                    $type = $_GET['category'];
                } else {
                    $search = null;
                    $type = null;
                }
                require '../orgFunctions/read.php';
                OrganizerVenuesTable($search, $type);
                ?>
            </div>
        </div>
    </div>


</body>

</html>