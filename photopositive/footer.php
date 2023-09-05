<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photopositive
 */

?>

<footer class="footer" id="line-end-block">
    <div class="footer-flex">
        <div class="">
            <h2>Проект Фотопозитив</h2>
            <a class="" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>
            <a class="" href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
            <a class="footer-link__enter" href="https://pv-foto.ru/#forms">Войти</a>
            <h3><a class="open-rules" href="<?php echo get_template_directory_uri(); ?>/rules.pdf">Правила участия</a>
            </h3>
        </div>
        <div class="text-right">
            <a href="http://peresvet-group.com/" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-image.svg" alt="logo">
            </a>
            <!-- 				<p>Мы в соцсетях:</p> -->
            <div class="">
                <?php
                $page_title = 'facebook';
                $vk_page = get_page_by_title($page_title);
                $facebook = strstr(strstr($vk_page->post_content, 'http'), '">', true);
                ?>
                <!-- 					<a class="circle" href="<?php echo $facebook; ?>"><i class="fab fa-facebook-f"></i></a> -->
                <?php
                $page_title = 'vk';
                $vk_page = get_page_by_title($page_title);
                $vk = strstr(strstr($vk_page->post_content, 'http'), '">', true);
                ?>
                <!-- 					<a class="circle" href="<?php echo $vk; ?>"><i class="fab fa-vk"></i></a> -->
                <?php
                $page_title = 'instagram';
                $insta_page = get_page_by_title($page_title);
                $instagram = strstr(strstr($insta_page->post_content, 'http'), '">', true);
                ?>
                <!-- 					<a class="circle" href="<?php echo $instagram; ?>" onclick="ym(73524736, 'reachGoal', 'insta'); return true;"><i class="fab fa-instagram"></i></a> -->
            </div>
            <?php
            $page_title = 'tel';
            $tel_page = get_page_by_title($page_title);
            // print_r($tel_page);
            $tel = substr(strstr(strstr($tel_page->post_content, '</p>', true), '<p>'), 3);
            // echo strstr(strstr($insta_page->post_content, 'http'), '">', true);
            ?>
            <a class="footer-link__tel" href="tel:<?php echo $tel; ?>"><?php echo $tel; ?></a>
            <?php
            $page_title = 'email';
            $email_page = get_page_by_title($page_title);
            // print_r($email_page);
            $email = substr(strstr(strstr($email_page->post_content, '</p>', true), '<p>'), 3);
            ?>
            <a class="footer-link__email"
               href="mailto:<?php echo $email; ?>?subject=Обращение с сайта Фотопозитив"><?php echo $email; ?></a>
        </div>
    </div>
    <div class="footer-madeby">
        <p>Создание и поддержка ресурса: <a href="https://github.com/boriscom123">#bynextpr</a></p>
    </div>
</footer>

<div class="modal d-none">

    <div class="d-none">
        <div class="recover-password">
            <i class="far fa-times-circle close-fp"></i>
            <h2>Восстановить пароль</h2>
            <!--<form class="recover-password__form" action="" method="post">
                <input type="email" name="email" value="" placeholder="Адрес электроннй почты" required>
                <input type="password" name="pass1" value="" placeholder="Новый пароль" required>
                <input type="password" name="pass1" value="" placeholder="Повторите пароль" required>
                <input type="submit" name="changepass" value="Изменить">
            </form>-->
            <a href="<?php echo wp_login_url(); ?>">Восстановить пароль</a>
        </div>
    </div>

    <div class="d-none">
        <div class="join-form-pop">
            <i class="far fa-times-circle close-join"></i>
            <h2 class="join-form-pop__title">Получай деньги, следуя за позитивом!</h2>
            <div class="join-form-pop-flex">
                <form class="form__reg" action="" method="post">
                    <h2>Для регистрации введите номер телефона российского оператора</h2>
                    <h3></h3>
                    <div class="form__reg_login" title="Используйте только цифры">
                        <input id="input-reg-tel" type="text" name="login" value="" placeholder="8 913 504 47 02"
                               required>
                    </div>
                    <!-- <h3>Введите Ф.И.О.</h3>
                    <div class="form__reg_name" title="Используйте русские буквы"><input type="text" name="last-name" value="" placeholder="ФИО (ru)" pattern="^[А-Яа-яЁё\s]+$" required></div> -->
                    <p>Регистрируясь, вы соглашаетесь с</p>
                    <a href="<?php echo get_template_directory_uri(); ?>/privacy.pdf" target="_blank">Политикой
                        обработки персональных данных</a>
                    <h6>
                        После нажатия на кнопку на указанный Вами номер телефона поступит смс с паролем для
                        подтверждения регистрации.
                    </h6>
                    <?php
                    // если пользователь залогинен - отправляем на страницу загрузка фотографии
                    if (is_user_logged_in()) { // проверяем зарегистринованный это пользователь или нет
                        echo "<button type='submit' name='go-to-add-foto' form='go-to-add-foto' value='3'>Добавить работу</button>";
                    } else {
                        echo '<button type="submit" name="reg-submit" id="reg-form-button" onclick="ym(73524736, \'reachGoal\', \'uchastie\'); return true;">Принять участие</button>';
                    }
                    ?>
                </form>
                <form class="form__login" action="" method="post">
                    <h2>Уже зарегистрированы?</h2>
                    <div class="" title="Используйте латинские буквы или цифры">
                        <input id="input-login-tel"
                               type="text" name="login"
                               value=""
                               placeholder="Логин - номер телефона"
                               pattern="^[0-9A-Za-z\+\-\(\)]+$"
                               required>
                    </div>
                    <div class=""><input type="password" name="pass" value="" placeholder="Пароль"></div>
                    <p class="foget-password">Забыли пароль?</p>
                    <button type="submit" name="login-submit">Войти</button>
                </form>
            </div>
        </div>
    </div>

    <div class="d-none">
        <div class="reg-password-form">
            <i class="far fa-times-circle close-fp"></i>
            <h2>Для продолжения регистрации</h2>
            <h2>Введите пароль из СМС</h2>
            <form class="reg-form-password" action="" method="post">
                <input type="password" name="pass" value="" placeholder="Введите пароль" required>
                <input type="submit" name="reg-form-password-submit" value="Отправить">
            </form>
        </div>
    </div>

    <div class="d-none">
        <div class="reg-password-form">
            <i class="far fa-times-circle close-fp"></i>
            <h2>Для продолжения введите номер телефона</h2>
            <p></p>
            <form class="reg-form-password" action="" method="post">
                <input id="input-foget-tel" type="text" name="tel" value="" placeholder="Введите номер телефона"
                       required>
                <button type="button" name="foget-password-submit">Отправить</button>
            </form>
        </div>
    </div>

    <div class="d-none">
        <div class="new-registration">
            <div class="modal-close">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/icon-close.svg" alt="icon-close">
            </div>
