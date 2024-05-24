<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $con = mysqli_connect("localhost", "root", "", "smldb");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve and escape form data
    $firstName = mysqli_real_escape_string($con, $_POST["firstName"]);
    $middleName = mysqli_real_escape_string($con, $_POST["middleName"]);
    $lastName = mysqli_real_escape_string($con, $_POST["lastName"]);
    $sex = mysqli_real_escape_string($con, $_POST["sex"]);
    $phoneNumber = mysqli_real_escape_string($con, $_POST["phoneNumber"]);
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    // Validate input
    if (!preg_match('/^[A-Za-z\s]+$/', $firstName)) {
        echo "First name should only contain letters.";
        exit;
    }
    
    if (!preg_match('/^[A-Za-z\s]+$/', $middleName)) {
        echo "Middle name should only contain letters.";
        exit;
    }
    
    if (!preg_match('/^[A-Za-z\s]+$/', $lastName)) {
        echo "Last name should only contain letters.";
        exit;
    }

    if (!ctype_digit($phoneNumber)) {
        echo "Phone number should only contain digits.";
        exit; 
    }

    if (strlen($username) < 6) {
        echo "Username should be at least 6 characters long.";
        exit;
    }
    
    if (strlen($password) < 6) {
        echo "Password should be at least 6 characters long.";
        exit;
    }

    // Check if username already exists
    $query = "SELECT * FROM user_info WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        echo "Username already exists. Please choose a different username.";
    } else {
        $idNumberPrefix = "100";
        $randomDigits = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        $idNumber = $idNumberPrefix . $randomDigits;

        // Check if the random id number already exists
        do {
            $query = "SELECT * FROM user_info WHERE idNumber = '$idNumber'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $randomDigits = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
                $idNumber = $idNumberPrefix . $randomDigits;
            } else {
                break;
            }
        } while (true);


        $sql = "INSERT INTO user_info (idNumber, FirstName, LastName, MiddleName, Sex, PhoneNumber, Username, Password) 
                VALUES ('$idNumber', '$firstName', '$lastName', '$middleName', '$sex', '$phoneNumber', '$username', '$password')";

        if (mysqli_query($con, $sql)) {
            echo $idNumber;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    mysqli_close($con);
}
?>
