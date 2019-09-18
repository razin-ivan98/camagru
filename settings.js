function new_avatar()
{
	var forme = document.querySelector('#settings');
	var request = new XMLHttpRequest();
    request.open('POST', 'settings/new_avatar/', true);

    var formData = new FormData(forme);
    request.send(formData);

    // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200){
			//alert(request.responseText);
			var answer = JSON.parse(request.responseText);
			if (answer.answer === true)
				alert("Success");
			else
				alert("Error");
		} 
	} 
}