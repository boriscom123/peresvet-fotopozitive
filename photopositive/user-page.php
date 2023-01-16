<?php
/*
Template Name: ByNextPr - User-Page
*/

if (is_user_logged_in()) {
    $current_user_id = get_current_user_id();
} else {
    wp_redirect(home_url());
    exit;
}

if (isset($_POST)) {
    if (isset($_FILES['avatar'])) {
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        $file_array = $_FILES['avatar'];
        $post_id = 0;
        $img_tag = media_handle_sideload($file_array, $post_id);
        if (is_wp_error($img_tag)) {
            echo $img_tag->get_error_message();
        }
        $meta_key = 'wp_foto_user_avatar';
        update_user_meta($current_user_id, $meta_key, $img_tag);
    }
}

if (isset($_POST)) {
    if (isset($_POST['post-id']) && isset($_POST['del-post'])) {
        if ($_POST['del-post'] == 'del-post') {
            $postid = $_POST['post-id'];
            $force_delete = true;
            wp_delete_post($postid, $force_delete);
        }
    }
}

if (isset($_POST)) {
    if (isset($_POST['comment'])) {
        $cat = get_categories(array(
            'orderby' => 'term_id',
            'order' => 'DESC',
            'hide_empty' => '0',
            'number' => '1',
        ));
        $post_data = array(
            'post_title' => wp_strip_all_tags($_POST['comment']),
            'post_status' => 'publish',
            'post_author' => $current_user_id,
            'post_category' => array($cat['0']->term_id),
        );

        $post_id = wp_insert_post($post_data);
    }
    if (isset($_FILES['f'])) {
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        $file_array = $_FILES['f'];
        $desc = $_POST['comment'];
        $post_data = array(
            'post_parent' => $post_id,
        );
        $img_tag = media_handle_sideload($file_array, $post_id);
        if (is_wp_error($img_tag)) {
            echo $img_tag->get_error_message();
        } else {
            set_post_thumbnail($post_id, $img_tag);
        }
    }
}

if (isset($_POST)) {
    if (isset($_POST['user-nick']) && isset($_POST['user-submit'])) {
        $user_nick = $_POST['user-nick'];
        wp_update_user(['ID' => $current_user_id, 'nickname' => $user_nick, 'display_name' => $user_nick]);
    }
    if (isset($_POST['last-name']) && isset($_POST['user-submit'])) {
        $last_name = $_POST['last-name'];
        wp_update_user(['ID' => $current_user_id, 'last_name' => $last_name]);
    }
    if (isset($_POST['user-tel']) && isset($_POST['user-submit'])) {
        $user_tel = $_POST['user-tel'];
        wp_update_user(['ID' => $current_user_id, 'description' => $user_tel]);
    }
    if (isset($_POST['user-email']) && isset($_POST['user-submit'])) {
        $user_email = $_POST['user-email'];
        wp_update_user(['ID' => $current_user_id, 'user_email' => $user_email]);
    }
    if (isset($_POST['new-pass']) && isset($_POST['user-submit']) && isset($_POST['rep-new-pass']) && isset($_POST['current-pass'])) {
        $user = get_userdata($current_user_id);
        if ($user) {
            $password = $_POST['current-pass'];
            $hash = $user->data->user_pass;
            if (wp_check_password($password, $hash)) {
                if (!empty($_POST['new-pass']) && !empty($_POST['rep-new-pass'])) {
                    if ($_POST['new-pass'] === $_POST['rep-new-pass']) { // ставим новый пароль если совпадает
                        $user_pass = $_POST['new-pass'];
                        wp_update_user(['ID' => $current_user_id, 'user_pass' => $user_pass]);
                    }
                }
            }
        }
    }
}

if (isset($_POST['user_id'])) {
    $like_user_id = $_POST['user_id'];
    if (is_numeric($like_user_id)) {
        if (isset($_POST['dislike'])) {
            $dislike_post_id = $_POST['dislike'];
            if (is_numeric($dislike_post_id)) {
                $dislikes = $wpdb->query("DELETE FROM wp_foto_likes WHERE post_id=$dislike_post_id AND user_id=$like_user_id");
            }
        }
        if (isset($_POST['like'])) {
            $like_post_id = $_POST['like'];
            if (is_numeric($like_post_id)) {
                $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$like_post_id AND user_id=$like_user_id");
                if ($user_like[0]->user_like === '0') {
                    $table = 'wp_likes';
                    $data = array("user_id" => $like_user_id, "post_id" => $like_post_id);
                    $format = array("%d", "%d");
                    $likes = $wpdb->insert($table, $data, $format);
                }
            }
        }
    }
}

