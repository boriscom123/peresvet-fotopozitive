// console.log('archive');
// отображение навигации
function openNav(el){
  if (openBurgerMenu[0].children[1].classList.contains('d-none')) {
    openBurgerMenu[0].children[1].classList.remove('d-none');
  } else {
    openBurgerMenu[0].children[1].classList.add('d-none');
  }
  closeBurgerMenu.addEventListener("mouseout",  function(){closeNav(this)}, { once: true, passive: true, capture: false } ); // активность после нажатия на любое место 1 раз
  addEventListener("scroll",  function(){closeNav(this)}, { once: true, passive: true, capture: false } ); // активность после нажатия на любое место 1 раз
}
function closeNav(el){
  if (openBurgerMenu[0].children[1].classList.contains('d-none')) {
  } else {
    openBurgerMenu[0].children[1].classList.add('d-none');
  }
}

var openBurgerMenu = document.getElementsByClassName('header-flex__burger'); // поле с 4 линиями в навигации header
openBurgerMenu[0].addEventListener("click",  function(){openNav(this)}, { once: false, passive: true, capture: false } ); // активность после клика на поле
openBurgerMenu[0].addEventListener("mouseover",  function(){openNav(this)}, { once: false, passive: true, capture: false } ); // активность после наведения на поле
openBurgerMenu[0].addEventListener("mouseout",  function(){closeNav(this)}, { once: false, passive: true, capture: false } ); // активность после наведения на поле
var closeBurgerMenu = document.body;

// расстановка фотогалереи
function reLoad(el) {
  // console.log('Обновляем галерею');
  // console.log(leadersField[0].offsetWidth);
  if(leadersField[0].offsetWidth > 400) {
    // в 3 колонки
    leadersPhoto3col(); // обновляем плитку лидеров
  } else if (leadersField[0].offsetWidth <= 260) {
    // в 1 колонку
    leadersPhoto1col(); // обновляем плитку лидеров
  } else {
    // в 2 колонки
    leadersPhoto2col(); // обновляем плитку лидеров
  }
}
function minKey(arr){
  arrMin = arr[0];
  arrKey = 0;
  for (var i = 0; i < arr.length; i++) {
    if(arrMin > arr[i]) {
        arrMin = arr[i];
        arrKey = i;
    }
  }
  return arrKey;
}

