<?php
include 'connect.php';

// Function to fetch venues from the database
function getVenues($conn)
{
    $query = $conn->query("SELECT VenueID, VenueName FROM Venues");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Function to fetch users from the database
function getUsers($conn)
{
    $query = $conn->query("SELECT UserID, UserName FROM Users");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['BookingID']) && is_numeric($_GET['BookingID'])) {
    $bookingID = $_GET['BookingID'];

    // Fetch booking details for editing
    $selectQuery = $conn->prepare("SELECT * FROM Bookings WHERE BookingID = ?");
    $selectQuery->execute([$bookingID]);
    $booking = $selectQuery->fetch(PDO::FETCH_ASSOC);

    if ($booking) {
        // Booking found, display the edit form
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Booking</title>
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
                <h1>Edit Booking</h1>
            </header>

            <form method="post" action="">
                <input type="hidden" name="bookingID" value="<?php echo $booking['BookingID']; ?>">

                <label for="venueID">Venue ID:</label>
                <select name="venueID" style="width: 100%; height: 2.5rem; margin-bottom: 1rem;" required>
                    <?php
                    $venues = getVenues($conn);
                    foreach ($venues as $venue) {
                        echo "<option value=\"{$venue['VenueID']}\" ";
                        echo ($venue['VenueID'] == $booking['VenueID']) ? 'selected' : '';
                        echo ">{$venue['VenueName']}</option>";
                    }
                    ?>
                </select>

                <label for="userID">User ID:</label>
                <select name="userID" style="width: 100%; height: 2.5rem; margin-bottom: 1rem;" required>
                    <?php
                    $users = getUsers($conn);
                    foreach ($users as $user) {
                        echo "<option value=\"{$user['UserID']}\" ";
                        echo ($user['UserID'] == $booking['UserID']) ? 'selected' : '';
                        echo ">{$user['UserName']}</option>";
                    }
                    ?>
                </select>

                <label for="bookingDate">Booking Date:</label>
                <input type="date" name="bookingDate" value="<?php echo $booking['BookingDate']; ?>" required>

                <label for="endBooking">End Booking:</label>
                <input type="date" name="endBooking" value="<?php echo $booking['EndBooking']; ?>" required>

                <button type="submit" name="editBooking">Save Changes</button>
            </form>

            <?php
    } else {
        // Booking not found
        echo "Booking not found.";
    }
} else {
    // Invalid or missing BookingID parameter
    echo "Invalid request.";
}

// Handle form submission to edit booking details
if (isset($_POST['editBooking'])) {
    $editedBookingID = $_POST['bookingID'];
    $editedVenueID = $_POST['venueID'];
    $editedUserID = $_POST['userID'];
    $editedBookingDate = $_POST['bookingDate'];
    $editedEndBooking = $_POST['endBooking'];

    // Perform the update
    $updateQuery = $conn->prepare("UPDATE Bookings SET VenueID = ?, UserID = ?, BookingDate = ?, EndBooking = ? WHERE BookingID = ?");
    $updateQuery->execute([$editedVenueID, $editedUserID, $editedBookingDate, $editedEndBooking, $editedBookingID]);

    // Redirect back to index.php after update
    header("Location: ../dashboard/dashboard_bookings.php");
    exit();
}

// Close the connection
$conn = null;
?>