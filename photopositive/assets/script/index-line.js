// // console.log('index-line');
// // console.log('Анимация прокрутки');
//
// function prepareLines(el) {
//     // отмечаем точку старта - начало линии 7
//     var startPosition = lineStep7[0].getBoundingClientRect().top + window.scrollY;
//     // console.log('Точка старта:' + startPosition);
//     // отмечаем точку окончания - начало контейнера с join
//     var endPosition = lineEnd[0].getBoundingClientRect().top + window.scrollY;
//     // console.log('Точка окончания:' + endPosition);
//     var maxHeight = endPosition - startPosition;
//     // console.log('Высота контейнера:' + maxHeight);
//     // задаем расстояние между линиями
//     var elMarginTop = 500;
//     // console.log('Расстояние между линиями:' + elMarginTop);
//     var linesCount = Math.floor(maxHeight / elMarginTop);
//     // console.log('Максимальное количество горизонтальных линий:' + linesCount);
//     var styleNumber = 0;
//     var marginTop = 0;
//     // очищаем элемент
//     if (lineBox[0].children.length > 0) {
//         for (var i = lineBox[0].children.length - 1; i >= 0; i--) {
//             lineBox[0].children[i].remove();
//         }
//     }
//     for (var i = 0; i < linesCount * 2; i++) {
//         // console.log('Создаем линию:' + i);
//         let div = document.createElement('div');
//         div.classList.add('navigation-line');
//         div.classList.add('gallery-step-' + styleNumber);
//         if (i % 2 == 0) {
//             // на горизонтальной линии увеличиваем отступ
//             var marginTop = marginTop + elMarginTop;
//         }
//         // для каждой линии задаем отступ
//         div.style.top = marginTop + 'px';
//         // добавляем элемент в родительский div
//         lineBox[0].append(div);
//         styleNumber++;
//         if (styleNumber == 4) {
//             styleNumber = 0;
//         }
//     }
// }
//
// function step1Width() {
//     if (document.documentElement.clientWidth > 1000) {
//         elWidth = (((document.documentElement.clientWidth - 1000) / 2) - 10 + 17);
//         if (elWidth > 60) {
//             elWidth = 60;
//         }
//         lineStep1[0].style.width = elWidth + 'px';
//     } else {
//         elWidth = 7;
//         lineStep1[0].style.width = elWidth + 'px';
//     }
// }
//
// function showCoord() {
//     // console.log('Прокрутка:' + window.scrollY);
//     // брейкпоинты прокрутки экрана
//     var el2Start = 0;
//     var el3Start = ((lineStep3[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50); // Вертикальный элемент
//     var el4Start = ((lineStep4[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтальный элемент
//     var el5Start = ((lineStep5[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50); // Вертикальный элемент
//     var el6Start = ((lineStep6[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтальный элемент
//     var el7Start = ((lineStep7[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50); // Вертикальный элемент
//     var el8Start = ((lineStep8[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтальный элемент
//     // var el9Start = ((lineStep9[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50); // Вертикальный элемент
//     // var el10Start = ((lineStep10[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтальный элемент
//     // var el11Start = ((lineStep11[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50); // Вертикальный элемент
//     // var el12Start = ((lineStep12[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтальный элемент
//     // var el13Start = ((lineStep13[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50); // Вертикальный элемент
//     // var el14Start = ((lineStep14[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтальный элемент
//     // var el15Start = ((lineStep15[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50); // Вертикальный элемент
//     // var el16Start = ((lineStep16[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтальный элемент
//     // var el17Start = ((lineStep17[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) - 50); // Вертикальный элемент
//     // var el18Start = ((lineStep18[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Горизонтальный элемент
//     // var endOfLine = ((lineEnd[0].getBoundingClientRect().top + window.pageYOffset) - (document.documentElement.clientHeight / 2) + 50); // Последний Вертикальный элемент
//     // размеры элементов
//     var elMin = 0;
//     var el2MaxHeight = lineStep3[0].getBoundingClientRect().top - lineStep2[0].getBoundingClientRect().top + 7;
//     if (document.documentElement.clientWidth > 1100) {
//         var el3MaxWidth = 1100;
//     } else {
//         var el3MaxWidth = document.documentElement.clientWidth - 20;
//     }
//     var el4MaxHeight = lineStep5[0].getBoundingClientRect().top - lineStep4[0].getBoundingClientRect().top + 7;
//     if (document.documentElement.clientWidth > 1100) {
//         var el5MaxWidth = 1100;
//     } else {
//         var el5MaxWidth = document.documentElement.clientWidth - 20;
//     }
//     var el6MaxHeight = lineStep7[0].getBoundingClientRect().top - lineStep6[0].getBoundingClientRect().top + 7;
//     if (document.documentElement.clientWidth > 1100) {
//         var el7MaxWidth = 1100;
//     } else {
//         var el7MaxWidth = document.documentElement.clientWidth - 20;
//     }
//     // var el8MaxHeight = lineStep9[0].getBoundingClientRect().top - lineStep8[0].getBoundingClientRect().top + 7;
//     if (document.documentElement.clientWidth > 1100) {
//         var el9MaxWidth = 1100;
//     } else {
//         var el9MaxWidth = document.documentElement.clientWidth - 20;
//     }
//     // var el10MaxHeight = lineStep11[0].getBoundingClientRect().top - lineStep10[0].getBoundingClientRect().top + 7;
//     if (document.documentElement.clientWidth > 1100) {
//         var el11MaxWidth = 1100;
//     } else {
//         var el11MaxWidth = document.documentElement.clientWidth - 20;
//     }
//     // var el12MaxHeight = lineStep13[0].getBoundingClientRect().top - lineStep12[0].getBoundingClientRect().top + 7;
//     if (document.documentElement.clientWidth > 1100) {
//         var el13MaxWidth = 1100;
//     } else {
//         var el13MaxWidth = document.documentElement.clientWidth - 20;
//     }
//     // var el14MaxHeight = lineStep15[0].getBoundingClientRect().top - lineStep14[0].getBoundingClientRect().top + 7;
//     if (document.documentElement.clientWidth > 1100) {
//         var el15MaxWidth = 1100;
//     } else {
//         var el15MaxWidth = document.documentElement.clientWidth - 20;
//     }
//     // var el16MaxHeight = lineStep17[0].getBoundingClientRect().top - lineStep16[0].getBoundingClientRect().top + 7;
//     if (document.documentElement.clientWidth > 1100) {
//         var el17MaxWidth = 1100;
//     } else {
//         var el17MaxWidth = document.documentElement.clientWidth - 20;
//     }
//     // var el18MaxHeight = lineEnd[0].getBoundingClientRect().top - lineStep18[0].getBoundingClientRect().top + 7;
//     // анимация линии
//     if (window.scrollY == 0) {
//         lineStep2[0].style.height = elMin + 'px';
//         lineStep3[0].style.width = elMin + 'px';
//         lineStep4[0].style.height = elMin + 'px';
//         lineStep5[0].style.width = elMin + 'px';
//         lineStep6[0].style.height = elMin + 'px';
//         lineStep7[0].style.width = elMin + 'px';
//         lineStep8[0].style.height = elMin + 'px';
//         // lineStep9[0].style.width = elMin + 'px';
//         // lineStep10[0].style.height = elMin + 'px';
//         // lineStep11[0].style.width = elMin + 'px';
//         // lineStep12[0].style.height = elMin + 'px';
//         // lineStep13[0].style.width = elMin + 'px';
//         // lineStep14[0].style.height = elMin + 'px';
//         // lineStep15[0].style.width = elMin + 'px';
//         // lineStep16[0].style.height = elMin + 'px';
//         // lineStep17[0].style.width = elMin + 'px';
//         // lineStep18[0].style.height = elMin + 'px';
//     } else if (window.pageYOffset > el2Start && window.pageYOffset <= el3Start) {
//         // Элемент 2
//         var step = el2MaxHeight / (el3Start - el2Start);
//         var el2Height = (window.pageYOffset * step);
//         if (el2Height > el2MaxHeight) {
//             el2Height = el2MaxHeight;
//         } else {
//             el2Height = el2Height;
//         }
//         lineStep2[0].style.height = el2Height + 'px';
//         lineStep3[0].style.width = elMin + 'px';
//         lineStep4[0].style.height = elMin + 'px';
//         lineStep5[0].style.width = elMin + 'px';
//         lineStep6[0].style.height = elMin + 'px';
//         lineStep7[0].style.width = elMin + 'px';
//         lineStep8[0].style.height = elMin + 'px';
//         // lineStep9[0].style.width = elMin + 'px';
//         // lineStep10[0].style.height = elMin + 'px';
//         // lineStep11[0].style.width = elMin + 'px';
//         // lineStep12[0].style.height = elMin + 'px';
//         // lineStep13[0].style.width = elMin + 'px';
//         // lineStep14[0].style.height = elMin + 'px';
//         // lineStep15[0].style.width = elMin + 'px';
//         // lineStep16[0].style.height = elMin + 'px';
//         // lineStep17[0].style.width = elMin + 'px';
//         // lineStep18[0].style.height = elMin + 'px';
//     } else if (window.pageYOffset > el3Start && window.pageYOffset <= el4Start) {
//         // Элемент 3
//         var step = el3MaxWidth / (el4Start - el3Start);
//         var el3Width = ((window.pageYOffset - el3Start) * step);
//         if (el3Width > el3MaxWidth) {
//             el3Width = el3MaxWidth;
//         } else {
//             el3Width = el3Width;
//         }
//         lineStep2[0].style.height = el2MaxHeight + 'px';
//         lineStep3[0].style.width = el3Width + 'px';
//         lineStep4[0].style.height = elMin + 'px';
//         lineStep5[0].style.width = elMin + 'px';
//         lineStep6[0].style.height = elMin + 'px';
//         lineStep7[0].style.width = elMin + 'px';
//         lineStep8[0].style.height = elMin + 'px';
//         // lineStep9[0].style.width = elMin + 'px';
//         // lineStep10[0].style.height = elMin + 'px';
//         // lineStep11[0].style.width = elMin + 'px';
//         // lineStep12[0].style.height = elMin + 'px';
//         // lineStep13[0].style.width = elMin + 'px';
//         // lineStep14[0].style.height = elMin + 'px';
//         // lineStep15[0].style.width = elMin + 'px';
//         // lineStep16[0].style.height = elMin + 'px';
//         // lineStep17[0].style.width = elMin + 'px';
//         // lineStep18[0].style.height = elMin + 'px';
//     } else if (window.pageYOffset > el4Start && window.pageYOffset <= el5Start) {
//         // Элемент 4
//         var step = el4MaxHeight / (el5Start - el4Start);
//         var el4Height = ((window.pageYOffset - el4Start) * step);
//         if (el4Height > el4MaxHeight) {
//             el4Height = el4MaxHeight;
//         } else {
//             el4Height = el4Height;
//         }
//         lineStep2[0].style.height = el2MaxHeight + 'px';
//         lineStep3[0].style.width = el3MaxWidth + 'px';
//         lineStep4[0].style.height = el4Height + 'px';
//         lineStep5[0].style.width = elMin + 'px';
//         lineStep6[0].style.height = elMin + 'px';
//         lineStep7[0].style.width = elMin + 'px';
//         lineStep8[0].style.height = elMin + 'px';
//         // lineStep9[0].style.width = elMin + 'px';
//         // lineStep10[0].style.height = elMin + 'px';
//         // lineStep11[0].style.width = elMin + 'px';
//         // lineStep12[0].style.height = elMin + 'px';
//         // lineStep13[0].style.width = elMin + 'px';
//         // lineStep14[0].style.height = elMin + 'px';
//         // lineStep15[0].style.width = elMin + 'px';
//         // lineStep16[0].style.height = elMin + 'px';
//         // lineStep17[0].style.width = elMin + 'px';
//         // lineStep18[0].style.height = elMin + 'px';
//     } else if (window.pageYOffset > el5Start && window.pageYOffset <= el6Start) {
//         // Элемент 5
//         var step = el5MaxWidth / (el6Start - el5Start);
//         var el5Width = ((window.pageYOffset - el5Start) * step);
//         if (el5Width > el5MaxWidth) {
//             el5Width = el5MaxWidth;
//         } else {
//             el5Width = el5Width;
//         }
//         lineStep2[0].style.height = el2MaxHeight + 'px';
//         lineStep3[0].style.width = el3MaxWidth + 'px';
//         lineStep4[0].style.height = el4MaxHeight + 'px';
//         lineStep5[0].style.width = el5Width + 'px';
//         lineStep6[0].style.height = elMin + 'px';
//         lineStep7[0].style.width = elMin + 'px';
//         lineStep8[0].style.height = elMin + 'px';
//         // lineStep9[0].style.width = elMin + 'px';
//         // lineStep10[0].style.height = elMin + 'px';
//         // lineStep11[0].style.width = elMin + 'px';
//         // lineStep12[0].style.height = elMin + 'px';
//         // lineStep13[0].style.width = elMin + 'px';
//         // lineStep14[0].style.height = elMin + 'px';
//         // lineStep15[0].style.width = elMin + 'px';
//         // lineStep16[0].style.height = elMin + 'px';
//         // lineStep17[0].style.width = elMin + 'px';
//         // lineStep18[0].style.height = elMin + 'px';
//     } else if (window.pageYOffset > el6Start && window.pageYOffset <= el7Start) {
//         // Элемент 6
//         var step = el6MaxHeight / (el7Start - el6Start);
//         var el6Height = ((window.pageYOffset - el6Start) * step);
//         if (el6Height > el6MaxHeight) {
//             el6Height = el6MaxHeight;
//         } else {
//             el6Height = el6Height;
//         }
//         lineStep2[0].style.height = el2MaxHeight + 'px';
//         lineStep3[0].style.width = el3MaxWidth + 'px';
//         lineStep4[0].style.height = el4MaxHeight + 'px';
//         lineStep5[0].style.width = el5MaxWidth + 'px';
//         lineStep6[0].style.height = el6Height + 'px';
//         lineStep7[0].style.width = elMin + 'px';
//         lineStep8[0].style.height = elMin + 'px';
//         // lineStep9[0].style.width = elMin + 'px';
//         // lineStep10[0].style.height = elMin + 'px';
//         // lineStep11[0].style.width = elMin + 'px';
//         // lineStep12[0].style.height = elMin + 'px';
//         // lineStep13[0].style.width = elMin + 'px';
//         // lineStep14[0].style.height = elMin + 'px';
//         // lineStep15[0].style.width = elMin + 'px';
//         // lineStep16[0].style.height = elMin + 'px';
//         // lineStep17[0].style.width = elMin + 'px';
//         // lineStep18[0].style.height = elMin + 'px';
//     } else if (window.pageYOffset > el7Start && window.pageYOffset <= el8Start) {
//         // Элемент 7
//         var step = el7MaxWidth / (el8Start - el7Start);
//         var el7Width = ((window.pageYOffset - el7Start) * step);
//         if (el7Width > el7MaxWidth) {
//             el7Width = el7MaxWidth;
//         } else {
//             el7Width = el7Width;
//         }
//         lineStep2[0].style.height = el2MaxHeight + 'px';
//         lineStep3[0].style.width = el3MaxWidth + 'px';
//         lineStep4[0].style.height = el4MaxHeight + 'px';
//         lineStep5[0].style.width = el5MaxWidth + 'px';
//         lineStep6[0].style.height = el6MaxHeight + 'px';
//         lineStep7[0].style.width = el7Width + 'px';
//         lineStep8[0].style.height = elMin + 'px';
//         // lineStep9[0].style.width = elMin + 'px';
//         // lineStep10[0].style.height = elMin + 'px';
//         // lineStep11[0].style.width = elMin + 'px';
//         // lineStep12[0].style.height = elMin + 'px';
//         // lineStep13[0].style.width = elMin + 'px';
//         // lineStep14[0].style.height = elMin + 'px';
//         // lineStep15[0].style.width = elMin + 'px';
//         // lineStep16[0].style.height = elMin + 'px';
//         // lineStep17[0].style.width = elMin + 'px';
//         // lineStep18[0].style.height = elMin + 'px';
//     }
//     // else if (window.scrollY > el8Start && window.scrollY <= el9Start) {
//     //     // Элемент 8
//     //     var step = el8MaxHeight / (el9Start - el8Start);
//     //     var el8Height = ((window.pageYOffset - el8Start) * step);
//     //     if (el8Height > el8MaxHeight) {
//     //         el8Height = el8MaxHeight;
//     //     } else {
//     //         el8Height = el8Height;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8Height + 'px';
//     //     // lineStep9[0].style.width = elMin + 'px';
//     //     // lineStep10[0].style.height = elMin + 'px';
//     //     // lineStep11[0].style.width = elMin + 'px';
//     //     // lineStep12[0].style.height = elMin + 'px';
//     //     // lineStep13[0].style.width = elMin + 'px';
//     //     // lineStep14[0].style.height = elMin + 'px';
//     //     // lineStep15[0].style.width = elMin + 'px';
//     //     // lineStep16[0].style.height = elMin + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el9Start && window.pageYOffset <= el10Start) {
//     //     // Элемент 9
//     //     var step = el9MaxWidth / (el10Start - el9Start);
//     //     var el9Width = ((window.pageYOffset - el9Start) * step);
//     //     if (el9Width > el9MaxWidth) {
//     //         el9Width = el9MaxWidth;
//     //     } else {
//     //         el9Width = el9Width;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9Width + 'px';
//     //     // lineStep10[0].style.height = elMin + 'px';
//     //     // lineStep11[0].style.width = elMin + 'px';
//     //     // lineStep12[0].style.height = elMin + 'px';
//     //     // lineStep13[0].style.width = elMin + 'px';
//     //     // lineStep14[0].style.height = elMin + 'px';
//     //     // lineStep15[0].style.width = elMin + 'px';
//     //     // lineStep16[0].style.height = elMin + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el10Start && window.pageYOffset <= el11Start) {
//     //     // Элемент 10
//     //     var step = el10MaxHeight / (el11Start - el10Start);
//     //     var el10Height = ((window.pageYOffset - el10Start) * step);
//     //     if (el10Height > el10MaxHeight) {
//     //         el10Height = el10MaxHeight;
//     //     } else {
//     //         el10Height = el10Height;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10Height + 'px';
//     //     // lineStep11[0].style.width = elMin + 'px';
//     //     // lineStep12[0].style.height = elMin + 'px';
//     //     // lineStep13[0].style.width = elMin + 'px';
//     //     // lineStep14[0].style.height = elMin + 'px';
//     //     // lineStep15[0].style.width = elMin + 'px';
//     //     // lineStep16[0].style.height = elMin + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el11Start && window.pageYOffset <= el12Start) {
//     //     // Элемент 11
//     //     var step = el11MaxWidth / (el12Start - el11Start);
//     //     var el11Width = ((window.pageYOffset - el11Start) * step);
//     //     if (el11Width > el11MaxWidth) {
//     //         el11Width = el11MaxWidth;
//     //     } else {
//     //         el11Width = el11Width;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11Width + 'px';
//     //     // lineStep12[0].style.height = elMin + 'px';
//     //     // lineStep13[0].style.width = elMin + 'px';
//     //     // lineStep14[0].style.height = elMin + 'px';
//     //     // lineStep15[0].style.width = elMin + 'px';
//     //     // lineStep16[0].style.height = elMin + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el12Start && window.pageYOffset <= el13Start) {
//     //     // Элемент 12
//     //     var step = el12MaxHeight / (el13Start - el12Start);
//     //     var el12Height = ((window.pageYOffset - el12Start) * step);
//     //     if (el12Height > el12MaxHeight) {
//     //         el12Height = el12MaxHeight;
//     //     } else {
//     //         el12Height = el12Height;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11MaxWidth + 'px';
//     //     // lineStep12[0].style.height = el12Height + 'px';
//     //     // lineStep13[0].style.width = elMin + 'px';
//     //     // lineStep14[0].style.height = elMin + 'px';
//     //     // lineStep15[0].style.width = elMin + 'px';
//     //     // lineStep16[0].style.height = elMin + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el13Start && window.pageYOffset <= el14Start) {
//     //     // Элемент 13
//     //     var step = el13MaxWidth / (el14Start - el13Start);
//     //     var el13Width = ((window.pageYOffset - el13Start) * step);
//     //     if (el13Width > el13MaxWidth) {
//     //         el13Width = el13MaxWidth;
//     //     } else {
//     //         el13Width = el13Width;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11MaxWidth + 'px';
//     //     // lineStep12[0].style.height = el12MaxHeight + 'px';
//     //     // lineStep13[0].style.width = el13Width + 'px';
//     //     // lineStep14[0].style.height = elMin + 'px';
//     //     // lineStep15[0].style.width = elMin + 'px';
//     //     // lineStep16[0].style.height = elMin + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el14Start && window.pageYOffset <= el15Start) {
//     //     // Элемент 14
//     //     var step = el14MaxHeight / (el15Start - el14Start);
//     //     var el14Height = ((window.pageYOffset - el14Start) * step);
//     //     if (el14Height > el14MaxHeight) {
//     //         el14Height = el14MaxHeight;
//     //     } else {
//     //         el14Height = el14Height;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11MaxWidth + 'px';
//     //     // lineStep12[0].style.height = el12MaxHeight + 'px';
//     //     // lineStep13[0].style.width = el13MaxWidth + 'px';
//     //     // lineStep14[0].style.height = el14Height + 'px';
//     //     // lineStep15[0].style.width = elMin + 'px';
//     //     // lineStep16[0].style.height = elMin + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el15Start && window.pageYOffset <= el16Start) {
//     //     // Элемент 15
//     //     var step = el15MaxWidth / (el16Start - el15Start);
//     //     var el15Width = ((window.pageYOffset - el15Start) * step);
//     //     if (el15Width > el15MaxWidth) {
//     //         el15Width = el15MaxWidth;
//     //     } else {
//     //         el15Width = el15Width;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11MaxWidth + 'px';
//     //     // lineStep12[0].style.height = el12MaxHeight + 'px';
//     //     // lineStep13[0].style.width = el13MaxWidth + 'px';
//     //     // lineStep14[0].style.height = el14MaxHeight + 'px';
//     //     // lineStep15[0].style.width = el15Width + 'px';
//     //     // lineStep16[0].style.height = elMin + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el16Start && window.pageYOffset <= el17Start) {
//     //     // Элемент 16
//     //     var step = el16MaxHeight / (el17Start - el16Start);
//     //     var el16Height = ((window.pageYOffset - el16Start) * step);
//     //     if (el16Height > el16MaxHeight) {
//     //         el16Height = el16MaxHeight;
//     //     } else {
//     //         el16Height = el16Height;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11MaxWidth + 'px';
//     //     // lineStep12[0].style.height = el12MaxHeight + 'px';
//     //     // lineStep13[0].style.width = el13MaxWidth + 'px';
//     //     // lineStep14[0].style.height = el14MaxHeight + 'px';
//     //     // lineStep15[0].style.width = el15MaxWidth + 'px';
//     //     // lineStep16[0].style.height = el16Height + 'px';
//     //     // lineStep17[0].style.width = elMin + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el17Start && window.pageYOffset <= el18Start) {
//     //     // Элемент 17
//     //     var step = el17MaxWidth / (el18Start - el17Start);
//     //     var el17Width = ((window.pageYOffset - el17Start) * step);
//     //     if (el17Width > el17MaxWidth) {
//     //         el17Width = el17MaxWidth;
//     //     } else {
//     //         el17Width = el17Width;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11MaxWidth + 'px';
//     //     // lineStep12[0].style.height = el12MaxHeight + 'px';
//     //     // lineStep13[0].style.width = el13MaxWidth + 'px';
//     //     // lineStep14[0].style.height = el14MaxHeight + 'px';
//     //     // lineStep15[0].style.width = el15MaxWidth + 'px';
//     //     // lineStep16[0].style.height = el16MaxHeight + 'px';
//     //     // lineStep17[0].style.width = el17Width + 'px';
//     //     // lineStep18[0].style.height = elMin + 'px';
//     // }
//     // else if (window.pageYOffset > el18Start && window.pageYOffset <= endOfLine) {
//     //     // Элемент 18
//     //     var step = el18MaxHeight / (endOfLine - el18Start);
//     //     var el18Height = ((window.pageYOffset - el18Start) * step);
//     //     if (el18Height > el18MaxHeight) {
//     //         el18Height = el18MaxHeight;
//     //     } else {
//     //         el18Height = el18Height;
//     //     }
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11MaxWidth + 'px';
//     //     // lineStep12[0].style.height = el12MaxHeight + 'px';
//     //     // lineStep13[0].style.width = el13MaxWidth + 'px';
//     //     // lineStep14[0].style.height = el14MaxHeight + 'px';
//     //     // lineStep15[0].style.width = el15MaxWidth + 'px';
//     //     // lineStep16[0].style.height = el16MaxHeight + 'px';
//     //     // lineStep17[0].style.width = el17MaxWidth + 'px';
//     //     // lineStep18[0].style.height = el18Height + 'px';
//     // }
//     // else if (window.scrollY > endOfLine) {
//     //     // конец линии - все элементы на максимум
//     //     lineStep2[0].style.height = el2MaxHeight + 'px';
//     //     lineStep3[0].style.width = el3MaxWidth + 'px';
//     //     lineStep4[0].style.height = el4MaxHeight + 'px';
//     //     lineStep5[0].style.width = el5MaxWidth + 'px';
//     //     lineStep6[0].style.height = el6MaxHeight + 'px';
//     //     lineStep7[0].style.width = el7MaxWidth + 'px';
//     //     // lineStep8[0].style.height = el8MaxHeight + 'px';
//     //     // lineStep9[0].style.width = el9MaxWidth + 'px';
//     //     // lineStep10[0].style.height = el10MaxHeight + 'px';
//     //     // lineStep11[0].style.width = el11MaxWidth + 'px';
//     //     // lineStep12[0].style.height = el12MaxHeight + 'px';
//     //     // lineStep13[0].style.width = el13MaxWidth + 'px';
//     //     // lineStep14[0].style.height = el14MaxHeight + 'px';
//     //     // lineStep15[0].style.width = el15MaxWidth + 'px';
//     //     // lineStep16[0].style.height = el16MaxHeight + 'px';
//     //     // lineStep17[0].style.width = el17MaxWidth + 'px';
//     //     // lineStep18[0].style.height = el18MaxHeight + 'px';
//     // }
//
//     let headerEL = document.getElementsByClassName('header-flex')[0];
//     if (headerEL) {
//         if (window.scrollY > 0) {
//             // console.log('Header должен быть закреплен');
//             if (!headerEL.classList.contains('header-fixed')) {
//                 headerEL.classList.add('header-fixed');
//             }
//         } else {
//             // console.log('Header стандартный');
//             if (headerEL.classList.contains('header-fixed')) {
//                 headerEL.classList.remove('header-fixed');
//             }
//         }
//
//         if (window.scrollY > 623) {
//             if (!headerEL.classList.contains('hide-line')) {
//                 headerEL.classList.add('hide-line');
//             }
//         } else {
//             if (headerEL.classList.contains('hide-line')) {
//                 headerEL.classList.remove('hide-line');
//             }
//         }
//     }
// }
//
// var lineStep1 = document.getElementsByClassName('step-1'); // линия step-1
// var lineStep2 = document.getElementsByClassName('step-2'); // линия step-2
// var lineStep3 = document.getElementsByClassName('step-3'); // линия step-3
// var lineStep4 = document.getElementsByClassName('step-4'); // линия step-4
// var lineStep5 = document.getElementsByClassName('step-5'); // линия step-5
// var lineStep6 = document.getElementsByClassName('step-6'); // линия step-6
// var lineStep7 = document.getElementsByClassName('step-7'); // линия step-7
// var lineStep8 = document.getElementsByClassName('step-8'); // линия step-8
// var lineStep9 = document.getElementsByClassName('step-9'); // линия step-9
// var lineStep10 = document.getElementsByClassName('step-10'); // линия step-10
// var lineStep11 = document.getElementsByClassName('step-11'); // линия step-11
// var lineStep12 = document.getElementsByClassName('step-12'); // линия step-12
// var lineStep13 = document.getElementsByClassName('step-13'); // линия step-13
// var lineStep14 = document.getElementsByClassName('step-14'); // линия step-14
// var lineStep15 = document.getElementsByClassName('step-15'); // линия step-15
// var lineStep16 = document.getElementsByClassName('step-16'); // линия step-16
// var lineStep17 = document.getElementsByClassName('step-17'); // линия step-17
// var lineStep18 = document.getElementsByClassName('step-18'); // линия step-18
// var lineEnd = document.getElementsByClassName('block-show-more');
//
// addEventListener("scroll", function () {
//     showCoord(this)
// }, false); // активность линии при прокрутке страницы
// addEventListener("resize", function () {
//     showCoord(this)
// }, false); // активность линии при изменении размера страницы
// addEventListener("load", function () {
//     step1Width(this)
// }, false); // активность при полной загрузке страницы
// addEventListener("resize", function () {
//     step1Width(this)
// }, false); // активность при изменении размера страницы
