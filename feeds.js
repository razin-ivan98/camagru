var is_in_request = 0;
var is_edotor_opened = 0;
var is_camera_active = 0;
var file = null;
var stickers = new Array();
var src_image = new Image();
var curr_sticker = null;
var is_move = 0;
var delta_x;
var delta_y;
var is_image = 0;

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
			var canvases = document.querySelector('.canvases');
		
			var stickers_button = document.querySelector('#stickers');
			label.style.display = 'none';
			src.style.display = 'none';
			canvases.style.display = 'block';
			stickers_canvas.style.display = 'block';
			file = event.dataTransfer.files[0];
			reset.style.display = 'inline';
			stickers_button.style.display = 'inline';
			previewFile();
		}
	}, false);

	var stickers_canvas = document.querySelector('#stickers_canvas');

	window.onmouseup = function()
	{
		is_move = 0;
	}

	stickers_canvas.onmousemove = function(e) {
		if (is_move == 0)
			return;
		var rect = this.getBoundingClientRect();
	    //var canvas = document.querySelector('#canvas');
		if (e.pageX > rect.left && e.pageX < rect.left + 580)
			stickers[curr_sticker].x = Math.round(e.pageX - rect.left- delta_x);
		if (e.pageY > rect.top && e.pageY < rect.top + this.height)
			stickers[curr_sticker].y = Math.round(e.pageY - rect.top- delta_y);
		refresh_stickers_canvas();
		
	}

	stickers_canvas.onmousedown = function(e) {
			//var canvas = document.querySelector('#canvas');
			var rect = this.getBoundingClientRect();
		//	console.log(rect.top);
		//	console.log(rect.left);
		//	if (e.button == 2)
		//	{
		//		e.preventDefault();
		//		this.remove();
		//		return ;
		//	}
		if (e.button == 2)
		{
			return (false);
		}
		for (var i = 0; i < stickers.length; i++)
		{
			if (e.pageX > rect.left + stickers[i].x &&
				e.pageX < rect.left + stickers[i].x + 150 &&
				e.pageY > rect.top + stickers[i].y &&
				e.pageY < rect.top + stickers[i].y + 150)
			{
				curr_sticker = i;
				delta_x = e.pageX - rect.left - stickers[i].x;
				delta_y = e.pageY - rect.top - stickers[i].y;
				is_move = 1;
			}
			
		}
		//alert(curr_sticker);
		//	var self = this;
			//e = fixEvent(e);
		//	this.style.position = 'relative';
		//	moveAt(e);
		//	document.body.appendChild(this);
		//	this.style.zIndex = 1000;
		  
		/*	function moveAt(e) {
				//var canvas = document.querySelector('#canvas');
				if (e.pageX > rect.top && e.pageX < rect.top + 580)
					  stickers[curr_sticker].x = Math.round(e.pageX - rect.left - delta_x) +'px';
			/*	if (e.pageY - rect.top > 75 && e.pageY < rect.top + canvas.height - 75)
					  self.style.top = Math.round(e.pageY - rect.top - 75) +'px';*/
					  //console.log(self.style.left);
					  ///console.log(self.style.top);
				/*	  alert(stickers[0].x);
					  refresh_stickers_canvas();
	}*/
			//stickers_canvas.onmousemove = function(e) {
			 // e = fixEvent(e);
			//  moveAt(e);
			//}
			//this.onmouseup = function() {
			//  document.onmousemove = stickers_canvas.onmouseup = null;
			//}
		}
		 /* sticker_elem.ondragstart = function() {
			return false;
		  };*/
}

function snap()
{
	var canvases = document.querySelector('.canvases');
	var src = document.querySelector('#src');
	var canvas = document.querySelector('#canvas');
	//var stickers_canvas = document.querySelector('#stickers_canvas');
	var reset = document.querySelector('#reset');
	var stickers_button = document.querySelector('#stickers');
	var video = document.querySelector('#video');
	var label = document.querySelector('.input_label');
	
	var context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
	src_image = video;
	context.drawImage(src_image, 0, 0, 580, 435);
	camera();
	src.style.display = 'none';
	//file = null;
	//canvas.style.display = 'block';
	canvases.style.display = 'block';
	stickers_button.style.display = 'inline';
	label.style.display = 'none';
	reset.style.display = 'inline';
	is_image = 1;
}

function show_stickers()
{
	var stickers = document.querySelector('.stickers_pack');

	stickers.style.display = "block";
}

function refresh_stickers_canvas()
{
	var stickers_canvas = document.querySelector('#stickers_canvas');
	var context = stickers_canvas.getContext('2d');
	context.clearRect(0, 0, stickers_canvas.width, stickers_canvas.height);
	//context.drawImage(src_image, 0, 0, 580, 435);
	for (var i = 0; i < stickers.length; i++)
	{
		//console.log(stickers[i].image);
		context.drawImage(stickers[i].image, stickers[i].x, stickers[i].y, 150, 150);
	}
}

