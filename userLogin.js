function validate() {
    var uname = document.getElementById("txtuser").value;
    var upass = document.getElementById("txtpass").value;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = processResponse;
    var url = "userLogin.php?uname=" + encodeURIComponent(uname) + "&upass=" + encodeURIComponent(upass);
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
    return false;
}

function processResponse() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        var para = document.getElementById("msg");
        var responseText = xmlHttp.responseText.trim();

        if (responseText === "Invalid username or password!" || responseText === "Username and password are required!") {
            para.innerHTML = responseText;
        } else if (responseText === "Valid user!") {
            para.innerHTML = '<a href="index.html">Proceed</a>';
        }
    }
}
