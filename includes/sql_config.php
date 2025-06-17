<?php
    $servername = "localhost";
    $username = getenv('USERNAME');
    $password = getenv('PASSWORD');
    $dbname = "rooms";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die ("MySQL connection failed: " . mysqli_connect_error());
    }
?>