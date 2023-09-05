// console.log('projects-line');
// console.log('Анимация прокрутки');
function step1Width() {
    if (document.documentElement.clientWidth > 1000) {
        elWidth = (((document.documentElement.clientWidth - 1000) / 2) - 10 + 17);
        if (elWidth > 60) {
            elWidth = 60;
        }
        lineStep1[0].style.width = elWidth + 'px';
    } else {
        elWidth = 7;
        lineStep1[0].style.width = elWidth + 'px';
    }
}

function showCoord() {
    // console.log('Прокрутка:' + window.scrollY);
    // брейкпоинты прокрутки экрана
    let el2Start = 0;
    let el3Start = ((lineStep3[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 200); // Вертикальный элемент
    let el4Start = ((lineStep4[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 300); // Горизонтпльный элемент
    let el5Start = ((lineStep5[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 0); // Вертикальный элемент
    let el6Start = ((lineStep6[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтпльный элемент
    let endOfLine = ((lineEnd[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Последний Вертикальный элемент
    // размеры элементов
    let elMin = 0;
    let el2MaxHeight = lineStep3[0].getBoundingClientRect().top - lineStep2[0].getBoundingClientRect().top + 7;
    if (document.documentElement.clientWidth > 1100) {
        var el3MaxWidth = 1100;
    } else {
        var el3MaxWidth = document.documentElement.clientWidth - 20;
    }
    let el4MaxHeight = lineStep5[0].getBoundingClientRect().top - lineStep4[0].getBoundingClientRect().top + 7;
    if (document.documentElement.clientWidth > 1100) {
        var el5MaxWidth = 1100;
    } else {
        var el5MaxWidth = document.documentElement.clientWidth - 20;
    }
    let el6MaxHeight = lineEnd[0].getBoundingClientRect().top - lineStep6[0].getBoundingClientRect().top + 7;

    if (window.pageYOffset == 0) {
        lineStep2[0].style.height = elMin + 'px';
        lineStep3[0].style.width = elMin + 'px';
        lineStep4[0].style.height = elMin + 'px';
        lineStep5[0].style.width = elMin + 'px';
        lineStep6[0].style.height = elMin + 'px';
    } else if (window.pageYOffset > el2Start && window.pageYOffset <= el3Start) {
        // Элемент 2
        let step = el2MaxHeight / (el3Start - el2Start);
        let el2Height = (window.pageYOffset * step);
        if (el2Height > el2MaxHeight) {
            el2Height = el2MaxHeight;
        } else {
            el2Height = el2Height;
        }
        lineStep2[0].style.height = el2Height + 'px';
        lineStep3[0].style.width = elMin + 'px';
        lineStep4[0].style.height = elMin + 'px';
        lineStep5[0].style.width = elMin + 'px';
        lineStep6[0].style.height = elMin + 'px';
    } else if (window.pageYOffset > el3Start && window.pageYOffset <= el4Start) {
        // Элемент 3
        let step = el3MaxWidth / (el4Start - el3Start);
        let el3Width = ((window.pageYOffset - el3Start) * step);
        if (el3Width > el3MaxWidth) {
            el3Width = el3MaxWidth;
        } else {
            el3Width = el3Width;
        }
        lineStep2[0].style.height = el2MaxHeight + 'px';
        lineStep3[0].style.width = el3Width + 'px';
        lineStep4[0].style.height = elMin + 'px';
        lineStep5[0].style.width = elMin + 'px';
        lineStep6[0].style.height = elMin + 'px';
    } else if (window.pageYOffset > el4Start && window.pageYOffset <= el5Start) {
        // Элемент 4
        let step = el4MaxHeight / (el5Start - el4Start);
        let el4Height = ((window.pageYOffset - el4Start) * step);
        if (el4Height > el4MaxHeight) {
            el4Height = el4MaxHeight;
        } else {
            el4Height = el4Height;
        }
        lineStep2[0].style.height = el2MaxHeight + 'px';
        lineStep3[0].style.width = el3MaxWidth + 'px';
        lineStep4[0].style.height = el4Height + 'px';
        lineStep5[0].style.width = elMin + 'px';
        lineStep6[0].style.height = elMin + 'px';
    } else if (window.pageYOffset > el5Start && window.pageYOffset <= el6Start - 150) {
        // Элемент 5
        let step = el5MaxWidth / (el6Start - el5Start);
        let el5Width = ((window.pageYOffset - el5Start) * step);
        if (el5Width > el5MaxWidth) {
            el5Width = el5MaxWidth;
        } else {
            el5Width = el5Width;
        }
        lineStep2[0].style.height = el2MaxHeight + 'px';
        lineStep3[0].style.width = el3MaxWidth + 'px';
        lineStep4[0].style.height = el4MaxHeight + 'px';
        lineStep5[0].style.width = el5Width + 'px';
        lineStep6[0].style.height = elMin + 'px';
    } else if (window.pageYOffset > el6Start && window.pageYOffset <= footerEl[0].getBoundingClientRect().top + window.pageYOffset + footerEl[0].getBoundingClientRect().height - document.documentElement.clientHeight - 200) {
        // console.log('Элемент 6');
        let step = el6MaxHeight / (endOfLine - el6Start);
        let el6Height = ((window.pageYOffset - el6Start) * step * 1.5);
        if (el6Height > el6MaxHeight) {
            el6Height = el6MaxHeight;
        } else {
            el6Height = el6Height;
        }
        lineStep2[0].style.height = el2MaxHeight + 'px';
        lineStep3[0].style.width = el3MaxWidth + 'px';
        lineStep4[0].style.height = el4MaxHeight + 'px';
        lineStep5[0].style.width = el5MaxWidth + 'px';
        lineStep6[0].style.height = el6Height + 'px';
    } else if (window.pageYOffset >= footerEl[0].getBoundingClientRect().top + window.pageYOffset + footerEl[0].getBoundingClientRect().height - document.documentElement.clientHeight - 5) {
        // console.log('конец линии - все элементы на максимум');
        lineStep2[0].style.height = el2MaxHeight + 'px';
        lineStep3[0].style.width = el3MaxWidth + 'px';
        lineStep4[0].style.height = el4MaxHeight + 'px';
        lineStep5[0].style.width = el5MaxWidth + 'px';
        lineStep6[0].style.height = el6MaxHeight + 'px';
    }

    let headerEL = document.getElementsByClassName('header-flex')[0];
    if (headerEL) {
        if (window.scrollY > 155) {
            if (!headerEL.classList.contains('hide-line')) {
                headerEL.classList.add('hide-line');
            }
        } else {
            if (headerEL.classList.contains('hide-line')) {
                headerEL.classList.remove('hide-line');
            }
        }
    }
}

let lineStep1 = document.getElementsByClassName('step-1'); // линия step-1
let lineStep2 = document.getElementsByClassName('step-2'); // линия step-2
let lineStep3 = document.getElementsByClassName('step-3'); // линия step-3
let lineStep4 = document.getElementsByClassName('step-4'); // линия step-4
let lineStep5 = document.getElementsByClassName('step-5'); // линия step-5
let lineStep6 = document.getElementsByClassName('step-6'); // линия step-6
let lineEnd = document.getElementsByClassName('join'); // Блок с формами - конец линий
let footerEl = document.getElementsByClassName('footer');

addEventListener("scroll", function () {
    showCoord(this)
}, false); // активность линии при прокрутке страницы
addEventListener("resize", function () {
    showCoord(this)
}, false); // активность линии при изменении размера страницы
addEventListener("load", function () {
    step1Width(this)
}, false); // активность при полной загрузке страницы
addEventListener("resize", function () {
    step1Width(this)
}, false); // активность при изменении размера страницы
