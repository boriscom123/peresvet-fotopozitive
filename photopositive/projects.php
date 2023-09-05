<?php
/*
Template Name: ByNextPr - Projects
*/

get_header();
?>
<?php
//if (isset($_POST['login-submit']) && isset($_POST['login']) && isset($_POST['pass'])) {
//    $user_login = '';
//    for ($i = 0; $i < mb_strlen($_POST['login']); $i++) {
//        if ($i === 0 && $_POST['login'][0] === '+' && $_POST['login'][1] === '7') {
//            $user_login .= 8;
//            $i = 2;
//        }
//        if (is_int((int)$_POST['login'][$i])) {
//            $user_login .= $_POST['login'][$i];
//        }
//    }
//    $credentials = array(
//        'user_login' => $_POST['login'],
//        'user_password' => $_POST['pass'],
//        'remember' => true,
//    );
//    $secure_cookie = '';
//    $user = wp_signon($credentials);
//    if (is_wp_error($user)) {
//    } else {
//        wp_redirect(home_url() . '/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/', 302);
//        exit;
//    }
//}
//?>
<!--    <!DOCTYPE html>-->
<!--    <html --><?php //language_attributes(); ?><!-->-->
<!--    <head>-->
<!--        <meta charset="--><?php //bloginfo('charset'); ?><!--">-->
<!--        <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--        <link rel="profile" href="https://gmpg.org/xfn/11">-->
<!--        --><?php
//        wp_site_icon();
//        wp_head();
//        wp_enqueue_style('photopositive-projects', get_template_directory_uri() . '/assets/style/projects.css', array(), _S_VERSION);
//        ?>
<!--    </head>-->
<!--    <body --><?php //body_class(); ?><!-->-->
<!--    <header class="gallery-header">-->
<!--        <div class="gallery-header-opacity">-->
<!--            <div class="header-flex container">-->
<!--                <div class="navigation-line step-0">-->
<!--                    <div class="navigation-line step-1">-->
<!--                        <div class="navigation-line step-2"></div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <a class="" href="https://pv-foto.ru/">Фотопозитив</a>-->
<!--                <div class="header-logo-splitter"></div>-->
<!--                <a href="http://peresvet-group.com/" target="_blank">-->
<!--                    <img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/image/logo.png" alt="logo">-->
<!--                </a>-->
<!--                <div class="header-flex__links">-->
<!--                    <a class="link-join" href="https://pv-foto.ru/#forms">Принять участие</a>-->
<!--                    <a class="" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Смотреть фото</a>-->
<!--                    <a class="active"-->
<!--                       href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>-->
<!--                </div>-->
<!--                <div class="header-flex__login">-->
<!--                    --><?php //if (!is_user_logged_in()) : ?>
<!--                        <a href="#" class="button-login">Войти</a>-->
<!--                        <a href="#" class="button-registration">Принять участие</a>-->
<!--                    --><?php //else: ?>
<!--                        <div class="">-->
<!--                            --><?php
//                            if (is_user_logged_in()) {
//                                $avatar = get_avatar_url(get_current_user_id());
//                                echo "<a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'><img src='" . $avatar . "' alt='avatar'></a>";
//                            } else {
//                                echo "<a href='https://pv-foto.ru/#forms'><i class='fas fa-user'></i></a>";
//                            }
//                            ?>
<!--                        </div>-->
<!--                        --><?php
//                        if (is_user_logged_in()) {
//                            $user_data = get_userdata(get_current_user_id());
//                            $username = $user_data->get('display_name');
//                            echo "<a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'>" . $username . "</a>";
//                        } else {
//                            echo "<a href='https://pv-foto.ru/#forms'>Логин</a>";
//                        }
//                        ?>
<!--                    --><?php //endif; ?>
<!--                </div>-->
<!--                <div class="header-flex__burger">-->
<!--                    <i class="fas fa-align-justify"></i>-->
<!--                    <div class="burger-menu d-none">-->
<!--                        --><?php
//                        if (is_user_logged_in()) {
//                            echo "<div class=''><a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'>Личный кабинет</a></div>";
//                        } else {
//                            echo "<div class=''><a href='https://pv-foto.ru/#forms'>Войти</a></div>";
//                        }
//                        ?>
<!--                        <div class="active"><a href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>-->
<!--                        </div>-->
<!--                        <div class=""><a-->
<!--                                    href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>-->
<!--                        </div>-->
<!--                        --><?php
//                        if (is_user_logged_in()) {
//                            echo '<div class=""><a href="';
//                            echo wp_logout_url('https://pv-foto.ru/');
//                            echo '">Выход</a></div>';
//                        } else {
//                            echo "<div class=''><a href='https://pv-foto.ru/#forms'>Принять участие</a></div>";
//                        }
//                        ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </header>-->

    <main class="main-projects">

        <h1>Наши победители</h1>

        <div class="navi-container flex-start">
            <div class="navigation-line step-3">
                <div class="navigation-line step-4"></div>
            </div>
        </div>

        <div class="main-projects__flex">
            <?php
            $cat_args = array(
                'orderby' => 'ID',
                'number' => NULL,
                'taxonomy' => 'category',
                'hide_title_if_empty' => false,
                'title_li' => '',
                'style' => '',
            );
            $categories = get_categories($cat_args);
            // print_r($categories);
            foreach ($categories as $cat) {
                $args = array(
                    'numberposts' => 1,
                    'category' => $cat->cat_ID,
                    'tag' => 'winner',
                    'suppress_filters' => true,
                );
                $posts = get_posts($args);
                foreach ($posts as $post) {
                    ?>
                    <div class="card">
                        <div class="card__image">
                            <a href="<?php echo get_category_link($cat->term_id); ?>">
                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="image">
                                <div class="card__comment">
                                    <p></p>
                                </div>
                            </a>
                        </div>
                        <div class="card__info">
                            <div class="">
                                <p><?php echo $cat->name; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

        </div>

        <div class="navi-container flex-end">
            <div class="navigation-line step-5 line-5-project">
                <div class="navigation-line step-6"></div>
            </div>
        </div>
    </main>

    <div class="join">
        <div class="join__content">
            <?php
            if (is_user_logged_in()) {
                echo "<form action='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/' method='post' id='go-to-add-foto'></form>";
                echo "<button type='submit' name='go-to-add-foto' form='go-to-add-foto' value='3'>Добавить работу</button>";
            } else {
                echo "<div class='button show-join-pop'>Принять участие</div>";
            }
            ?>
        </div>
    </div>

<?php
/** get_sidebar(); */
get_footer();