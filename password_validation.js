function validatePassword()
{
	var name = document.getElementById("usnm").value;
	var pass1 = document.getElementById("pswd1").value;
	var pass2 = document.getElementById("pswd2").value;

	if(name=="")
	{
		alert("Please enter an username");
		document.getElementById("create").setAttribute("href", "#");
		return false;
	}

	else if(pass1=="")
	{
		alert("Please enter a password");
		document.getElementById("create").setAttribute("href", "#");
		return false;
	}

	else if(pass2=="")
	{
		alert("Please confirm your password");
		document.getElementById("create").setAttribute("href", "#");
		return false;
	}

	else if(pass1!=pass2&&(pass1!=""&&pass2!=""))
	{
		alert("Password do not match. Please try again!");
		document.getElementById("create").setAttribute("href", "#");
		return false;
	}

	else if(pass1==pass2&&name!="")
	{
		document.getElementById("create").setAttribute("href", "home.html");
		return true;
	}

	
}
