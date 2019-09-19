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
    request.open('POST', 'create_account/create_account', true);
	request.send(formData);
	
	
    // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
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
	} 
}