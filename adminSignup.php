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
    $adfirstName = mysqli_real_escape_string($con, $_POST["firstName"]);
    $admiddleName = mysqli_real_escape_string($con, $_POST["middleName"]);
    $adlastName = mysqli_real_escape_string($con, $_POST["lastName"]);
    $adsex = mysqli_real_escape_string($con, $_POST["sex"]);
    $adphoneNumber = mysqli_real_escape_string($con, $_POST["phoneNumber"]);
    $adusername = mysqli_real_escape_string($con, $_POST["username"]);
    $adpassword = mysqli_real_escape_string($con, $_POST["password"]);

    // Validate input
    if (!preg_match('/^[A-Za-z\s]+$/', $adfirstName)) {
        echo "First name should only contain letters.";
        exit;
    }
    
    if (!preg_match('/^[A-Za-z\s]+$/', $admiddleName)) {
        echo "Middle name should only contain letters.";
        exit;
    }
    
    if (!preg_match('/^[A-Za-z\s]+$/', $adlastName)) {
        echo "Last name should only contain letters.";
        exit;
    }

    if (!ctype_digit($adphoneNumber)) {
        echo "Phone number should only contain digits.";
        exit; 
    }

    if (strlen($adusername) < 6) {
        echo "Username should be at least 6 characters long.";
        exit;
    }
    
    if (strlen($adpassword) < 6) {
        echo "Password should be at least 6 characters long.";
        exit;
    }

    // Check if username already exists
    $query = "SELECT * FROM admin_info WHERE username = '$adusername'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        echo "Username already exists. Please choose a different username.";
    } else {
        $idNumberPrefix = "101";
        $randomDigits = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        $adidNumber = $idNumberPrefix . $randomDigits;

        // Check if the random id number already exists
        do {
            $query = "SELECT * FROM admin_info WHERE idNumber = '$adidNumber'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $randomDigits = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
                $adidNumber = $idNumberPrefix . $randomDigits;
            } else {
                break;
            }
        } while (true);


        $sql = "INSERT INTO admin_info (idNumber, FirstName, LastName, MiddleName, Sex, PhoneNumber, Username, Password) 
                VALUES ('$adidNumber', '$adfirstName', '$adlastName', '$admiddleName', '$adsex', '$adphoneNumber', '$adusername', '$adpassword')";

        if (mysqli_query($con, $sql)) {
            echo $adidNumber;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    mysqli_close($con);
}
?>
