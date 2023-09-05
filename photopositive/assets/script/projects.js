// открытие модального окна - забыли пароль
function telFeildCheck(el) {
    // console.log('Проверка корректтности воода номера телефона во всплывающем окне', el);
    // let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
    let re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
    let valid = re.test(el.children[2].children[0].value);
    if (valid) {
        // console.log('Номер телефона подходит');
        let tel = '';
        for (let i = 0; i < el.children[2].children[0].value.length; i++) {
            // console.log('Символ: ', el.children[2].children[0].value[i]);
            if ((i == 0) && (el.children[2].children[0].value[i] == '+') && (el.children[2].children[0].value[i + 1] == 7)) {
                tel += '8';
                i = 2;
            }
            if (parseInt(el.children[2].children[0].value[i])) {
                // console.log('parseInt: ');
                tel += String(el.children[2].children[0].value[i]);
            } else if (el.children[2].children[0].value[i] == 0 && el.children[2].children[0].value[i] != ' ') {
                // console.log('Ноль');
                tel += 0;
            }
        }
        if (el.previousElementSibling.classList.contains('error')) {
            el.previousElementSibling.classList.remove('error');
        }
        if (!el.previousElementSibling.classList.contains('ok')) {
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
        }).then(response => response.text()).then((response) => {
            console.log(response);
            if (response === 'true') {
                // console.log('Такого номера телефона нет в базе');
                el.parentNode.previousElementSibling.innerHTML = 'Такого номера телефона нет в базе. <br> Проверьте правильность ввода данных.'
            } else {
                // console.log('Такой номер телефона есть в базе - высылаем пароль для входа');
                el.parentNode.previousElementSibling.innerHTML = 'Пароль для входа отправлен в смс';
                if (tel) {
                    // высылаем новый пароль
                    let sendedPass = '';
                    let url = 'https://pv-foto.ru/wp-content/themes/photopositive/assets/ajax/sms.php';
                    let formData = new FormData();
                    formData.set('tel', tel);
                    fetch(url, {
                        method: 'POST',
                        body: formData
                    }).then(response => response.text()).then((response) => {
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
                        }).then(response => response.text()).then((response) => {
                            // console.log('Ответ сервера: ', response);
                            setTimeout(() => {
                                modalContent[0].classList.add('d-none');
                            }, 3000);
                        });
                    });
                }
            }
        });
    } else {
        // console.log('Номер телефона Не подходит', el.previousElementSibling.value);
        if (el.previousElementSibling.classList.contains('ok')) {
            el.previousElementSibling.classList.remove('ok');
        }
        if (!el.previousElementSibling.classList.contains('error')) {
            el.previousElementSibling.classList.add('error');
        }
    }
}

function openModal(el) {
    if (show_console) {
        console.log('Показываем всплывающее окно', el);
        console.log('event.target', event.target);
    }
    if (el.classList.contains('open-rules')) {
        // console.log('Показываем правила участия');
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[1].classList.remove('d-none');
    }
    if (el.classList.contains('foget-password')) {
        // console.log('Показываем окно восстановления пароля');
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[3].classList.remove('d-none');
        // добавляем проверку введенного номера телефона
        modalContent[0].children[3].children[0].children[3].children[1].addEventListener("click", function () {
            recoverPassword(this)
        });
    }
    if (el.classList.contains('show-join-pop')) {
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[4].classList.remove('d-none');
    }
    if (el.classList.contains('button-registration')) {
        if (show_console) {
            console.log('Показываем новое модальное окно регистрации');
        }
        closeAllModal();
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[4].classList.remove('d-none');
    }
    if (el.classList.contains('button-login')) {
        if (show_console) {
            console.log('Показываем новое модальное окно входа');
        }
        closeAllModal();
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[5].classList.remove('d-none');
    }
    if (el.id === 'modal-button-switch-to-login') {
        if (show_console) {
            console.log('Показываем новое модальное окно входа');
        }
        closeAllModal();
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[5].classList.remove('d-none');
    }

    if (el.id === 'modal-button-ok-show') {
        if (show_console) {
            console.log('Показываем новое модальное OK');
        }
        closeAllModal();
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[6].classList.remove('d-none');
    }

    if (el.id === 'modal-button-switch-to-forget') {
        if (show_console) {
            console.log('Показываем модальное окно - Забыли пароль');
        }
        closeAllModal();
        modalContent[0].classList.remove('d-none');
        modalContent[0].children[7].classList.remove('d-none');
    }
}

