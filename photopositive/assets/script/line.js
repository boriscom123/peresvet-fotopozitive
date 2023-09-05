// Скрипы для отрисовки линии на всех страницах

// let show_console = true;
if (show_console) {
    console.log('Линия для всех страниц в 1 файле');
}

// Настройки
// Задаем высоту вертикальных линий в пикселях
let elVerticalLineHeight = 500;

// Линия начинается с блока (id="line-start-block")
// let startEl = document.getElementById('line-start-block');

// Линия заканчивается на блоке (id="line-end-block")
// let endEl = document.getElementById('line-end-block');

// Подготовка блока с линиями
function prepareLines() {
    if (show_console) {
        console.log('Подготовка разметки');
    }
    // Создаем необходимые переменные
    let startPosition, endPosition;

    let startEl = document.getElementById('line-start-block');
    if (startEl) {
        // console.log('startEl', startEl);
        startPosition = startEl.getBoundingClientRect().top + window.scrollY;
        // console.log('Точка старта:', startPosition);
    }

    let endEl = document.getElementById('line-end-block');
    if (endEl) {
        // console.log('endEl', endEl);
        endPosition = endEl.getBoundingClientRect().top + window.scrollY;
        // console.log('Точка окончания:', endPosition);
    }

    let maxHeight = endPosition - startPosition - (elVerticalLineHeight / 2);
    // console.log('Высота контейнера для отрисовки линий:', maxHeight);

    // Задаем расстояние между линиями
    let elMarginTop = elVerticalLineHeight;
    // console.log('Расстояние между линиями: ' + elMarginTop);

    let linesCount = Math.floor(maxHeight / elMarginTop);
    // console.log('Максимальное количество горизонтальных линий:', linesCount);

    // Очищаем элемент от предыдущих линий (например при изменении размеров экрана)
    if (lineBox.children.length > 0) {
        for (let i = lineBox.children.length - 1; i >= 0; i--) {
            lineBox.children[i].remove();
        }
    }

    // Добавляем линии в контейнер
    let styleNumber = 2;
    let marginTop = 0;

    // Создаем стартовую линию (вертикальная из header)
    let startDiv = document.createElement('div');
    startDiv.classList.add('navigation-line');
    startDiv.classList.add('step-start');
    lineBox.append(startDiv);

    for (let i = 0; i < linesCount * 2; i++) {
        // console.log('Создаем линию: ' + i);
        let div = document.createElement('div');
        div.classList.add('navigation-line');
        div.classList.add('gallery-step-' + styleNumber);
        if (i % 2 === 0) {
            // на горизонтальной линии увеличиваем отступ
            marginTop = marginTop + elMarginTop;
        }
        // для каждой линии задаем отступ
        div.style.top = marginTop + 'px';
        // добавляем элемент в родительский div
        lineBox.append(div);
        styleNumber++;
        if (styleNumber === 4) {
            styleNumber = 0;
        }
    }

    // Создаем стартовую линию (вертикальная из header)
    let endDiv = document.createElement('div');
    endDiv.classList.add('navigation-line');
    endDiv.classList.add('step-end');
    endDiv.style.top = (endEl.getBoundingClientRect().top + window.scrollY) + 'px';
    endDiv.style.height = 100 + 'px';
    lineBox.append(endDiv);

    showCoord();
}

