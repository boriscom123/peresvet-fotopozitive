<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photopositive
 */

/** get_header(); */
?>
<?php
/*
// обрабатываем нажатие лайков
if (isset($_POST['user_id'])) {
  // все значения только цифровые
  $like_user_id = $_POST['user_id'];
  if(is_numeric($like_user_id)) {
    if(isset($_POST['dislike'])) {
      $dislike_post_id = $_POST['dislike'];
      if(is_numeric($dislike_post_id)) {
        $dislikes = $wpdb->query("DELETE FROM wp_foto_likes WHERE post_id=$dislike_post_id AND user_id=$like_user_id");
      }
    }
    if(isset($_POST['like'])) {
      $like_post_id = $_POST['like'];
      if(is_numeric($like_post_id)) {
        // проверяем наличие такой записи в БД и если нет - добавляем
        $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$like_post_id AND user_id=$like_user_id");
        if($user_like[0]->user_like === '0') {
          $table = 'wp_likes';
          $data = array("user_id" => $like_user_id, "post_id" => $like_post_id);
          $format = array("%d", "%d");
          $likes = $wpdb->insert($table, $data, $format);
        }
      }
    }
  }
}
*/
// проверка перехода с формы логина или регистрации

// форма логина
if(isset($_POST['login-submit']) && isset($_POST['login']) && isset($_POST['pass'])) {
	// print_r($_POST);
	$user_login = '';
	for( $i =0; $i < mb_strlen($_POST['login']); $i++) {
		if( $i === 0 && $_POST['login'][0] === '+' && $_POST['login'][1] === '7') { $user_login .= 8; $i = 2; }
		if( is_int((int)$_POST['login'][$i]) ) { $user_login .= $_POST['login'][$i]; }
	}
	// echo $user_login;
	$credentials = array(
				'user_login'    => $user_login,
				'user_password' => $_POST['pass'],
				'remember'      => true,
				);
	$secure_cookie = '';
	$user = wp_signon( $credentials);
	if ( is_wp_error($user) ) {
	// echo 'Не зашли';
  // echo $user->get_error_message();
 } else {
	 // echo 'Успешно зашли';
	 wp_redirect( 'https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/', 302 );
	 exit;
 }
}


