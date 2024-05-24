function register(event) {
    event.preventDefault();

    var adfirstName = document.getElementById("adfirstName").value;
    var admiddleName = document.getElementById("admiddleName").value;
    var adlastName = document.getElementById("adlastName").value;
    var adsex = document.getElementById("adsex").value;
    var adphoneNumber = document.getElementById("adphoneNumber").value;
    var adusername = document.getElementById("adusername").value;
    var adpassword = document.getElementById("adpassword").value.trim();


    var xhr = new XMLHttpRequest();
    xhr.open("POST", "adminSignup.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var para = document.getElementById("admsg");
            var responseText = xhr.responseText.trim();
        
            if (responseText.includes('should') || responseText.includes('already')) {
                para.innerHTML = responseText;
            } 
            else {
                para.innerHTML = '';

                var idNumberInput = document.getElementById('adidNumber');
                idNumberInput.value = responseText;

                var submitButton = document.querySelector('input[type="submit"]');
                submitButton.outerHTML = '<button type="button" id="updateButton" onclick="editDetails()">Update</button>';

                var resetInput = document.querySelector('input[type="reset"]');
                resetInput.outerHTML = '<a href="index.html">Proceed</a>';
            }
        }
    };
    var formData = "firstName=" + encodeURIComponent(adfirstName) +
                   "&middleName=" + encodeURIComponent(admiddleName) +
                   "&lastName=" + encodeURIComponent(adlastName) +
                   "&sex=" + encodeURIComponent(adsex) +
                   "&phoneNumber=" + encodeURIComponent(adphoneNumber) +
                   "&username=" + encodeURIComponent(adusername) +
                   "&password=" + encodeURIComponent(adpassword);

    xhr.send(formData);
}
function editDetails() {
    var form1 = document.getElementById('adeditForm');
    form1.style.display = 'block';
    var form2= document.getElementById('adregistrationForm');
    form2.style.display = 'none';
    
    var adlastName = document.getElementById('adlastName').value;
    var adfirstName = document.getElementById('adfirstName').value;
    var admiddleName = document.getElementById('admiddleName').value;
    var adsex = document.getElementById('adsex').value;
    var adphoneNumber = document.getElementById('adphoneNumber').value;
    var adusername = document.getElementById('adusername').value;
    var adpassword = document.getElementById('adpassword').value;
    var adidNumber = document.getElementById('adidNumber').value;

    document.getElementById('adeditlastName').value = adlastName;
    document.getElementById('adeditfirstName').value = adfirstName;
    document.getElementById('adeditmiddleName').value = admiddleName;
    document.getElementById('adeditsex').value = adsex;
    document.getElementById('adeditphoneNumber').value = adphoneNumber;
    document.getElementById('adeditusername').value = adusername;
    document.getElementById('adeditpassword').value = adpassword;
    document.getElementById('adeditidNumber').value = adidNumber;

}
