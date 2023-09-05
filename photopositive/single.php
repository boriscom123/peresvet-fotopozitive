<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Photopositive
 */

// get_header();

if (isset($_POST['login-submit']) && isset($_POST['login']) && isset($_POST['pass'])) {
    $user_login = '';
    for ($i = 0; $i < mb_strlen($_POST['login']); $i++) {
        if ($i === 0 && $_POST['login'][0] === '+' && $_POST['login'][1] === '7') {
            $user_login .= 8;
            $i = 2;
        }
        if (is_int((int)$_POST['login'][$i])) {
            $user_login .= $_POST['login'][$i];
        }
    }
    $credentials = array(
        'user_login' => $_POST['login'],
        'user_password' => $_POST['pass'],
        'remember' => true,
    );
    $secure_cookie = '';
    $user = wp_signon($credentials);
    if (is_wp_error($user)) {
    } else {
        wp_redirect(home_url() . '/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/', 302);
        exit;
    }
}
?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php
        wp_site_icon();
        wp_head();
        wp_enqueue_style('photopositive-gallery', get_template_directory_uri() . '/assets/style/photo.css', array(), _S_VERSION);
        ?>
    </head>
    <body <?php body_class(); ?>>

    <?php $the_p = the_post(); ?>
    <main class="main-content">
        <div class="image-card">
            <div class="slider">
                <div class="image-card__close">
                    <a href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/cancel.svg" alt="close">
                    </a>
                </div>
                <div class="slider__left">
                    <?php $prev_post = get_previous_post_link('%link', '<img src="' . get_template_directory_uri() . '/assets/image/left.svg" alt="left">', 1);
                    if ($prev_post === '') {
                        $term = get_the_terms($post->ID, 'category');
                        $term = $term[0];
                        $order = 'DESC';
                        $article = get_posts([
                            'numberposts' => 1,
                            'exclude' => $post->ID,
                            'category' => $term->term_id,
                            'order' => $order
                        ]);
                        $article = $article[0];
                        echo '<a href="' . get_post_permalink($article->ID) . '"><img src="' . get_template_directory_uri() . '/assets/image/left.svg" alt="left"></a>';
                    } else {
                        echo $prev_post;
                    }
                    ?>
                </div>
                <div class="slider__card">
                    <div class="slider__card-image">
                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="image">
                        <div class="slider__card-image-title">
                            <p><?php echo get_the_author(); ?></p>
                        </div>
                    </div>
                    <div class="slider__card-info">
                        <?php
                        $user_id = get_current_user_id();
                        $post_id = get_the_ID();
                        $likes = $wpdb->get_results("SELECT COUNT(id) as likes FROM wp_foto_likes WHERE post_id=$post_id");
                        $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$post_id AND user_id=$user_id");
                        if (is_user_logged_in()) {
                            if ($user_like[0]->user_like === '0') {
                                ?>
                                <div class="">
                                    <form class="likes" action="" method="post">
                                        <button class="d-none" type="submit" name="like"
                                                value="<?php echo $post_id; ?>"><i class="fas fa-heart"></i></button>
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <button type="submit" name="like"><i class="far fa-heart"></i></button>
                                    </form>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="">
                                    <form class="likes" action="" method="post">
                                        <button class="d-none" type="submit" name="dislike"
                                                value="<?php echo $post_id; ?>"><i class="far fa-heart"></i></button>
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <button type="submit" name="dislike"><i class="fas fa-heart"></i></button>
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="">
                                <div class="join-pop" data-id="<?php echo $post_id; ?>">
                                    <button class="d-none" type="" name="like" value=""><i class="fas fa-heart"></i>
                                    </button>
                                    <input type="hidden" name="user_id" value="">
                                    <button type="" name="like"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <p><?php echo $likes[0]->likes; ?></p>
                    </div>
                    <div class="slider__card-comments">
                        <div class="">
                            <span><?php echo get_the_author(); ?>: </span><?php the_title(); ?>
                        </div>
                        <?php
                        $comments = get_comments(array(
                            'post_id' => get_the_ID(),
                            'status' => 'approve'
                        ));
                        ?>

                        <?php
                        $i = 0;
                        foreach ($comments as $comm) {
                            if ($i > 2) {
                                ?>
                                <div class="d-none">
                                    <span><?php echo $comm->comment_author; ?>: </span><?php echo $comm->comment_content; ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="">
                                    <span><?php echo $comm->comment_author; ?>: </span><?php echo $comm->comment_content; ?>
                                </div>
                                <?php
                            }
                            $i++;
                        }
                        ?>
                        <div class="">
                            <a href="#">Посмотреть все комментарии...</a>
                        </div>
                    </div>
                    <div class="slider__card-addcomm">
                        <?php
                        if (is_user_logged_in()) {
                            $comm_form_arg = [
                                'class_container' => 'slider__card-addcomm',
                                'title_reply' => '',
                                'logged_in_as' => '',
                                'comment_notes_before' => '',
                                'label_submit' => 'Опубликовать',
                                'submit_field' => '<p class="form-submit">%1$s %2$s</p>',
                                'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
                                'class_form' => 'slider__card-addcomm-form',
                                'comment_field' => '<input type="text" name="comment" value="" placeholder="Добавьте комментарий...">',
                            ];
                            $add_comm = comment_form($comm_form_arg);
                        } else {
                            echo "<a class='login' href='https://pv-foto.ru/#forms'>Авторизироваться</a>";
                        }

                        ?>
                    </div>
                </div>
                <div class="slider__right">
                    <?php $next_post = get_next_post_link('%link', '<img src="' . get_template_directory_uri() . '/assets/image/right.svg" alt="right">', 1); // <i class="fas fa-chevron-right"></i>
                    if ($next_post === '') {
                        $term = get_the_terms($post->ID, 'category');
                        $term = $term[0];
                        $order = 'ASC';
                        $article = get_posts([
                            'numberposts' => 1,
                            'exclude' => $post->ID,
                            'category' => $term->term_id,
                            'order' => $order
                        ]);
                        $article = $article[0];
                        echo '<a href="' . get_post_permalink($article->ID) . '"><img src="' . get_template_directory_uri() . '/assets/image/right.svg" alt="right"></a>';
                    } else {
                        echo $next_post;
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <div class="modal d-none" data-modal="join-pop">

        <div class="d-none">
            <div class="recover-password">
                <i class="far fa-times-circle close-fp"></i>
                <h2>Изменить пароль</h2>
                <form class="recover-password__form" action="#" method="post">
                    <input type="email" name="email" value="" placeholder="Адрес электроннй почты" required>
                    <input type="password" name="pass1" value="" placeholder="Новый пароль" required>
                    <input type="password" name="pass1" value="" placeholder="Повторите пароль" required>
                    <input type="submit" name="changepass" value="Изменить">
                </form>
                <a href="<?php echo wp_login_url(); ?>">Восстановить пароль</a>
            </div>
        </div>

        <div class="d-none">
            <div class="join-form-pop">
                <i class="far fa-times-circle close-join"></i>
                <h2 class="join-form-pop__title">Получай деньги, следуя за позитивом!</h2>
                <div class="join-form-pop-flex">
                    <form class="form__reg" action="" method="post">
                        <h2>Для регистрации введите номер телефона с кодом страны</h2>
                        <h3></h3>
                        <div class="form__reg_login" title="Используйте только цифры">
                            <input id="input-reg-tel" type="text" name="login" value="" placeholder="8 913 504 47 02"
                                   required></div>
                        <p>Регистрируясь, вы соглашаетесь с</p>
                        <a href="<?php echo get_template_directory_uri(); ?>/privacy.pdf" target="_blank">Политикой
                            обработки персональных данных</a>
                        <h6>
                            После нажатия на кнопку на указанный Вами номер телефона поступит смс с паролем для
                            подтверждения регистрации.
                        </h6>
                        <?php
                        if (is_user_logged_in()) {
                            echo "<button type='submit' name='go-to-add-foto' form='go-to-add-foto' value='3'>Добавить работу</button>";
                        } else {
                            echo '<button type="submit" name="reg-submit" id="reg-form-button" onclick="ym(73524736, \'reachGoal\', \'uchastie\'); return true;">Принять участие</button>';
                        }
                        ?>
                    </form>
                    <form class="form__login" action="" method="post">
                        <h2>Уже зарегистрированы?</h2>
                        <div class="" title="Используйте латинские буквы или цифры"><input type="text" name="login"
                                                                                           value=""
                                                                                           placeholder="Логин - номер телефона"
                                                                                           pattern="^[0-9A-Za-z\+\-\(\)]+$"
                                                                                           required></div>
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

    <?php
    wp_footer();
    ?>
    </body>
    </html>

<?php