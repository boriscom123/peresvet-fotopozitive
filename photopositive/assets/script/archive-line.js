// console.log('archive-line');
// подготовка разметки
function prepareLines(el){
  // отмечаем точку старта
  let startPosition = lineStep3[0].getBoundingClientRect().top + window.pageYOffset;
  // console.log('Точка старта:' + startPosition);
  // отмечаем точку окончания
  let endPosition = lineEnd[0].getBoundingClientRect().top + window.pageYOffset;
  // console.log('Точка окончания:' + endPosition);
  let maxHeight = endPosition - startPosition;
  // console.log('Высота контейнера:' + maxHeight);
  // задаем расстояние между линиями
  let elMarginTop = 500;
  // console.log('Расстояние между линиями:' + elMarginTop);
  let linesCount = Math.floor(maxHeight / elMarginTop);
  // console.log('Максимальное количество горизонтальных линий:' + linesCount);
  let styleNumber = 0;
  let marginTop = 0;
  // очищаем элемент
  if(lineBox[0].children.length > 0) {
    for (let i = lineBox[0].children.length - 1; i >= 0; i--) {
      lineBox[0].children[i].remove();
    }
  }
  for (let i = 0; i < linesCount * 2; i++) {
    // console.log('Создаем линию:' + i);
    let div = document.createElement('div');
    div.classList.add('navigation-line');
    div.classList.add('gallery-step-'+styleNumber);
    if(i % 2 == 0) {
      // на горизонтальной линии увеличиваем отступ
      marginTop = marginTop + elMarginTop;
    }
    // для каждой линии задаем отступ
    div.style.top = marginTop + 'px';
    // добавляем элемент в родительский div
    lineBox[0].append(div);
    styleNumber++;
    if(styleNumber == 4) {styleNumber = 0;}
  }
}
function maxWidth(){
  if(document.documentElement.clientWidth > 1100) {
    return 1100;
  } else {
    return (document.documentElement.clientWidth - 20);
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
  let el2Start = 0;
  let el3Start = ((lineStep3[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 200);
  let el4Start = ((lineStep4[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 300);
  let endOfLine = ((lineEnd[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight/2) + 50);
  // размеры элементов
  let elMin = 0;
  let el2MaxHeight = lineStep3[0].getBoundingClientRect().top - lineStep2[0].getBoundingClientRect().top + 7;
  let el3MaxWidth = maxWidth();
  let el4MaxHeight = lineEnd[0].getBoundingClientRect().top - lineStep4[0].getBoundingClientRect().top + 7;

  if(window.pageYOffset == 0) {
    lineStep2[0].style.height = elMin + 'px';
    lineStep3[0].style.width = elMin + 'px';
  } else if (window.pageYOffset > el2Start && window.pageYOffset <= el3Start) {
    // console.log('прокурутка элемента 2');
    let step = el2MaxHeight / (el3Start - el2Start);
    let el2Height = (window.pageYOffset * step);
    if(el2Height > el2MaxHeight) {
      el2Height = el2MaxHeight;
    } else {
      el2Height = el2Height;
    }
    lineStep2[0].style.height = el2Height + 'px';
    lineStep3[0].style.width = elMin + 'px';
    lineStep4[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el3Start && window.pageYOffset <= el4Start) {
    // console.log('прокурутка элемента 3');
    let step = el3MaxWidth / (el4Start - el3Start);
    let el3Width = ((window.pageYOffset - el3Start) * step);
    if(el3Width > el3MaxWidth) {
      el3Width = el3MaxWidth;
    } else {
      el3Width = el3Width;
    }
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3Width + 'px';
    lineStep4[0].style.height = elMin + 'px';
  } else if (window.pageYOffset > el4Start && window.pageYOffset <= endOfLine) {
    // console.log('прокурутка элемента 4');
    let step = el4MaxHeight / (endOfLine - el4Start);
    let el4Height = ((window.pageYOffset - el4Start) * step * lineBox[0].children.length);
    if(el4Height > el4MaxHeight) {
      el4Height = el4MaxHeight;
    } else {
      el4Height = el4Height;
    }
    if(el4Height > 507) { el4Height = 507; }
    lineStep2[0].style.height = el2MaxHeight + 'px';
    lineStep3[0].style.width = el3MaxWidth + 'px';
    lineStep4[0].style.height = el4Height + 'px';
    // console.log('Начало прокрутки: ', el4Start);
    // console.log('Конец прокрутки: ', endOfLine);
    // console.log('Максимальная высота элемента: ', el4MaxHeight);
    // console.log('Шаг прокрутки: ', step);
    // добавляем отображение дополнительных линий
    for (let i = 0; i < lineBox[0].children.length; i++) {
      let centerScreen = window.pageYOffset + (document.documentElement.clientHeight / 2);
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
        let j = i;
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
    lineStep4[0].style.height = 507 + 'px';
  }
}
let lineStep1 = document.getElementsByClassName('step-1'); // линия step-1
let lineStep2 = document.getElementsByClassName('step-2'); // линия step-2
let lineStep3 = document.getElementsByClassName('step-3'); // линия step-3
let lineStep4 = document.getElementsByClassName('step-4'); // линия step-4

let lineBox = document.getElementsByClassName('line-steps'); // Блок с линиями
lineBox[0].style.zIndex = 0;
lineBox[0].style.margin = 0;
let lineEnd = document.getElementsByClassName('footer'); // Блок футера - конец линий

addEventListener("scroll",  function(){showCoord(this)}, false); // активность линии при прокрутке страницы
addEventListener("resize",  function(){showCoord(this)}, false); // активность линии при изменении размера страницы
addEventListener("load",  function(){step1Width(this)}, false); // активность при полной загрузке страницы
addEventListener("resize",  function(){step1Width(this)}, false); // активность при изменении размера страницы
addEventListener("load",  function(){prepareLines(this)}, false); // активность при полной загрузке страницы
addEventListener("resize",  function(){prepareLines(this)}, false); // активность при изменении размера страницы
