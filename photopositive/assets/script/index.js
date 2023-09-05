// Скрипт для всех страниц

let show_console = true;
if (show_console) {
    console.log('show_console', show_console);
    console.log('Скрипты для всех страниц в 1 файле');
}

// Отображение навигации
function openNav(el) {
    if (show_console) {
        console.log('openNav', el);
    }
    if (openBurgerMenu[0].children[1].classList.contains('d-none')) {
        openBurgerMenu[0].children[1].classList.remove('d-none');
    } else {
        openBurgerMenu[0].children[1].classList.add('d-none');
    }
    closeBurgerMenu.addEventListener("mouseout", function () {
        closeNav(this)
    }, {once: true, passive: true, capture: false}); // активность после нажатия на любое место 1 раз
    addEventListener("scroll", function () {
        closeNav(this)
    }, {once: true, passive: true, capture: false}); // активность после нажатия на любое место 1 раз
}

// Закрытие навигации
function closeNav(el) {
    if (show_console) {
        console.log('closeNav', el);
        console.log('event.target', event.target);
        console.log('event.target.classList', event.target.classList);
        console.log('event.target.tagName', event.target.tagName);
    }
    if (event.target.tagName === 'I') {
        if (show_console) {
            console.log('Тыкнули по I элементу');
        }
    } else {
        if (openBurgerMenu[0].children[1].classList.contains('d-none')) {
        } else {
            openBurgerMenu[0].children[1].classList.add('d-none');
        }
    }
}

let openBurgerMenu = document.getElementsByClassName('header-burger'); // поле с 4 линиями в навигации header
if (openBurgerMenu) {
    openBurgerMenu[0].addEventListener("click", function () {
        openNav(this);
    }, {once: false, passive: true, capture: false});
}
let closeBurgerMenu = document.body;
