// console.log('Одиночный просмотр');
// открытие модального окна
function openModal(el){
  if (el.classList.contains('open-rules')) {
    // console.log('Показываем правила участия');
    modalContent[0].classList.remove('d-none');
    modalContent[0].children[2].classList.remove('d-none');
  }
  if (el.classList.contains('show-join-pop')) {
    // console.log('Присоединиться');
    modalContent[0].classList.remove('d-none');
    modalContent[0].children[1].classList.remove('d-none');
  }
  if (el.classList.contains('join-pop')) {
    // console.log('Присоединиться');
    modalContent[0].classList.remove('d-none');
    modalContent[0].children[1].classList.remove('d-none');
    regFormButtonEl.parentNode.setAttribute('post-id', el.getAttribute('data-id'));
  }
  if (el.classList.contains('foget-password')) {
    // console.log('Показываем окно восстановления пароля');
    modalContent[0].classList.remove('d-none');
    modalContent[0].children[1].classList.add('d-none');
    modalContent[0].children[2].classList.remove('d-none');
    // добавляем проверку введенного номера телефона
    modalContent[0].children[2].children[0].children[3].children[1].addEventListener("click",  function(){recoverPassword(this)});
  }
}
function closeModal(){
  if(event.target.tagName == 'DIV') {
    modalContent[0].classList.add('d-none');
    for (var i = 0; i < modalContent[0].children.length; i++) {
      if (modalContent[0].children[i].classList.contains('d-none')) {
      } else {
        modalContent[0].children[i].classList.add('d-none');
      }
    }
  }
  if(event.target.tagName == 'I') {
    modalContent[0].classList.add('d-none');
    for (var i = 0; i < modalContent[0].children.length; i++) {
      if (modalContent[0].children[i].classList.contains('d-none')) {
      } else {
        modalContent[0].children[i].classList.add('d-none');
      }
    }
  }
}
let modalContent = document.getElementsByClassName('modal');
let openJoinButton = document.getElementsByClassName('show-join-pop');
let openFPButton = document.getElementsByClassName('foget-password');
openFPButton[0].addEventListener("click",  function(){openModal(this)}, { once: false, passive: true, capture: false } );
if(openJoinButton.length !== 0) {
  openJoinButton[0].addEventListener("click",  function(){openModal(this)}, { once: false, passive: true, capture: false } );
}
modalContent[0].addEventListener("click",  function(){closeModal(this)}, { once: false, passive: true, capture: true } );
let heartEl = document.getElementsByClassName('join-pop');
for(let i = 0; i < heartEl.length; i++ ){
  heartEl[i].addEventListener("click",  function(){openModal(this)}, { once: false, passive: true, capture: false } );
}
// новый вид регистрации от 20-03-2021
function telCheck(el){
  // console.log('Функция проверки ввода номера телефона');
  // let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
  let re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
  let valid = re.test(el.children[2].children[0].value);
  if (valid) {
    // console.log('Номер телефона подходит');
    let tel = '';
    for (let i = 0; i < el.children[2].children[0].value.length; i++) {
      // console.log('Символ: ', el.children[2].children[0].value[i]);
      if( (i == 0) && (el.children[2].children[0].value[i] == '+' ) && (el.children[2].children[0].value[i+1] == 7) ) {
        tel += '8';
        i = 2;
      }
      if(parseInt(el.children[2].children[0].value[i])) {
        // console.log('parseInt: ');
        tel += String(el.children[2].children[0].value[i]);
      } else if (el.children[2].children[0].value[i] == 0 && el.children[2].children[0].value[i] != ' ') {
        // console.log('Ноль');
        tel += 0;
      }
    }
    if(el.children[2].classList.contains('error')) {
      el.children[2].classList.remove('error');
    }
    if(!el.children[2].classList.contains('ok')) {
      el.children[2].classList.add('ok');
    }
    // console.log('Добавляем проверку на присутствие телефона в БД', tel);
    let url = 'https://pv-foto.ru/ajax/';
    let formData = new FormData();
    // formData.set('name', name);
    formData.set('tel', tel);
    formData.set('post-id', el.getAttribute('post-id'));
    // formData.set('info', info);
    // console.log('Запрос для отправки: tel=', tel);
    let loginCheck = fetch(url, {
      method: 'POST',
      // headers: { 'Content-Type': 'text/plain;charset=utf-8' },
      body: formData
    }).then(response => response.text()).then((response)=> {
      // console.log('ответ сервера:', response);
      if(response === 'true') {
        // console.log('login был свобоен - регистрация прошла успешно. Показываем поле для ввода пароля для входа.');
        // показываем всплывающее окно для ввода пароля
        modalContent[0].children[1].classList.add('d-none');
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[2].classList.remove('d-none');
        modalContent[0].children[2].children[0].children[1].innerHTML = 'Для входа';
        modalContent[0].children[2].children[0].children[2].innerHTML = 'введите пароль из СМС';
        modalContent[0].children[2].children[0].children[3].innerHTML = `
        <input type="password" name="pass" value="" placeholder="Введите пароль" required>
        <input type="submit" name="login-submit" value="Отправить">
        <input type="hidden" name="login" value="${tel}">
        `;
      }
      else {
        el.children[1].innerHTML = 'Такой номер телефона уже используется. Введите другой номер.';
        // console.log('Телефон уже используется');
        if(el.children[2].classList.contains('ok')) {
          el.children[2].classList.remove('ok');
        }
        if(!el.children[2].classList.contains('error')) {
          el.children[2].classList.add('error');
        }
      }
    });
  } else {
    // console.log('Номер телефона Не подходит', );
    if(el.children[2].classList.contains('ok')) {
      el.children[2].classList.remove('ok');
    }
    if(!el.children[2].classList.contains('error')) {
      el.children[2].classList.add('error');
    }
  }
}
function recoverPassword(el){
  // console.log('кнопка восстановления пароля', el);
  // let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
  let re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
  let valid = re.test(el.children[2].children[0].value);
  if (valid) {
    // console.log('Номер телефона подходит');
    let tel = '';
    for (let i = 0; i < el.children[2].children[0].value.length; i++) {
      // console.log('Символ: ', el.children[2].children[0].value[i]);
      if( (i == 0) && (el.children[2].children[0].value[i] == '+' ) && (el.children[2].children[0].value[i+1] == 7) ) {
        tel += '8';
        i = 2;
      }
      if(parseInt(el.children[2].children[0].value[i])) {
        // console.log('parseInt: ');
        tel += String(el.children[2].children[0].value[i]);
      } else if (el.children[2].children[0].value[i] == 0 && el.children[2].children[0].value[i] != ' ') {
        // console.log('Ноль');
        tel += 0;
      }
    }
    if(el.previousElementSibling.classList.contains('error')) {
      el.previousElementSibling.classList.remove('error');
    }
    if(!el.previousElementSibling.classList.contains('ok')) {
      el.previousElementSibling.classList.add('ok');
    }
    // console.log('Добавляем проверку на присутствие телефона в БД', tel);
    let url = 'https://pv-foto.ru/ajax/';
    let formData = new FormData();
    // formData.set('name', name);
    formData.set('reg-tel', tel);
    formData.set('foget-password-submit', 'true');
    // formData.set('info', info);
    // console.log('Запрос для отправки: tel=', tel);
    let loginCheck = fetch(url, {
      method: 'POST',
      // headers: { 'Content-Type': 'text/plain;charset=utf-8' },
      body: formData
    }).then(response => response.text()).then((response)=> {
      // console.log('ответ сервера:', response);
      if(response === 'true') {
        // console.log('Номер телефна есть в базе. Сбрасываем пароль.');
        // показываем всплывающее окно для ввода пароля
        el.parentNode.previousElementSibling.innerHTML = '';
        // modalContent[0].children[3].classList.add('d-none');
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[2].classList.remove('d-none');
        modalContent[0].children[2].children[0].children[1].innerHTML = 'Для продолжения';
        modalContent[0].children[2].children[0].children[2].innerHTML = 'введите пароль из СМС';
        modalContent[0].children[2].children[0].children[3].innerHTML = `
        <input type="password" name="pass" value="" placeholder="Введите пароль" required>
        <input type="submit" name="login-submit" value="Отправить">
        <input type="hidden" name="login" value="${tel}">
        `;
      }
      else {
        el.parentNode.previousElementSibling.innerHTML = 'Такого номера телефона нет. Введите другой номер.';
        // console.log('Такого номера телефона нет');
        if(el.previousElementSibling.classList.contains('ok')) {
          el.previousElementSibling.classList.remove('ok');
        }
        if(!el.previousElementSibling.classList.contains('error')) {
          el.previousElementSibling.classList.add('error');
        }
      }
    });
  } else {
    // console.log('Номер телефона Не подходит', );
    if(el.previousElementSibling.classList.contains('ok')) {
      el.previousElementSibling.classList.remove('ok');
    }
    if(!el.previousElementSibling.classList.contains('error')) {
      el.previousElementSibling.classList.add('error');
    }
  }
}
function checkSmsPass(val){
  // console.log('Сверяем пароли');
  // console.log('Искомый пароль:', val);
  if(modalContent[0].children[2].children[0].children[2].children[0].value == val){
    console.log('Пароли совпали, отправляем данные для регистрации пользователя');
    // отправляем данные для регистрации пользователя
    modalContent[0].children[2].children[0].children[2].innerHTML += '<input type="hidden" name="pass2" value="'+ val +'">';
    modalContent[0].children[2].children[0].children[2].submit();
  } else {
    event.preventDefault();
    // console.log('Пароли НЕ совпали');
    // просим ввести пароль повторно
    modalContent[0].children[2].children[0].children[1].innerHTML = 'Пароль не совпал - попробуйте еще раз';
  }
}
function checkRegform(el){
  let regform = el.parentNode;
  event.preventDefault();
  let tel = telCheck(regform);
  if(tel) {
      // console.log('Регистрационный номер телефона: ', tel);
  }
}
let regFormButtonEl = document.getElementById('reg-form-button');
if(regFormButtonEl) {
  regFormButtonEl.addEventListener("click",  function(){checkRegform(this)}, false);
}
function inputCheckTel(el){
  // console.log('Проверяем номер телефона при нажатии клавиш', el);
  let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
  let valid = re.test(el.value);
  if (valid) {
    // console.log('Номер телефона подходит');
    if(el.parentNode.classList.contains('error')) {
      el.parentNode.classList.remove('error');
    }
    if(!el.parentNode.classList.contains('ok')) {
      el.parentNode.classList.add('ok');
    }
  } else {
    // console.log('Номер телефона Не подходит');
    if(el.parentNode.classList.contains('ok')) {
      el.parentNode.classList.remove('ok');
    }
    if(!el.parentNode.classList.contains('error')) {
      el.parentNode.classList.add('error');
    }
  }
}
let inputElelement = document.getElementById('input-reg-tel'); // input ввода номера телефона
inputElelement.addEventListener("keyup",  function(){inputCheckTel(this)}, false);
function inputCheckFogetTel(el){
  // console.log('Проверяем номер телефона при нажатии клавиш', el);
  let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
  let valid = re.test(el.value);
  if (valid) {
    // console.log('Номер телефона подходит');
    if(el.classList.contains('error')) {
      el.classList.remove('error');
    }
    if(!el.classList.contains('ok')) {
      el.classList.add('ok');
    }
  } else {
    // console.log('Номер телефона Не подходит');
    if(el.classList.contains('ok')) {
      el.classList.remove('ok');
    }
    if(!el.classList.contains('error')) {
      el.classList.add('error');
    }
  }
}
let inputFogetTelElelement = document.getElementById('input-foget-tel'); // input ввода номера телефона
inputFogetTelElelement.addEventListener("keyup",  function(){inputCheckFogetTel(this)}, false);

