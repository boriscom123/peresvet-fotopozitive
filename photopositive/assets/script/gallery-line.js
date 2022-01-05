// console.log('gallery-line');
// подготовка разметки
function prepareLines(el){
  // отмечаем точку старта - начало линии 7
  var startPosition = lineStep7[0].getBoundingClientRect().top + window.pageYOffset;
  // console.log('Точка старта:' + startPosition);
  // отмечаем точку окончания - начало контейнера с join
  var endPosition = lineEnd[0].getBoundingClientRect().top + window.pageYOffset;
  // console.log('Точка окончания:' + endPosition);
  var maxHeight = endPosition - startPosition;
  // console.log('Высота контейнера:' + maxHeight);
  // задаем расстояние между линиями
  var elMarginTop = 500;
  // console.log('Расстояние между линиями:' + elMarginTop);
  var linesCount = Math.floor(maxHeight / elMarginTop);
  // console.log('Максимальное количество горизонтальных линий:' + linesCount);
  var styleNumber = 0;
  var marginTop = 0;
  // очищаем элемент
  if(lineBox[0].children.length > 0) {
    for (var i = lineBox[0].children.length - 1; i >= 0; i--) {
      lineBox[0].children[i].remove();
    }
  }
  for (var i = 0; i < linesCount * 2; i++) {
    // console.log('Создаем линию:' + i);
    let div = document.createElement('div');
    div.classList.add('navigation-line');
    div.classList.add('gallery-step-'+styleNumber);
    if(i % 2 == 0) {
      // на горизонтальной линии увеличиваем отступ
      var marginTop = marginTop + elMarginTop;
    }
    // для каждой линии задаем отступ
    div.style.top = marginTop + 'px';
    // добавляем элемент в родительский div
    lineBox[0].append(div);
    styleNumber++;
    if(styleNumber == 4) {styleNumber = 0;}
  }
}

function step1Width(){
  if(document.documentElement.clientWidth > 1000) {
    elWidth = (((document.documentElement.clientWidth - 1000) / 2) - 10 + 17);
    if(elWidth > 70){
      elWidth = 70;
    }
    lineStep1[0].style.width = elWidth+ 'px';
  } else {
    elWidth = 7;
    lineStep1[0].style.width = elWidth + 'px';
  }
}

