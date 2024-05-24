<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <script>
        function addForm() {
            var form = document.getElementById('addContactinfo');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }
        
        function editForm(index) {
            var form = document.getElementById('editContactinfo');
            var district = document.getElementById('district_' + index).innerText.split(' ')[0];
            var barangay = document.getElementById('barangay_' + index).innerText.split(': ')[1];
            var bdrrmc = document.getElementById('bdrrmc_' + index).innerText.split(': ')[1];

            document.getElementById('edit_district').value = district;
            document.getElementById('edit_barangay').value = barangay;
            document.getElementById('edit_bdrrmc').value = bdrrmc;

            form.style.display = 'block';
        }
        function editRow(index) {
            editForm(index);
        }
        function deleteForm(index){
            var form = document.getElementById('deleteContactinfo');
            var district = document.getElementById('district_' + index).innerText.split(' ')[0];
            var barangay = document.getElementById('barangay_' + index).innerText.split(': ')[1];
            var bdrrmc = document.getElementById('bdrrmc_' + index).innerText.split(': ')[1];

            document.getElementById('delete_district').value = district;
            document.getElementById('delete_barangay').value = barangay;
            document.getElementById('delete_bdrrmc').value = bdrrmc;

            form.style.display = 'block';
        }
        function deleteRow(index){
                deleteForm(index);
        }
    </script>
</head>
<body>
    <div class="container">
        <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "smldb";

        $con = mysqli_connect($serverName, $userName, $password, $dbName);

        if(mysqli_connect_errno()){
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM contact_info";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $index = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div id='row-$index'>";
                echo "<h5 id='district_$index'>{$row['DISTRICT']} District</h5>";
                echo "<p id='barangay_$index'>Barangay: {$row['Barangay']}</p>";
                echo "<p id='bdrrmc_$index'>BDRRMC: {$row['BDRRMC']}</p>";
                echo "<button id='edit-$index' onclick='editRow($index)'>Edit</button>";
                echo "<button id='delete-$index' onclick='deleteRow($index)'>Delete</button>";
                echo "</div>";
                $index++;
            }
        } else {
            echo "<p>No data found</p>";
        }
        ?>
    </div>

    <button onclick="addForm()">Add data</button>

    <form id="addContactinfo" method="POST" action="addData.php" style="display: none;">
        <input type="hidden" name="contact" value="addContactinfo">
        <div>
            <label for="district">District</label>
            <input type="text" id="district" name="district" required>
        </div>
        <div>
            <label for="barangay">Barangay</label>
            <input type="text" id="barangay" name="barangay" required>
        </div>
        <div>
            <label for="bdrrmcr">BDRRMC</label>
            <input type="text" id="bdrrmc" name="bdrrmc" required>
        </div>
        <button type="submit">Add Data</button>
    </form>

    <form id="editContactinfo" method="POST" action="editData.php" style="display: none;">
        <input type="hidden" name="editContact" value="editContactinfo">
        <input type="hidden" id="original_district" name="original_district">
        <div>
            <label for="edit_district">District</label>
            <input type="text" id="edit_district" name="district" required>
        </div>
        <div>
            <label for="edit_barangay">Barangay</label>
            <input type="text" id="edit_barangay" name="barangay" required>
        </div>
        <div>
            <label for="edit_bdrrmc">BDRRMC</label>
            <input type="text" id="edit_bdrrmc" name="bdrrmc" required>
        </div>
        <button type="submit">Done</button>
    </form>

    <form id="deleteContactinfo" method="POST" action="deleteData.php" style="display: none;">
        <input type="hidden" name="deleteContact" value="deleteContactinfo">
        <div>
            <label for="delete_district">District</label>
            <input type="text" id="delete_district" name="district" required>
        </div>
        <div>
            <label for="delete_barangay">Barangay</label>
            <input type="text" id="delete_barangay" name="barangay" required>
        </div>
        <div>
            <label for="delete_bdrrmc">BDRRMC</label>
            <input type="text" id="delete_bdrrmc" name="bdrrmc" required>
        </div>
        <button type="submit">Delete</button>
    </form>
</body>
</html>
