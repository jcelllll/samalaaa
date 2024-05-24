<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "smldb";

$con = mysqli_connect($serverName, $userName, $password, $dbName);

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Delete data in resilience_info table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteResilience']) && $_POST['deleteResilience'] == 'deleteResilienceInformation') {
    if (isset($_POST['district'], $_POST['cdrrmd'], $_POST['chor'], $_POST['pcg'], $_POST['bfp'])) {
        $district = mysqli_real_escape_string($con, $_POST['district']);
        $cdrrmd = mysqli_real_escape_string($con, $_POST['cdrrmd']);
        $chor = mysqli_real_escape_string($con, $_POST['chor']);
        $pcg = mysqli_real_escape_string($con, $_POST['pcg']);
        $bfp = mysqli_real_escape_string($con, $_POST['bfp']);

        $deleteQuery = "DELETE FROM resilience_info WHERE District='$district' AND CDRRMD='$cdrrmd' AND CHOC='$chor' AND PCG='$pcg' AND BFP='$bfp'";

        if (mysqli_query($con, $deleteQuery)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
    } else {
        echo "Incomplete data provided for deleting resilience information";
    }
}

// Delete data in contact_info table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteContact']) && $_POST['deleteContact'] == 'deleteContactinfo') {
    if (isset($_POST['district'], $_POST['barangay'], $_POST['bdrrmc'])) {
        $district = mysqli_real_escape_string($con, $_POST['district']);
        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
        $bdrrmc = mysqli_real_escape_string($con, $_POST['bdrrmc']);

        $deleteQuery = "DELETE FROM contact_info WHERE District='$district' AND Barangay='$barangay' AND BDRRMC='$bdrrmc'";

        if (mysqli_query($con, $deleteQuery)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
    } else {
        echo "Incomplete data provided for deleting contact information";
    }
}

mysqli_close($con);
?>
