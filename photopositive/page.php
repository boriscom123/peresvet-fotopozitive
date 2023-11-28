<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photopositive
 */

get_header();
?>

    <div class="page-video">
        <div class="container">
            <?php
            $page_title = 'Видео на главной странице';
            $video_page = get_page_by_title($page_title);
            // $facebook = strstr(strstr($vk_page->post_content, 'http'), '">', true);
            print_r($video_page->post_content);
            ?>
        </div>
        <!-- <div class="">
            <i class="fas fa-play"></i>
        </div> -->
    </div>

    <div class="bunner-left" onclick="ym(73524736, 'reachGoal', 'baner'); return true;">
        <div class="bunner-left-content">
            <?php
            $page_title = 'Баннер Слева';
            $bunner_left = get_page_by_title($page_title);
            //print_r($left_bunner);
            $bunner_left_link = strstr(strstr($bunner_left->post_content, 'http'), '">', true);
            $bunner_left_image = get_the_post_thumbnail_url($bunner_left, 'full');
            //print_r($left_bunner_image);
            //echo $left_bunner_link;
            ?>
            <a href="<?php echo $bunner_left_link; ?>" target="_blank"><img src="<?php echo $bunner_left_image; ?>"
                                                                            alt="bunner"></a>
        </div>
        <div class="bunner-left-mini-content">
            <?php
            $page_title = 'Баннер Слева Мини';
            $bunner_left_mini = get_page_by_title($page_title);
            //print_r($left_bunner);
            $bunner_left_mini_link = strstr(strstr($bunner_left_mini->post_content, 'http'), '">', true);
            $bunner_left_mini_image = get_the_post_thumbnail_url($bunner_left_mini, 'full');
            //print_r($left_bunner_image);
            //echo $left_bunner_link;
            ?>
            <a href="<?php echo $bunner_left_mini_link; ?>" target="_blank" class=""><img
                        src="<?php echo $bunner_left_mini_image; ?>" alt="bunner"></a>
        </div>
    </div>

    <div class="bunner-right d-none">
        <div class="bunner-right-content">
            <?php
            $page_title = 'Баннер Справа';
            $bunner_right = get_page_by_title($page_title);
            //print_r($left_bunner);
            $bunner_right_link = strstr(strstr($bunner_right->post_content, 'http'), '">', true);
            $bunner_right_image = get_the_post_thumbnail_url($bunner_right, 'full');
            //print_r($left_bunner_image);
            //echo $left_bunner_link;
            ?>
            <a href="<?php echo $bunner_right_link; ?>" target="_blank"><img src="<?php echo $bunner_right_image; ?>"
                                                                             alt="bunner"></a>
        </div>
        <div class="bunner-right-mini-content">
            <?php
            $page_title = 'Баннер Справа Мини';
            $bunner_right_mini = get_page_by_title($page_title);
            //print_r($left_bunner);
            $bunner_right_mini_link = strstr(strstr($bunner_right_mini->post_content, 'http'), '">', true);
            $bunner_right_mini_image = get_the_post_thumbnail_url($bunner_right_mini, 'full');
            //print_r($left_bunner_image);
            //echo $left_bunner_link;
            ?>
            <a href="<?php echo $bunner_right_mini_link; ?>" target="_blank" class=""><img
                        src="<?php echo $bunner_right_mini_image; ?>" alt="bunner"></a>
        </div>
    </div>

    <div class="bunner">
        <div class="navi-container flex-end">
            <div class="navigation-line step-5">
                <div class="navigation-line step-6"></div>
            </div>
        </div>
        <div class="bunner-flex">
            <div class="bunner__content">
                <?php
                // echo do_shortcode('[supsystic-slider id=2 position="center"]');
                // echo do_shortcode('[nextcodeslider id="1"]'); // видео слайдер
               echo do_shortcode('[smartslider3 slider="4"]');

                /*<img src="<?php echo get_template_directory_uri(); ?>/assets/image/banner.jpg" alt="Изображение">*/
                ?>
            </div>
        </div>
        <!--        <div class="navi-container flex-start">-->
        <!--            <div class="navigation-line step-7">-->
        <!--                <div class="navigation-line step-8"></div>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>

    <!--    <div class="steps">-->

    <!--        <div class="steps__one">-->
    <!--            <img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/image/step-1.png" alt="step-1">-->
    <!--            <div>-->
    <!--                <h3>1</h3>-->
    <!--                <div class=""><p>Сделай крутое фото согласно условиям акции</p></div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="navi-container flex-end">-->
    <!--            <div class="navigation-line step-9">-->
    <!--                <div class="navigation-line step-10"></div>-->
    <!--            </div>-->
    <!--        </div>-->


    <!--        <div class="steps__two">-->
    <!--            <img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/image/step-2.png" alt="step-2">-->
    <!--            <div>-->
    <!--                <h3>2</h3>-->
    <!--                <div class=""><p>Загрузи фото на сайт и подпиши креативным комментарием</p></div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="navi-container flex-start">-->
    <!--            <div class="navigation-line step-11">-->
    <!--                <div class="navigation-line step-12"></div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="steps__three">-->
    <!--            <img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/image/step-3.png" alt="step-3">-->
    <!--            <div>-->
    <!--                <h3>3</h3>-->
    <!--                <div class=""><p>Набирай максимальное количество лайков</p></div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="navi-container flex-end">-->
    <!--            <div class="navigation-line step-13">-->
    <!--                <div class="navigation-line step-14"></div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="steps__four">-->
    <!--            <img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/image/step-4.png" alt="step-4">-->
    <!--            <div>-->
    <!--                <h3>4</h3>-->
    <!--                <div class=""><p>Забирай свой приз в <span>50 000</span> рублей!</p></div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="navi-container flex-start">-->
    <!--            <div class="navigation-line step-15">-->
    <!--                <div class="navigation-line step-16"></div>-->
    <!--            </div>-->
    <!--        </div>-->


    <!--        <div class="steps__five">-->
    <!--            <div class="navi-container flex-end">-->
    <!--                <div class="navigation-line step-17">-->
    <!--                    <div class="navigation-line step-18"></div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->

    <!--    <div class="forms" id="forms">-->
    <!--        <h2 class="forms__title">Получай деньги, следуя за позитивом!</h2>-->
    <!--        <div class="forms-flex">-->
    <!--            <form class="form__reg" action="" method="post">-->
    <!--                <h2>Для регистрации введите номер телефона российского оператора</h2>-->
    <!--                <h3></h3>-->
    <!--                <div class="form__reg_login" title="Используйте только цифры">-->
    <!--                    <input id="input-reg-tel" type="text" name="login" value="" placeholder="8 913 504 47 02" required>-->
    <!--                </div>-->
    <!--                <h3>Введите Ф.И.О.</h3>-->
    <!--                <div class="form__reg_name" title="Используйте русские буквы"><input type="text" name="last-name" value="" placeholder="ФИО (ru)" pattern="^[А-Яа-яЁё\s]+$" required></div> -->
    <!--                <p>Регистрируясь, вы соглашаетесь с</p>-->
    <!--                <a href="--><?php //echo get_template_directory_uri(); ?><!--/privacy.pdf" target="_blank">Политикой обработки-->
    <!--                    персональных данных</a>-->
    <!--                <h6>-->
    <!--                    После нажатия на кнопку на указанный Вами номер телефона поступит смс с паролем для подтверждения-->
    <!--                    регистрации.-->
    <!--                </h6>-->
    <!--                --><?php
