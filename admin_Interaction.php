<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <script>
        function addForm() {
            var form = document.getElementById('addAdminInfo');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }
        
        function addForm() {
            var form = document.getElementById('addAdminInfo');
            form.style.display = 'block';
        }
        
        function editForm(index) {
            var form = document.getElementById('editAdminInfo');
            var lastName = document.getElementById('lastName_' + index).innerText.split(': ')[1];
            var firstName = document.getElementById('firstName_' + index).innerText.split(': ')[1];
            var middleName = document.getElementById('middleName_' + index).innerText.split(': ')[1];
            var suffix = document.getElementById('suffix_' + index).innerText.split(': ')[1];
            var phoneNumber = document.getElementById('phoneNumber_' + index).innerText.split(': ')[1];
            var idNumber = document.getElementById('idNumber_' + index).innerText;

            document.getElementById('edit_lastName').value = lastName;
            document.getElementById('edit_firstName').value = firstName;
            document.getElementById('edit_middleName').value = middleName;
            document.getElementById('edit_suffix').value = suffix;
            document.getElementById('edit_phoneNumber').value = phoneNumber;
            document.getElementById('edit_idNumber').value = idNumber; // Display idNumber

            form.style.display = 'block';
        }

        function editRow(index) {
            editForm(index);
        }

        function deleteForm(index){
            var form = document.getElementById('deleteAdminInfo');
            var lastName = document.getElementById('lastName_' + index).innerText.split(': ')[1];
            var firstName = document.getElementById('firstName_' + index).innerText.split(': ')[1];
            var middleName = document.getElementById('middleName_' + index).innerText.split(': ')[1];
            var suffix = document.getElementById('suffix_' + index).innerText.split(': ')[1];
            var phoneNumber = document.getElementById('phoneNumber_' + index).innerText.split(': ')[1];
            var idNumber = document.getElementById('idNumber_' + index).innerText;

            document.getElementById('delete_lastName').value = lastName;
            document.getElementById('delete_firstName').value = firstName;
            document.getElementById('delete_middleName').value = middleName;
            document.getElementById('delete_suffix').value = suffix;
            document.getElementById('delete_phoneNumber').value = phoneNumber;
            document.getElementById('delete_idNumber').value = idNumber;
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

        $query = "SELECT * FROM admin_info";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $index = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div id='row-$index'>";
                echo "<h5 id='idNumber_$index'>{$row['idNumber']}</h5>";
                echo "<p id='phoneNumber_$index'>Phone Number: {$row['phoneNumber']}</p>";
                echo "<p id='lastName_$index'>Last Name: {$row['lastName']}</p>";
                echo "<p id='firstName_$index'>First Name: {$row['firstName']}</p>";
                echo "<p id='middleName_$index'>Middle Name: {$row['middleName']}</p>";
                echo "<p id='suffix_$index'>Suffix: {$row['suffix']}</p>";
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

    <form id="addAdminInfo" method="POST" action="addData.php" style="display: none;">
        <input type="hidden" name="id" value="addAdminInfo">
        <div>
            <label for="lastName">Last Name: </label>
            <input type="text" id="lastName" name="lastName" required>
        </div>
        <div>
            <label for="firstName">First Name: </label>
            <input type="text" id="firstName" name="firstName" required>
        </div>
        <div>
            <label for="middleName">Middle Name</label>
            <input type="text" id="middleName" name="middleName">
        </div>
        <div>
        <label for="suffix">Suffix</label>
        <input type="radio" id="suffix_sr" name="suffix" value="Sr.">
        <label for="suffix_sr">Sr.</label>

        <input type="radio" id="suffix_jr" name="suffix" value="Jr.">
        <label for="suffix_jr">Jr.</label>

        <input type="radio" id="suffix_ii" name="suffix" value="II">
        <label for="suffix_ii">II</label>

        <input type="radio" id="suffix_iii" name="suffix" value="III">
        <label for="suffix_iii">III</label>

        <input type="radio" id="suffix_iv" name="suffix" value="IV">
        <label for="suffix_iv">IV</label>

        <input type="radio" id="suffix_none" name="suffix" value="None">
        <label for="suffix_none">None</label>
        </div>
        <div>
            <label for="phoneNumber">Phone Number: </label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>
        </div>
        <button type="submit">Add</button>
    </form>

    <form id="editAdminInfo" method="POST" action="editData.php" style="display: none;">
        <input type="hidden" name="form_id" value="editAdminInfo">
        <div>
            <label for="edit_lastName">Last Name: </label>
            <input type="text" id="edit_lastName" name="lastName" required>
        </div>
        <div>
            <label for="edit_firstName">First Name: </label>
            <input type="text" id="edit_firstName" name="firstName" required>
        </div>
        <div>
            <label for="edit_middleName">Middle Name</label>
            <input type="text" id="edit_middleName" name="middleName">
        </div>
        <div>
            <label for="edit_suffix">Suffix</label>
            <input type="text" id="edit_suffix" name="suffix">
        </div>
        <div>
            <label for="edit_phoneNumber">Phone Number: </label>
            <input type="text" id="edit_phoneNumber" name="phoneNumber">
        </div>
        <div>
        <label for="edit_idNumber">ID Number: </label>
        <input type="text" id="edit_idNumber" name="idNumber">
    </div>
        <button type="submit">Update</button>
    </form>


    <form id="deleteAdminInfo" method="POST" action="deleteData.php" style="display: none;">
        <input type="hidden" name="form_id" value="deleteAdminInfo">
        <div>
            <label for="delete_lastName">Last Name: </label>
            <input type="text" id="delete_lastName" name="lastName">
        </div>
        <div>
            <label for="delete_firstName">First Name: </label>
            <input type="text" id="delete_firstName" name="firstName">
        </div>
        <div>
            <label for="delete_middleName">Middle Name</label>
            <input type="text" id="delete_middleName" name="middleName">
        </div>
        
        <div>
            <label for="delete_suffix">Suffix</label>
            <input type="text" id="delete_suffix" name="suffix">
        </div>
        <div>
            <label for="delete_phoneNumber">Phone Number: </label>
            <input type="text" id="delete_phoneNumber" name="phoneNumber">
        </div>
        <div>
            <label for="delete_idNumber">ID Number: </label>
            <input type="text" id="delete_idNumber" name="idNumber">
        </div>
        
        <button type="submit">Delete</button>
    </form>
</body>
</html>
