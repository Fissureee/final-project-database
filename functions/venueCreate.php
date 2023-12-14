<?php
include 'connect.php';

// Handle form submission to add a new venue
if (isset($_POST['addVenue'])) {
    $newVenueName = $_POST['venueName'];
    $newLocation = $_POST['location'];
    $newCapacity = $_POST['capacity'];
    $newAmenities = $_POST['amenities'];
    $newPricePerDay = $_POST['pricePerDay'];

    // Perform the insertion for Venues
    $insertVenueQuery = $conn->prepare("INSERT INTO Venues (VenueName, Location, Capacity, Amenities, PricePerDay) VALUES (?, ?, ?, ?, ?)");
    $insertVenueQuery->execute([$newVenueName, $newLocation, $newCapacity, $newAmenities, $newPricePerDay]);

    // Redirect back to dashboard for Venues
    header("Location: ../dashboard/dashboard_venues.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Venue</title>
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
        <h1>Add Venue</h1>
    </header>

    <!-- Form for adding a new venue -->
    <form method="post" action="">
        <label for="venueName">Venue Name:</label>
        <input type="text" name="venueName" required>

        <label for="location">Location:</label>
        <input type="text" name="location" required>

        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" required>

        <label for="amenities">Amenities:</label>
        <input type="text" name="amenities" required>

        <label for="pricePerDay">Price Per Day (in Rupiah):</label>
        <input type="number" name="pricePerDay" required>

        <button type="submit" name="addVenue">Add Venue</button>
    </form>

</body>

</html>