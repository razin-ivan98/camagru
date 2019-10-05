window.onload = function()
{
	window.onkeypress = function(event)
	{
		if (event.keyCode === 13)
		{
			event.preventDefault();
			reset_pass();
		}
	}
}


function reset_pass()
{
    var forme = document.querySelector('#reset_form');

    var formData = new FormData(forme);
	if (formData.get('password') === '' || formData.get('confirm_password') === '')
	{
		alert('Empty fields');
		return;
    }
    if (formData.get('password') !== formData.get('confirm_password'))
	{
		alert('Passwords is not match');
		return;
	}
	var request = new XMLHttpRequest();
    request.open('POST', '/reset_password/new_password/', true);
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