function closeModal(el) {
    if (show_console) {
        console.log('closeModal', el);
        console.log('event.target', event.target);
        console.log('event.target.classList', event.target.classList);
        console.log('event.target.tagName', event.target.tagName);
    }
    if (event.target.tagName === 'DIV' && (
        !event.target.classList.contains('content') &&
        !event.target.classList.contains('modal-content') &&
        !event.target.classList.contains('form') &&
        !event.target.classList.contains('form-change') &&
        !event.target.classList.contains('check-box') &&
        !event.target.classList.contains('input') &&
        !event.target.classList.contains('modal-link-switch')
    )) {
        modalContent[0].classList.add('d-none');
        for (var i = 0; i < modalContent[0].children.length; i++) {
            modalContent[0].children[i].classList.add('d-none');
        }
    } else {
        console.log('Что-то совпало', el);
    }
    if (event.target.tagName == 'I' || event.target.tagName == 'IMG') {
        modalContent[0].classList.add('d-none');
        for (var i = 0; i < modalContent[0].children.length; i++) {
            modalContent[0].children[i].classList.add('d-none');
        }
    }
}

function closeAllModal(el) {
    modalContent[0].classList.add('d-none');
    for (let i = 0; i < modalContent[0].children.length; i++) {
        modalContent[0].children[i].classList.add('d-none');
    }
}

let modalContent = document.getElementsByClassName('modal');
let openFPButton = document.getElementsByClassName('foget-password');
let openJoinButton = document.getElementsByClassName('show-join-pop');
let closeFPButton = document.getElementsByClassName('close-fp');
let openRules = document.getElementsByClassName('open-rules');
let closeRulesButton = document.getElementsByClassName('close-rules');
openFPButton[0].addEventListener("click", function () {
    openModal(this)
}, {once: false, passive: true, capture: false});
if (openJoinButton.length !== 0) {
    openJoinButton[0].addEventListener("click", function () {
        openModal(this)
    }, {once: false, passive: true, capture: false});
}
modalContent[0].addEventListener("click", function () {
    closeModal(this)
}, {once: false, passive: true, capture: true});
closeFPButton[0].addEventListener("click", function () {
    closeModal(this)
}, {once: false, passive: true, capture: true});

// новый вид регистрации от 20-03-2021
function telCheck(el) {
    console.log('Функция проверки ввода номера телефона');
    // let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
    let re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
    let valid = re.test(el.children[2].children[0].value);
    if (valid) {
        // console.log('Номер телефона подходит');
        let tel = '';
        for (let i = 0; i < el.children[2].children[0].value.length; i++) {
            // console.log('Символ: ', el.children[2].children[0].value[i]);
            if ((i == 0) && (el.children[2].children[0].value[i] == '+') && (el.children[2].children[0].value[i + 1] == 7)) {
                tel += '8';
                i = 2;
            }
            if (parseInt(el.children[2].children[0].value[i])) {
                // console.log('parseInt: ');
                tel += String(el.children[2].children[0].value[i]);
            } else if (el.children[2].children[0].value[i] == 0 && el.children[2].children[0].value[i] != ' ') {
                // console.log('Ноль');
                tel += 0;
            }
        }
        if (el.children[2].classList.contains('error')) {
            el.children[2].classList.remove('error');
        }
        if (!el.children[2].classList.contains('ok')) {
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
        }).then(response => response.text()).then((response) => {
            // console.log('ответ сервера:', response);
            if (response === 'true') {
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
            } else {
                el.children[1].innerHTML = 'Такой номер телефона уже используется. Введите другой номер.';
                // console.log('Телефон уже используется');
                if (el.children[2].classList.contains('ok')) {
                    el.children[2].classList.remove('ok');
                }
                if (!el.children[2].classList.contains('error')) {
                    el.children[2].classList.add('error');
                }
            }
        });
    } else {
        console.log('Номер телефона Не подходит',);
        if (el.children[2].classList.contains('ok')) {
            el.children[2].classList.remove('ok');
        }
        if (!el.children[2].classList.contains('error')) {
            el.children[2].classList.add('error');
        }
    }
}

