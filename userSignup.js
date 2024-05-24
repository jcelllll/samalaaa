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
    xhr.open("POST", "userSignup.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var para = document.getElementById("msg");
            var responseText = xhr.responseText.trim();
        
            if (responseText.includes('should') || responseText.includes('already')) {
                para.innerHTML = responseText;
            } 
            else {
                para.innerHTML = '';

                var idNumberInput = document.getElementById('idNumber');
                idNumberInput.value = responseText;

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
    var form1 = document.getElementById('editForm');
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
