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
    $lastName = mysqli_real_escape_string($con, $_POST['adlastName']);
    $firstName = mysqli_real_escape_string($con, $_POST['adfirstName']);
    $middleName = mysqli_real_escape_string($con, $_POST['admiddleName']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['adphoneNumber']);
    $sex = mysqli_real_escape_string($con, $_POST['adsex']);
    $username = mysqli_real_escape_string($con, $_POST['adusername']);
    $password = mysqli_real_escape_string($con, $_POST['adpassword']);
    $idNumber = mysqli_real_escape_string($con, $_POST['adidNumber']);

    $updateEditQuery = "UPDATE admin_info SET 
                    lastName='$lastName', 
                    firstName='$firstName', 
                    middleName='$middleName', 
                    phoneNumber='$phoneNumber', 
                    sex='$sex',
                    username='$username',
                    password='$password' 
                    WHERE idNumber='$idNumber'";

    if (mysqli_query($con, $updateEditQuery)) {
        echo "Record updated successfully";
        echo "<a href='index.html'>Proceed</a>";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
