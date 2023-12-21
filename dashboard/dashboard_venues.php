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
        header("Location: login.php");
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
            <li class="logo-container">
                <h1 class="logo">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 6H12.01M9 20L3 17V4L5 5M9 20L15 17M9 20V14M15 17L21 20V7L19 6M15 17V14M15 6.2C15 7.96731 13.5 9.4 12 11C10.5 9.4 9 7.96731 9 6.2C9 4.43269 10.3431 3 12 3C13.6569 3 15 4.43269 15 6.2Z"
                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Venue Dashboard</span>
                </h1>
            </li>

            <li>
                <a href="dashboard_home.php" class="menu">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.99999 10L12 3L20 10L20 20H15V16C15 15.2044 14.6839 14.4413 14.1213 13.8787C13.5587 13.3161 12.7956 13 12 13C11.2043 13 10.4413 13.3161 9.87868 13.8787C9.31607 14.4413 9 15.2043 9 16V20H4L3.99999 10Z"
                            stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Home</span>
                </a>
            </li>

            <li>
                <a href="dashboard_users.php" class="menu">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 21C4 17.134 7.13401 14 11 14C11.3395 14 11.6734 14.0242 12 14.0709M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7ZM12.5898 21L14.6148 20.595C14.7914 20.5597 14.8797 20.542 14.962 20.5097C15.0351 20.4811 15.1045 20.4439 15.1689 20.399C15.2414 20.3484 15.3051 20.2848 15.4324 20.1574L19.5898 16C20.1421 15.4477 20.1421 14.5523 19.5898 14C19.0376 13.4477 18.1421 13.4477 17.5898 14L13.4324 18.1574C13.3051 18.2848 13.2414 18.3484 13.1908 18.421C13.1459 18.4853 13.1088 18.5548 13.0801 18.6279C13.0478 18.7102 13.0302 18.7985 12.9948 18.975L12.5898 21Z"
                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Manage Users</span>
                </a>
            </li>

            <li>
                <a href="dashboard_venues.php" class="menu" style="color: white; background-color: black;">
                    <svg viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 18H21M12 6V4M4 15V14C4 9.58172 7.58172 6 12 6V6C16.4183 6 20 9.58172 20 14V15H4Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Manage Venues</span>
                </a>
            </li>

            <li>
                <a href="dashboard_bookings.php" class="menu">
                    <svg viewBox="0 0 1024 1024" fill="#000000" class="icon" version="1.1"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M300 462.4h424.8v48H300v-48zM300 673.6H560v48H300v-48z" fill="" />
                        <path
                            d="M818.4 981.6H205.6c-12.8 0-24.8-2.4-36.8-7.2-11.2-4.8-21.6-11.2-29.6-20-8.8-8.8-15.2-18.4-20-29.6-4.8-12-7.2-24-7.2-36.8V250.4c0-12.8 2.4-24.8 7.2-36.8 4.8-11.2 11.2-21.6 20-29.6 8.8-8.8 18.4-15.2 29.6-20 12-4.8 24-7.2 36.8-7.2h92.8v47.2H205.6c-25.6 0-47.2 20.8-47.2 47.2v637.6c0 25.6 20.8 47.2 47.2 47.2h612c25.6 0 47.2-20.8 47.2-47.2V250.4c0-25.6-20.8-47.2-47.2-47.2H725.6v-47.2h92.8c12.8 0 24.8 2.4 36.8 7.2 11.2 4.8 21.6 11.2 29.6 20 8.8 8.8 15.2 18.4 20 29.6 4.8 12 7.2 24 7.2 36.8v637.6c0 12.8-2.4 24.8-7.2 36.8-4.8 11.2-11.2 21.6-20 29.6-8.8 8.8-18.4 15.2-29.6 20-12 5.6-24 8-36.8 8z"
                            fill="" />
                        <path
                            d="M747.2 297.6H276.8V144c0-32.8 26.4-59.2 59.2-59.2h60.8c21.6-43.2 66.4-71.2 116-71.2 49.6 0 94.4 28 116 71.2h60.8c32.8 0 59.2 26.4 59.2 59.2l-1.6 153.6z m-423.2-47.2h376.8V144c0-6.4-5.6-12-12-12H595.2l-5.6-16c-11.2-32.8-42.4-55.2-77.6-55.2-35.2 0-66.4 22.4-77.6 55.2l-5.6 16H335.2c-6.4 0-12 5.6-12 12v106.4z"
                            fill="" />
                    </svg>
                    <span>Booking Overview</span>
                </a>
            </li>

            <li>
                <a href="../functions/logout.php" class="menu">
                    <svg fill="#000000" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.651 16.989h17.326c0.553 0 1-0.448 1-1s-0.447-1-1-1h-17.264l3.617-3.617c0.391-0.39 0.391-1.024 0-1.414s-1.024-0.39-1.414 0l-5.907 6.062 5.907 6.063c0.196 0.195 0.451 0.293 0.707 0.293s0.511-0.098 0.707-0.293c0.391-0.39 0.391-1.023 0-1.414zM29.989 0h-17c-1.105 0-2 0.895-2 2v9h2.013v-7.78c0-0.668 0.542-1.21 1.21-1.21h14.523c0.669 0 1.21 0.542 1.21 1.21l0.032 25.572c0 0.668-0.541 1.21-1.21 1.21h-14.553c-0.668 0-1.21-0.542-1.21-1.21v-7.824l-2.013 0.003v9.030c0 1.105 0.895 2 2 2h16.999c1.105 0 2.001-0.895 2.001-2v-28c-0-1.105-0.896-2-2-2z">
                        </path>
                    </svg>
                    <span>LogOut</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="content">
        <div class="container">
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
            <a href="../functions/venueCreate.php" class="create">+ Create New Venue</a>
            <div class="table-container">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
                    $search = $_GET['searchTerm'];
                    $type = $_GET['category'];
                } else {
                    $search = null;
                    $type = null;
                }
                require '../functions/read.php';
                VenuesTable($search, $type);
                ?>
            </div>
        </div>
    </div>


</body>

</html>