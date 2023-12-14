<?php
include 'connect.php';

function UsersTable()
{
    include 'connect.php';

    // Fetch data from the Users table
    $query = $conn->query("SELECT * FROM Users");
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

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

function VenuesTable()
{
    include 'connect.php';

    // Fetch data from the Users table
    $query = $conn->query("SELECT * FROM Venues");
    $venues = $query->fetchAll(PDO::FETCH_ASSOC);

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

function BookingsTable()
{
    include 'connect.php';
    $query = $conn->query("SELECT B.*, V.VenueName, U.UserName AS OrganizerName FROM Bookings B JOIN Venues V ON B.VenueID = V.VenueID JOIN Users U ON B.UserID = U.UserID;");
    $bookings = $query->fetchAll(PDO::FETCH_ASSOC);

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