function showCoord(){

  // console.log('Прокрутка:' + window.pageYOffset);
  // брейкпоинты прокрутки экрана
  var el2Start = 0;
  var el3Start = ((lineStep3[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 200); // Вертикальный элемент
  var el4Start = ((lineStep4[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 300); // Горизонтпльный элемент
  var el5Start = ((lineStep5[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 0); // Вертикальный элемент
  var el6Start = ((lineStep6[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 50); // Горизонтпльный элемент
  var el7Start = ((lineStep7[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) - 50); // Вертикальный элемент
  var el8Start = ((lineStep8[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 50); // Горизонтпльный элемент
  var el8LinesCol = (Math.floor((chooseLeadersField[0].offsetHeight - ((lineStep7[0].getBoundingClientRect().top + window.pageYOffset) - (chooseLeadersField[0].getBoundingClientRect().top + window.pageYOffset))) / 450));
  var endOfLine = ((lineEnd[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 50); // Последний Вертикальный элемент
  // размеры элементов
  var elMin = 0;
  var el2MaxHeight = lineStep3[0].getBoundingClientRect().top - lineStep2[0].getBoundingClientRect().top + 7;
  if(document.documentElement.clientWidth > 1100) { var el3MaxWidth = 1100; } else { var el3MaxWidth = document.documentElement.clientWidth - 20; }
  var el4MaxHeight = lineStep5[0].getBoundingClientRect().top - lineStep4[0].getBoundingClientRect().top + 7;
  if(document.documentElement.clientWidth > 1100) { var el5MaxWidth = 1100; } else { var el5MaxWidth = document.documentElement.clientWidth - 20; }
  var el6MaxHeight = lineStep7[0].getBoundingClientRect().top - lineStep6[0].getBoundingClientRect().top + 7;
  if(document.documentElement.clientWidth > 1100) { var el7MaxWidth = 1100; } else { var el7MaxWidth = document.documentElement.clientWidth - 20; }
  var el8MaxHeight = lineEnd[0].getBoundingClientRect().top - lineStep8[0].getBoundingClientRect().top + 7;

  if(window.pageYOffset == 0) {
    lineStep2[0].style.height = elMin + 'px';
    lineStep3[0].style.width = elMin + 'px';
    lineStep4[0].style.height = elMin + 'px';
    lineStep5[0].style.width = elMin + 'px';
    lineStep6[0].style.height = elMin + 'px';
    lineStep7[0].style.width = elMin + 'px';
    lineStep8[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el2Start && window.pageYOffset <= el3Start) {
    // Элемент 2
    var step = el2MaxHeight / (el3Start - el2Start);
    var el2Height = (window.pageYOffset * step);
    if(el2Height > el2MaxHeight) {
      el2Height = el2MaxHeight;
    } else {
      el2Height = el2Height;
    }
    lineStep2[0].style.height = el2Height + 'px';
    lineStep3[0].style.width = elMin + 'px';
    lineStep4[0].style.height = elMin + 'px';
    lineStep5[0].style.width = elMin + 'px';
    lineStep6[0].style.height = elMin + 'px';
    lineStep7[0].style.width = elMin + 'px';
    lineStep8[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el3Start && window.pageYOffset <= el4Start) {
    // Элемент 3
    var step = el3MaxWidth / (el4Start - el3Start);
    var el3Width = ((window.pageYOffset - el3Start) * step);
    if(el3Width > el3MaxWidth) {
      el3Width = el3MaxWidth;
    } else {
      el3Width = el3Width;
    }
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3Width + 'px';
    lineStep4[0].style.height = elMin + 'px';
    lineStep5[0].style.width = elMin + 'px';
    lineStep6[0].style.height = elMin + 'px';
    lineStep7[0].style.width = elMin + 'px';
    lineStep8[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el4Start && window.pageYOffset <= el5Start) {
    // Элемент 4
    var step = el4MaxHeight / (el5Start - el4Start);
    var el4Height = ((window.pageYOffset - el4Start) * step);
    if(el4Height > el4MaxHeight) {
      el4Height = el4MaxHeight;
    } else {
      el4Height = el4Height;
    }
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3MaxWidth + 'px';
    lineStep4[0].style.height = el4Height + 'px';
    lineStep5[0].style.width = elMin + 'px';
    lineStep6[0].style.height = elMin + 'px';
    lineStep7[0].style.width = elMin + 'px';
    lineStep8[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el5Start && window.pageYOffset <= el6Start) {
    // Элемент 5
    var step = el5MaxWidth / (el6Start - el5Start);
    var el5Width = ((window.pageYOffset - el5Start) * step);
    if(el5Width > el5MaxWidth) {
      el5Width = el5MaxWidth;
    } else {
      el5Width = el5Width;
    }
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3MaxWidth + 'px';
    lineStep4[0].style.height = el4MaxHeight + 'px';
    lineStep5[0].style.width = el5Width + 'px';
    lineStep6[0].style.height = elMin + 'px';
    lineStep7[0].style.width = elMin + 'px';
    lineStep8[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el6Start && window.pageYOffset <= el7Start) {
    // Элемент 6
    var step = el6MaxHeight / (el7Start - el6Start);
    var el6Height = ((window.pageYOffset - el6Start) * step);
    if(el6Height > el6MaxHeight) { el6Height = el6MaxHeight; }
      else { el6Height = el6Height; }
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3MaxWidth + 'px';
    lineStep4[0].style.height = el4MaxHeight + 'px';
    lineStep5[0].style.width = el5MaxWidth + 'px';
    lineStep6[0].style.height = el6Height + 'px';
    lineStep7[0].style.width = elMin + 'px';
    lineStep8[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el7Start && window.pageYOffset <= el8Start) {
    // Элемент 7
    var step = el7MaxWidth / (el8Start - el7Start);
    var el7Width = ((window.pageYOffset - el7Start) * step);
    if(el7Width > el7MaxWidth) {
      el7Width = el7MaxWidth;
    } else {
      el7Width = el7Width;
    }
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3MaxWidth + 'px';
    lineStep4[0].style.height = el4MaxHeight + 'px';
    lineStep5[0].style.width = el5MaxWidth + 'px';
    lineStep6[0].style.height = el6MaxHeight + 'px';
    lineStep7[0].style.width = el7Width + 'px';
    lineStep8[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el8Start && window.pageYOffset <= endOfLine) {
    // Элемент 8
    var step = el8MaxHeight / (endOfLine - el8Start);
    var el8Height = ((window.pageYOffset - el8Start) * 1.3);
    if(el8Height > 507) { el8Height = 507; }
      else { el8Height = el8Height; }
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3MaxWidth + 'px';
    lineStep4[0].style.height = el4MaxHeight + 'px';
    lineStep5[0].style.width = el5MaxWidth + 'px';
    lineStep6[0].style.height = el6MaxHeight + 'px';
    lineStep7[0].style.width = el7MaxWidth + 'px';
    lineStep8[0].style.height = el8Height + 'px';
    // добавляем отображение дополнительных линий
    for (var i = 0; i < lineBox[0].children.length; i++) {
      // console.log('получаем координаты дочернего элемента: '+ lineBox[0].children[i]);
      // console.log('получаем координаты дочернего элемента: '+ (lineBox[0].children[i].getBoundingClientRect().top + window.pageYOffset));
      //console.log('получаем середину высоты экрана: '+ (document.documentElement.clientHeight / 2));
      var centerScreen = window.pageYOffset + (document.documentElement.clientHeight / 2);
      if(i % 2 == 0) {
        // горизонтальная линия
        lineBox[0].children[i].elementStart = (lineBox[0].children[i].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50;
        lineBox[0].children[i].elementEnd = (lineBox[0].children[i].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50;
        lineBox[0].children[i].elementWidth = window.pageYOffset - lineBox[0].children[i].elementStart;
        if(document.documentElement.clientWidth > 1100) { lineBox[0].children[i].elementMaxWidth = 1100; } else { lineBox[0].children[i].elementMaxWidth = document.documentElement.clientWidth - 20; }
        if (lineBox[0].children[i].elementWidth < 0) { lineBox[0].children[i].style.width = 0 + 'px';}
        else if (lineBox[0].children[i].elementWidth < 100) {lineBox[0].children[i].style.width = (lineBox[0].children[i].elementMaxWidth / 100 * Math.floor(lineBox[0].children[i].elementWidth)) + 'px';}
        else {lineBox[0].children[i].style.width = lineBox[0].children[i].elementMaxWidth + 'px';}
      } else {
        // вертикальная линия
        lineBox[0].children[i].elementStart = (lineBox[0].children[i].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50;
        var j = i;
        if (++j < lineBox[0].children.length) {
          // console.log('Элемент не последний'+ i);
          lineBox[0].children[i].elementEnd = ((lineBox[0].children[j].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50);
          lineBox[0].children[i].elementMaxHeight = (lineBox[0].children[j].getBoundingClientRect().top + window.pageYOffset) - (lineBox[0].children[i].getBoundingClientRect().top + window.pageYOffset) + 7;
          lineBox[0].children[i].elementYOffset = lineBox[0].children[i].elementEnd - lineBox[0].children[i].elementStart;
          lineBox[0].children[i].step = lineBox[0].children[i].elementMaxHeight / lineBox[0].children[i].elementYOffset;
          lineBox[0].children[i].elementHeight = window.pageYOffset - lineBox[0].children[i].elementStart;
          if (lineBox[0].children[i].elementHeight < 0) { lineBox[0].children[i].style.height = 0 + 'px';}
          else if (lineBox[0].children[i].elementHeight < 400) {lineBox[0].children[i].style.height = (lineBox[0].children[i].elementHeight * lineBox[0].children[i].step) + 'px';}
          else {lineBox[0].children[i].style.height = lineBox[0].children[i].elementMaxHeight + 'px';}
        } else {
          // console.log('Элемент Последний'+ i);
          lineBox[0].children[i].elementEnd = (lineEnd[0].getBoundingClientRect().top + window.pageYOffset);
          lineBox[0].children[i].elementMaxHeight = (lineEnd[0].getBoundingClientRect().top + window.pageYOffset) - (lineBox[0].children[i].getBoundingClientRect().top + window.pageYOffset) + 7;
          lineBox[0].children[i].elementYOffset = lineBox[0].children[i].elementEnd - lineBox[0].children[i].elementStart;
          lineBox[0].children[i].step = lineBox[0].children[i].elementMaxHeight / lineBox[0].children[i].elementYOffset;
          lineBox[0].children[i].elementHeight = window.pageYOffset - lineBox[0].children[i].elementStart;
          if (lineBox[0].children[i].elementHeight < 0) { lineBox[0].children[i].style.height = 0 + 'px';}
          else if (lineBox[0].children[i].elementHeight < lineBox[0].children[i].elementMaxHeight) {lineBox[0].children[i].style.height = (lineBox[0].children[i].elementHeight * 1.5) + 'px';}
          else {lineBox[0].children[i].style.height = lineBox[0].children[i].elementMaxHeight + 'px';}
        }
      }
    }


  } else if (window.pageYOffset > endOfLine) {
    // конец линии - все элементы на максимум
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3MaxWidth + 'px';
    lineStep4[0].style.height = el4MaxHeight + 'px';
    lineStep5[0].style.width = el5MaxWidth + 'px';
    lineStep6[0].style.height = el6MaxHeight + 'px';
    lineStep7[0].style.width = el7MaxWidth + 'px';
    lineStep8[0].style.height = 507 + 'px';
  }
}
var lineStep1 = document.getElementsByClassName('step-1'); // линия step-1
var lineStep2 = document.getElementsByClassName('step-2'); // линия step-2
var lineStep3 = document.getElementsByClassName('step-3'); // линия step-3
var lineStep4 = document.getElementsByClassName('step-4'); // линия step-4
var lineStep5 = document.getElementsByClassName('step-5'); // линия step-5
var lineStep6 = document.getElementsByClassName('step-6'); // линия step-6
var lineStep7 = document.getElementsByClassName('step-7'); // линия step-6
var lineStep8 = document.getElementsByClassName('step-8'); // линия step-6

var lineBox = document.getElementsByClassName('line-steps'); // Блок с линиями
var lineEnd = document.getElementsByClassName('join'); // Блок с формами - конец линий

addEventListener("scroll",  function(){showCoord(this)}, false); // активность линии при прокрутке страницы
addEventListener("resize",  function(){showCoord(this)}, false); // активность линии при изменении размера страницы
addEventListener("load",  function(){step1Width(this)}, false); // активность при полной загрузке страницы
addEventListener("resize",  function(){step1Width(this)}, false); // активность при изменении размера страницы
addEventListener("load",  function(){prepareLines(this)}, false); // активность при полной загрузке страницы
addEventListener("resize",  function(){prepareLines(this)}, false); // активность при изменении размера страницы
//addEventListener("scroll",  function(){prepareLines(this)}, false); // активность при ипри прокрутке страницы
