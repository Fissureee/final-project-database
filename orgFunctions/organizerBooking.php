<?php
include 'connect.php';

// Start session
session_start();

// Fetch available venues
$venuesQuery = $conn->query("SELECT VenueID, VenueName FROM Venues");
$venues = $venuesQuery->fetchAll(PDO::FETCH_ASSOC);

// Fetch the organizer's user ID from the session
$organizerUserID = $_SESSION['user_id'];

// Handle form submission to add a new booking
if (isset($_POST['addBooking'])) {
    $venueID = $_POST['venueID'];
    $bookingDate = $_POST['bookingDate'];
    $endBookingDate = $_POST['endBookingDate'];

    // Validate that the end booking date is not earlier than the booking date
    if (strtotime($endBookingDate) < strtotime($bookingDate)) {
        // Handle the error, for example, you can redirect back with an error message
        header("Location:  ../organizer/home.php.php?error=EndBookingDateEarlier");
        exit();
    }

    // Check if the venue is already booked in the same time frame or overlapping
    $checkBookingQuery = $conn->prepare("SELECT * FROM Bookings WHERE VenueID = ? AND ((BookingDate <= ? AND EndBooking >= ?) OR (BookingDate <= ? AND EndBooking >= ?) OR (BookingDate >= ? AND EndBooking <= ?))");
    $checkBookingQuery->execute([$venueID, $bookingDate, $bookingDate, $endBookingDate, $endBookingDate, $bookingDate, $endBookingDate]);
    $existingBookings = $checkBookingQuery->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($existingBookings)) {
        // Handle the error, for example, you can redirect back with an error message
        header("Location:  ../organizer/home.php?error=VenueAlreadyBooked");
        exit();
    }

    // Perform the insertion for Bookings with the organizer's user ID
    $insertBookingQuery = $conn->prepare("INSERT INTO Bookings (VenueID, UserID, BookingDate, EndBooking) VALUES (?, ?, ?, ?)");
    $insertBookingQuery->execute([$venueID, $organizerUserID, $bookingDate, $endBookingDate]);

    // Redirect back to dashboard for Bookings
    header("Location:  ../organizer/home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking</title>
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
        <h1>Add Booking</h1>
    </header>

    <!-- Form for adding a new booking -->
    <form method="post" action="">
        <label for="venueID">Venue:</label>
        <select name="venueID" required>
            <?php foreach ($venues as $venue): ?>
                <option value="<?php echo $venue['VenueID']; ?>">
                    <?php echo $venue['VenueName']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="bookingDate">Booking Date:</label>
        <input type="date" name="bookingDate" required>

        <label for="endBookingDate">End Booking Date:</label>
        <input type="date" name="endBookingDate" required>

        <button type="submit" name="addBooking">Add Booking</button>
    </form>

</body>

</html>