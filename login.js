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
	request.open('POST', 'login/login', true);
    request.send(formData);

    // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
	request.onreadystatechange = function(){ 
		if (request.readyState == 4 && request.status == 200){
		//alert(request.responseText);
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
