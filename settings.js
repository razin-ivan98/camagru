function new_avatar() {
  var forme = document.querySelector("#change_avatar");
  var request = new XMLHttpRequest();
  request.open("POST", "settings/new_avatar/", true);

  var formData = new FormData(forme);
  request.send(formData);

  // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      //alert(request.responseText);
      var answer = JSON.parse(request.responseText);
      if (answer.answer === true) alert("Success");
      else alert("Error");
    }
  };
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
  request.send(formData);

  // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      // alert(request.responseText);
      var answer = JSON.parse(request.responseText);
      if (answer.answer === true) alert("Success");
      else alert(answer.text);
    }
  };
}
