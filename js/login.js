window.onload = function()
{
	window.onkeypress = function(event)
	{
		if (event.keyCode === 13)
		{
			event.preventDefault();
			log_in();
		}
	}
}


function log_in()
{
	var forme = document.querySelector('#login_form');
    var formData = new FormData(forme);
	if (formData.get('password') == '' || formData.get('login') == '')
	{
		alert('Empty fields');
		return;
	}
	var request = new XMLHttpRequest();
	request.open('POST', '/login/login', true);
    request.send(formData);

	request.onreadystatechange = function(){ 
		if (request.readyState == 4 && request.status == 200){

			var res = JSON.parse(request.responseText);
			if (res.answer == true)
				document.location.href = "/feeds";
			else
				alert(res.text);
		}
		else if (request.readyState == 4 && request.status == 204)
		{
			document.location.href = '/db_error';
		}
	} 
}

function fogotten()
{
	var forme = document.querySelector('#login_form');
	var formData = new FormData(forme);
	if (formData.get('login') == '')
	{
		alert('Empty fields');
		return;
	}
	var request = new XMLHttpRequest();
	request.open('POST', '/login/reset_password', true);
    request.send(formData);

	request.onreadystatechange = function(){ 
		if (request.readyState == 4 && request.status == 200){
			var res = JSON.parse(request.responseText);
			if (res.answer == true)
				alert("The link was send to your email");
			else
				alert(res.text);
		}
		else if (request.readyState == 4 && request.status == 204)
		{
			document.location.href = '/db_error';
		}
	}
}