// Активность при прокрутке страницы
function showCoord() {
    // console.log('Прокрутка:', window.scrollY);

    let centerScreen = (document.documentElement.clientHeight / 2);
    // console.log('centerScreen', centerScreen);

    // Заполняем элемент находящийся ближе к центру видимости
    let currentCenter = centerScreen + window.scrollY;
    // console.log('Текущий центр экрана на:', currentCenter);

    // Находим необходимый блок для заполнения
    let elGap = elVerticalLineHeight / 4;
    // console.log('Отступ от начала и окончания заполнения блока:', elGap);
    for (let i = 0; i < lineBox.children.length; i++) {

        if (i % 2 === 1 && lineBox.children[i] !== lineBox.lastChild) {
            // Горизонтальный блок
            // console.log('Начало заполнения блока ', i, lineBox.children[i].getBoundingClientRect().top + window.scrollY - elGap);
            // console.log('Конец заполнения блока ', i, lineBox.children[i].getBoundingClientRect().top + window.scrollY + elGap);
            if (lineBox.children[i].getBoundingClientRect().top + window.scrollY - elGap < currentCenter &&
                lineBox.children[i].getBoundingClientRect().top + window.scrollY + elGap > currentCenter) {
                // console.log('Текущий горизонтальный блок', i);
                let elMaxWidth;
                if (document.documentElement.clientWidth > 1100) {
                    elMaxWidth = 1100;
                } else {
                    elMaxWidth = document.documentElement.clientWidth - 20;
                }
                // console.log('elMaxWidth', elMaxWidth);
                let elFillStep = elMaxWidth / (elGap * 2);
                // console.log('elFillStep', elFillStep);
                let elCurrentStep = currentCenter - (lineBox.children[i].getBoundingClientRect().top + window.scrollY - elGap);
                // console.log('elCurrentStep', elCurrentStep);
                lineBox.children[i].style.width = (elCurrentStep * elFillStep) + 'px';

            }

            // Если до блока еще не дошли - он должен быть пустым
            if (lineBox.children[i].getBoundingClientRect().top + window.scrollY - elGap > currentCenter) {
                lineBox.children[i].style.width = 0 + 'px';
            }

            // Если блока уже прошли - он должен быть полностью заполненным
            if (lineBox.children[i].getBoundingClientRect().top + window.scrollY + elGap < currentCenter) {
                lineBox.children[i].style.width = 100 + '%';
            }
            // Добавляем исключение для первого блока
            if (window.scrollY === 0) {
                lineBox.children[1].style.width = 0 + 'px';
            }
        } else {
            // Вертикальный блок
            // console.log('Вертикальный блок', i);
            // console.log('Начало заполнения блока ', i, lineBox.children[i].getBoundingClientRect().top + window.scrollY + elGap);
            // console.log('Конец заполнения блока ', i, lineBox.children[i].getBoundingClientRect().top + elVerticalLineHeight + window.scrollY - elGap);
            if (lineBox.children[i].getBoundingClientRect().top + window.scrollY + elGap < currentCenter &&
                lineBox.children[i].getBoundingClientRect().top + elVerticalLineHeight + window.scrollY - elGap > currentCenter) {
                // console.log('Текущий вертикальный блок', i);
                let elMaxHeight = elVerticalLineHeight + 14;
                // console.log('elMaxHeight', elMaxHeight);
                let elFillStep = elMaxHeight / (elGap * 2);
                // console.log('elFillStep', elFillStep);
                let elCurrentStep = currentCenter - (lineBox.children[i].getBoundingClientRect().top + window.scrollY + elGap);
                // console.log('elCurrentStep', elCurrentStep);
                lineBox.children[i].style.height = (elCurrentStep * elFillStep) + 'px';
            }

            // Если до блока еще не дошли - он должен быть пустым
            if (lineBox.children[i].getBoundingClientRect().top + window.scrollY + elGap > currentCenter) {
                lineBox.children[i].style.height = 0 + 'px';
            }

            // Если блока уже прошли - он должен быть полностью заполненным
            if (lineBox.children[i].getBoundingClientRect().top + elVerticalLineHeight + window.scrollY - elGap < currentCenter) {
                lineBox.children[i].style.height = 507 + 'px';
            }

            // Добавляем исключение для первого блока
            if (window.scrollY === 0) {
                lineBox.children[0].style.height = 0 + 'px';
            }

            // Добавляем стили для полной прокрутки (когда дошли до конца)
            let documentHeight = Math.max(
                document.body.scrollHeight, document.documentElement.scrollHeight,
                document.body.offsetHeight, document.documentElement.offsetHeight,
                document.body.clientHeight, document.documentElement.clientHeight
            );
            let endEl = document.getElementById('line-end-block');
            // if (window.scrollY + document.documentElement.clientHeight >= documentHeight) {
            //     // console.log('Дошли до конца - показываем и закрашиваем все вертикальные линии');
            //     // console.log('lastChild', lineBox.lastChild);
            //     lineBox.lastChild.style.top = (endEl.getBoundingClientRect().top - 80 + window.scrollY) + 'px';
            //     lineBox.lastChild.style.height = 100 + 'px';
            //     lineBox.lastChild.previousSibling.style.height = (elVerticalLineHeight * 1.3) + 'px';
            // } else {
            //     lineBox.lastChild.style.top = (endEl.getBoundingClientRect().top + window.scrollY) + 'px';
            //     lineBox.lastChild.style.height = 0 + 'px';
            // }

            // Добавляем стили для прокрутки до блока с кнопкой перед футером
            // console.log('endEl.previousElementSibling.getBoundingClientRect().top + window.scrollY', endEl.previousElementSibling.getBoundingClientRect().top + window.scrollY);

            if (endEl.previousElementSibling.getBoundingClientRect().top + window.scrollY < (currentCenter + (centerScreen / 4)) ) {
                // console.log('Прошли центр экрана');
                lineBox.lastChild.style.top = (endEl.getBoundingClientRect().top - 80 + window.scrollY) + 'px';
                lineBox.lastChild.style.height = 100 + 'px';
                lineBox.lastChild.previousSibling.style.height = (endEl.getBoundingClientRect().bottom) + 'px';
            } else {
                // console.log('Не докрутили еще до центра экрана');
                lineBox.lastChild.style.top = (endEl.getBoundingClientRect().top + window.scrollY) + 'px';
                lineBox.lastChild.style.height = 0 + 'px';
            }
        }
    }
}

// Линии располагаются в блоке с (id="line-box-block")
let lineBox = document.getElementById('line-box-block');
if (lineBox) {
    // console.log('lineBox', lineBox);
}

// Выполняем команду при полной загрузке страницы
addEventListener("load", function () {
    // prepareLines(this);
    setTimeout(() => {
        prepareLines();
    }, 500);
}, false);

// Активность при изменении размера страницы
// addEventListener("resize", function () {
//     prepareLines(this);
// }, false);

// Активность при прокрутке страницы
addEventListener("scroll", function () {
    showCoord(this);
}, false);

// Активность при изменении размера страницы
addEventListener("resize", function () {
    prepareLines(this);
}, false);

// let chooseLeadersField = document.getElementsByClassName('choose-leader__content'); // поле с Выбором лидера
// let observer = new MutationObserver(function(mutations) {
//     mutations.forEach(function(mutationRecord) {
//         console.log('style changed!');
//     });
// });
//
// // var target = document.getElementById('myId');
// observer.observe(chooseLeadersField[0], { attributes : true, attributeFilter : ['style'] });