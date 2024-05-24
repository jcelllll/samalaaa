<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <script>
        function addForm() {
            var form = document.getElementById('addResilienceInformation');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }
        
        function editForm(index) {
            var form = document.getElementById('editResilienceInformation');
            var district = document.getElementById('district_' + index).innerText.split(' ')[0];
            var cdrrmd = document.getElementById('cdrrmd_' + index).innerText.split(': ')[1];
            var chor = document.getElementById('chor_' + index).innerText.split(': ')[1];
            var pcg = document.getElementById('pcg_' + index).innerText.split(': ')[1];
            var bfp = document.getElementById('bfp_' + index).innerText.split(': ')[1];

            document.getElementById('edit_district').value = district;
            document.getElementById('edit_cdrrmd').value = cdrrmd;
            document.getElementById('edit_chor').value = chor;
            document.getElementById('edit_pcg').value = pcg;
            document.getElementById('edit_bfp').value = bfp;
            document.getElementById('original_district').value = district;

            form.style.display = 'block';
        }
        function editRow(index) {
            editForm(index);
        }
        function deleteForm(index){
            var form = document.getElementById('deleteResilienceInformation');
            var district = document.getElementById('district_' + index).innerText.split(' ')[0];
            var cdrrmd = document.getElementById('cdrrmd_' + index).innerText.split(': ')[1];
            var chor = document.getElementById('chor_' + index).innerText.split(': ')[1];
            var pcg = document.getElementById('pcg_' + index).innerText.split(': ')[1];
            var bfp = document.getElementById('bfp_' + index).innerText.split(': ')[1];

            document.getElementById('delete_district').value = district;
            document.getElementById('delete_cdrrmd').value = cdrrmd;
            document.getElementById('delete_chor').value = chor;
            document.getElementById('delete_pcg').value = pcg;
            document.getElementById('delete_bfp').value = bfp;

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

        $query = "SELECT * FROM resilience_info";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $index = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div id='row-$index'>";
                echo "<h5 id='district_$index'>{$row['District']} District</h5>";
                echo "<p id='cdrrmd_$index'>CDRRMD: {$row['CDRRMD']}</p>";
                echo "<p id='chor_$index'>CHOC: {$row['CHOC']}</p>";
                echo "<p id='pcg_$index'>PCG: {$row['PCG']}</p>";
                echo "<p id='bfp_$index'>BFP: {$row['BFP']}</p>";
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

    <form id="addResilienceInformation" method="POST" action="addData.php" style="display: none;">
        <input type="hidden" name="resilience" value="addResilienceInformation">
        <div>
            <label for="district">District</label>
            <input type="text" id="district" name="district" required>
        </div>
        <div>
            <label for="cdrrmd">CDRRMD</label>
            <input type="text" id="cdrrmd" name="cdrrmd" required>
        </div>
        <div>
            <label for="chor">CHOR</label>
            <input type="text" id="chor" name="chor" required>
        </div>
        <div>
            <label for="pcg">PCG</label>
            <input type="text" id="pcg" name="pcg" required>
        </div>
        <div>
            <label for="bfp">BFP</label>
            <input type="text" id="bfp" name="bfp" required>
        </div>
        <button type="submit">Add Data</button>
    </form>

    <form id="editResilienceInformation" method="POST" action="editData.php" style="display: none;">
        <input type="hidden" name="editResilience" value="editResilienceInformation">
        <input type="hidden" id="original_district" name="original_district">
        <div>
            <label for="edit_district">District</label>
            <input type="text" id="edit_district" name="district" required>
        </div>
        <div>
            <label for="edit_cdrrmd">CDRRMD</label>
            <input type="text" id="edit_cdrrmd" name="cdrrmd" required>
        </div>
        <div>
            <label for="edit_chor">CHOR</label>
            <input type="text" id="edit_chor" name="chor" required>
        </div>
        <div>
            <label for="edit_pcg">PCG</label>
            <input type="text" id="edit_pcg" name="pcg" required>
        </div>
        <div>
            <label for="edit_bfp">BFP</label>
            <input type="text" id="edit_bfp" name="bfp" required>
        </div>
        <button type="submit">Done</button>
    </form>

    <form id="deleteResilienceInformation" method="POST" action="deleteData.php" style="display: none;">
        <input type="hidden" name="deleteResilience" value="deleteResilienceInformation">
        <div>
            <label for="delete_district">District</label>
            <input type="text" id="delete_district" name="district" required>
        </div>
        <div>
            <label for="delete_cdrrmd">CDRRMD</label>
            <input type="text" id="delete_cdrrmd" name="cdrrmd" required>
        </div>
        <div>
            <label for="delete_chor">CHOR</label>
            <input type="text" id="delete_chor" name="chor" required>
        </div>
        <div>
            <label for="delete_pcg">PCG</label>
            <input type="text" id="delete_pcg" name="pcg" required>
        </div>
        <div>
            <label for="delete_bfp">BFP</label>
            <input type="text" id="delete_bfp" name="bfp" required>
        </div>
        <button type="submit">Delete</button>
    </form>
</body>
</html>
