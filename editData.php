<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "smldb";

$con = mysqli_connect($serverName, $userName, $password, $dbName);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Edit data within resilience_info
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editResilience']) && $_POST['editResilience'] == 'editResilienceInformation') {
        $original_district = mysqli_real_escape_string($con, $_POST['original_district']);
        $district = mysqli_real_escape_string($con, $_POST['district']);
        $cdrrmd = mysqli_real_escape_string($con, $_POST['cdrrmd']);
        $chor = mysqli_real_escape_string($con, $_POST['chor']);
        $pcg = mysqli_real_escape_string($con, $_POST['pcg']);
        $bfp = mysqli_real_escape_string($con, $_POST['bfp']);

        $updateQuery = "UPDATE resilience_info SET 
                        District='$district', 
                        CDRRMD='$cdrrmd', 
                        CHOR='$chor', 
                        PCG='$pcg', 
                        BFP='$bfp' 
                        WHERE District='$original_district'";

        if (mysqli_query($con, $updateQuery)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }

    //edit data within contact info
    if (isset($_POST['editContact']) && $_POST['editContact'] == 'editContactinfo') {
        $original_district = mysqli_real_escape_string($con, $_POST['original_district']);
        $district = mysqli_real_escape_string($con, $_POST['district']);
        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
        $bdrrmc = mysqli_real_escape_string($con, $_POST['bdrrmc']);

        $updateQuery = "UPDATE contact_info SET 
                        DISTRICT='$district', 
                        Barangay='$barangay', 
                        BDRRMC='$bdrrmc' 
                        WHERE District='$original_district'";

        if (mysqli_query($con, $updateQuery)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?>
