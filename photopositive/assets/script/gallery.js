// console.log('gallery');
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
    chooseLeaderPhoto3col(); // обновляем плитку претендентов
  } else if (leadersField[0].offsetWidth <= 260) {
    // в 1 колонку
    leadersPhoto1col(); // обновляем плитку лидеров
    chooseLeaderPhoto1col(); // обновляем плитку претендентов
  } else {
    // в 2 колонки
    leadersPhoto2col(); // обновляем плитку лидеров
    chooseLeaderPhoto2col(); // обновляем плитку претендентов
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

function chooseLeaderPhoto3col(el){
  //console.log('Выбор Лидера');
  //console.log(leadersField[0].children.length);
  var cols = []; // создаем массив для подсчета высоты колонок
  for (var i = 0; i < chooseLeadersField[0].children.length; i++) {
    var el = chooseLeadersField[0].children[i];
    el.classList.remove('d-none');
    if (cols.length < 3) {
      cols.push(el.offsetHeight);
      if(cols.length == 1) {
        // первый элемент
        var oSl = 0;
        //console.log(oSl);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 2) {
        // второй элемент
        var oSl = (((chooseLeadersField[0].offsetWidth - (el.offsetWidth * 3)) / 2) + el.offsetWidth);
        //console.log(oSl);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 3) {
        // третий элемент
        var oSl = (chooseLeadersField[0].offsetWidth - el.offsetWidth);
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
        var oSl = (((chooseLeadersField[0].offsetWidth - (el.offsetWidth * 3)) / 2) + el.offsetWidth);
        //console.log(oSl);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[1] += el.offsetHeight + 20;
      }
      if(numColumn == 2) {
        // третий элемент
        var oSt = cols[2] + 20;
        var oSl = (chooseLeadersField[0].offsetWidth - el.offsetWidth);
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
  chooseLeadersField[0].style.height = totalHeight + 'px';
}
function chooseLeaderPhoto2col(el){
  var cols = []; // создаем массив для подсчета высоты колонок
  for (var i = 0; i < chooseLeadersField[0].children.length; i++) {
    var el = chooseLeadersField[0].children[i];
    el.classList.remove('d-none');
    if (cols.length < 2) {
      cols.push(el.offsetHeight);
      if(cols.length == 1) {
        // первый элемент
        var oSl = 0;
        //console.log(oSl);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 2) {
        // третий элемент
        var oSl = (chooseLeadersField[0].offsetWidth - el.offsetWidth);
        //console.log(oSl);
        el.style.top = oSt + 'px';
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
        var oSl = (chooseLeadersField[0].offsetWidth - el.offsetWidth);
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
  chooseLeadersField[0].style.height = totalHeight + 'px';
}
function chooseLeaderPhoto1col(el){
  var cols = []; // создаем массив для подсчета высоты колонок
  for (var i = 0; i < chooseLeadersField[0].children.length; i++) {
    var el = chooseLeadersField[0].children[i];
    el.classList.remove('d-none');
    if (cols.length < 1) {
      cols.push(el.offsetHeight);
      if(cols.length == 0) {
        // первый элемент
        var oSl = 0;
        //console.log(oSl);
        el.style.top = oSt + 'px';
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
  chooseLeadersField[0].style.height = totalHeight + 'px';
}

var leadersField = document.getElementsByClassName('main-leaders__flex'); // поле с лидерами
var chooseLeadersField = document.getElementsByClassName('choose-leader__content'); // поле с Выбором лидера

addEventListener("load",  function(){reLoad(this)}, false); // активность после полной загрузки страницы
addEventListener("resize",  function(){reLoad(this)}, false); // активность после изменения размера страницы

// addEventListener("load",  function(){chooseLeaderPhoto(this)}, false); // активность после полной загрузки страницы

// сердечки
function chHeart(el){
  // console.log('Нажали на сердечко', el);
  event.preventDefault();

  let formData = new FormData(); // создаём объект, по желанию берём данные формы <form>
  if(el.children[0].children[0].name == 'dislike'){
    // console.log('Диз лайкаем');
    formData.append('dislike', el.children[0].children[0].value); // добавляем поле post_id с данными из кнопки
    formData.append('user_id', el.children[0].children[1].value); // добавляем поле user_id с данными из скратого input

  } else if(el.children[0].children[0].name == 'like') {
    // console.log('Лайкаем');
    formData.append('like', el.children[0].children[0].value); // добавляем поле post_id с данными из кнопки
    formData.append('user_id', el.children[0].children[1].value); // добавляем поле user_id с данными из скратого input

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
        el.children[0].children[0].name = 'dislike';
        el.children[0].children[0].innerHTML = '<i class="far fa-heart"></i>';
        el.children[0].children[2].name = 'dislike';
        el.children[0].children[2].innerHTML = '<i class="fas fa-heart"></i>';
        // изменяем счетчик лайков на +1
        // console.log(el.parentNode.children[1].innerHTML);
        let countLikes = Number(el.parentNode.children[2].innerHTML)+1;
        // console.log(countLikes);
        el.parentNode.children[2].innerHTML = countLikes;
      }
      if(likeRequest.response[0] == 'd') {
        // console.log("Меняем стили с дизлайка на лайк");
        el.children[0].children[0].name = 'like';
        el.children[0].children[0].innerHTML = '<i class="fas fa-heart"></i>';
        el.children[0].children[2].name = 'like';
        el.children[0].children[2].innerHTML = '<i class="far fa-heart"></i>';
        // изменяем счетчик лайков на -1
        // console.log(el.parentNode.children[1].innerHTML);
        let countLikes = Number(el.parentNode.children[2].innerHTML)-1;
        // console.log(countLikes);
        el.parentNode.children[2].innerHTML = countLikes;
      }
    }
  };

  likeRequest.onerror = function() {
    // console.log("Запрос не удался");
  };
}
let hearts = document.getElementsByClassName('change-heart'); // поле с сердцем и количеством лайков
for(let i = 0; i < hearts.length; i++){
  hearts[i].children[1].addEventListener("click",  function(){chHeart(this)}, false); // активность после полной загрузки страницы
}

// опции показа галереи
function changeOptions(el){
  // console.log('Отправляем форму');
  optionForm[0].submit();
}
var optionForm = document.getElementsByClassName('gal-options');
var optionDirectionUp = document.getElementById('up');
var optionDirectionDown = document.getElementById('down');
var optionSelect = document.getElementsByClassName('select-option');
optionDirectionUp.addEventListener("click",  function(){changeOptions(this)}, false);
optionDirectionDown.addEventListener("click",  function(){changeOptions(this)}, false);
optionSelect[0].addEventListener("change",  function(){changeOptions(this)}, false);

// открытие модального окна - забыли пароль
function telFeildCheck(el){
  // console.log('Проверка корректтности воода номера телефона во всплывающем окне', el);
  let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
  let valid = re.test(el.previousElementSibling.value);
  if (valid) {
    // console.log('Номер телефона подходит', el.previousElementSibling.value);
    let tel = '';
    for (let i = 0; i < el.previousElementSibling.value.length; i++) {
      if( (i == 0) && (el.previousElementSibling.value[i] == '+' ) && (el.previousElementSibling.value[i+1] == 7) ) {
        tel += '8';
        i = 2;
      }
      if(parseInt(el.previousElementSibling.value[i])) {
        tel += String(el.previousElementSibling.value[i]);
      }
    }
    if(el.previousElementSibling.classList.contains('error')) {
      el.previousElementSibling.classList.remove('error');
    }
    if(!el.previousElementSibling.classList.contains('ok')) {
      el.previousElementSibling.classList.add('ok');
    }
    // console.log('Добавляем проверку на присутствие телефона в БД', tel);
    let url = 'http://pv-documents/ajax/';
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
           let url = 'https://pv-foto.ru/ajax/';
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
  if (el.classList.contains('open-rules')) {
    // console.log('Показываем правила участия');
    modalContent[0].classList.remove('d-none');
    modalContent[0].children[2].classList.remove('d-none');
  }
  if (el.classList.contains('show-join-pop')) {
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
    // console.log('Элемент нажатия: ', el);
    // console.log('ID', el.getAttribute('data-id'));
    // console.log(regFormButtonEl);
    regFormButtonEl.parentNode.setAttribute('post-id', el.getAttribute('data-id'));
    // console.log(regFormButtonEl);
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
var modalContent = document.getElementsByClassName('modal');
var openFPButton = document.getElementsByClassName('foget-password');
let openJoinButton = document.getElementsByClassName('show-join-pop');
// var closeFPButton = document.getElementsByClassName('close-fp');
var openRules = document.getElementsByClassName('open-rules'); // открываем модальное окно с правилами участия
var closeRulesButton = document.getElementsByClassName('close-rules'); // закрываем модальное окно с правилами участия
openFPButton[0].addEventListener("click",  function(){openModal(this)}, { once: false, passive: true, capture: false } );
if(openJoinButton.length !== 0) {
  openJoinButton[0].addEventListener("click",  function(){openModal(this)}, { once: false, passive: true, capture: false } );
}
modalContent[0].addEventListener("click",  function(){closeModal(this)}, { once: false, passive: true, capture: true } );
let heartEl = document.getElementsByClassName('join-pop');
for(let i = 0; i < heartEl.length; i++ ){
  heartEl[i].addEventListener("click",  function(){openModal(this)});
  heartEl[i].addEventListener("touchstart",  function(){openModal(this)});
}


// позиционирование баннера
// левый
function leftBunnerPosition(){
  //console.log('Прокрутка:' + window.pageYOffset);
  let startFixed = leftBunnerEl[0].getBoundingClientRect().top + window.pageYOffset;
  //console.log('Начало фиксации:' + startFixed);
  let endFixed = leftBunnerEl[0].children[0].getBoundingClientRect().top + leftBunnerEl[0].children[0].getBoundingClientRect().height + window.pageYOffset;
  //console.log('Конец фиксации:' + endFixed);
  //console.log('Высота элемента:' + leftBunner[0].children[0].getBoundingClientRect().height);
  // для больших экранов
  if((window.pageYOffset + window.innerHeight) > (startFixed + leftBunnerEl[0].children[0].getBoundingClientRect().height)) {
    //console.log('Фиксируем:');
    //console.log(leftBunner[0].children[0]);
    if(leftBunnerEl[0].children[0].classList.contains('bunner-left-fixed')) {
      //console.log('Фиксед уже есть:');
    } else {
      leftBunnerEl[0].children[0].classList.add('bunner-left-fixed');
    }
  } else {
    //console.log('Убираем фиксацию:');
    if(leftBunnerEl[0].children[0].classList.contains('bunner-left-fixed')) {
      leftBunnerEl[0].children[0].classList.remove('bunner-left-fixed');
    } else {
      //console.log('Фиксед уже убран:');
    }
  }
  if((window.pageYOffset + window.innerHeight) > (startFixed + leftBunnerEl[0].children[1].getBoundingClientRect().height)) {
    //console.log('Фиксируем:');
    //console.log(leftBunner[0].children[0]);
    if(leftBunnerEl[0].children[1].classList.contains('bunner-left-mini-fixed')) {
      //console.log('Фиксед уже есть:');
    } else {
      leftBunnerEl[0].children[1].classList.add('bunner-left-mini-fixed');
    }
  } else {
    //console.log('Убираем фиксацию:');
    if(leftBunnerEl[0].children[1].classList.contains('bunner-left-mini-fixed')) {
      leftBunnerEl[0].children[1].classList.remove('bunner-left-mini-fixed');
    } else {
      //console.log('Фиксед уже убран:');
    }
  }
  // для экранов меньше 1300px
  // добавляет отступ внизу футера для горизонтального баннера
  if(window.innerWidth < 1300) {
    //console.log('Добавляем отступ');
    //console.log('Высота отступа '+ leftBunner[0].children[0].getBoundingClientRect().height);
    let footerMarginBottom = leftBunnerEl[0].children[1].getBoundingClientRect().height;
    footerEl[0].style.paddingBottom = footerMarginBottom + 'px';
  } else {
    // console.log('Убираем отступ');
    footerEl[0].style.paddingBottom = 11 + 'px';
  }
}
// правый
function rightBunnerPosition(){
  //console.log('Прокрутка:' + window.pageYOffset);
  let startFixed = rightBunnerEl[0].getBoundingClientRect().top + window.pageYOffset;
  //console.log('Начало фиксации:' + startFixed);
  let endFixed = rightBunnerEl[0].children[0].getBoundingClientRect().top + rightBunnerEl[0].children[0].getBoundingClientRect().height + window.pageYOffset;
  //console.log('Конец фиксации:' + endFixed);
  //console.log('Высота элемента:' + leftBunner[0].children[0].getBoundingClientRect().height);
  // для больших экранов
  if((window.pageYOffset + window.innerHeight) > (startFixed + rightBunnerEl[0].children[0].getBoundingClientRect().height)) {
    //console.log('Фиксируем:');
    //console.log(leftBunner[0].children[0]);
    if(rightBunnerEl[0].children[0].classList.contains('bunner-right-fixed')) {
      //console.log('Фиксед уже есть:');
    } else {
      rightBunnerEl[0].children[0].classList.add('bunner-right-fixed');
    }
  } else {
    //console.log('Убираем фиксацию:');
    if(rightBunnerEl[0].children[0].classList.contains('bunner-right-fixed')) {
      rightBunnerEl[0].children[0].classList.remove('bunner-right-fixed');
    } else {
      //console.log('Фиксед уже убран:');
    }
  }
  // для экранов меньше 1300px
  if((window.pageYOffset + window.innerHeight) > (startFixed + rightBunnerEl[0].children[1].getBoundingClientRect().height)) {
    //console.log('Фиксируем:');
    //console.log(leftBunner[0].children[0]);
    if(rightBunnerEl[0].children[1].classList.contains('bunner-right-mini-fixed')) {
      //console.log('Фиксед уже есть:');
    } else {
      rightBunnerEl[0].children[1].classList.add('bunner-right-mini-fixed');
    }
  } else {
    //console.log('Убираем фиксацию:');
    if(rightBunnerEl[0].children[1].classList.contains('bunner-right-mini-fixed')) {
      rightBunnerEl[0].children[1].classList.remove('bunner-right-mini-fixed');
    } else {
      //console.log('Фиксед уже убран:');
    }
  }
}
let leftBunnerEl = document.getElementsByClassName('bunner-left');
let rightBunnerEl = document.getElementsByClassName('bunner-right');
addEventListener("scroll",  function(){leftBunnerPosition()}, false); // позиция баннера при прокрутке страницы
addEventListener("scroll",  function(){rightBunnerPosition()}, false); // позиция баннера при прокрутке страницы
let footerEl = document.getElementsByClassName('footer');

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

// function checkPress(el){
//   console.log(el);
//   if(element) {
//     element.children[0].style.opacity = 0;
//   }
//   console.log('Элемент'+ el.children[0]);
//   element = el;
//   startDate = new Date();
//   //console.log('Дата '+ startDate);
//   //console.log('Нажали'+ event);
//   // прерываем переход по ссылке
//   event.preventDefault();
//   event.stopPropagation();
//   // console.log(event.target);
//   href = event.target.getAttribute('href');
//   // console.log('href'+ href);
//   interval = setInterval(showTimer, 100);
// }
// function checkUnPress(el){
//   console.log(el);
//   endDate = new Date();
//   //console.log('Дата '+ endDate);
//   //console.log('Нажали'+ event);
//   //console.log('прошло'+ (endDate - startDate));
//   if(endDate - startDate < 2000) {
//     document.location.href = href;
//   }
// }
// let cardEl = document.getElementsByClassName('card__comment');
// for (let i = 0; i < cardEl.length; i++) {
//   cardEl[i].addEventListener("touchstart", function () { checkPress(this); });
//   cardEl[i].addEventListener("touchend", function () { checkUnPress(this); });
// }
//document.addEventListener("touchstart", function () { checkPress(this); });
//document.addEventListener("touchend", function () { checkUnPress(this); });
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
  // if(tel) {
      // console.log('Регистрационный номер телефона: ', tel);
  // }
}
let regFormButtonEl = document.getElementById('reg-form-button'); // кнопка принять участие
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
let inputLoginTelElelement = document.getElementById('input-login-tel'); // input ввода номера телефона
inputLoginTelElelement.addEventListener("keyup",  function(){inputCheckTel(this)}, false);
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
