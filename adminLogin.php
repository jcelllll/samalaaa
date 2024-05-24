<?php
if (isset($_GET["uname"]) && isset($_GET["upass"])) {
    $uname = $_GET["uname"];
    $upass = $_GET["upass"];
    $flag = false;

    $con = mysqli_connect("localhost", "root", "", "smldb");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $result = mysqli_query($con, "SELECT * FROM admin_info");
    while ($x = mysqli_fetch_array($result)) {
        if ($uname == $x["username"] && $upass == $x["password"]) {
            $flag = true;
            break;
        }
    }
    mysqli_close($con);
    
    if ($flag) {
        echo "Valid user!";
    } else {
        echo "Invalid username or password!";
    }
} else {
    echo "Username and password are required!";
}
?>
