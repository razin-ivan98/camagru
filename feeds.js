var is_in_request = 0;
var is_edotor_opened = 0;
var is_camera_active = 0;

var isMobile = {
	Android: function () {
		return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function () {
		return navigator.userAgent.match(/BlackBerry/i);
	},
	iOS: function () {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function () {
		return navigator.userAgent.match(/Opera Mini/i);
	},
	Windows: function () {
		return navigator.userAgent.match(/IEMobile/i);
	},
	any: function () {
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	}
};


window.onload = function () {
	var container = document.querySelector(".container");
	///alert(container.style.height);
	var scrollHeight = Math.max(
		document.body.scrollHeight, document.documentElement.scrollHeight,
		document.body.offsetHeight, document.documentElement.offsetHeight,
		document.body.clientHeight, document.documentElement.clientHeight
	);
	container.style.height = scrollHeight + 'px';

	setInterval("set_int_check();", 200);

	if (isMobile.any()) {

		var link = document.createElement("link");
		link.setAttribute("rel", "stylesheet");
		link.setAttribute("type", "text/css");
		link.setAttribute("href", 'mobile.css');
		document.getElementsByTagName("head")[0].appendChild(link);
	}



		

		/*
		var video = document.getElementById('video');
		var mediaConfig =  { video: true };
		if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
		{
			navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
				video.srcObject = stream;
				 //video.play();
			});
		}*/
}

function camera()
{
	var label = document.querySelector('.input_label');
	var video = document.getElementById('video');
	if (is_camera_active === 0)
	{
		label.style.display = 'none';
		video.style.display = 'block';
		is_camera_active = 1;
		var mediaConfig =  { video: true };
		if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
		{
			navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
				video.srcObject = stream;
				 video.play();
			});
		}
	}
	else
	{
		label.style.display = 'block';
		video.style.display = 'none';
		is_camera_active = 0;

		let stream = video.srcObject;
  		let tracks = stream.getTracks();

  		tracks.forEach(function(track) {
    		track.stop();
  		});

  		video.srcObject = null;
	}
}

function open_image_editor()
{
	var video = document.getElementById('video');
	var editor = document.querySelector('.editor');
	if (is_edotor_opened === 0)
	{
		is_edotor_opened = 1;
		editor.style.display = 'block';
	}
	else
	{
		is_edotor_opened = 0;

		let stream = video.srcObject;
  		let tracks = stream.getTracks();

  		tracks.forEach(function(track) {
    		track.stop();
  		});

  		video.srcObject = null;
		editor.style.display = 'none';

		is_camera_active = 1;
		camera();
	}
}


function set_int_check() {

	if (is_in_request == 0) {
		var alert = document.querySelector(".alert");
		var a = document.querySelector("#dialogs_link");

		var request = new XMLHttpRequest();
		request.open('POST', 'feeds/check_dialogs_activity', true);
		is_in_request = 1;
		var formData = new FormData();
		request.send(formData);

		// Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				var res = JSON.parse(request.responseText);
				if (res.answer === true) {
					a.innerHTML = "Dialogs<div class='unread'>" + res.text + "</div>";
					if (isMobile.any())
						alert.innerHTML = "<div class='unread'>" + res.text + "</div>";
				}
				else {
					a.innerHTML = "Dialogs";
					if (isMobile.any())
						alert.innerHTML = "";
				}
				is_in_request = 0;
			}
			else if (request.readyState == 4 && request.status == 204)
			{
				document.location.href = '/db_error';
			}
		}
	}
}

function new_publish(elem) {
	var forme = elem.parentNode;
	var request = new XMLHttpRequest();
	request.open('POST', '/feeds/new_publish', true);

	var formData = new FormData(forme);
	is_in_request = 1;
	request.send(formData);

	// Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//document.querySelector('#myip').innerHTML = request.responseText;
			var marg = document.querySelector('#publish_constructor');
			marg.insertAdjacentHTML("afterEnd", request.responseText);
			is_in_request = 0;
		}
		else if (request.readyState == 4 && request.status == 204)
		{
			document.location.href = '/db_error';
		}
	}
}

function send_mail() {
	ajaxGET('feeds/send_mail', null, function (data) {
		alert(data);
	});
}

function delete_comment(elem) {
	var par = elem.parentNode;
	par = par.parentNode;

	ajaxGET('feeds/delete_comment/?id=' + par.id, par, function (data, par) {
		var arr = JSON.parse(data);
		if (arr.answer == true)
			par.remove();
		else
			alert('Не имеешь права');
	});
}

function f_new_comment(elem) {
	var par = elem.parentNode;
	var forme = par;
	par = par.parentNode;
	par = par.parentNode;
	par = par.parentNode;

	var request = new XMLHttpRequest();
	request.open('POST', '/feeds/new_comment', true);

	var formData = new FormData(forme);
	formData.append('publish_id', par.id);
	is_in_request = 1;
	request.send(formData);

	// Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			if (request.responseText !== 'none') {
				par.insertAdjacentHTML("afterEnd", request.responseText);
				par.remove();
			}
			is_in_request = 0;
		}
		else if (request.readyState == 4 && request.status == 204)
		{
			document.location.href = '/db_error';
		}
	}
}

function delete_publish(elem) {
	/*if (!confirm('Вы действительно хотите удалить запись?'))
		return;*/
	var par = elem.parentNode;
	par = par.parentNode;

	//alert('удолити');

	ajaxGET('/feeds/delete_publish/?id=' + par.id, par, function (data, par) {
		//alert(data);
		var arr = JSON.parse(data);
		if (arr.answer == true)
			par.remove();
		else
			alert('Не имеешь права');
	});
}

function comment_like(elem) {
	var par = elem.parentNode;
	par = par.parentNode;
	var gr = par.parentNode;
	gr = gr.parentNode;


	ajaxGET('feeds/comment_like/?id=' + par.id + '&publish_id=' + gr.id, elem, function (data, elem) {

		var arr = JSON.parse(data);
		elem.innerHTML = (arr.is_liked == true ? '&#x1F49D;' : '&#x1F497;') + arr.count;
	});
}

function like(elem) {
	var par = elem.parentNode;
	par = par.parentNode;

	ajaxGET('feeds/like/?id=' + par.id, elem, function (data, elem) {
		var arr = JSON.parse(data);
		elem.innerHTML = (arr.is_liked == true ? '&#x1F49D;' : '&#x1F497;') + arr.count;
	});
	//var arr = JSON.parse(req.responseText);
	//alert(req);

	//elem.innerHTML = (req.)
}


function ajaxGET(url, elem, callback) {
	var request = new XMLHttpRequest();

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//document.querySelector('#myip').innerHTML = request.responseText;
			callback(request.responseText, elem);
			is_in_request = 0;
		}
		else if (request.readyState == 4 && request.status == 204)
		{
			document.location.href = '/db_error';
		}
	}
	request.open('GET', url);
	is_in_request = 1;
	request.send();
}