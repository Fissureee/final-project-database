<?php
include 'connect.php';
function OrganizerBookingTable($userID)
{
    include 'connect.php';
    $query = $conn->query("SELECT 
                            B.*,
                            V.VenueName,
                            U.UserName AS OrganizerName,
                            DATEDIFF(DAY, B.BookingDate, B.EndBooking) + 1 AS Duration,
                            (DATEDIFF(DAY, B.BookingDate, B.EndBooking) + 1) * V.PricePerDay AS TotalPrice
                            FROM 
                                Bookings B
                            JOIN 
                                Venues V ON B.VenueID = V.VenueID
                            JOIN 
                                Users U ON B.UserID = U.UserID
                            WHERE 
                                U.UserID = $userID;
                            ");
    $bookings = $query->fetchAll(PDO::FETCH_ASSOC);

    // Display bookings table
    if (!empty($bookings)) {
        echo "<table border='1'>";
        echo "<tr><th>Booking ID</th><th>Venue Name</th><th>Username</th><th>Booking Date</th><th>End Booking</th><th>Duration</th><<th>TotalPrice</th><<th>Action</th></tr>";
        foreach ($bookings as $booking) {
            echo "<tr>";
            echo "<td>{$booking['BookingID']}</td>";
            echo "<td>{$booking['VenueName']}</td>";
            echo "<td>{$booking['OrganizerName']}</td>";
            echo "<td>{$booking['BookingDate']}</td>";
            echo "<td>{$booking['EndBooking']}</td>";
            echo "<td>{$booking['Duration']}</td>";
            echo "<td>{$booking['TotalPrice']}</td>";
            echo "<td><a href='../orgFunctions/bookingUpdate.php?BookingID={$booking['BookingID']}' class='action edit'>Edit</a> <a href='../orgFunctions/bookingDelete.php?BookingID={$booking['BookingID']}' class='action delete'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No bookings found.";
    }
}

function OrganizerVenuesTable($search, $type)
{
    include 'connect.php';
    $venues = []; // Initialize an empty array to avoid undefined variable warning

    if (!$search == null) {
        switch ($type) {
            case 'name':
                $query = $conn->prepare("SELECT * FROM Venues WHERE VenueName LIKE ?");
                $query->execute(["%$search%"]);
                break;

            case 'location':
                $query = $conn->prepare("SELECT * FROM Venues WHERE Location LIKE ?");
                $query->execute(["%$search%"]);
                break;

            case 'capacity':
                $query = $conn->prepare("SELECT * FROM Venues WHERE Capacity LIKE ?");
                $query->execute(["$search"]);
                break;

            default:
                // Handle invalid category
                echo "Invalid category selected.";
                break;
        }
    } else {
        $query = $conn->query("SELECT * FROM Venues");
    }

    // Check if the query was successful before fetching results
    if ($query) {
        $venues = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Error executing the query.";
    }

    // Fetch data from the Users table

    // Display data in a table
    if (!empty($venues)) {
        echo "<table>";
        echo "<tr><th>Venue ID</th><th>Venue Name</th><th>Location</th><th>Capacity</th><th>Amenities</th><th>PricePerDay</th></tr>";
        foreach ($venues as $venue) {
            echo "<tr>";
            echo "<td>{$venue['VenueID']}</td>";
            echo "<td>{$venue['VenueName']}</td>";
            echo "<td>{$venue['Location']}</td>";
            echo "<td>{$venue['Capacity']}</td>";
            echo "<td>{$venue['Amenities']}</td>";
            echo "<td>Rp.{$venue['PricePerDay']},-</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No venues found.";
    }
}


function OrganizerProfile($userID)
{
    include 'connect.php';

    // Fetch data from the Users table
    $query = $conn->query("SELECT * FROM Users WHERE userID = $userID");
    $user = $query->fetchAll(PDO::FETCH_ASSOC);

    // Display data in a table
    if (!empty($user)) {
        echo "<h1>Username: {$user[0]['UserName']}</h1>";
        echo "<h1>First Name: {$user[0]['FirstName']}</h1>";
        echo "<h1>Last Name: {$user[0]['LastName']}</h1>";
        echo "<h1>Email: {$user[0]['Email']}</h1>";
        echo "<h1>Phone Number: {$user[0]['PhoneNumber']}</h1>";
    } else {
        echo "No user found.";
    }
}

?>