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
                <a href="dashboard_home.php" class="menu" style="color: white; background-color: black;">
                    <svg viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.99999 10L12 3L20 10L20 20H15V16C15 15.2044 14.6839 14.4413 14.1213 13.8787C13.5587 13.3161 12.7956 13 12 13C11.2043 13 10.4413 13.3161 9.87868 13.8787C9.31607 14.4413 9 15.2043 9 16V20H4L3.99999 10Z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
                <a href="dashboard_venues.php" class="menu">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 18H21M12 6V4M4 15V14C4 9.58172 7.58172 6 12 6V6C16.4183 6 20 9.58172 20 14V15H4Z"
                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
        <h1 style="position: absolute; top: 0;">
            <?php echo "Welcome, $userName" ?>
        </h1>
        <div class="card-container">
            <div class="card">
                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: none;
                                stroke: #000000;
                                stroke-linecap: round;
                                stroke-linejoin: round;
                                stroke-width: 2px;
                            }
                        </style>
                    </defs>
                    <title />
                    <g data-name="79-users" id="_79-users">
                        <circle class="cls-1" cx="16" cy="13" r="5" />
                        <path class="cls-1" d="M23,28A7,7,0,0,0,9,28Z" />
                        <path class="cls-1" d="M24,14a5,5,0,1,0-4-8" />
                        <path class="cls-1" d="M25,24h6a7,7,0,0,0-7-7" />
                        <path class="cls-1" d="M12,6a5,5,0,1,0-4,8" />
                        <path class="cls-1" d="M8,17a7,7,0,0,0-7,7H7" />
                    </g>
                </svg>
                <h1>Users</h1>
                <?php
                include '../functions/connect.php';

                // Fetch data from the Users table
                $query = $conn->query("SELECT COUNT(*) AS TotalRows FROM Users;");
                $users = $query->fetchAll(PDO::FETCH_ASSOC);

                // Display data
                if (!empty($users)) {
                    echo "Total Users: " . $users[0]['TotalRows'];
                } else {
                    echo "No users found.";
                }
                ?>
            </div>




            <div class="card">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 22L2 22" stroke="#000000" stroke-width="1.5" stroke-linecap="round" />
                    <path
                        d="M21 22V13M11.0044 5C11.0223 3.76022 11.1143 3.05733 11.5858 2.58579C12.1716 2 13.1144 2 15 2H17C18.8857 2 19.8285 2 20.4143 2.58579C21 3.17157 21 4.11438 21 6V9"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="round" />
                    <path
                        d="M15 22V16M3 22V13M3 9C3 7.11438 3 6.17157 3.58579 5.58579C4.17157 5 5.11438 5 7 5H11C12.8856 5 13.8284 5 14.4142 5.58579C15 6.17157 15 7.11438 15 9V12"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M9 22V19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M6 8H12" stroke="#000000" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M6 11H7M12 11H9.5" stroke="#000000C" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M6 14H12" stroke="#000000" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                <h1>Venues</h1>
                <?php

                // Fetch data from the Users table
                $query = $conn->query("SELECT COUNT(*) AS TotalRows FROM Venues;");
                $venues = $query->fetchAll(PDO::FETCH_ASSOC);

                // Display data
                if (!empty($venues)) {
                    echo "Total Venues: " . $venues[0]['TotalRows'];
                } else {
                    echo "No venues found.";
                }
                ?>
            </div>




            <div class="card">
                <svg fill="#000000" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <title>books</title>
                    <path
                        d="M30.639 26.361l-6.211-23.183c-0.384-1.398-1.644-2.408-3.139-2.408-0.299 0-0.589 0.040-0.864 0.116l0.023-0.005-2.896 0.776c-0.23 0.065-0.429 0.145-0.618 0.243l0.018-0.008c-0.594-0.698-1.472-1.14-2.453-1.143h-2.999c-0.76 0.003-1.457 0.27-2.006 0.713l0.006-0.005c-0.543-0.438-1.24-0.705-1.999-0.708h-3.001c-1.794 0.002-3.248 1.456-3.25 3.25v24c0.002 1.794 1.456 3.248 3.25 3.25h3c0.76-0.003 1.457-0.269 2.006-0.712l-0.006 0.005c0.543 0.438 1.24 0.704 1.999 0.708h2.999c1.794-0.002 3.248-1.456 3.25-3.25v-13.053l3.717 13.873c0.382 1.398 1.641 2.408 3.136 2.408 0.3 0 0.59-0.041 0.866-0.117l-0.023 0.005 2.898-0.775c1.398-0.386 2.407-1.646 2.407-3.141 0-0.298-0.040-0.587-0.115-0.862l0.005 0.023zM19.026 10.061l4.346-1.165 3.494 13.042-4.345 1.164zM18.199 4.072l2.895-0.775c0.056-0.015 0.121-0.023 0.188-0.023 0.346 0 0.639 0.231 0.731 0.547l0.001 0.005 0.712 2.656-4.346 1.165-0.632-2.357v-0.848c0.094-0.179 0.254-0.312 0.446-0.37l0.005-0.001zM11.5 3.25h2.998c0.412 0.006 0.744 0.338 0.75 0.749v2.75l-4.498 0.001v-2.75c0.006-0.412 0.338-0.744 0.749-0.75h0.001zM8.25 22.75h-4.5v-13.5l4.5-0.001zM10.75 9.25l4.498-0.001v13.501h-4.498zM4.5 3.25h3c0.412 0.006 0.744 0.338 0.75 0.749v2.75l-4.5 0.001v-2.75c0.006-0.412 0.338-0.744 0.749-0.75h0.001zM7.5 28.75h-3c-0.412-0.006-0.744-0.338-0.75-0.749v-2.751h4.5v2.75c-0.006 0.412-0.338 0.744-0.749 0.75h-0.001zM14.498 28.75h-2.998c-0.412-0.006-0.744-0.338-0.75-0.749v-2.751h4.498v2.75c-0.006 0.412-0.338 0.744-0.749 0.75h-0.001zM27.693 27.928l-2.896 0.775c-0.057 0.015-0.122 0.024-0.189 0.024-0.139 0-0.269-0.037-0.381-0.102l0.004 0.002c-0.171-0.099-0.298-0.259-0.35-0.45l-0.001-0.005-0.711-2.655 4.345-1.164 0.712 2.657c0.015 0.056 0.023 0.12 0.023 0.186 0 0.347-0.232 0.639-0.549 0.73l-0.005 0.001z">
                    </path>
                </svg>
                <h1>Bookings</h1>
                <?php

                // Fetch data from the Users table
                $query = $conn->query("SELECT COUNT(*) AS TotalRows FROM Bookings;");
                $bookings = $query->fetchAll(PDO::FETCH_ASSOC);

                // Display data
                if (!empty($bookings)) {
                    echo "Total Bookings: " . $bookings[0]['TotalRows'];
                } else {
                    echo "No bookings found.";
                }
                ?>
            </div>



            <div class="card">
                <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 491.4 491.4" xml:space="preserve">
                    <g>
                        <path
                            d="M89.6,224.6c11.6,0,21,9.4,21,21c0,11.6-9.4,21-21,21c-11.6,0-21-9.4-21-21C68.5,234,77.9,224.6,89.6,224.6z M34.7,369.4
                        H282c-0.8-2.6-1.2-5.3-1.2-8.1v-21.5H70.3c0.4-2.1,0.6-4.2,0.6-6.5c0-19.4-15.7-35.1-35.1-35.1c-2.1,0-4.2,0.2-6.2,0.6V192.4
                        c2,0.4,4.1,0.6,6.2,0.6c19.4,0,35.1-15.7,35.1-35.1c0-2.2-0.2-4.4-0.6-6.5h257.4c-0.7,2.7-1.1,5.6-1.1,8.6
                        c0,15.3,9.9,28.3,23.6,33.1c1.7-14.2,13.8-25.3,28.4-25.3H400v-11.3c0-19.1-15.5-34.6-34.7-34.6H34.7C15.6,121.9,0,137.4,0,156.5
                        v178.3C0,353.8,15.6,369.4,34.7,369.4z M309.5,246.5c-4.5,0-8.1,3.6-8.1,8.1v106.7c0,4.5,3.6,8.1,8.1,8.1h35.7
                        c4.5,0,8.1-3.6,8.1-8.1V254.6c0-4.5-3.6-8.1-8.1-8.1H309.5z M414.2,188.3h-35.7c-4.5,0-8.1,3.6-8.1,8.1v164.9
                        c0,4.5,3.6,8.1,8.1,8.1h35.7c4.5,0,8.1-3.6,8.1-8.1V196.4C422.3,192,418.7,188.3,414.2,188.3z M483.3,283.7h-35.7
                        c-4.5,0-8.1,3.6-8.1,8.1v69.6c0,4.5,3.6,8.1,8.1,8.1h35.7c4.5,0,8.1-3.6,8.1-8.1v-69.6C491.4,287.3,487.7,283.7,483.3,283.7z
                        M200,169.7c41.8,0,75.9,34,75.9,75.9c0,41.8-34,75.9-75.9,75.9c-41.8,0-75.9-34-75.9-75.9C124.1,203.8,158.1,169.7,200,169.7z
                        M224.1,214l-33.9,33.7L176,233.4l-14.8,14.7l14.2,14.3l14.7,14.8l14.8-14.7l33.9-33.7L224.1,214z" />
                    </g>
                </svg>
                <h1>Total Earning</h1>
                <?php

                $query = $conn->query("SELECT TOP 1 BookingID FROM Bookings;");
                $bookingID = $query->fetch(PDO::FETCH_ASSOC)['BookingID'];

                // Execute the function and store the result in a variable
                $totalPriceQuery = $conn->query("SELECT dbo.CalculateTotalBookingPrice() AS TotalPrice;");
                $totalPrice = $totalPriceQuery->fetch(PDO::FETCH_ASSOC)['TotalPrice'];

                // Display the result
                echo "Total: Rp." . number_format($totalPrice, 0, ',', '.') . ",-";

                ?>
            </div>


        </div>
    </div>


</body>

</html>