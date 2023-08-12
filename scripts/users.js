const searchBar = document.querySelector('.search input');
const searchBtn = document.querySelector('.search button');
const searchSpan = document.querySelector('.search span');
const usersList = document.querySelector('.users-list');

searchBtn.onclick = () => {
  searchBar.classList.toggle('active');
  searchSpan.classList.toggle('unactive');
  searchBar.focus();
  searchBtn.classList.toggle('active');
  searchBar.value = '';
};

searchBar.onkeyup = () => {
  // onkeyup - на каждый введённый символ делать заданную функцию
  let searchTerm = searchBar.value;
  if (searchTerm != '') {
    // добавляем фейк-класс, чтобы остановить обновление
    searchBar.classList.add('active');
  } else {
    searchBar.classList.remove('active');
  }
  let xhr = new XMLHttpRequest(); // создаём XML объекта
  xhr.open('POST', 'php/search.php', true); // функция принимающая параметры для запроса
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('searchTerm=' + searchTerm);
};

setInterval(() => {
  // функция проверяющая людей в сети через каждые 0.5с
  let xhr = new XMLHttpRequest(); // создаём XML объекта
  xhr.open('GET', 'php/users.php', true); // функция принимающая параметры для запроса
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (!searchBar.classList.contains('active')) {
          // если имеется active в классе у searchBar - не обновлять и наоборот
          usersList.innerHTML = data;
        }
      }
    }
  };
  xhr.send();
}, 500);
