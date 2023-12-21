<?php
include 'connect.php';

function UsersTable($search, $type)
{
    include 'connect.php';
    $users = []; // Initialize an empty array to avoid undefined variable warning

    if (!$search == null) {
        switch ($type) {
            case 'username':
                $query = $conn->prepare("SELECT * FROM Users WHERE UserName LIKE ?");
                $query->execute(["%$search%"]);
                break;

            case 'role':
                $query = $conn->prepare("SELECT * FROM Users WHERE UserRole LIKE ?");
                $query->execute(["%$search%"]);
                break;

            case 'firstname':
                $query = $conn->prepare("SELECT * FROM Users WHERE FirstName LIKE ?");
                $query->execute(["$search"]);
                break;

            case 'lastname':
                $query = $conn->prepare("SELECT * FROM Users WHERE LastName LIKE ?");
                $query->execute(["$search"]);
                break;

            case 'email':
                $query = $conn->prepare("SELECT * FROM Users WHERE Email LIKE ?");
                $query->execute(["$search"]);
                break;

            case 'phone':
                $query = $conn->prepare("SELECT * FROM Users WHERE PhoneNumber LIKE ?");
                $query->execute(["$search"]);
                break;

            default:
                // Handle invalid category
                echo "Invalid category selected.";
                break;
        }
    } else {
        $query = $conn->query("SELECT * FROM Users");
    }

    // Check if the query was successful before fetching results
    if ($query) {
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Error executing the query.";
    }

    // Display data in a table
    if (!empty($users)) {
        echo "<table>";
        echo "<tr><th>User ID</th><th>User Name</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th></th><th>User Role</th><th>Action</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>{$user['UserID']}</td>";
            echo "<td>{$user['UserName']}</td>";
            echo "<td>{$user['FirstName']}</td>";
            echo "<td>{$user['LastName']}</td>";
            echo "<td>{$user['Email']}</td>";
            echo "<td>{$user['PhoneNumber']}</td>";
            echo "<td>{$user['UserRole']}</td>";
            echo "<td><a href='../functions/userUpdate.php?UserID={$user['UserID']}' class='action edit'>Edit</a> <a href='../functions/userDelete.php?UserID={$user['UserID']}' class='action delete'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No users found.";
    }
}

function VenuesTable($search, $type)
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

    // Display data in a table
    if (!empty($venues)) {
        echo "<table>";
        echo "<tr><th>Venue ID</th><th>Venue Name</th><th>Location</th><th>Capacity</th><th>Amenities</th><th>PricePerDay</th><th>Action</th></tr>";
        foreach ($venues as $venue) {
            echo "<tr>";
            echo "<td>{$venue['VenueID']}</td>";
            echo "<td>{$venue['VenueName']}</td>";
            echo "<td>{$venue['Location']}</td>";
            echo "<td>{$venue['Capacity']}</td>";
            echo "<td>{$venue['Amenities']}</td>";
            echo "<td>Rp.{$venue['PricePerDay']},-</td>";
            echo "<td><a href='../functions/venueUpdate.php?VenueID={$venue['VenueID']}' class='action edit'>Edit</a> <a href='../functions/venueDelete.php?VenueID={$venue['VenueID']}' class='action delete'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No venues found.";
    }
}

function BookingsTable($search, $type)
{
    include 'connect.php';
    $bookings = []; // Initialize an empty array to avoid undefined variable warning

    if (!$search == null) {
        switch ($type) {
            case 'venue':
                $query = $conn->prepare("SELECT B.*, V.VenueName, U.UserName AS OrganizerName FROM Bookings B JOIN Venues V ON B.VenueID = V.VenueID JOIN Users U ON B.UserID = U.UserID WHERE VenueName LIKE ?");
                $query->execute(["%$search%"]);
                break;

            case 'user':
                $query = $conn->prepare("SELECT B.*, V.VenueName, U.UserName AS OrganizerName FROM Bookings B JOIN Venues V ON B.VenueID = V.VenueID JOIN Users U ON B.UserID = U.UserID WHERE UserName LIKE ?");
                $query->execute(["%$search%"]);
                break;

            default:
                // Handle invalid category
                echo "Invalid category selected.";
                break;
        }
    } else {
        $query = $conn->query("SELECT B.*, V.VenueName, U.UserName AS OrganizerName FROM Bookings B JOIN Venues V ON B.VenueID = V.VenueID JOIN Users U ON B.UserID = U.UserID;");
    }

    // Check if the query was successful before fetching results
    if ($query) {
        $bookings = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Error executing the query.";
    }


    // Display bookings table
    if (!empty($bookings)) {
        echo "<table border='1'>";
        echo "<tr><th>Booking ID</th><th>Venue Name</th><th>Username</th><th>Booking Date</th><th>End Booking</th><th>Action</th></tr>";
        foreach ($bookings as $booking) {
            echo "<tr>";
            echo "<td>{$booking['BookingID']}</td>";
            echo "<td>{$booking['VenueName']}</td>";
            echo "<td>{$booking['OrganizerName']}</td>";
            echo "<td>{$booking['BookingDate']}</td>";
            echo "<td>{$booking['EndBooking']}</td>";
            echo "<td><a href='../functions/bookingUpdate.php?BookingID={$booking['BookingID']}' class='action edit'>Edit</a> <a href='../functions/bookingDelete.php?BookingID={$booking['BookingID']}' class='action delete'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No bookings found.";
    }

}
?>