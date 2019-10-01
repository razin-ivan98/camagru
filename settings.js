var is_in_request = 0;

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

  setInterval("set_int_check();", 200);
  if (isMobile.any()) {

    var link = document.createElement("link");
    link.setAttribute("rel", "stylesheet");
    link.setAttribute("type", "text/css");
    link.setAttribute("href", 'mobile.css');
    document.getElementsByTagName("head")[0].appendChild(link);
  }
}



function new_avatar() {
  var forme = document.querySelector("#change_avatar");
  var request = new XMLHttpRequest();
  request.open("POST", "settings/new_avatar/", true);

  var formData = new FormData(forme);
  is_in_request = 1;
  request.send(formData);

  // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      //alert(request.responseText);
      var answer = JSON.parse(request.responseText);
      if (answer.answer === true) alert("Success");
      else alert("Error");
      is_in_request = 0;
    }
    else if (request.readyState == 4 && request.status == 204)
		{
			document.location.href = '/db_error';
		}
  };
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


function change_password() {
  var forme = document.querySelector("#change_password");
  var request = new XMLHttpRequest();
  request.open("POST", "settings/change_password/", true);
  // alert('k');
  var formData = new FormData(forme);

  if (formData.get("old_pass") === "" || formData.get("new_pass") === "" || formData.get("r_new_pass") === "") {
    alert("Empty fields");
    return;
  }
  if (formData.get("r_new_pass") !== formData.get("new_pass")) {
    alert("Passwords are diferrent");
    return;
  }
  is_in_request = 1;
  request.send(formData);

  // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      // alert(request.responseText);
      var answer = JSON.parse(request.responseText);
      if (answer.answer === true) alert("Success");
      else alert(answer.text);
      is_in_request = 0;
    }
    else if (request.readyState == 4 && request.status == 204)
		{
			document.location.href = '/db_error';
		}
  };
}