$user_data = get_userdata($current_user_id);
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
        wp_enqueue_style('photopositive-user-page', get_template_directory_uri() . '/assets/style/user-page.css', array(), _S_VERSION);
        ?>
    </head>
    <body <?php body_class(); ?>>

    <header class="gallery-header">
        <div class="gallery-header-opacity">
            <div class="header-flex container">
                <div class="navigation-line step-0">
                    <div class="navigation-line step-1">
                        <div class="navigation-line step-2"></div>
                    </div>
                </div>
                <a class="" href="https://pv-foto.ru/">Фотопозитив</a>
                <div class="header-flex__links">
                    <a class="link-join" href="https://pv-foto.ru/#forms">Принять участие</a>
                    <a class="" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>
                    <a class="" href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
                </div>
                <a href="http://peresvet-group.com/"><img
                            src="<?php echo get_template_directory_uri(); ?>/assets/image/logo.png" alt="logo"></a>
                <div class="header-flex__login">
                    <div class="">
                        <?php
                        if (is_user_logged_in()) {
                            $avatar = get_avatar_url(get_current_user_id());
                            echo "<a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'><img src='" . $avatar . "' alt='avatar'></a>";
                        } else {
                            echo "<a href='https://pv-foto.ru/#forms'><i class='fas fa-user'></i></a>";
                        }
                        ?>
                    </div>
                    <?php
                    if (is_user_logged_in()) {
                        $user_data = get_userdata(get_current_user_id());
                        $username = $user_data->get('display_name');
                        echo "<a class='active' href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'>" . $username . "</a>";
                    } else {
                        echo "<a href='https://pv-foto.ru/#forms'>Логин</a>";
                    }
                    ?>
                </div>
                <div class="header-flex__burger">
                    <i class="fas fa-align-justify"></i>
                    <div class="burger-menu d-none">
                        <?php
                        if (is_user_logged_in()) {
                            echo "<div class=''><a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'>Личный кабинет</a></div>";
                        } else {
                            echo "<div class=''><a href='https://pv-foto.ru/#forms'>Войти</a></div>";
                        }
                        ?>
                        <div class="active"><a href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>
                        </div>
                        <div class=""><a
                                    href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
                        </div>
                        <div class=""><a href="https://pv-foto.ru/#forms">Принять учатие</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="user-page-header">

        <div class="user-container">
            <div class="info">
                <div class="info__foto">
                    <img src="<?php echo get_avatar_url($current_user_id); ?>" alt="avatar">
                    <div class="info__foto-line"></div>
                    <div class="info__foto-plus">
                        <form class="avatar-form" action="" enctype="multipart/form-data" method="post">
                            <input type="file" name="avatar" id="avatar">
                            <label for="avatar"><i class="fas fa-plus"></i></label>
                        </form>
                    </div>
                </div>
                <div class="info__name">
                    <p><?php echo $username = $user_data->get('display_name'); ?></p>
                </div>
                <div class="info__line">
                    <div class="step-1">
                        <div class="step-2">
                            <div class="step-3">
                                <div class="step-4">
                                    <div class="step-5">
                                        <div class="step-6">
                                            <div class="step-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="exit">
                <a href="<?php echo wp_logout_url(home_url()); ?>">Выйти</a>
            </div>
        </div>

    </div>

    <main class="user-page">

        <?php
        if (isset($_POST['go-to-add-foto'])) {
            if ($_POST['go-to-add-foto'] === "1") {
                echo "<input type='radio' name='user' id='user' value='' checked>";
                echo "<input type='radio' name='user' id='foto' value=''>";
                echo "<input type='radio' name='user' id='work' value=''>";
            } elseif ($_POST['go-to-add-foto'] === "2") {
                echo "<input type='radio' name='user' id='user' value=''>";
                echo "<input type='radio' name='user' id='foto' value='' checked>";
                echo "<input type='radio' name='user' id='work' value=''>";
            } elseif ($_POST['go-to-add-foto'] === "3") {
                echo "<input type='radio' name='user' id='user' value=''>";
                echo "<input type='radio' name='user' id='foto' value=''>";
                echo "<input type='radio' name='user' id='work' value='' checked>";
            } else {
                echo "<input type='radio' name='user' id='user' value='' checked>";
                echo "<input type='radio' name='user' id='foto' value=''>";
                echo "<input type='radio' name='user' id='work' value=''>";
            }
        } else {
            echo "<input type='radio' name='user' id='user' value=''>";
            echo "<input type='radio' name='user' id='foto' value=''>";
            echo "<input type='radio' name='user' id='work' value='' checked>";
        }
        ?>

        <div class="flex">

            <div class="flex__links">
                <label for="user">Личные данные</label>
                <label for="foto">Загруженные фото</label>
                <label for="work">Добавить работу</label>
            </div>

            <div class="flex_info">

                <div class="d-none user">
                    <?php
                    $user_tel = $wpdb->get_results("SELECT tel FROM wp_users_tel WHERE user_id=$current_user_id");
                    if (empty($user_tel)) {
                        unset($user_tel);
                    } else {
                        print_r($user_tel);
                    }
                    ?>
                    <form class="user-form" action="" method="post">
                        <p>Только при наличии актуальных данных Вы можете получить выигрыш. Призовые деньги не
                            передаются по фейковым данным. </p>
                        <input type="text" name="user-nick" value="<?php echo $user_data->get('nickname'); ?>"
                               placeholder="Ник">
                        <input type="text" name="last-name" value="<?php echo $user_data->get('last_name'); ?>"
                               placeholder="ФИО">
                        <input type="tel" name="user-tel" value="<?php echo $user_data->get('user_login'); ?>"
                               placeholder="Номер телефона" disabled>
                        <h3 class="user-form-avatar"><label for="avatar">Загрузить аватарку</label></h3>
                        <h3 class="user-form-changepassword">Изменить пароль<i class="fas fa-hourglass"></i></h3>
                        <div class="d-none">
                            <input type="password" name="current-pass" value="" placeholder="Текущий пароль">
                            <input type="password" name="new-pass" value="" placeholder="Новый пароль">
                            <input type="password" name="rep-new-pass" value="" placeholder="Повторите пароль">
                        </div>
                        <input type="submit" name="user-submit" value="Сохранить">
                    </form>
                </div>

                <div class="d-none foto">
                    <div class="image-content">
                        <div class="image-field">

                            <div class="space"></div><!-- Пустой блок для отступа первого изображения -->

                            <?php
                            $args = array(
                                'posts_per_page' => 10,
                            );
                            $lastposts = get_posts($args);
                            foreach ($lastposts as $post) {
                                setup_postdata($post);
                                echo "ID автора поста: " . $post->post_author;
                                if ($post->post_author == $current_user_id) {
                                    echo 'Показываем';
                                    ?>
                                    <div class="card">
                                        <div class="card__image">
                                            <form class="del-foto" action="" method="post">
                                                <input type="hidden" name="go-to-add-foto" value="2">
                                                <input type="hidden" name="post-id" value="<?php echo get_the_ID(); ?>">
                                                <button type="submit" name="del-post" value="del-post" title="Удалить">
                                                    <i class="far fa-times-circle"></i></button>
                                            </form>
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="image">
                                                <div class="card__comment">
                                                    <p><?php the_title(); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card__info">
                                            <?php
                                            $user_id = get_current_user_id();
                                            $post_id = get_the_ID();
                                            $likes = $wpdb->get_results("SELECT COUNT(id) as likes FROM wp_foto_likes WHERE post_id=$post_id");
                                            $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$post_id AND user_id=$user_id");
                                            if ($user_like[0]->user_like === '0') {
                                                ?>
                                                <div class="">
                                                    <form class="" action="" method="post">
                                                        <button class="d-none" type="submit" name="like"
                                                                value="<?php echo $post_id; ?>"><i
                                                                    class="fas fa-heart"></i></button>
                                                        <input type="hidden" name="user_id"
                                                               value="<?php echo $user_id; ?>">
                                                        <button type="submit" name="like"><i class="far fa-heart"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="">
                                                    <form class="" action="" method="post">
                                                        <button class="d-none" type="submit" name="dislike"
                                                                value="<?php echo $post_id; ?>"><i
                                                                    class="far fa-heart"></i></button>
                                                        <input type="hidden" name="user_id"
                                                               value="<?php echo $user_id; ?>">
                                                        <button type="submit" name="dislike"><i
                                                                    class="fas fa-heart"></i></button>
                                                    </form>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <p><?php echo $likes[0]->likes; ?></p>
                                        </div>
                                    </div>

                                    <?php

                                }
                                ?>

                                <?php
                            }
                            wp_reset_postdata();
                            ?>

                        </div>
                        <div class="image-button">
                            <form class="d-none"
                                  action="https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/"
                                  method="post" id="go-to-add-foto"></form>
                            <button type="submit" name="go-to-add-foto" value="3" form="go-to-add-foto">Добавить
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-none work">

                    <form class="foto-form" action="" enctype="multipart/form-data" method="post">
                        <h2>Загрузить фотографию</h2>
                        <div class="add-foto">
                            <div class="foto-space">
                                <input type="file" name="f" id="file" multiple="false" accept=".jpg,.jpeg,.png,.gif">
                                <label for="file"><i class="fas fa-plus"></i></label>
                            </div>
                        </div>
                        <div class="add-comment">
                            <textarea name="comment" placeholder="Добавить комментарий" required></textarea>
                        </div>
                        <p>
                            Публикуя фотографию Вы подтверждаете своё авторство данного изображения.
                            Использование чужих фото, а также декораций, созданных другими участниками, влечет за собой
                            прекращение участия в проекте.
                        </p>
                        <input type="hidden" name="go-to-add-foto" value="2">
                        <input type="submit" name="post-submit" value="Опубликовать">
                    </form>

                </div>

            </div>

        </div>

    </main>

    <footer class="footer">
        <div class="footer-flex">
            <div class="">
                <h2>Проект Фотопозитив</h2>
                <a class="" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>
                <a class="" href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
                <a class="footer-link__enter" href="https://pv-foto.ru/#forms">Войти</a>
                <h3><a class="open-rules" href="<?php echo get_template_directory_uri(); ?>/rules.pdf">Правила
                        участия</a></h3>
            </div>
            <div class="text-right">
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo.png" alt="logo"></a>
                <p>Мы в соцсетях:</p>
                <div class="">
                    <?php
                    $page_title = 'facebook';
                    $vk_page = get_page_by_title($page_title);
                    $facebook = strstr(strstr($vk_page->post_content, 'http'), '">', true);
                    ?>
                    <a class="circle" href="<?php echo $facebook; ?>"><i class="fab fa-facebook-f"></i></a>
                    <?php
                    $page_title = 'vk';
                    $vk_page = get_page_by_title($page_title);
                    $vk = strstr(strstr($vk_page->post_content, 'http'), '">', true);
                    ?>
                    <a class="circle" href="<?php echo $vk; ?>"><i class="fab fa-vk"></i></a>
                    <?php
                    $page_title = 'instagram';
                    $insta_page = get_page_by_title($page_title);
                    $instagram = strstr(strstr($insta_page->post_content, 'http'), '">', true);
                    ?>
                    <a class="circle" href="<?php echo $instagram; ?>"
                       onclick="ym(73524736, 'reachGoal', 'insta'); return true;"><i class="fab fa-instagram"></i></a>
                </div>
                <?php
                $page_title = 'tel';
                $tel_page = get_page_by_title($page_title);
                $tel = substr(strstr(strstr($tel_page->post_content, '</p>', true), '<p>'), 3);
                ?>
                <a class="footer-link__tel" href="tel:<?php echo str_replace(' ', '', $tel); ?>"><?php echo $tel; ?></a>
                <?php
                $page_title = 'email';
                $email_page = get_page_by_title($page_title);
                $email = substr(strstr(strstr($email_page->post_content, '</p>', true), '<p>'), 3);
                ?>
                <a class="footer-link__email"
                   href="mailto:<?php echo $email; ?>?subject=Обращение-с-сайта-Фотопозитив"><?php echo $email; ?></a>
            </div>
        </div>
        <div class="footer-madeby">
            <p>Создание и поддержка ресурса: <a href="https://github.com/boriscom123">#bynextpr</a></p>
        </div>
    </footer>
    <?php
    wp_enqueue_script('photopositive-user-page-gallery', get_template_directory_uri() . '/assets/script/user-page-gallery.js', array(), _S_VERSION, true);
    wp_enqueue_script('photopositive-user-page-line', get_template_directory_uri() . '/assets/script/user-page-line.js', array(), _S_VERSION, true);
    wp_footer();
    ?>
    </body>
    </html>

<?php
