<?php
include 'connect.php';

if (isset($_GET['VenueID']) && is_numeric($_GET['VenueID'])) {
    $venueID = $_GET['VenueID'];

    // Fetch venue details for editing
    $selectQuery = $conn->prepare("SELECT * FROM Venues WHERE VenueID = ?");
    $selectQuery->execute([$venueID]);
    $venue = $selectQuery->fetch(PDO::FETCH_ASSOC);

    if ($venue) {
        // Venue found, display the edit form
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Venue</title>
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

                input,
                textarea {
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
                <h1>Edit Venue</h1>
            </header>

            <form method="post" action="">
                <input type="hidden" name="venueID" value="<?php echo $venue['VenueID']; ?>">

                <label for="venueName">Venue Name:</label>
                <input type="text" name="venueName" value="<?php echo $venue['VenueName']; ?>" required>

                <label for="location">Location:</label>
                <input type="text" name="location" value="<?php echo $venue['Location']; ?>" required>

                <label for="capacity">Capacity:</label>
                <input type="number" name="capacity" value="<?php echo $venue['Capacity']; ?>" required>

                <label for="amenities">Amenities:</label>
                <textarea name="amenities"><?php echo $venue['Amenities']; ?></textarea>

                <label for="pricePerDay">Price Per Day (in Rupiah):</label>
                <input type="number" name="pricePerDay" value="<?php echo $venue['PricePerDay']; ?>" required>

                <button type="submit" name="editVenue">Save Changes</button>
            </form>

            <?php
    } else {
        // Venue not found
        echo "Venue not found.";
    }
} else {
    // Invalid or missing VenueID parameter
    echo "Invalid request.";
}

// Handle form submission to edit venue details
if (isset($_POST['editVenue'])) {
    $editedVenueID = $_POST['venueID'];
    $editedVenueName = $_POST['venueName'];
    $editedLocation = $_POST['location'];
    $editedCapacity = $_POST['capacity'];
    $editedAmenities = $_POST['amenities'];
    $editedPricePerDay = $_POST['pricePerDay'];

    // Perform the update
    $updateQuery = $conn->prepare("UPDATE Venues SET VenueName = ?, Location = ?, Capacity = ?, Amenities = ?, PricePerDay = ? WHERE VenueID = ?");
    $updateQuery->execute([$editedVenueName, $editedLocation, $editedCapacity, $editedAmenities, $editedPricePerDay, $editedVenueID]);

    // Redirect back to index.php after update
    header("Location: ../dashboard/dashboard_venues.php");
    exit();
}

// Close the connection
$conn = null;
?>