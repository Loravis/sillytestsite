<?php
    $servername = "localhost";
    $sql_username = getenv('DB_USERNAME');
    $sql_password = getenv('DB_PASSWORD');
    $dbname = "rooms";

    $conn = mysqli_connect($servername, $sql_username, $sql_password, $dbname);

    if (!$conn) {
        die ("MySQL connection failed: " . mysqli_connect_error());
    }
?>