function leadersPhoto3col(el){
  var cols = []; // создаем массив для подсчета высоты колонок
  for (var i = 0; i < leadersField[0].children.length; i++) {
    var el = leadersField[0].children[i];
    el.classList.remove('d-none');
    if (cols.length < 3) {
      cols.push(el.offsetHeight);
      // console.log('Добавляем: ');
      // console.log(el.offsetHeight);
      if(cols.length == 1) {
        // первый элемент
        var oSl = 0;
        //console.log(oSl);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 2) {
        // второй элемент
        var oSl = (((leadersField[0].offsetWidth - (el.offsetWidth * 3)) / 2) + el.offsetWidth);
        //console.log(oSl);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 3) {
        // третий элемент
        var oSl = (leadersField[0].offsetWidth - el.offsetWidth);
        //console.log(oSl);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
    } else {
      var numColumn = minKey(cols);
      //console.log('Минимальный ключ' + numColumn);
      if(numColumn == 0) {
        // первый элемент
        var oSt = cols[0] + 20;
        var oSl = 0;
        //console.log(oSl);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[0] += el.offsetHeight + 20;
      }
      if(numColumn == 1) {
        // второй элемент
        var oSt = cols[1] + 20;
        var oSl = (((leadersField[0].offsetWidth - (el.offsetWidth * 3)) / 2) + el.offsetWidth);
        //console.log(oSl);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[1] += el.offsetHeight + 20;
      }
      if(numColumn == 2) {
        // третий элемент
        var oSt = cols[2] + 20;
        var oSl = (leadersField[0].offsetWidth - el.offsetWidth);
        //console.log(oSl);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[2] += el.offsetHeight + 20;
      }
    }
  }
  var totalHeight = Math.max.apply( null, cols );
  //console.log(cols);
  //console.log(Math.min.apply( null, cols ));
  //console.log(Math.max.apply( null, cols ));
  leadersField[0].style.height = totalHeight + 'px';
}
function leadersPhoto2col(el){
  var cols = []; // создаем массив для подсчета высоты колонок
  for (var i = 0; i < leadersField[0].children.length; i++) {
    var el = leadersField[0].children[i];
    el.classList.remove('d-none');
    if (cols.length < 2) {
      cols.push(el.offsetHeight);
      if(cols.length == 1) {
        // первый элемент
        var oSl = 0;
        //console.log(oSl);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 2) {
        // третий элемент
        var oSl = (leadersField[0].offsetWidth - el.offsetWidth);
        //console.log(oSl);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
    } else {
      var numColumn = minKey(cols);
      //console.log('Минимальный ключ' + numColumn);
      if(numColumn == 0) {
        // первый элемент
        var oSt = cols[0] + 20;
        var oSl = 0;
        //console.log(oSl);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[0] += el.offsetHeight + 20;
      }
      if(numColumn == 1) {
        // третий элемент
        var oSt = cols[1] + 20;
        var oSl = (leadersField[0].offsetWidth - el.offsetWidth);
        //console.log(oSl);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[1] += el.offsetHeight + 20;
      }
    }
  }
  var totalHeight = Math.max.apply( null, cols );
  //console.log(cols);
  //console.log(Math.min.apply( null, cols ));
  //console.log(Math.max.apply( null, cols ));
  leadersField[0].style.height = totalHeight + 'px';
}
function leadersPhoto1col(el){
  var cols = []; // создаем массив для подсчета высоты колонок
  for (var i = 0; i < leadersField[0].children.length; i++) {
    var el = leadersField[0].children[i];
    el.classList.remove('d-none');
    if (cols.length < 1) {
      cols.push(el.offsetHeight);
      if(cols.length == 1) {
        // первый элемент
        var oSl = 0;
        //console.log(oSl);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
    } else {
      var numColumn = minKey(cols);
      //console.log('Минимальный ключ' + numColumn);
      if(numColumn == 0) {
        // первый элемент
        var oSt = cols[0] + 20;
        var oSl = 0;
        //console.log(oSl);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[0] += el.offsetHeight + 20;
      }
    }
  }
  var totalHeight = Math.max.apply( null, cols );
  //console.log(cols);
  //console.log(Math.min.apply( null, cols ));
  //console.log(Math.max.apply( null, cols ));
  leadersField[0].style.height = totalHeight + 'px';
}

var leadersField = document.getElementsByClassName('main-leaders__flex'); // поле с лидерами

addEventListener("load",  function(){reLoad(this)}, false); // активность после полной загрузки страницы
addEventListener("resize",  function(){reLoad(this)}, false); // активность после изменения размера страницы

// обрабатываем нажатия на экран
let startDate, endDate, interval, href, element;
function showTimer(){
  endDate = new Date();
  //console.log('Таймер'+ (endDate - startDate));
  //console.log(element.children[0].children[1]);
  if(endDate - startDate > 2000) {
    clearInterval(interval);
    element.children[0].style.opacity = 1;
  }
}

function checkPress(el){
  console.log(el);
  if(element) {
    element.children[0].style.opacity = 0;
  }
  console.log('Элемент'+ el.children[0]);
  element = el;
  startDate = new Date();
  //console.log('Дата '+ startDate);
  //console.log('Нажали'+ event);
  // прерываем переход по ссылке
  event.preventDefault();
  event.stopPropagation();
  // console.log(event.target);
  href = event.target.getAttribute('href');
  // console.log('href'+ href);
  interval = setInterval(showTimer, 100);
}
function checkUnPress(el){
  console.log(el);
  endDate = new Date();
  //console.log('Дата '+ endDate);
  //console.log('Нажали'+ event);
  //console.log('прошло'+ (endDate - startDate));
  if(endDate - startDate < 2000) {
    document.location.href = href;
  }
}
let cardEl = document.getElementsByClassName('card__comment');
for (let i = 0; i < cardEl.length; i++) {
  cardEl[i].addEventListener("touchstart", function () { checkPress(this); });
  cardEl[i].addEventListener("touchend", function () { checkUnPress(this); });
}
//document.addEventListener("touchstart", function () { checkPress(this); });
//document.addEventListener("touchend", function () { checkUnPress(this); });
// открытие модального окна - забыли пароль
function telFeildCheck(el){
  // console.log('Проверка корректтности воода номера телефона во всплывающем окне', el);
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
    formData.set('tel', tel);
    let loginCheck = fetch(url, {
      method: 'POST',
      // headers: { 'Content-Type': 'text/plain;charset=utf-8' },
      body: formData
    }).then(response => response.text()).then((response)=> { console.log(response);
       if(response === 'true') {
         // console.log('Такого номера телефона нет в базе');
         el.parentNode.previousElementSibling.innerHTML = 'Такого номера телефона нет в базе. <br> Проверьте правильность ввода данных.'
       }
       else {
         // console.log('Такой номер телефона есть в базе - высылаем пароль для входа');
         el.parentNode.previousElementSibling.innerHTML = 'Пароль для входа отправлен в смс';
         if(tel){
           // высылаем новый пароль
           let sendedPass = '';
           let url = 'https://pv-foto.ru/wp-content/themes/photopositive/assets/ajax/sms.php';
           let formData = new FormData();
           formData.set('tel', tel);
           fetch(url, {
             method: 'POST',
             body: formData
           }).then(response => response.text()).then((response)=> {
             // console.log('Ответ сервера: ', response);
             // sendedPass = response;
             // меняем пароль для пользователя в БД
             let url = 'https://pv-foto.ru/ajax/';
             let formData = new FormData();
             formData.set('tel', tel);
             formData.set('u-pass', response);
             fetch(url, {
               method: 'POST',
               body: formData
             }).then(response => response.text()).then((response)=> {
               // console.log('Ответ сервера: ', response);
               setTimeout(()=>{modalContent[0].classList.add('d-none');}, 3000);
             });
           });
         }
      }
    });
  } else {
    // console.log('Номер телефона Не подходит', el.previousElementSibling.value);
    if(el.previousElementSibling.classList.contains('ok')) {
      el.previousElementSibling.classList.remove('ok');
    }
    if(!el.previousElementSibling.classList.contains('error')) {
      el.previousElementSibling.classList.add('error');
    }
  }
}
function openModal(el){
  // console.log('Показываем модальное окно');
  if (el.classList.contains('open-rules')) {
    // console.log('Показываем правила участия');
    modalContent[0].classList.remove('d-none');
    modalContent[0].children[2].classList.remove('d-none');
  }
  if (el.classList.contains('show-join-pop')) {
    // console.log('Показываем окно с возможностью регистрации');
    let formEl = modalContent[0].children[1].children[0].children[2].children[0];
    let hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'redirect');
    hiddenInput.setAttribute('value', 'true');
    formEl.append(hiddenInput);
    modalContent[0].classList.remove('d-none');
    modalContent[0].children[1].classList.remove('d-none');
  }
  if (el.classList.contains('join-pop')) {
    modalContent[0].classList.remove('d-none');
    modalContent[0].children[1].classList.remove('d-none');
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
    for (let i = 0; i < modalContent[0].children.length; i++) {
      if (modalContent[0].children[i].classList.contains('d-none')) {
      } else {
        modalContent[0].children[i].classList.add('d-none');
      }
    }
  }
  if(event.target.tagName == 'I') {
    modalContent[0].classList.add('d-none');
    for (let i = 0; i < modalContent[0].children.length; i++) {
      if (modalContent[0].children[i].classList.contains('d-none')) {
      } else {
        modalContent[0].children[i].classList.add('d-none');
      }
    }
  }
}
let modalContent = document.getElementsByClassName('modal');
let openFPButton = document.getElementsByClassName('foget-password');
let openJoinButton = document.getElementsByClassName('show-join-pop');
let closeFPButton = document.getElementsByClassName('close-fp');
let openRules = document.getElementsByClassName('open-rules');
let closeRulesButton = document.getElementsByClassName('close-rules');
openFPButton[0].addEventListener("click",  function(){openModal(this)}, { once: false, passive: true, capture: false } );
if(openJoinButton.length !== 0) {
  openJoinButton[0].addEventListener("click",  function(){openModal(this)}, { once: false, passive: true, capture: false } );
}
modalContent[0].addEventListener("click",  function(){closeModal(this)}, { once: false, passive: true, capture: true } );
closeFPButton[0].addEventListener("click",  function(){closeModal(this)}, { once: false, passive: true, capture: true } );

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
    console.log('Номер телефона Не подходит', );
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
