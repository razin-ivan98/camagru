var is_in_request = 0;
var is_edotor_opened = 0;
var is_camera_active = 0;
var file = null;
//var stickers = new Array();

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



	//var dropzone = document.querySelector('.input_label');
	document.addEventListener("dragover", function(event) {
		// prevent default to allow drop
		event.preventDefault();
	  }, false);

	document.addEventListener("drop", function(event) {
		event.preventDefault();

		if (event.target.className == 'dropzone')
		{
			var src = document.querySelector('#src');
			var reset = document.querySelector('#reset');
			var label = document.querySelector('.input_label');
			var canvas = document.querySelector('#canvas');
			var stickers_button = document.querySelector('#stickers');
			label.style.display = 'none';
			src.style.display = 'none';
			canvas.style.display = 'block';
			file = event.dataTransfer.files[0];
			reset.style.display = 'inline';
			stickers_button.style.display = 'inline';
			previewFile();
		}
	}, false);

}

function snap()
{
	var src = document.querySelector('#src');
	var canvas = document.querySelector('#canvas');
	var reset = document.querySelector('#reset');
	var stickers_button = document.querySelector('#stickers');
	var video = document.querySelector('#video');
	var label = document.querySelector('.input_label');
	
	var context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
	context.drawImage(video, 0, 0, 580, 435);
	camera();
	src.style.display = 'none';
	//file = null;
	canvas.style.display = 'block';
	stickers_button.style.display = 'inline';
	label.style.display = 'none';
	reset.style.display = 'inline';
}

function show_stickers()
{
	var stickers = document.querySelector('.stickers_pack');

	stickers.style.display = "block";
}

function add_sticker(sticker)
{
	var stickers_field = document.querySelector('.stickers_field');
	var sticker_elem = document.createElement('img');
	sticker_elem.src = sticker.src;
//	sticker_elem.style.top = 200+'px';
//	sticker_elem.style.left = 200+'px';
	sticker_elem.classList.add('sticker');
	

	sticker_elem.onmousedown = function(e) {
		var canvas = document.querySelector('#canvas');
		var rect = canvas.getBoundingClientRect();
		console.log(rect.top);
		console.log(rect.left);
		if (e.button == 2)
		{
			e.preventDefault();
			this.remove();
			return ;
		}
		var self = this;
		//e = fixEvent(e);
	//	this.style.position = 'relative';
		moveAt(e);
		document.body.appendChild(this);
		this.style.zIndex = 1000;
	  
		function moveAt(e) {
			var canvas = document.querySelector('#canvas');
			//if (e.pageX - rect.left > 75 && e.pageX < rect.left + 505)
				  self.style.left = Math.round(e.pageX - rect.left- 75) +'px';
			//if (e.pageY - rect.top > 75 && e.pageY < rect.top + canvas.height - 75)
				  self.style.top = Math.round(e.pageY - rect.top - 75) +'px';
				  //console.log(self.style.left);
				  ///console.log(self.style.top);
		 }
		document.onmousemove = function(e) {
		 // e = fixEvent(e);
		  moveAt(e);
		}
		this.onmouseup = function() {
		  document.onmousemove = self.onmouseup = null;
		}
	  }
	  sticker_elem.ondragstart = function() {
		return false;
	  };


	stickers_field.prepend(sticker_elem);
	  //alert(sticker_elem.style.top);

}

function reset()
{
	var src = document.querySelector('#src');
	var label = document.querySelector('.input_label');
	var canvas = document.querySelector('#canvas');
	var reset = document.querySelector('#reset');
	var stickers_button = document.querySelector('#stickers');
	var stickers_pack = document.querySelector('.stickers_pack');
	var stickers_field = document.querySelector('.stickers_field');
	
/*	for (st in stickers)
	{
		st.remove();
	}*/
	stickers_field.innerHTML = '';
	canvas.height = 435;
	var context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
	src.style.display = 'inline';
	file = null;
	canvas.style.display = 'none';
	stickers_button.style.display = 'none';
	stickers_pack.style.display = 'none';
	label.style.display = 'block';
	reset.style.display = 'none';
}

function previewFile()
{
	var image = new Image();
	var canvas = document.getElementById('canvas');
	
	var reader  = new FileReader();
	
  
	reader.onloadend = function () {
		image.src = reader.result;
	}
	image.onload = function() {
		var height = image.height * 580 / image.width;
		canvas.height = height;
		var context = canvas.getContext('2d');
		context.clearRect(0, 0, canvas.width, canvas.height);
		context.drawImage(image, 0, 0, 580, height);
	};
	if (file) {
	  reader.readAsDataURL(file);
	} else {
	  image.src = "";
	}
  }

function camera()
{
	var label = document.querySelector('.input_label');
	var video = document.getElementById('video');
	var button = document.getElementById('src');
	var snap = document.getElementById('snap');
	if (is_camera_active === 0)
	{
		label.style.display = 'none';
		video.style.display = 'block';
		snap.style.display = 'inline';
		
		var mediaConfig =  { video: true };
		if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
		{
			navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
				video.srcObject = stream;
				video.play();
			});
		}
		is_camera_active = 1;
		button.innerHTML = 'Файл';
	}
	else
	{
		let stream = video.srcObject;
		if (stream === null)
			return ;
		label.style.display = 'block';
		video.style.display = 'none';
		snap.style.display = 'none';
  		let tracks = stream.getTracks();

  		tracks.forEach(function(track) {
    		track.stop();
  		});

		video.srcObject = null;
		is_camera_active = 0;
		button.innerHTML = 'Камера';
	}
}

function open_image_editor()
{
	//var video = document.getElementById('video');
	var editor = document.querySelector('.editor');
	if (is_edotor_opened === 0)
	{
		is_edotor_opened = 1;
		editor.style.display = 'block';
	}
	else
	{
		is_edotor_opened = 0;
		reset();
		// let stream = video.srcObject;
		// if (stream !== null)
		// {
		// 	let tracks = stream.getTracks();

		// 	tracks.forEach(function(track) {
		// 		track.stop();
		// 	});

		// 	video.srcObject = null;
		// }
		editor.style.display = 'none';

		if (is_camera_active === 1)
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

function input_change()
{
	var inp = document.querySelector('.input_file');
	file = inp.files[0];
	var label = document.querySelector('.input_label');
	var src = document.querySelector('#src');
	var canvas = document.querySelector('#canvas');
	var reset = document.querySelector('#reset');
	var stickers_button = document.querySelector('#stickers');

	src.style.display = 'none';
	label.style.display = 'none';
	canvas.style.display = 'block';
	reset.style.display = 'inline';
	stickers_button.style.display = "inline";
	previewFile();
}

function new_publish(elem) {
	var forme = elem.parentNode;
	var request = new XMLHttpRequest();
	request.open('POST', '/feeds/new_publish', true);

	var formData = new FormData(forme);
	formData.get
	is_in_request = 1;
	//if (file !== null)
		formData.append('file', file);
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