function recoverPassword(el) {
    // console.log('кнопка восстановления пароля', el);
    // let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
    let re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
    let valid = re.test(el.children[2].children[0].value);
    if (valid) {
        // console.log('Номер телефона подходит');
        let tel = '';
        for (let i = 0; i < el.children[2].children[0].value.length; i++) {
            // console.log('Символ: ', el.children[2].children[0].value[i]);
            if ((i == 0) && (el.children[2].children[0].value[i] == '+') && (el.children[2].children[0].value[i + 1] == 7)) {
                tel += '8';
                i = 2;
            }
            if (parseInt(el.children[2].children[0].value[i])) {
                // console.log('parseInt: ');
                tel += String(el.children[2].children[0].value[i]);
            } else if (el.children[2].children[0].value[i] == 0 && el.children[2].children[0].value[i] != ' ') {
                // console.log('Ноль');
                tel += 0;
            }
        }
        if (el.previousElementSibling.classList.contains('error')) {
            el.previousElementSibling.classList.remove('error');
        }
        if (!el.previousElementSibling.classList.contains('ok')) {
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
        }).then(response => response.text()).then((response) => {
            // console.log('ответ сервера:', response);
            if (response === 'true') {
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
            } else {
                el.parentNode.previousElementSibling.innerHTML = 'Такого номера телефона нет. Введите другой номер.';
                // console.log('Такого номера телефона нет');
                if (el.previousElementSibling.classList.contains('ok')) {
                    el.previousElementSibling.classList.remove('ok');
                }
                if (!el.previousElementSibling.classList.contains('error')) {
                    el.previousElementSibling.classList.add('error');
                }
            }
        });
    } else {
        // console.log('Номер телефона Не подходит', );
        if (el.previousElementSibling.classList.contains('ok')) {
            el.previousElementSibling.classList.remove('ok');
        }
        if (!el.previousElementSibling.classList.contains('error')) {
            el.previousElementSibling.classList.add('error');
        }
    }
}

function checkSmsPass(val) {
    // console.log('Сверяем пароли');
    // console.log('Искомый пароль:', val);
    if (modalContent[0].children[2].children[0].children[2].children[0].value == val) {
        console.log('Пароли совпали, отправляем данные для регистрации пользователя');
        // отправляем данные для регистрации пользователя
        modalContent[0].children[2].children[0].children[2].innerHTML += '<input type="hidden" name="pass2" value="' + val + '">';
        modalContent[0].children[2].children[0].children[2].submit();
    } else {
        event.preventDefault();
        // console.log('Пароли НЕ совпали');
        // просим ввести пароль повторно
        modalContent[0].children[2].children[0].children[1].innerHTML = 'Пароль не совпал - попробуйте еще раз';
    }
}

function checkRegform(el) {
    let regform = el.parentNode;
    event.preventDefault();
    let tel = telCheck(regform);
    if (tel) {
        // console.log('Регистрационный номер телефона: ', tel);
    }
}

let regFormButtonEl = document.getElementById('reg-form-button');
if (regFormButtonEl) {
    regFormButtonEl.addEventListener("click", function () {
        checkRegform(this)
    }, false);
}

function inputCheckTel(el) {
    // console.log('Проверяем номер телефона при нажатии клавиш', el);
    let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
    let valid = re.test(el.value);
    if (valid) {
        // console.log('Номер телефона подходит');
        if (el.parentNode.classList.contains('error')) {
            el.parentNode.classList.remove('error');
        }
        if (!el.parentNode.classList.contains('ok')) {
            el.parentNode.classList.add('ok');
        }
    } else {
        // console.log('Номер телефона Не подходит');
        if (el.parentNode.classList.contains('ok')) {
            el.parentNode.classList.remove('ok');
        }
        if (!el.parentNode.classList.contains('error')) {
            el.parentNode.classList.add('error');
        }
    }
}

