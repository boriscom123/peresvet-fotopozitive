// console.log('UP-Gallery');
// отображение навигации
function openNav(el){
  if (openBurgerMenu[0].children[1].classList.contains('d-none')) {
    openBurgerMenu[0].children[1].classList.remove('d-none');
  } else {
    openBurgerMenu[0].children[1].classList.add('d-none');
  }
  closeBurgerMenu.addEventListener("mouseout",  function(){closeNav(this)}, { once: true, passive: true, capture: false } );
  addEventListener("scroll",  function(){closeNav(this)}, { once: true, passive: true, capture: false } );
}
function closeNav(el){
  if (openBurgerMenu[0].children[1].classList.contains('d-none')) {
  } else {
    openBurgerMenu[0].children[1].classList.add('d-none');
  }
}

var openBurgerMenu = document.getElementsByClassName('header-flex__burger');
openBurgerMenu[0].addEventListener("click",  function(){openNav(this)}, { once: false, passive: true, capture: false } );
openBurgerMenu[0].addEventListener("mouseover",  function(){openNav(this)}, { once: false, passive: true, capture: false } );
openBurgerMenu[0].addEventListener("mouseout",  function(){closeNav(this)}, { once: false, passive: true, capture: false } );
var closeBurgerMenu = document.body;

// отображение полей для смены пароля
function showHidePassFields(el){
  if(el.nextElementSibling.classList.contains('d-none')){
    el.nextElementSibling.classList.remove('d-none');
    el.nextElementSibling.classList.add('user-form-password-field');
  } else {
    el.nextElementSibling.classList.remove('user-form-password-field');
    el.nextElementSibling.classList.add('d-none');
  }
}
let passTitleEl = document.getElementsByClassName('user-form-changepassword');
passTitleEl[0].addEventListener("click",  function(){showHidePassFields(this)}, { once: false, passive: true, capture: false } );
// расстановка фотогалереи
function reLoad(el) {

  if(leadersField[0].offsetWidth > 600) {
    // в 3 колонки
    leadersPhoto3col();
  } else if (leadersField[0].offsetWidth <= 360) {
    // в 1 колонку
    leadersPhoto1col();
  } else {
    // в 2 колонки
    leadersPhoto2col();

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
      if(cols.length == 1) {
        // первый элемент - поле для меню размером 200 на 200 пикселей
        var oSl = 0;
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 2) {
        // второй элемент
        var oSl = (((leadersField[0].offsetWidth - (el.offsetWidth * 3)) / 2) + el.offsetWidth);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 3) {
        // третий элемент
        var oSl = (leadersField[0].offsetWidth - el.offsetWidth);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
    } else {
      var numColumn = minKey(cols);
      if(numColumn == 0) {
        // первый элемент
        var oSt = cols[0] + 20;
        var oSl = 0;
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[0] += el.offsetHeight + 20;
      }
      if(numColumn == 1) {
        // второй элемент
        var oSt = cols[1] + 20;
        var oSl = (((leadersField[0].offsetWidth - (el.offsetWidth * 3)) / 2) + el.offsetWidth);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[1] += el.offsetHeight + 20;
      }
      if(numColumn == 2) {
        // третий элемент
        var oSt = cols[2] + 20;
        var oSl = (leadersField[0].offsetWidth - el.offsetWidth);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[2] += el.offsetHeight + 20;
      }
    }
  }
  var totalHeight = Math.max.apply( null, cols );
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
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
      if(cols.length == 2) {
        // третий элемент
        var oSl = (leadersField[0].offsetWidth - el.offsetWidth);
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
    } else {
      var numColumn = minKey(cols);
      if(numColumn == 0) {
        // первый элемент
        var oSt = cols[0] + 20;
        var oSl = 0;
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[0] += el.offsetHeight + 20;
      }
      if(numColumn == 1) {
        // третий элемент
        var oSt = cols[1] + 20;
        var oSl = (leadersField[0].offsetWidth - el.offsetWidth);
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[1] += el.offsetHeight + 20;
      }
    }
  }
  var totalHeight = Math.max.apply( null, cols );
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
        el.style.top = 0 + 'px';
        el.style.left = oSl + 'px';
      }
    } else {
      var numColumn = minKey(cols);
      if(numColumn == 0) {
        // первый элемент
        var oSt = cols[0] + 20;
        var oSl = 0;
        el.style.top = oSt + 'px';
        el.style.left = oSl + 'px';
        cols[0] += el.offsetHeight + 20;
      }
    }
  }
  var totalHeight = Math.max.apply( null, cols );
  leadersField[0].style.height = totalHeight + 'px';
}

var leadersField = document.getElementsByClassName('image-field'); // поле с фотографиями


addEventListener("load",  function(){reLoad(this)}, false);
addEventListener("resize",  function(){reLoad(this)}, false);
addEventListener("click",  function(){reLoad(this)}, false);

// сердечки
function chHeart(el){
  event.preventDefault();

  let formData = new FormData();
  if(el.children[0].children[0].name == 'dislike'){
    // console.log('Диз лайкаем');
    formData.append('dislike', el.children[0].children[0].value);
    formData.append('user_id', el.children[0].children[1].value);
  } else if(el.children[0].children[0].name == 'like') {
    // console.log('Лайкаем');
    formData.append('like', el.children[0].children[0].value);
    formData.append('user_id', el.children[0].children[1].value);
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
      console.log(`Ошибка ${likeRequest.status}: ${likeRequest.statusText}`); // Например, 404: Not Found
    } else { // если всё прошло гладко, выводим результат
      // console.log(`Готово, получили ${likeRequest.response.length} байт`); // response -- это ответ сервера
      // console.log(`Полученный ответ ${likeRequest.response}`);
      // после удачного ответа от сервера - меняем стили для кнопок
      if (likeRequest.response[0] == 'l') {
        // console.log("Меняем стили с лайка на дизлайк");
        el.children[0].children[0].name = 'dislike';
        el.children[0].children[0].innerHTML = '<i class="far fa-heart"></i>';
        el.children[0].children[2].name = 'dislike';
        el.children[0].children[2].innerHTML = '<i class="fas fa-heart"></i>';
        // изменяем счетчик лайков на +1
        let countLikes = Number(el.parentNode.children[1].innerHTML) + 1;
        el.parentNode.children[1].innerHTML = countLikes;
      }
      if(likeRequest.response[0] == 'd') {
        // console.log("Меняем стили с дизлайка на лайк");
        el.children[0].children[0].name = 'like';
        el.children[0].children[0].innerHTML = '<i class="fas fa-heart"></i>';
        el.children[0].children[2].name = 'like';
        el.children[0].children[2].innerHTML = '<i class="far fa-heart"></i>';
        // изменяем счетчик лайков на -1
        let countLikes = Number(el.parentNode.children[1].innerHTML) - 1;
        el.parentNode.children[1].innerHTML = countLikes;
      }
    }
  };

  likeRequest.onerror = function() {
    console.log("Запрос не удался");
  };


}
var hearts = document.getElementsByClassName('card__info');
for(var i = 0; i < hearts.length; i++){
  hearts[i].children[0].addEventListener("click",  function(){chHeart(this)}, false);
}

// изменяем аватар
function changeAvatar(el){
  avaForm[0].submit();
}
var avaForm = document.getElementsByClassName('avatar-form');
avaForm[0].children[0].addEventListener("change",  function(){changeAvatar(this)}, false); 
