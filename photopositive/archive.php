<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photopositive
 */

get_header();
?>
    <main class="main-leaders">
        <?php $cat = get_the_category(); ?>
        <h1><?php echo $cat['0']->name; ?></h1>
        <div class="main-leaders__flex">
            <?php
            // формирование запроса для вывода постов текущей рубрики
            // выбираем текущаю категорию (текущий конкурс)
            $all_posts = get_posts(array(
                'category' => $cat['0']->term_id, // вывод постов только из текущей категории (текущего конкурса)
                'numberposts' => -1, // снимаем ограничения на показ постов
            ));
            // print_r($all_posts);
            foreach ($all_posts as $l_post) {
                //echo 'Пост'.$post->ID; // По ID поста считаем лайки
                $post_likes = $wpdb->get_results("SELECT COUNT(id) as likes FROM wp_foto_likes WHERE post_id=$l_post->ID");
                //echo 'Лайков'.$post_likes['0']->post_likes;
                $posts_likes[$l_post->ID] = $post_likes['0']->likes;
            }
            if (empty($posts_likes)) {
                echo "В настоящий момент нет работ для отображения";
            } else {
                // print_r($posts_likes);
                // сортируем по значанию (количеству лайков)
                arsort($posts_likes);
                // print_r($posts_likes);
                $leaders_limit = 10; // предел списка лидеров
                foreach ($posts_likes as $key => $value) {
                    // echo 'ID поста'.$key;
                    $post = get_post($key);
                    // print_r($leader_post);
                    // setup_postdata($post);
                    ?>
                    <div class="card d-none">
                        <div class="card__image">
                            <img src="<?php echo get_the_post_thumbnail_url($key); ?>" alt="image">
                            <div class="card__comment">
                                <a href="<?php echo get_post_permalink($key); ?>"><?php echo get_the_title($key); ?></a>
                            </div>
                        </div>
                        <div class="card__info">
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
                            if (is_user_logged_in()) {
                                // если пользователь залогинен - есть возможность поставить лайк
                                if ($user_like[0]->user_like === '0') {
                                    ?>
                                    <div class="">
                                        <div class="">
                                            <button class="d-none" type="submit" name="like"
                                                    value="<?php echo $post_id; ?>"><i class="fas fa-heart"></i>
                                            </button>
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <button type="submit" name="like"><i class="far fa-heart"></i></button>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="">
                                        <div class="">
                                            <button class="d-none" type="submit" name="dislike"
                                                    value="<?php echo $post_id; ?>"><i class="far fa-heart"></i>
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
                                    <div class="">
                                        <button class="d-none join-pop" type="submit" name="like" value=""><i
                                                    class="fas fa-heart"></i></button>
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
                    // wp_reset_postdata();
                    $leaders_limit--;
//                    if ($leaders_limit == 0) {
//                        break;
//                    }
                }
            }


            ?>

        </div>

    </main>

    <div class="join">
        <div class="join__content">
            <?php
            // если пользователь залогинен - отправляем на страницу загрузка фотографии
            if (is_user_logged_in()) { // проверяем зарегистринованный это пользователь или нет
                echo "<form action='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/' method='post' id='go-to-add-foto'></form>";
                echo "<button type='submit' name='go-to-add-foto' form='go-to-add-foto' value='3'>Добавить работу</button>";
            } else {
                echo "<div class='button show-join-pop'>Принять участие</div>";
            }
            ?>
        </div>
    </div>

<?php
get_footer();
