function validateLogin()
{
	var name = document.getElementById("usnm").value;
	var pass = document.getElementById("pswd").value;

	if(name=="")
	{
		alert("Please enter your username");
		document.getElementById("login").setAttribute("href", "#");
		return false;
	}

	else if(pass=="")
	{
		alert("Please enter your password");
		document.getElementById("login").setAttribute("href", "#");
		return false;
	}

	else if(name!=""&&pass!="")
	{
		document.getElementById("login").setAttribute("href", "home.html");
		return true;
	}
}