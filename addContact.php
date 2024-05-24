<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form id="registrationForm" onsubmit="register(event)">
        <p>
            <label>First Name: </label>
            <input type="text" id="firstName" name="firstName" required />
        </p>
        <p>
            <label>Middle Name: </label>
            <input type="text" id="middleName" name="middleName" />
        </p>
        <p>
            <label>Last Name: </label>
            <input type="text" id="lastName" name="lastName" required />
        </p>
        <p>
            <label>Sex: </label>
            <select id="sex" name="sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </p>
        <p>
            <label>Phone Number: </label>
            <input type="text" id="phoneNumber" name="phoneNumber" required />
        </p>
        <p>
            <label>Username: </label>
            <input type="text" id="username" name="username" required />
        </p>
        <p>
            <label>Password: </label>
            <input type="password" id="password" name="password" required />
        </p>
            <input type="text" id="idNumber" name="idNumber" style="display: none;" disabled />
        <p>
            <input type="submit" value="Register" />
            <input type="reset" value="Clear" />
        </p>
    </form>
    <p id="msg"></p>

    <form id="admin_editForm" method="POST" action="adminEditdata.php" style="display: none;">
        <input type="hidden" name="editform" value="editform">
        <p>
            <label>First Name: </label>
            <input type="text" id="editfirstName" name="firstName" required />
        </p>
        <p>
            <label>Middle Name: </label>
            <input type="text" id="editmiddleName" name="middleName" />
        </p>
        <p>
            <label>Last Name: </label>
            <input type="text" id="editlastName" name="lastName" required />
        </p>
        <p>
            <label>Sex: </label>
            <select id="editsex" name="sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </p>
        <p>
            <label>Phone Number: </label>
            <input type="text" id="editphoneNumber" name="phoneNumber" required />
        </p>
        <p>
            <label>Username: </label>
            <input type="text" id="editusername" name="username" required />
        </p>
        <p>
            <label>Password: </label>
            <input type="password" id="editpassword" name="password" required />
        </p>
        <label>ID Number:</label>
        <input type="text" id="editidNumber" name="idNumber" />
        <button type="submit">Update</button>
    </form>

    <script src="adminSignUp.js"></script>
</body>
</html>
function register(event) {
    event.preventDefault();

    var firstName = document.getElementById("firstName").value;
    var middleName = document.getElementById("middleName").value;
    var lastName = document.getElementById("lastName").value;
    var sex = document.getElementById("sex").value;
    var phoneNumber = document.getElementById("phoneNumber").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value.trim();


    var xhr = new XMLHttpRequest();
    xhr.open("POST", "adminSignup.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText.includes('should') || xhr.responseText.includes('already')) {
                var para = document.getElementById("msg");
                para.innerHTML = xhr.responseText;
            } 
            else{
                para.innerHTML = '';
                var idNumber = xhr.responseText;
                var idNumberInput = document.getElementById('idNumber');
                idNumberInput.value = idNumber;
        
                var submitButton = document.querySelector('input[type="submit"]');
                submitButton.outerHTML = '<button type="button" id="updateButton" onclick="editDetails()">Update</button>';
        
                var resetInput = document.querySelector('input[type="reset"]');
                resetInput.outerHTML = '<a href="index.html">Proceed</a>';
            
            }
        }
    };
    var formData = "firstName=" + encodeURIComponent(firstName) +
                   "&middleName=" + encodeURIComponent(middleName) +
                   "&lastName=" + encodeURIComponent(lastName) +
                   "&sex=" + encodeURIComponent(sex) +
                   "&phoneNumber=" + encodeURIComponent(phoneNumber) +
                   "&username=" + encodeURIComponent(username) +
                   "&password=" + encodeURIComponent(password);

    xhr.send(formData);
}
function editDetails() {
    var form1 = document.getElementById('admin_editForm');
    form1.style.display = 'block';
    var form2= document.getElementById('registrationForm');
    form2.style.display = 'none';
    

    var lastName = document.getElementById('lastName').value;
    var firstName = document.getElementById('firstName').value;
    var middleName = document.getElementById('middleName').value;
    var sex = document.getElementById('sex').value;
    var phoneNumber = document.getElementById('phoneNumber').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var idNumber = document.getElementById('idNumber').value;

    document.getElementById('editlastName').value = lastName;
    document.getElementById('editfirstName').value = firstName;
    document.getElementById('editmiddleName').value = middleName;
    document.getElementById('editsex').value = sex;
    document.getElementById('editphoneNumber').value = phoneNumber;
    document.getElementById('editusername').value = username;
    document.getElementById('editpassword').value = password;
    document.getElementById('editidNumber').value = idNumber;

}