// сердечки
function chHeart(el){
  // console.log('Нажали на сердечко', el);
  event.preventDefault();

  let formData = new FormData(); // создаём объект, по желанию берём данные формы <form>
  if(el.children[0].name == 'dislike'){
    // console.log('Диз лайкаем');
    formData.append('dislike', el.children[0].value); // добавляем поле post_id с данными из кнопки
    formData.append('user_id', el.children[1].value); // добавляем поле user_id с данными из скратого input

  } else if(el.children[0].name == 'like') {
    // console.log('Лайкаем');
    formData.append('like', el.children[0].value); // добавляем поле post_id с данными из кнопки
    formData.append('user_id', el.children[1].value); // добавляем поле user_id с данными из скратого input

  } else {
    // console.log('Непонятно');
  }

  let likeRequest = new XMLHttpRequest();
  let method = 'POST';
  let url = 'https://pv-foto.ru/ajax/'
  likeRequest.open(method, url); // подготавливаем запрос
  likeRequest.send(formData); // посылаем запрос

  likeRequest.onload = function() {
    if (likeRequest.status != 200) { // анализируем HTTP-статус ответа, если статус не 200, то произошла ошибка
      // console.log(`Ошибка ${likeRequest.status}: ${likeRequest.statusText}`); // Например, 404: Not Found
    } else { // если всё прошло гладко, выводим результат
      // console.log(`Готово, получили ${likeRequest.response.length} байт`); // response -- это ответ сервера
      // console.log('Полученный ответ: ', likeRequest.response);
      // после удачного ответа от сервера - меняем стили для кнопок
      if (likeRequest.response[0] == 'l') {
        // console.log("Меняем стили с лайка на дизлайк");
        el.children[0].name = 'dislike';
        el.children[0].innerHTML = '<i class="far fa-heart"></i>';
        el.children[2].name = 'dislike';
        el.children[2].innerHTML = '<i class="fas fa-heart"></i>';
        // изменяем счетчик лайков на +1
        // console.log(el.parentNode.children[1].innerHTML);
        let countLikes = Number(el.parentNode.nextElementSibling.innerHTML)+1;
        // console.log(countLikes);
        el.parentNode.nextElementSibling.innerHTML = countLikes;
      }
      if(likeRequest.response[0] == 'd') {
        // console.log("Меняем стили с дизлайка на лайк");
        el.children[0].name = 'like';
        el.children[0].innerHTML = '<i class="fas fa-heart"></i>';
        el.children[2].name = 'like';
        el.children[2].innerHTML = '<i class="far fa-heart"></i>';
        // изменяем счетчик лайков на -1
        // console.log(el.parentNode.children[1].innerHTML);
        let countLikes = Number(el.parentNode.nextElementSibling.innerHTML)-1;
        // console.log(countLikes);
        el.parentNode.nextElementSibling.innerHTML = countLikes;
      }
    }
  };

  likeRequest.onerror = function() {
    // console.log("Запрос не удался");
  };
}
let hearts = document.getElementsByClassName('likes'); // поле с сердцем и количеством лайков
if(hearts.length !== 0) {
  hearts[0].addEventListener("click",  function(){chHeart(this)}, false); // активность после полной загрузки страницы
}
