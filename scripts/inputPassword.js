const currentField = document.querySelector(".form input[type='password']");
const toggleButton = document.querySelector('.form .field i');

toggleButton.onclick = () => {
  if (currentField.type == 'password') {
    currentField.type = 'text';
    toggleButton.classList.add('active');
  } else {
    currentField.type = 'password';
    toggleButton.classList.remove('active');
  }
};
