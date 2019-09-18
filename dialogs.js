var is_in_dialog = -1;
var is_in_request = 0;

window.onload = function()
{	
	var is_in_dialog = -1;
	setInterval("set_int();", 200);
}

function set_int()
{
	if (is_in_dialog != -1 && is_in_request == 0)
	{
		var id;
		var field = document.querySelector('#dialogs_field');
		var dialogs = document.querySelector('.dialogs_block');
		if (dialogs == null || dialogs.lastChild == null)
			id = -1;
		else
			id = dialogs.lastChild.id;
		
		//alert(last_mess.id);
	
		var request = new XMLHttpRequest();
		request.open('POST', 'dialogs/check_new_messages', true);
		var formData = new FormData();
		formData.append('last_message_id', id);
		formData.append('dialog_id', is_in_dialog);
		request.send(formData);
		is_in_request = 1;
		// Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
		request.onreadystatechange = function(){ 
			if (request.readyState == 4 && request.status == 200){ 
				var res = JSON.parse(request.responseText);
				if (res.answer === true)
				{
					data = res.messages;
					for (var i = 0; i < data.length; i++)
					{
						var m_class = (data[i].is_my ? "my_message" : "opp_message");
						var insert = '<div class="'+m_class+'" id="'+data[i].id+'">'
							+data[i].date+
							'<p>'+data[i].text+'</p></div>';
						dialogs.insertAdjacentHTML("beforeEnd", insert);
					}
					field.scrollTop = field.scrollHeight;
				}
				
				is_in_request = 0;
			}
		}
	}
}

function new_dialog_choose()
{
	
	var dialogs = document.querySelector('.dialogs_block');
	var title = document.querySelector('.title');
	title.innerHTML = "New Dialog";
	dialogs.innerHTML = '';
	ajaxGET('/dialogs/new_dialog_choose', dialogs, function(data, dialogs){
			
			data = JSON.parse(data);
			
			for (var i = 0; i < data.length; i++)
			{
				//alert (dialog.avatar);
				var insert = '<div class="dialog" id="'+data[i].user_id+'" onclick="create_dialog_with(this);">'+
					'<div class="avatar"><img src="avatars/'+data[i].avatar+'"></div>'+
					'<div class="author"><h3>'+data[i].user+'</h3></div>';
				dialogs.insertAdjacentHTML("beforeEnd", insert);
			}
			
		});
}

function open_dialog(elem)
{
	var title = document.querySelector('.publish_header');
	var dialogs = document.querySelector('.dialogs_block');
	var field = document.querySelector('#dialogs_field');
	field.className = "publish_body";
	dialogs.innerHTML = '';
	is_in_request = 1;
	ajaxGET('dialogs/open_dialog/?dialog_id='+elem.id, dialogs, function(data, marg){
		//alert(data);
			data = JSON.parse(data);
			
			if (data.answer === false)
			{
				alert("Access denied");
			}
			title.innerHTML = '<div><div class="avatar"><img src="avatars/'+data.avatar+'"></div>'+
				'<div class="author"><h3>'+data.user+'</h3></div></div>';
			data = data.messages;
			//alert(data.length);
			for (var i = 0; i < data.length; i++)
			{
				var unread = (data[i].is_read === 1 ? '' : '<div class="unread"></div>');
				//alert(unread);
				var m_class = (data[i].is_my ? "my_message" : "opp_message");
				var insert = '<div class="'+m_class+'" id="'+data[i].id+'">'
					+unread+data[i].date+
					'<p>'+data[i].text+'</p></div>';
				dialogs.insertAdjacentHTML("beforeEnd", insert);
			}
				field.insertAdjacentHTML("afterEnd", '<div class="publish_footer">'+
					'<form method="POST" class="new_message">'+
						'<input type="text" name="text">'+
						'<button  type="button" onclick="f_new_message();">отправить</button>'+
					'</form>'+
				'</div>');
		field.scrollTop = field.scrollHeight;
		is_in_request = 0;
		});
		
	is_in_dialog = elem.id;
}

function f_new_message()
{
	var forme = document.querySelector('.new_message');
	
	var request = new XMLHttpRequest();
    request.open('POST', 'dialogs/new_message/', true);

    var formData = new FormData(forme);
	formData.append('dialog_id', is_in_dialog);
    request.send(formData);

    // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
	request.onreadystatechange = function(){ 
	if (request.readyState == 4 && request.status == 200){ 
		//document.querySelector('#myip').innerHTML = request.responseText;
			//par.insertAdjacentHTML("beforeBegin", request.responseText);
			//alert(request.responseText);
		} 
	} 
}

function create_dialog_with(elem)
{
	ajaxGET('dialogs/create_dialog_with/?user_id='+elem.id, null, function(data, dialogs){
			//alert(data);
			data = JSON.parse(data);
			if (data.answer === true)
			{
				document.location.href = "/dialogs";
			}
			else
			{
				alert(data.text);
			}

		});
}

function ajaxGET(url, elem, callback){ 
	var request = new XMLHttpRequest(); 

	request.onreadystatechange = function(){ 
	if (request.readyState == 4 && request.status == 200){ 
		//document.querySelector('#myip').innerHTML = request.responseText;
			callback(request.responseText, elem);
		} 
	} 
	request.open('GET', url); 
	request.send();
}