function validate()
{
	var uname = document.getElementById("txtuser").value;
	var upass = document.getElementById("txtpass").value;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = processResponse;
	var url = "adminLogin.php?uname="+uname+"&upass="+upass;
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
	return false;
}
function processResponse()
{
	if(xmlHttp.readyState==4 && xmlHttp.status==200)
	{
		var para = document.getElementById("msg");
		para.innerHTML = xmlHttp.responseText;
	}
}