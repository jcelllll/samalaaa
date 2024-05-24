<?php
    // Establish connection to the database
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "smldb";

    $con = mysqli_connect($serverName, $userName, $password, $dbName);
    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    // Retrieve username from POST data
    $username = $_POST['username'];

    // Prepare SQL query to check if the username exists
    $sql = "SELECT * FROM admin_Info WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        echo "Username already exists";
    } else {
        // Username is available
        echo "Username is available";
    }

    // Close the database connection
    mysqli_close($con);
?>