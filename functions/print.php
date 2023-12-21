<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'connect.php';
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Booking Overview</h1>
        <div class="table-container">
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>Booking Date</th>
                    <th>End Date</th>
                    <th>Venue ID</th>
                    <th>Total Price</th>
                </tr>
                <?php
                // Include your PHP code to fetch bookings and calculate total price here
                // Example code to fetch bookings (modify as needed):
                $query = $conn->query("SELECT * FROM Bookings");
                $bookings = $query->fetchAll(PDO::FETCH_ASSOC);

                // Example code to calculate total price for each booking (modify as needed):
                foreach ($bookings as $booking) {
                    $bookingID = $booking['BookingID'];
                    $totalPriceQuery = $conn->query("SELECT dbo.CalculateBookingPrice($bookingID) AS TotalPrice;");
                    $totalPrice = $totalPriceQuery->fetch(PDO::FETCH_ASSOC)['TotalPrice'];

                    echo "<tr>";
                    echo "<td>{$booking['BookingID']}</td>";
                    echo "<td>{$booking['BookingDate']}</td>";
                    echo "<td>{$booking['EndBooking']}</td>";
                    echo "<td>{$booking['VenueID']}</td>";
                    echo "<td>Rp." . number_format($totalPrice, 0, ',', '.') . ",-</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <script>
        window.print();
        window.onafterprint = function () {
            window.history.back();
        } 
    </script>
</body>

</html>