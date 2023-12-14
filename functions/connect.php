<?php
$serverName = "LAPTOP-I2KFVJQ2"; // replace with your SQL Server's name or IP address
$connectionOptions = array(
    "Database" => "EventVenue", // replace with your database name
    "Uid" => "", // replace with your SQL Server username
    "PWD" => ""  // replace with your SQL Server password
);

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database={$connectionOptions['Database']}", $connectionOptions['Uid'], $connectionOptions['PWD']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>