let inputElelement = document.getElementById('input-reg-tel'); // input ввода номера телефона
inputElelement.addEventListener("keyup", function () {
    inputCheckTel(this)
}, false);

function inputCheckFogetTel(el) {
    // console.log('Проверяем номер телефона при нажатии клавиш', el);
    let re = /[(^\d)|(\+)][\d\(\)\ -]{9,15}\d$/;
    let valid = re.test(el.value);
    if (valid) {
        // console.log('Номер телефона подходит');
        if (el.classList.contains('error')) {
            el.classList.remove('error');
        }
        if (!el.classList.contains('ok')) {
            el.classList.add('ok');
        }
    } else {
        // console.log('Номер телефона Не подходит');
        if (el.classList.contains('ok')) {
            el.classList.remove('ok');
        }
        if (!el.classList.contains('error')) {
            el.classList.add('error');
        }
    }
}

let inputFogetTelElelement = document.getElementById('input-foget-tel'); // input ввода номера телефона
inputFogetTelElelement.addEventListener("keyup", function () {
    inputCheckFogetTel(this)
}, false);

// новые кнопки Войти или Принять участие в Header
let newLoginButtonEl = document.getElementsByClassName('button-login');
if (newLoginButtonEl) {
    if (show_console) {
        console.log('newLoginButtonEl', newLoginButtonEl);
    }
    for (let i = 0; i < newLoginButtonEl.length; i++) {
        newLoginButtonEl[i].addEventListener("click", function () {
            openModal(this);
        }, false); // активность после полной загрузки страницы
    }
}
let newRegButtonEl = document.getElementsByClassName('button-registration');
if (newRegButtonEl) {
    if (show_console) {
        console.log('newRegButtonEl', newRegButtonEl);
    }
    for (let i = 0; i < newRegButtonEl.length; i++) {
        newRegButtonEl[i].addEventListener("click", function () {
            openModal(this);
        }, false); // активность после полной загрузки страницы
    }
}

let newModalLoginButtonEl = document.getElementById('modal-button-login');
if (newModalLoginButtonEl) {
    newModalLoginButtonEl.addEventListener("click", function () {
        newModalLogin(this);
    }, false);
}
let newModalInputTelEl = document.getElementById('modal-input-tel');
let newModalInputPassEl = document.getElementById('modal-input-pass');
let newModalAlertLoginEl = document.getElementById('modal-alert-login');

function newModalLogin(el) {
    if (show_console) {
        console.log('newModalLogin', el);
    }
    // проверяем введенный номер телефона
    if (newModalInputTelEl && newModalInputPassEl) {
        console.log('newModalInputTelEl', newModalInputTelEl);
        if (checkTelNumber(newModalInputTelEl.value)) {
            console.log('Номер телефона подходит');
            hideModalAlertLogin();
            let data = [];
            data.push(['user-tel', prepareTelNumber(newModalInputTelEl.value)]);
            data.push(['user-pass', newModalInputPassEl.value]);
            sendLoginRequest('user-login', data);
        } else {
            console.log('Номер телефона НЕ подходит');
            showModalAlertLogin('Номер телефона НЕ подходит');
        }
    } else {
        console.log('Элемент с логином или паролем не найден');
    }
}

function checkTelNumber(value) {
    let re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
    return re.test(value);
}

function prepareTelNumber(value) {
    if (show_console) {
        console.log('prepareTelNumber', value);
    }
    let tel = '';
    for (let i = 0; i < value.length; i++) {
        if ((i === 0) && (value[i] === '+') && (value[i + 1] === 7)) {
            tel += '8';
            i = 2;
        }
        if (parseInt(value[i])) {
            tel += String(value[i]);
        } else if (value[i] === '0' && value[i] !== ' ') {
            tel += 0;
        }
    }
    if (tel.length > 11) {
        tel = tel.substring(0, 11);
    }

    if (show_console) {
        console.log('tel', tel);
    }
    return tel;
}

function showModalAlertLogin(message) {
    if (newModalAlertLoginEl) {
        newModalAlertLoginEl.innerHTML = message;
        if (newModalAlertLoginEl.classList.contains('transparent')) {
            newModalAlertLoginEl.classList.remove('transparent');
        }
    } else {
        console.log('Элемент для вывода сообщения не найден', message);
    }
}

