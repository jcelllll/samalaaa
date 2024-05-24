<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "smldb";

$con = mysqli_connect($serverName, $userName, $password, $dbName);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];
    $sex = $_POST["sex"];
    $phoneNumber = $_POST["phoneNumber"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Add validation checks here...

    // Check if username already exists
    $query = "SELECT * FROM user_info WHERE username=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already exists.";
    } else {
        $idNumberPrefix = "100";
        $randomDigits = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        $idNumber = $idNumberPrefix . $randomDigits;

        // Check if the random id number already exists
        do {
            $randomDigits = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
            $idNumber = $idNumberPrefix . $randomDigits;
            $query = "SELECT * FROM user_info WHERE idNumber=?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $idNumber);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } while (mysqli_num_rows($result) > 0);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $query = "INSERT INTO user_info (idNumber, firstName, lastName, middleName, sex, phoneNumber, username, password) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssss", $idNumber, $firstName, $lastName, $middleName, $sex, $phoneNumber, $username, $hashedPassword);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Registration successful";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
