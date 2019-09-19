window.onload = function(){
	var container = document.querySelector(".container");
	var publ_field = document.querySelector(".publishes_block");
	///alert(container.style.height);
	var scrollHeight = Math.max(
	  document.body.scrollHeight, document.documentElement.scrollHeight,
	  document.body.offsetHeight, document.documentElement.offsetHeight,
	  document.body.clientHeight, document.documentElement.clientHeight
	);
	container.style.height = scrollHeight + 'px';



		/*	var video = document.getElementById('video');
            var mediaConfig =  { video: true };

			if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
			{
                navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
					video.srcObject = stream;
                    video.play();
                });
            }*/
}

function new_publish(elem)
{
	var forme = elem.parentNode;
    var request = new XMLHttpRequest();
    request.open('POST', '/feeds/new_publish', true);

    var formData = new FormData(forme);
    request.send(formData);

    // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
	request.onreadystatechange = function(){ 
		if (request.readyState == 4 && request.status == 200){ 
		//document.querySelector('#myip').innerHTML = request.responseText;
			var marg = document.querySelector('#publish_constructor');
			marg.insertAdjacentHTML("afterEnd", request.responseText);
		} 
	} 
}

function send_mail()
{
	ajaxGET('feeds/send_mail', null, function(data){
			alert(data);
	});
}

function delete_comment(elem)
{
	var par = elem.parentNode;
	par = par.parentNode;
	
	ajaxGET('feeds/delete_comment/?id='+par.id, par, function(data, par){
			var arr = JSON.parse(data);
			if (arr.answer == true)
				par.remove();
			else
				alert('Не имеешь права');
		});
}

function f_new_comment(elem)
{
	var par = elem.parentNode;
	var forme = par;
	par = par.parentNode;
	par = par.parentNode;
	par = par.parentNode;
	
	var request = new XMLHttpRequest();
    request.open('POST', '/feeds/new_comment', true);

    var formData = new FormData(forme);
	formData.append('publish_id', par.id);
    request.send(formData);

    // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
	request.onreadystatechange = function(){ 
	if (request.readyState == 4 && request.status == 200){
			if (request.responseText !== 'none')
			{
				par.insertAdjacentHTML("afterEnd", request.responseText);
				par.remove();
			}
		} 
	} 
}

function delete_publish(elem)
{
	/*if (!confirm('Вы действительно хотите удалить запись?'))
		return;*/
	var par = elem.parentNode;
	par = par.parentNode;

	//alert('удолити');
	
	ajaxGET('/feeds/delete_publish/?id='+par.id, par, function(data, par){
		//alert(data);
			var arr = JSON.parse(data);
			if (arr.answer == true)
				par.remove();
			else
				alert('Не имеешь права');
		});
}

function comment_like(elem)
{
	var par = elem.parentNode;
	par = par.parentNode;
	var gr = par.parentNode;
	gr = gr.parentNode;
	
	
	ajaxGET('feeds/comment_like/?id='+par.id+'&publish_id='+gr.id, elem, function(data, elem){

			var arr = JSON.parse(data);
			elem.innerHTML = (arr.is_liked == true ? '&#x1F49D;' : '&#x1F497;') + arr.count;
		});
}

function like(elem)
{
	var par = elem.parentNode;
	par = par.parentNode;
	
	var req = ajaxGET('feeds/like/?id='+par.id, elem, function(data, elem){
			var arr = JSON.parse(data);
			elem.innerHTML = (arr.is_liked == true ? '&#x1F49D;' : '&#x1F497;') + arr.count;
		});
	//var arr = JSON.parse(req.responseText);
	//alert(req);
	
	//elem.innerHTML = (req.)
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