function hideModalAlertLogin() {
    if (newModalAlertLoginEl) {
        if (!newModalAlertLoginEl.classList.contains('transparent')) {
            newModalAlertLoginEl.classList.add('transparent');
        }
    } else {
        console.log('Элемент для вывода сообщения не найден');
    }
}

function sendLoginRequest(action, data) {
    if (show_console) {
        console.log('data', data);
    }
    let url = 'https://pv-foto.ru/ajax/';
    let formData = new FormData();
    formData.set('action', action);
    data.forEach((item, index, array) => {
        formData.set(item[0], item[1]);
    });
    let fetchResponse = fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => response.json()).then((response) => {
        if (show_console) {
            console.log('fetchResponse sendLoginRequest', response);
        }
        if ('result' in response) {
            if (response.result) {
                location.reload();
            } else {
                showModalAlertLogin(response.message);
            }
        }
    });
}

let newModalRegButtonEl = document.getElementById('modal-button-registration');
if (newModalRegButtonEl) {
    newModalRegButtonEl.addEventListener("click", function () {
        newModalReg(this);
    }, false);
}
let newModalRegInputTelEl = document.getElementById('modal-reg-input-tel');
let newModalRegInputPassEl = document.getElementById('modal-reg-input-pass');
let newModalCheckPoliticsEl = document.getElementById('modal-accept-politics');
let newModalAlertRegEl = document.getElementById('modal-alert-registration');
let newModalSwitchToLoginEl = document.getElementById('modal-button-switch-to-login');
if (newModalSwitchToLoginEl) {
    newModalSwitchToLoginEl.addEventListener("click", function () {
        openModal(this);
    }, false);
}
let newModalSwitchToForgetEl = document.getElementById('modal-button-switch-to-forget');
if (newModalSwitchToForgetEl) {
    newModalSwitchToForgetEl.addEventListener("click", function () {
        openModal(this);
    }, false);
}

function newModalReg(el) {
    if (show_console) {
        console.log('newModalReg', el);
    }
    if (newModalRegInputTelEl && newModalRegInputPassEl) {
        if (checkTelNumber(newModalRegInputTelEl.value)) {
            console.log('Номер телефона подходит');
            hideModalAlertReg();
            if (!newModalCheckPoliticsEl.checked) {
                showModalAlertReg('Необходимо подтвердить согласие с политикой конфиденциальности');
            } else {
                if (newModalRegInputPassEl.value === '') {
                    let data = [];
                    data.push(['user-tel', prepareTelNumber(newModalRegInputTelEl.value)]);
                    sendRegTelCheckRequest('user-reg-tel-check', data);
                } else {
                    let data = [];
                    data.push(['user-tel', prepareTelNumber(newModalRegInputTelEl.value)]);
                    data.push(['user-pass', newModalRegInputPassEl.value]);
                    data.push(['add-amo-contact', 'true']);
                    sendRegLoginRequest('user-login', data);
                }

            }
        } else {
            console.log('Номер телефона НЕ подходит');
            showModalAlertReg('Номер телефона НЕ подходит');
        }
    } else {
        console.log('Элемент с логином или паролем не найден');
    }
}

function showModalAlertReg(message) {
    if (newModalAlertRegEl) {
        newModalAlertRegEl.innerHTML = message;
        if (newModalAlertRegEl.classList.contains('transparent')) {
            newModalAlertRegEl.classList.remove('transparent');
        }
    } else {
        console.log('Элемент для вывода сообщения не найден', message);
    }
}

function hideModalAlertReg() {
    if (newModalAlertRegEl) {
        if (!newModalAlertRegEl.classList.contains('transparent')) {
            newModalAlertRegEl.classList.add('transparent');
        }
    } else {
        console.log('Элемент для вывода сообщения не найден');
    }
}