<!--            <i class="far fa-times-circle close-new-registration"></i>-->
            <div class="modal-content">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/modal-image-new-registration.png"
                         alt="modal-image-new-registration.png">
                </div>
                <div class="form">
                    <h3 class="title">Получай деньги, <br>следуя за позитивом!</h3>
                    <div class="content">
                        <h6 class="alert transparent" id="modal-alert-registration">Пользователь с этим номером телефона уже существует</h6>
                        <div class="input input-tel">
                            <label>
                                <input type="text" placeholder="+7 (123) 456 78 90" id="modal-reg-input-tel">
                            </label>
                        </div>
                        <div class="input input-pass hidden">
                            <label>
                                <input type="text" placeholder="Введи пароль из смс" id="modal-reg-input-pass">
                            </label>
                        </div>
                        <div class="check-box">
                            <input id="modal-accept-politics" type="checkbox">
                            <label for="modal-accept-politics" class="decoration"></label>
                            <label for="modal-accept-politics" class="text">
                                Я согласен на обработку моих персональных данных согласно
                                <a href="<?php echo get_template_directory_uri(); ?>/privacy.pdf" target="_blank">политике конфиденциальности</a>
                            </label>
                        </div>
                        <button class="button" type="button" id="modal-button-registration">Дальше</button>
                        <div class="form-change">
                            <div class="modal-link-switch" id="modal-button-switch-to-login">Уже зарегистрирован?</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-none">
        <div class="new-login">
            <div class="modal-close">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/icon-close.svg" alt="icon-close">
            </div>
            <div class="modal-content">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/modal-image-new-login.png"
                         alt="modal-image-new-registration.png">
                </div>
                <div class="form">
                    <h3 class="title">Вход в личный <br>кабинет</h3>
                    <div class="content">
                        <h6 class="alert transparent" id="modal-alert-login">Пользователь с этим номером телефона уже существует</h6>
                        <div class="input input-tel">
                            <label>
                                <input type="text" placeholder="+7 (123) 456 78 90" id="modal-input-tel">
                            </label>
                        </div>
                        <div class="input input-pass">
                            <label>
                                <input type="text" placeholder="Введи пароль из смс" id="modal-input-pass">
                            </label>
                        </div>
                        <button class="button" type="button" id="modal-button-login">Войти</button>
                        <div class="form-change">
                            <div class="modal-link-switch" id="modal-button-switch-to-forget">Забыли пароль?</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-none">
        <div class="new-login">
            <div class="modal-close">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/icon-close.svg" alt="icon-close">
            </div>
            <div class="modal-content">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/modal-image-ok.png"
                         alt="modal-image-ok.png">
                </div>
                <div class="form">
                    <h3 class="title">Регистрация прошла успешно</h3>
                    <div class="content">
                        <p class="text-ok">
                            Сохраните код из СМС — он является вашим паролем для входа. Вы можете изменить пароль в личном кабинете в любой момент.
                        </p>
                        <button class="button" type="button" id="modal-button-ok">Понятно</button>
                        <button class="d-none" type="button" id="modal-button-ok-show"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-none">
        <div class="new-login">
            <div class="modal-close">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/icon-close.svg" alt="icon-close">
            </div>
            <div class="modal-content">
                <div class="modal-forget-content">
                    <h3>
                        Введите номер телефона, который вы использовали при регистрации
                    </h3>
                    <p>
                        Вам придёт новый пароль в СМС. Используйте его для входа в личный кабинет
                    </p>
                    <h6 class="alert transparent" id="modal-alert-forget">Такой номер не зарегистрирован</h6>
                    <div class="input input-tel">
                        <label>
                            <input type="text" placeholder="+7 (123) 456 78 90" id="modal-input-tel-forget">
                        </label>
                    </div>
                    <button class="button" type="button" id="modal-button-forget">Продолжить</button>
                </div>
            </div>
        </div>
    </div>

</div>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