// форма регистрации
// if(isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['u-tel'])) {
// 	// echo "Регистрируем пользователя";
// 	if($_POST['pass2'] === $_POST['pass2']) {
// 		if($_POST['reg-code'] == $_SESSION['reg-code']) {
// 			$userdata = array(
// 				'user_login' => $_POST['u-tel'],
// 				'user_pass'  => $_POST['pass2'],
// 				// 'user_email' => $_POST['u-tel'].'@mail.ru',
// 				'display_name'    => '*'.substr($_POST['u-tel'], -4),
// 				// 'last_name'       => $_POST['u-tel'],
// 				'nickname'        => '*'.substr($_POST['u-tel'], -4),
// 			);
// 			$user_id = wp_insert_user( $userdata ) ;
// 			if( ! is_wp_error( $user_id ) ) {
// 				// логинем пользователя после регистрации
// 				$credentials = array(
// 							'user_login'    => $_POST['u-tel'],
// 							'user_password' => $_POST['pass2'],
// 							'remember'      => true,
// 							);
// 				$secure_cookie = '';
// 				$user = wp_signon( $credentials);
// 					if ( is_wp_error($user) ) {
// 					} else {
// 					 // не забываем добавить номер телефона
// 					 $current_user_id = $user_id;
// 					 $user_tel = preg_replace('/\D/', '', $_POST['u-tel']);
// 					 if($user_tel[0] == 8){
// 						$user_tel = '7'.substr($user_tel, 1);
// 					 }elseif($user_tel[0] == 9){
// 						$user_tel = '7'.$user_tel;
// 					 }
// 					 wp_update_user( [ 'ID' => $current_user_id, 'description' => $user_tel] );
// 					 // и отправить запрос на добавление новой сделки в амо срм
// 					 // интеграция amoCRM
// 					 if(!file_exists('amointegrationapi.json')){
// 							// echo "Делаем новую интеграцию";
// 							include 'amocrm.php';
// 						 } else {
// 							// echo "Используем имеющийся токен";
// 							$token = explode("/",file_get_contents("amointegrationapi.json"));
// 							if(json_decode($token[1], true)['until'] < $_SERVER['REQUEST_TIME']){
// 								// echo "Токен просрочен";
// 								include 'amocrmrefresh.php';
// 								// echo "Токен обновлен";
// 							}
// 							// $access_token = json_decode($token[0], true)['access_token'];
// 							echo "Отправляем в Амо";
// 							// include 'addcontact.php';
// 							// echo "Добавление прошло";
// 						}
// 					echo "редирект на страницу личного кабинета";
// 					// wp_redirect( 'https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/', 302 );
// 					exit;
// 					}
// 				// return true;
// 			} else {
// 				// return $user_id->get_error_message();
// 			}
// 		}
// 	}
// }
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
            <a class="active" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>
            <a class="" href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
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
              <div class="active"><a href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a></div>
              <div class=""><a href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a></div>
              <?php
              if( is_user_logged_in() ) {
				        echo '<div class=""><a href="'; echo wp_logout_url('https://pv-foto.ru/'); echo '">Выход</a></div>';
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
      <h1>Лидеры</h1>
      <div class="navi-container flex-start">
        <div class="navigation-line step-3"><div class="navigation-line step-4"></div></div>
      </div>
      <div class="main-leaders__flex">
				<?php
				// формирование запроса для вывода списка ПОБЕДИТЕЛЕЙ
        // формируем список лидеров
        // делаем запрос к постам - все посты
        // выбираем текущаю категорию (текущий конкурс)
        $cat = get_categories(array(
                  'orderby' => 'term_id', // сортируем по ID
                  'order' => 'DESC', // направление получения данных
                  'hide_empty' => '0', // показывать пустые
                  'number' => '1', // количество необходимых категорий
                  ));
        //print_r($cat);
        //echo "<br>";
        //echo $cat['0']->term_id;
        //echo "<br>";
        //$test_all_posts = get_posts();
        //print_r($test_all_posts);
        //echo "<br>";
        $all_posts = get_posts(array(
                  'category' => $cat['0']->term_id, // вывод постов только из текущей категории (текущего конкурса)
                  'numberposts' => -1, // снимаем ограничения на показ постов
                  ));
        //print_r($all_posts);
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
							<?php
							if( is_user_logged_in() ) {
								echo '<div class="card__info change-heart">';
							} else {
								echo '<div class="card__info">';
							}
							?>
              <!-- <div class="card__info"> -->
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
                echo '<a class="number">#'.$post_id.'</a>';
                if( is_user_logged_in() ) {
                  // если пользователь залогинен - есть возможность поставить лайк
                  if($user_like[0]->user_like === '0') {
                    ?>
                      <div class="">
                        <form class="" action="" method="post">
                          <button class="d-none" type="submit" name="like" value="<?php echo $post_id; ?>"><i class="fas fa-heart"></i></button>
                          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                          <button type="submit" name="like"><i class="far fa-heart"></i></button>
                        </form>
                      </div>
                    <?php
                    } else {
                    ?>
                     <div class="">
                       <form class="" action="" method="post">
                         <button class="d-none" type="submit" name="dislike" value="<?php echo $post_id; ?>"><i class="far fa-heart"></i></button>
                         <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                         <button type="submit" name="dislike"><i class="fas fa-heart"></i></button>
                       </form>
                     </div>
                     <?php
                   }
                 } else {
                   // пользователь не залогинен - при нажатии на сердечко показываем окно регистрации
                   ?>
                     <div class="">
                       <div class="join-pop" data-id="<?php echo $post_id; ?>">
                         <button class="d-none" type="submit" name="like" value=""><i class="fas fa-heart"></i></button>
                         <button type="button" name="like"><i class="far fa-heart"></i></button>
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

      <div class="navi-container flex-end">
        <div class="navigation-line step-5 line-5-gallery"><div class="navigation-line step-6"></div></div>
      </div>
    </main>

    <div class="bunner-left" onclick="ym(73524736, 'reachGoal', 'baner'); return true;">
  		<div class="bunner-left-content">
  			<?php
  			$page_title = 'Баннер Слева';
  			$bunner_left = get_page_by_title( $page_title );
  			//print_r($left_bunner);
  			$bunner_left_link = strstr(strstr($bunner_left->post_content, 'http'), '">', true);
  			$bunner_left_image = get_the_post_thumbnail_url($bunner_left, 'full');
  			//print_r($left_bunner_image);
  			//echo $left_bunner_link;
  			?>
  			<a href="<?php echo $bunner_left_link; ?>"><img src="<?php echo $bunner_left_image; ?>" alt="bunner"></a>
  		</div>
  		<div class="bunner-left-mini-content">
  			<?php
  			$page_title = 'Баннер Слева Мини';
  			$bunner_left_mini = get_page_by_title( $page_title );
  			//print_r($left_bunner);
  			$bunner_left_mini_link = strstr(strstr($bunner_left_mini->post_content, 'http'), '">', true);
  			$bunner_left_mini_image = get_the_post_thumbnail_url($bunner_left_mini, 'full');
  			//print_r($left_bunner_image);
  			//echo $left_bunner_link;
  			?>
  			<a href="<?php echo $bunner_left_mini_link; ?>" target="_blank" class=""><img src="<?php echo $bunner_left_mini_image; ?>" alt="bunner"></a>
  		</div>
  	</div>

  	<div class="bunner-right d-none">
  		<div class="bunner-right-content">
  			<?php
  			$page_title = 'Баннер Справа';
  			$bunner_right = get_page_by_title( $page_title );
  			//print_r($left_bunner);
  			$bunner_right_link = strstr(strstr($bunner_right->post_content, 'http'), '">', true);
  			$bunner_right_image = get_the_post_thumbnail_url($bunner_right, 'full');
  			//print_r($left_bunner_image);
  			//echo $left_bunner_link;
  			?>
  			<a href="<?php echo $bunner_right_link; ?>" target="_blank"><img src="<?php echo $bunner_right_image; ?>" alt="bunner"></a>
  		</div>
  		<div class="bunner-right-mini-content">
  			<?php
  			$page_title = 'Баннер Справа Мини';
  			$bunner_right_mini = get_page_by_title( $page_title );
  			//print_r($left_bunner);
  			$bunner_right_mini_link = strstr(strstr($bunner_right_mini->post_content, 'http'), '">', true);
  			$bunner_right_mini_image = get_the_post_thumbnail_url($bunner_right_mini, 'full');
  			//print_r($left_bunner_image);
  			//echo $left_bunner_link;
  			?>
  			<a href="<?php echo $bunner_right_mini_link; ?>" target="_blank" class=""><img src="<?php echo $bunner_right_mini_image; ?>" alt="bunner"></a>
  		</div>
  	</div>

    <div class="choose-leader">
      <h2>Выбирайте победителя</h2>
      <div class="choose-leader__select">
        <p>Сортировка</p>
        <?php
        // обрабоатываем запрос сортировки
        if(isset($_GET['options'])) {
          $sort_by = $_GET['options'];
        }
        if(isset($_GET['direction'])) {
          if($_GET['direction'] == 'up') {
            $sort_direction = 'ASC';
          }
          if($_GET['direction'] == 'down') {
            $sort_direction = 'DESC';
          }
        }
        ?>
        <form class="gal-options" action="#" method="get">
          <input type="radio" name="direction" value="up" id="up" <?php if(!isset($sort_direction)){echo "checked";} if(isset($sort_direction) && $sort_direction == 'ASC') {echo "checked";} ?> >
          <div class="">
            <label for="down"><i class="far fa-caret-square-down"></i></label>
          </div>
          <input type="radio" name="direction" value="down" id="down" <?php if(isset($sort_direction) && $sort_direction == 'DESC') { echo "checked";} ?> >
          <div class="">
            <label for="up"><i class="far fa-caret-square-up"></i></label>
          </div>
          <select class="select-option" name="options">
            <option value="date"<?php if(!isset($sort_by)){echo " selected";} if(isset($sort_by) && $sort_by == 'date') {echo " selected";} ?> >по Дате</option>
            <option value="like"<?php if(isset($sort_by) && $sort_by == 'like') {echo " selected";} ?> >по Лайкам</option>
            <option value="random" <?php if(isset($sort_by) && $sort_by == 'random') {echo " selected";} ?> >Случайная</option>
          </select>
        </form>
      </div>
      <div class="navi-container flex-start">
        <div class="navigation-line step-7 line-7-gallery"><div class="navigation-line step-8"></div></div>
        <div class="navi-container line-steps"></div>
      </div>

      <div class="choose-leader__content">

				<?php
				// выводим список ВЫБОРА ПОБЕДИТЕЛЯ
        // согласно сортировке (по умолчанию по дате добавления от ближайшей до давней)
        // необходимо добавить сортировку по дате, количеству лайков, и случайная
				global $wpdb, $post;
        if(isset($sort_by)) { //
          if($sort_by == 'date') { // сортировка по дате
            //echo "Сортиовка по дате";
            if(isset($sort_direction)) {
              if($sort_direction == 'ASC') {
                //echo "Сортиовка по дате + по возрастанию";
                // $result = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC");
                $result = get_posts(array(
                          'category' => $cat['0']->term_id, // вывод постов только из текущей категории (текущего конкурса)
                          'orderby'     => 'date',
	                         'order'       => 'ASC',
                           'numberposts' => -1, // снимаем ограничения на показ постов
                          ));
              }
              if($sort_direction == 'DESC') {
                //echo "Сортиовка по дате + по убыванию";
                // $result = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date ASC");
                $result = get_posts(array(
                          'category' => $cat['0']->term_id, // вывод постов только из текущей категории (текущего конкурса)
                          'orderby'     => 'date',
                           'order'       => 'DESC',
                           'numberposts' => -1, // снимаем ограничения на показ постов
                          ));
              }
            }
          }
          if($sort_by == 'like') { // сортировка по лайкам
            // echo "Сортировка по лайкам";
            if(isset($sort_direction)) {
              $leaders_limit = 50;
              foreach ($all_posts as $l_post) {
                // echo 'Пост'.$post->ID; // По ID поста считаем лайки
                $post_likes = $wpdb->get_results("SELECT COUNT(id) as likes FROM wp_foto_likes WHERE post_id=$l_post->ID");
                //echo 'Лайков'.$post_likes['0']->post_likes;
                $sort_posts_likes[$l_post->ID] = $post_likes['0']->likes;
                // print_r($sort_posts_likes);
              }
              if($sort_direction == 'DESC') {
                // echo "Сортиовка по лайкам + по возрастанию";
                // print_r($sort_posts_likes);
                asort($sort_posts_likes);
                // print_r($sort_posts_likes);
                $id_posts_like = '';
                foreach ($sort_posts_likes as $key => $value){
                  $id_posts_like .= $key.',';
                  $leaders_limit--;
                  if($leaders_limit == 0) {break;}
                }
                //$id_posts_like = implode(',', $sort_posts_likes);
                $id_posts_like = substr($id_posts_like, 0, -1);
                //echo $id_posts_like;
                $result = get_posts(array('include' => $id_posts_like, 'orderby' => 'post__in',));
                //print_r($result);
              }
              if($sort_direction == 'ASC') {
                // echo "Сортиовка по лайкам + по убыванию";
                // print_r($sort_posts_likes);
                arsort($sort_posts_likes);
                // print_r($sort_posts_likes);
                $id_posts_like = '';
                foreach ($sort_posts_likes as $key => $value){
                  $id_posts_like .= $key.',';
                  $leaders_limit--;
                  if($leaders_limit == 0) {break;}
                }
                //$id_posts_like = implode(',', $sort_posts_likes);
                $id_posts_like = substr($id_posts_like, 0, -1);
                //echo $id_posts_like;
                $result = get_posts(array('include' => $id_posts_like, 'orderby' => 'post__in',));
                //print_r($result);
              }
            }
          }
          if($sort_by == 'random') { // сортировка произвольная
            // echo "Сортиовка произвольная";
            // $result = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY RAND()");
            $result = get_posts(array(
                      'category' => $cat['0']->term_id, // вывод постов только из текущей категории (текущего конкурса)
                      'orderby'     => 'rand', // произвольная сортировка
                       'order'       => 'ASC',
                       'numberposts' => -1, // снимаем ограничения на показ постов
                      ));

          }
        } else {
          //echo "Сортиовка не задана";
          //$result = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC");
          //print_r($result);
          $result = get_posts(array(
                    'category' => $cat['0']->term_id, // вывод постов только из текущей категории (текущего конкурса)
                    'orderby'     => 'rand', // произвольная сортировка
                     'order'       => 'DESC',
                     'numberposts' => -1, // снимаем ограничения на показ постов
                    ));
        }


				$limit = 50; // лимит количества для отображения
				foreach($result as $post){
					// setup_postdata($post);
					// print_r($post);
					// the_permalink();
					// the_title();
					// the_content();
					?>

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
						if( is_user_logged_in() ) {
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
              echo '<a class="number">#'.$post_id.'</a>';
              if( is_user_logged_in() ) {
                // если пользователь залогинен - есть возможность поставить лайк
                if($user_like[0]->user_like === '0') {
                ?>
                  <div class="">
                    <form class="" action="" method="post">
                      <button class="d-none" type="submit" name="like" value="<?php echo $post_id; ?>"><i class="fas fa-heart"></i></button>
                      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                      <button type="submit" name="like"><i class="far fa-heart"></i></button>
                    </form>
                  </div>
                <?php
                } else {
                ?>
                 <div class="">
                   <form class="" action="" method="post">
                     <button class="d-none" type="submit" name="dislike"value="<?php echo $post_id; ?>"><i class="far fa-heart"></i></button>
                     <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                     <button type="submit" name="dislike"><i class="fas fa-heart"></i></button>
                   </form>
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
					if ($limit == 0) { break; }
				}
				// wp_reset_postdata(); // сброс запроса к постам
				?>

      </div>

    </div>

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
  					<a class="circle" href="<?php echo $instagram; ?>" onclick="ym(73524736, 'reachGoal', 'insta'); return true;"><i class="fab fa-instagram"></i></a>
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
      <div class="footer-madeby">
        <p>Создание и поддержка ресурса: <a href="https://github.com/boriscom123">#bynextpr</a></p>
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
                <input id="input-reg-tel" type="text" name="login" value="" placeholder="8 913 504 47 02" required>
              </div>
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
      				<div class="" title="Используйте латинские буквы или цифры"><input  id="input-login-tel" type="text" name="login" value="" placeholder="Логин - номер телефона" pattern="^[0-9A-Za-z\+\-\(\)]+$" required></div>
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
    <?php
      // wp_enqueue_script( 'photopositive-script', get_template_directory_uri() . '/assets/script/gallery.js', array(), _S_VERSION, true );
      // wp_enqueue_script( 'photopositive-index-line', get_template_directory_uri() . '/assets/script/gallery-line.js', array(), _S_VERSION, true );
      wp_footer();
    ?>
  </body>
</html>

<?php
/** get_sidebar(); */
/* get_footer(); */
