<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photopositive
 */

/* get_header(); */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
  	<meta charset="<?php bloginfo( 'charset' ); ?>">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="profile" href="https://gmpg.org/xfn/11">
  	<?php
      wp_site_icon();
      wp_head();
      wp_enqueue_style( 'photopositive-gallery', get_template_directory_uri().'/assets/style/gallery.css', array(), _S_VERSION );
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
            <a class="active" href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
          </div>
          <a href="http://peresvet-group.com/"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo.png" alt="logo"></a>
          <div class="header-flex__login">
            <div class="">
              <?php
  						if( is_user_logged_in() ) {
  							$avatar = get_avatar_url( get_current_user_id() );
  							echo "<a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'><img src='".$avatar."' alt='avatar'></a>";
  						} else {
  							echo "<a href='https://pv-foto.ru/#forms'><i class='fas fa-user'></i></a>";
  						}
  						?>
            </div>
            <?php
            if( is_user_logged_in() ) {
              $user_data = get_userdata( get_current_user_id() );
              $username = $user_data->get('display_name');
              echo "<a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'>".$username."</a>";
            } else {
              echo "<a href='https://pv-foto.ru/#forms'>Логин</a>";
            }
            ?>
          </div>
          <div class="header-flex__burger">
            <i class="fas fa-align-justify"></i>
            <div class="burger-menu d-none">
              <?php
  						if( is_user_logged_in() ) {
  							echo "<div class=''><a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'>Личный кабинет</a></div>";
  						} else {
  							echo "<div class=''><a href='https://pv-foto.ru/#forms'>Войти</a></div>";
  						}
  						?>
              <div class=""><a href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a></div>
              <div class="active"><a href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a></div>
              <?php
              if( is_user_logged_in() ) {
              } else {
                echo "<div class=''><a href='https://pv-foto.ru/#forms'>Принять участие</a></div>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main class="main-leaders">
			<?php $cat = get_the_category(); ?>
      <h1><?php echo $cat['0']->name; ?></h1>
      <div class="navi-container flex-start">
        <div class="navigation-line step-3"><div class="navigation-line step-4"></div></div>
        <div class="navi-container line-steps"></div>
      </div>
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
        if(empty($posts_likes)) {
          echo "В настоящий момент нет работ для отображения";
        } else {
          // print_r($posts_likes);
          // сортируем по значанию (количеству лайков)
          arsort($posts_likes);
          // print_r($posts_likes);
          $leaders_limit = 10; // предел списка лидеров
          foreach ($posts_likes as $key => $value) {
            // echo 'ID поста'.$key;
            $post = get_post( $key );
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
                if( is_user_logged_in() ) {
                  // если пользователь залогинен - есть возможность поставить лайк
                  if($user_like[0]->user_like === '0') {
                    ?>
                      <div class="">
                        <div class="">
                          <button class="d-none" type="submit" name="like" value="<?php echo $post_id; ?>"><i class="fas fa-heart"></i></button>
                          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                          <button type="submit" name="like"><i class="far fa-heart"></i></button>
                        </div>
                      </div>
                    <?php
                    } else {
                    ?>
                     <div class="">
                       <div class="">
                         <button class="d-none" type="submit" name="dislike" value="<?php echo $post_id; ?>"><i class="far fa-heart"></i></button>
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
                         <button class="d-none join-pop" type="submit" name="like" value=""><i class="fas fa-heart"></i></button>
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
             if($leaders_limit == 0) {break;}
     				}
        }


   				?>

         </div>

    </main>

    <div class="join">
      <div class="join__content">
        <?php
          // если пользователь залогинен - отправляем на страницу загрузка фотографии
          if ( is_user_logged_in() ) { // проверяем зарегистринованный это пользователь или нет
            echo "<form action='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/' method='post' id='go-to-add-foto'></form>";
            echo "<button type='submit' name='go-to-add-foto' form='go-to-add-foto' value='3'>Добавить работу</button>";
          } else {
            echo "<div class='button show-join-pop'>Принять участие</div>";
          }
        ?>
        <!--<button type="button" name="button">Принять участие</button>-->
        <div class="navigation-line join__step-1"></div>
        <div class="navigation-line join__step-2"></div>
        <div class="navigation-line join__step-3"></div>
      </div>
    </div>

    <footer class="footer">
      <div class="footer-flex">
        <div class="">
          <h2>Проект Фотопозитив</h2>
          <a class="active" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>
          <a class="" href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
          <a class="" href="https://pv-foto.ru/#forms">Войти</a>
          <h3><a class="open-rules" href="<?php echo get_template_directory_uri(); ?>/rules.pdf">Правила участия</a></h3>
        </div>
        <div class="text-right">
  				<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo.png" alt="logo"></a>
  				<p>Мы в соцсетях:</p>
  				<div class="">
  					<?php
  						$page_title = 'facebook';
  						$vk_page = get_page_by_title( $page_title);
  						$facebook = strstr(strstr($vk_page->post_content, 'http'), '">', true);
  						?>
  					<a class="circle" href="<?php echo $facebook; ?>"><i class="fab fa-facebook-f"></i></a>
  					<?php
  						$page_title = 'vk';
  						$vk_page = get_page_by_title( $page_title);
  						$vk = strstr(strstr($vk_page->post_content, 'http'), '">', true);
  						?>
  					<a class="circle" href="<?php echo $vk; ?>"><i class="fab fa-vk"></i></a>
  					<?php
  						$page_title = 'instagram';
  						$insta_page = get_page_by_title( $page_title);
  						$instagram = strstr(strstr($insta_page->post_content, 'http'), '">', true);
  						?>
  					<a class="circle" href="<?php echo $instagram; ?>"><i class="fab fa-instagram"></i></a>
  				</div>
  				<?php
  					$page_title = 'tel';
  					$tel_page = get_page_by_title( $page_title);
  					// print_r($tel_page);
  					$tel = substr(strstr(strstr($tel_page->post_content, '</p>', true), '<p>'), 3);
  					// echo strstr(strstr($insta_page->post_content, 'http'), '">', true);
  					?>
  				<a class="footer-link__tel" href="tel:<?php echo str_replace(' ', '', $tel); ?>"><?php echo $tel; ?></a>
  				<?php
  					$page_title = 'email';
  					$email_page = get_page_by_title( $page_title);
  					// print_r($email_page);
  					$email = substr(strstr(strstr($email_page->post_content, '</p>', true), '<p>'), 3);
  				?>
  				<a class="footer-link__email" href="mailto:<?php echo $email; ?>?subject=Обращение-с-сайта-Фотопозитив"><?php echo $email; ?></a>
  			</div>
      </div>
    </footer>

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
              <h2>Для регистрации введите номер телефона российского оператора</h2>
              <h3></h3>
              <div class="form__reg_login" title="Используйте только цифры">
                <input id="input-reg-tel" type="text" name="login" value="" placeholder="8 913 504 47 02" required></div>
              <!-- <h3>Введите Ф.И.О.</h3>
              <div class="form__reg_name" title="Используйте русские буквы"><input type="text" name="last-name" value="" placeholder="ФИО (ru)" pattern="^[А-Яа-яЁё\s]+$" required></div> -->
              <p>Регистрируясь, вы соглашаетесь с</p>
              <a href="<?php echo get_template_directory_uri(); ?>/privacy.pdf" target="_blank">Политикой обработки персональных данных</a>
              <h6>
                После нажатия на кнопку на указанный Вами номер телефона поступит смс с паролем для подтверждения регистрации.
              </h6>
              <?php
                // если пользователь залогинен - отправляем на страницу загрузка фотографии
                if ( is_user_logged_in() ) { // проверяем зарегистринованный это пользователь или нет
                  echo "<button type='submit' name='go-to-add-foto' form='go-to-add-foto' value='3'>Добавить работу</button>";
                } else {
                  echo '<button type="submit" name="reg-submit" id="reg-form-button" onclick="ym(73524736, \'reachGoal\', \'uchastie\'); return true;">Принять участие</button>';
                }
              ?>
            </form>
            <form class="form__login" action="" method="post">
              <h2>Уже зарегистрированы?</h2>
              <div class="" title="Используйте латинские буквы или цифры"><input type="text" name="login" value="" placeholder="Логин - номер телефона" pattern="^[0-9A-Za-z\+\-\(\)]+$" required></div>
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
            <input id="input-foget-tel" type="text" name="tel" value="" placeholder="Введите номер телефона" required>
            <button type="button" name="foget-password-submit">Отправить</button>
          </form>
        </div>
      </div>

    </div>

    <?php wp_footer(); ?>
  </body>
</html>

<?php
/** get_sidebar(); */
/* get_footer(); */
