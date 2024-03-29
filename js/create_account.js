window.onload = function()
{
	window.onkeypress = function(event)
	{
		if (event.keyCode === 13)
		{
			event.preventDefault();
			create_account();
		}
	}
}

function create_account()
{
	var forme = document.querySelector('#create_account_form');
	

    var formData = new FormData(forme);
   
	if (formData.get('password') == '' || formData.get('login') == '')
	{
		alert('Empty fields');
		return;
	}
	var request = new XMLHttpRequest();
    request.open('POST', '/create_account/create_account', true);
	request.send(formData);
	request.onreadystatechange = function(){ 
		if (request.readyState == 4 && request.status == 200){
			var res = JSON.parse(request.responseText);
			if (res.answer == true)
			{
				alert("Success");
				document.location.href = "/login";
			}
			else
				alert(res.text);
		}
		else if (request.readyState == 4 && request.status == 204)
		{
			document.location.href = '/db_error';
		}
	}
}