function sendRegTelCheckRequest(action, data) {
    if (show_console) {
        console.log('data', data);
    }
    let url = 'https://pv-foto.ru/ajax/';
    let formData = new FormData();
    formData.set('action', action);
    data.forEach((item, index, array) => {
        formData.set(item[0], item[1]);
    });
    let fetchResponse = fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => response.json()).then((response) => {
        if (show_console) {
            console.log('fetchResponse sendRegTelCheckRequest', response);
        }
        if ('result' in response) {
            if (response.result) {
                newModalRegInputPassEl.parentElement.parentElement.classList.remove('hidden');
                showModalAlertReg(response.message);
            } else {
                showModalAlertReg(response.message);
            }
        }
    });
}

function sendRegLoginRequest(action, data) {
    if (show_console) {
        console.log('data', data);
    }
    let url = 'https://pv-foto.ru/ajax/';
    let formData = new FormData();
    formData.set('action', action);
    data.forEach((item, index, array) => {
        formData.set(item[0], item[1]);
    });
    let fetchResponse = fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => response.json()).then((response) => {
        if (show_console) {
            console.log('fetchResponse sendRegLoginRequest', response);
        }
        if ('result' in response) {
            if (response.result) {
                newModalRegInputPassEl.parentElement.parentElement.classList.remove('hidden');
                showModalAlertReg(response.message);
                console.log('this', this);
                newModalOkShowEl.click();
            } else {
                showModalAlertReg(response.message);
            }
        }
    });
}

let newModalOkShowEl = document.getElementById('modal-button-ok-show');
if (newModalOkShowEl) {
    newModalOkShowEl.addEventListener("click", function () {
        openModal(this);
    }, false);
}
let newModalOkCloseEl = document.getElementById('modal-button-ok');
if (newModalOkCloseEl) {
    newModalOkCloseEl.addEventListener("click", function () {
        closeAllModal();
        location.reload();
    }, false);
}



let newModalForgetTelButtonEl = document.getElementById('modal-button-forget');
if (newModalForgetTelButtonEl) {
    newModalForgetTelButtonEl.addEventListener("click", function () {
        newForgetTel(this);
    }, false);
}
let newModalAlertForgetEl = document.getElementById('modal-alert-forget');
let newModalForgetInputTelEl = document.getElementById('modal-input-tel-forget');


function newForgetTel(el) {
    if (show_console) {
        console.log('newForgetTel', el);
    }
    // проверяем введенный номер телефона
    if (newModalForgetInputTelEl) {
        console.log('newModalForgetInputTelEl', newModalForgetInputTelEl);
        if (checkTelNumber(newModalForgetInputTelEl.value)) {
            console.log('Номер телефона подходит');
            hideModalAlertForget();
            let data = [];
            data.push(['user-tel', prepareTelNumber(newModalForgetInputTelEl.value)]);
            sendForgetTelCheckRequest('user-forget', data);
        } else {
            console.log('Номер телефона НЕ подходит');
            showModalAlertForget('Номер телефона НЕ подходит');
        }
    } else {
        console.log('Элемент с логином или паролем не найден');
    }
}

function showModalAlertForget(message) {
    if (newModalAlertForgetEl) {
        newModalAlertForgetEl.innerHTML = message;
        if (newModalAlertForgetEl.classList.contains('transparent')) {
            newModalAlertForgetEl.classList.remove('transparent');
        }
    } else {
        console.log('Элемент для вывода сообщения не найден', message);
    }
}
function hideModalAlertForget() {
    if (newModalAlertForgetEl) {
        if (!newModalAlertForgetEl.classList.contains('transparent')) {
            newModalAlertForgetEl.classList.add('transparent');
        }
    } else {
        console.log('Элемент для вывода сообщения не найден');
    }
}
function sendForgetTelCheckRequest(action, data) {
    if (show_console) {
        console.log('data', data);
    }
    let url = 'https://pv-foto.ru/ajax/';
    let formData = new FormData();
    formData.set('action', action);
    data.forEach((item, index, array) => {
        formData.set(item[0], item[1]);
    });
    let fetchResponse = fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => response.json()).then((response) => {
        if (show_console) {
            console.log('fetchResponse sendRegTelCheckRequest', response);
        }
        if ('result' in response) {
            if (response.result) {
                showModalAlertForget(response.message);
                newModalSwitchToLoginEl.click();
            } else {
                showModalAlertForget(response.message);
            }
        }
    });
}