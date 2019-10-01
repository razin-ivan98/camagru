function confirm()
{
	var forme = document.querySelector("#confirm_form");

	var formData = new FormData(forme);

	if (formData.get('email') == '')
	{
		alert('Empty field');
		return;
	}
	var request = new XMLHttpRequest();
    request.open('POST', 'confirm/confirm', true);
	request.send(formData);

	request.onreadystatechange = function(){ 
		if (request.readyState == 4 && request.status == 200){
			//alert(request.responseText);
			var res = JSON.parse(request.responseText);
			if (res.answer == true)
			{
				//alert("The link was send to your email");
				alert(res.text);
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