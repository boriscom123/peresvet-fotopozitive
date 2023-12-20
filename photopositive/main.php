<?php
/**
 * Template Name: ByNextPr - Обновленная главная страница
 *
 * @package Photopositive
 */

/** Подготовка данных для отображения в шаблоне */

get_header();
?>

    <div class="page-video">
        <div class="container">
            <?php
            $page_title = 'Видео на главной странице';
            $video_page = get_page_by_title($page_title);
            print_r($video_page->post_content);
            ?>
        </div>
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
            <a href="<?php echo $bunner_right_mini_link; ?>" target="_blank" class="">
                <img src="<?php echo $bunner_right_mini_image; ?>" alt="bunner">
            </a>
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
                <?php echo do_shortcode('[smartslider3 slider="4"]'); ?>
            </div>
        </div>
    </div>

    <div class="choose-leader">
        <h2>Выбирайте победителя</h2>

        <div class="images-list">

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
                    <div class="image-block">
                        <div class="image">
                            <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="image">
                            <div class="comment">
                                <a href="<?php echo get_post_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="info-block
                        <?php if (is_user_logged_in()) : ?>
                            change-heart
                        <?php endif; ?>
                    ">
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
                                        <button class="d-none" type="submit" name="like"
                                                value="<?php echo $post_id; ?>">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <button type="submit" name="like"><i class="far fa-heart"></i></button>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="">
                                    <div>
                                        <button class="d-none" type="submit" name="dislike"
                                                value="<?php echo $post_id; ?>">
                                            <i class="far fa-heart"></i>
                                        </button>
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
                                    <button class="d-none" type="submit" name="like" value="">
                                        <i class="fas fa-heart"></i>
                                    </button>
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