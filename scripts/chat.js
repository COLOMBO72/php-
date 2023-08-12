const form = document.querySelector('.typing-area');
const sendBtn = form.querySelector('button');
const inputField = form.querySelector('.input-field');
const chatBox = document.querySelector('.chat-box');

form.onsubmit = (e) => {
  e.preventDefault();
};

sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest(); // создаём XML объекта
  xhr.open('POST', 'php/insert-chat.php', true); // функция принимающая параметры для запроса
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = '';
        scrollBottom();
      }
    }
  };
  //отправление данных через AJAX в PHP
  let formData = new FormData(form);
  xhr.send(formData);
};

chatBox.onmouseenter = () => {
  chatBox.classList.add("active")
}
chatBox.onmouseleave = () => {
  chatBox.classList.remove("active")
}

setInterval(() => {
  // функция проверяющая людей в сети через каждые 0.5с
  let xhr = new XMLHttpRequest(); // создаём XML объекта
  xhr.open('POST', 'php/get-chat.php', true); // функция принимающая параметры для запроса
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")){
          scrollBottom();
        }else{
          
        }
      }
    }
  };
  //отправление данных через AJAX в PHP
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);

function scrollBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