function add_sticker(sticker)
{
	//var stickers_canvas = document.querySelector('#stickers_canvas');
	var new_sticker = new Object;
	//console.log(sticker);
	new_sticker = {
		image: sticker,
		id: sticker.id,
		x: 0,
		y: 0
	}
	stickers.push(new_sticker);
	refresh_stickers_canvas();
//	var context = stickers_canvas.getContext("2d");

//	context.drawImage(sticker, 200, 200, 150, 150);
	

	// sticker_elem.onmousedown = function(e) {
	// 	var canvas = document.querySelector('#canvas');
	// 	var rect = canvas.getBoundingClientRect();
	// 	console.log(rect.top);
	// 	console.log(rect.left);
	// 	if (e.button == 2)
	// 	{
	// 		e.preventDefault();
	// 		this.remove();
	// 		return ;
	// 	}
	// 	var self = this;
	// 	//e = fixEvent(e);
	// //	this.style.position = 'relative';
	// 	moveAt(e);
	// 	document.body.appendChild(this);
	// 	this.style.zIndex = 1000;
	  
	// 	function moveAt(e) {
	// 		var canvas = document.querySelector('#canvas');
	// 		//if (e.pageX - rect.left > 75 && e.pageX < rect.left + 505)
	// 			  self.style.left = Math.round(e.pageX - rect.left- 75) +'px';
	// 		//if (e.pageY - rect.top > 75 && e.pageY < rect.top + canvas.height - 75)
	// 			  self.style.top = Math.round(e.pageY - rect.top - 75) +'px';
	// 			  //console.log(self.style.left);
	// 			  ///console.log(self.style.top);
	// 	 }
	// 	document.onmousemove = function(e) {
	// 	 // e = fixEvent(e);
	// 	  moveAt(e);
	// 	}
	// 	this.onmouseup = function() {
	// 	  document.onmousemove = self.onmouseup = null;
	// 	}
	//   }
	//   sticker_elem.ondragstart = function() {
	// 	return false;
	//   };


	// stickers_field.prepend(sticker_elem);
	//   //alert(sticker_elem.style.top);

}

function reset()
{
	var src = document.querySelector('#src');
	var label = document.querySelector('.input_label');
	var canvas = document.querySelector('#canvas');
	var canvas_stickers = document.getElementById('stickers_canvas');
	var canvases = document.querySelector('.canvases');
	var reset = document.querySelector('#reset');
	var stickers_button = document.querySelector('#stickers');
	var stickers_pack = document.querySelector('.stickers_pack');
	var stickers_field = document.querySelector('.stickers_field');
	
/*	for (st in stickers)
	{
		st.remove();
	}*/
	canvas.height = 435;
	canvas_stickers.height = 435;
	canvases.style.height = 435+'px';
	var context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
	src.style.display = 'inline';
	file = null;
	canvases.style.display = 'none';
	stickers_button.style.display = 'none';
	stickers_pack.style.display = 'none';
	label.style.display = 'block';
	reset.style.display = 'none';
	while(stickers.length > 0) {
		stickers.pop();
	}
	curr_sticker = null;
	is_image = 0;
}

function previewFile()
{
	var image = new Image();
	var canvas = document.getElementById('canvas');
	var canvas_stickers = document.getElementById('stickers_canvas');
	var canvases = document.querySelector('.canvases');
	
	var reader  = new FileReader();
	
  
	reader.onloadend = function () {
		image.src = reader.result;
	}
	image.onload = function() {
		var height = image.height * 580 / image.width;
		canvas.height = height;
		canvas_stickers.height = height;
		canvases.style.height = height+'px';
		var context = canvas.getContext('2d');
		context.clearRect(0, 0, canvas.width, canvas.height);
		context.drawImage(image, 0, 0, 580, height);
	};
	if (file) {
	  reader.readAsDataURL(file);
	} else {
	  image.src = "";
	}
	src_image = image;
	is_image = 1;
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
	var canvases = document.querySelector('.canvases');
	var reset = document.querySelector('#reset');
	var stickers_button = document.querySelector('#stickers');

	src.style.display = 'none';
	label.style.display = 'none';
	canvases.style.display = 'block';
	reset.style.display = 'inline';
	stickers_button.style.display = "inline";
	previewFile();
}

function new_publish(elem) {
	var text_input = document.querySelector('.new_publ_input');
	var canvas = document.querySelector('#canvas');
	var stickers_canvas = document.querySelector('#stickers_canvas');
	var canvasData = canvas.toDataURL();
	var stickers_canvasData = stickers_canvas.toDataURL();
	var forme = elem.parentNode;
	var request = new XMLHttpRequest();
	request.open('POST', '/feeds/new_publish', true);

	var formData = new FormData(forme);

	is_in_request = 1;
	if (is_image === 1)
	{
		formData.append('canvas', canvasData);
		formData.append('stickers', stickers_canvasData);
	}
	request.send(formData);

	
	// Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//document.querySelector('#myip').innerHTML = request.responseText;
			var marg = document.querySelector('#publish_constructor');
			marg.insertAdjacentHTML("afterEnd", request.responseText);
			is_in_request = 0;
			if (is_edotor_opened === 1)
				open_image_editor();
			text_input.value = '';
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