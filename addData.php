<?php
//to connect within smldatabase
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "smldb";

$con = mysqli_connect($serverName, $userName, $password, $dbName);

if(mysqli_connect_errno()){
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}
//function to add data within resilience_Info table within smldb
if(isset($_POST["resilience"]) && $_POST["resilience"] === "addResilienceInformation"){
    //get user input via form to be inserted within the database
    $district = $_POST["district"];
    $cdrrmd = $_POST["cdrrmd"];
    $chor = $_POST["chor"];
    $pcg = $_POST["pcg"];
    $bfp = $_POST["bfp"];
    $sql = "INSERT INTO resilience_info (District, CDRRMD, CHOC, PCG, BFP) VALUES ('$district', '$cdrrmd', '$chor', '$pcg', '$bfp')";

    //display if the data is succesfully inserted or not
    if(mysqli_query($con, $sql)){
        echo "Records inserted successfully.";
        echo "<a href='index.html'>Proceed</a>";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}
//add data within contact info
if(isset($_POST["contact"]) && $_POST["contact"] === "addContactinfo"){
    //get user input via form to be inserted within the database
    $district = $_POST["district"];
    $barangay = $_POST["barangay"];
    $bdrrmc = $_POST["bdrrmc"];
    $sql = "INSERT INTO contact_info (DISTRICT, Barangay, BDRRMC) VALUES ('$district', '$barangay', '$bdrrmc')";

    //display if the data is succesfully inserted or not
    if(mysqli_query($con, $sql)){
        echo "Records inserted successfully.";
        echo "<a href='index.html'>Proceed</a>";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}
mysqli_close($con);
?>