//                // если пользователь залогинен - отправляем на страницу загрузка фотографии
//                if (is_user_logged_in()) { // проверяем зарегистринованный это пользователь или нет
//                    echo "<button type='submit' name='go-to-add-foto' form='go-to-add-foto' value='3'>Добавить работу</button>";
//                } else {
//                    echo '<button type="submit" name="reg-submit" id="reg-form-button" onclick="ym(73524736, \'reachGoal\', \'uchastie\'); return true;">Принять участие</button>';
//                }
//                ?>
    <!--            </form>-->
    <!--            <div class="form-border"></div>-->
    <!--            --><?php
//            if (is_user_logged_in()) {
//                echo "<form class='d-none' action='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/' method='post' id='go-to-add-foto'></form>";
//            }
//            ?>
    <!--            <form class="form__login" action="" method="post">-->
    <!--                <h2>Уже зарегистрированы?</h2>-->
    <!--                <div class="" title="Используйте латинские буквы или цифры"><input id="input-login-tel" type="text"-->
    <!--                                                                                   name="login" value=""-->
    <!--                                                                                   placeholder="Логин - номер телефона"-->
    <!--                                                                                   pattern="^[0-9A-Za-z\+\-\(\)]+$"-->
    <!--                                                                                   required></div>-->
    <!--                <div class=""><input type="password" name="pass" value="" placeholder="Пароль"></div>-->
    <!--                <p class="foget-password">Забыли пароль?</p>-->
    <!--                <button type="submit" name="login-submit">Войти</button>-->
    <!--            </form>-->
    <!--        </div>-->
    <!--    </div>-->

    <!--    <div class="forms-after-space">-->
    <!--        <div class="navigation-line step-19">-->
    <!--            <div class="navigation-line step-20"></div>-->
    <!--            <div class="navigation-line step-21"></div>-->
    <!--        </div>-->
    <!--        <div class="navigation-line step-22"></div>-->
    <!--    </div>-->

    <div class="choose-leader">
        <h2>Выбирайте победителя</h2>
        <div class="navi-container flex-start">
            <div class="navigation-line step-7 line-7-gallery">
                <div class="navigation-line step-8"></div>
            </div>
            <div class="navi-container line-steps"></div>
        </div>

        <div class="choose-leader__content">

            <?php
            global $wpdb, $post;
            $cat = get_categories(array(
                'orderby' => 'term_id', // сортируем по ID
                'order' => 'DESC', // направление получения данных
                'hide_empty' => '0', // показывать пустые
                'number' => '1', // количество необходимых категорий
            ));
            $result = get_posts(array(
                'category' => $cat['0']->term_id, // вывод постов только из текущей категории (текущего конкурса)
                'orderby' => 'rand', // произвольная сортировка
                'order' => 'ASC',
                'numberposts' => -1, // снимаем ограничения на показ постов
            ));

            $limit = 20; // лимит количества для отображения
            foreach ($result as $post) { ?>

            <div class="card">
                <div class="card__image">
                    <div class="card__image">
                        <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="image">
                        <div class="card__comment">
                            <a href="<?php echo get_post_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
                        </div>
                    </div>
                </div>
                <?php
                if (is_user_logged_in()) {
                    echo '<div class="card__info change-heart">';
                } else {
                    echo '<div class="card__info">';
                }
                ?>

                <?php
                $user_id = get_current_user_id();
                // echo $user_id;
                $post_id = get_the_ID();
                // echo $post_id;
                $likes = $wpdb->get_results("SELECT COUNT(id) as likes FROM wp_foto_likes WHERE post_id=$post_id");
                // print_r($likes);
                $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$post_id AND user_id=$user_id");
                // print_r($user_like);
                // echo get_permalink();
                echo '<a class="number">#' . $post_id . '</a>';
                if (is_user_logged_in()) {
                    // если пользователь залогинен - есть возможность поставить лайк
                    if ($user_like[0]->user_like === '0') {
                        ?>
                        <div class="">
                            <div>
                                <button class="d-none" type="submit" name="like" value="<?php echo $post_id; ?>"><i
                                            class="fas fa-heart"></i></button>
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <button type="submit" name="like"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="">
                            <div>
                                <button class="d-none" type="submit" name="dislike" value="<?php echo $post_id; ?>"><i
                                            class="far fa-heart"></i></button>
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <button type="submit" name="dislike"><i class="fas fa-heart"></i></button>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // пользователь не залогинен - при нажатии на сердечко показываем окно регистрации
                    ?>
                    <div class="">
                        <div class="join-pop" data-id="<?php echo $post_id; ?>">
                            <button class="d-none" type="submit" name="like" value=""><i class="fas fa-heart"></i></button>
                            <button type="submit" name="like"><i class="far fa-heart"></i></button>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <p><?php echo $likes[0]->likes; ?></p>

            </div>
        </div>

        <?php
        $limit--;
        // echo $limit;
        if ($limit == 0) {
            break;
        }
        }
        // wp_reset_postdata(); // сброс запроса к постам
        ?>
    </div>

    </div>

    <div class="block-show-more">
        <?php if (is_user_logged_in()): ?>
            <a href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Смотреть больше фото</a>
        <?php else: ?>
            <a href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Смотреть больше фото</a>
        <?php endif; ?>
    </div>

<?php
/**get_sidebar();*/
get_footer();
