const form = document.querySelector('.login form ');
const continueBtn = form.querySelector('.button input');
const errorText = document.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest(); // создаём XML объекта
  xhr.open('POST', 'php/login.php', true); // функция принимающая параметры для запроса
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == 'success'){
          location.href = "users.php";
        }else{
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  };
  //отправление данных через AJAX в PHP
  let formData = new FormData(form);
  xhr.send(formData);
};
