<?php
/*
Template Name: ByNextPr - Projects
*/
?>
<?php
// проверка переходи с формы логина или регистрации
// форма логина
if(isset($_POST['login-submit']) && isset($_POST['login']) && isset($_POST['pass'])) {
	$user_login = '';
	for( $i =0; $i < mb_strlen($_POST['login']); $i++) {
		if( $i === 0 && $_POST['login'][0] === '+' && $_POST['login'][1] === '7') { $user_login .= 8; $i = 2; }
		if( is_int((int)$_POST['login'][$i]) ) { $user_login .= $_POST['login'][$i]; }
	}
	// echo $user_login;
	$credentials = array(
				'user_login'    => $_POST['login'],
				'user_password' => $_POST['pass'],
				'remember'      => true,
				);
	$secure_cookie = '';
	$user = wp_signon( $credentials);
	if ( is_wp_error($user) ) {
   // echo $user->get_error_message();
 } else {
	 wp_redirect( 'https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/', 302 );
	 exit;
 }
}
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
		  wp_enqueue_style( 'photopositive-projects', get_template_directory_uri().'/assets/style/projects.css', array(), _S_VERSION );
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

    <main class="main-projects">

      <h1>Наши победители</h1>

      <div class="navi-container flex-start">
        <div class="navigation-line step-3"><div class="navigation-line step-4"></div></div>
      </div>

      <div class="main-projects__flex">
        <?php
				// запрашиваем данные по проектам - сортируем по дате - ставим каринку победителя
				// формирование запроса для вывода списка проектов
        // получаем доступные категории
				$cat_args = array(
        	'orderby'            => 'ID', // сортировка по ID
        	'number'             => NULL, // максимальнок количество для отображения
        	'taxonomy'           => 'category',
        	'hide_title_if_empty' => false,
          'title_li' => '',
          'style' => '',
         );
         $categories = get_categories( $cat_args );
         // print_r($categories);
         foreach ($categories as $cat) {
           // print_r($cat);
           // по каждой рубрике(категории делаем запрос)
           $args = array(
              'numberposts' => 1, // получаем 1  пост из каждой категории
             	'category'    => $cat->cat_ID, // ID категории
              'tag'         => 'winner', // метка поста - как победитель
             	'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
           );
           $posts = get_posts( $args );
           foreach( $posts as $post ){
             // print_r($post); // получили победителя категории
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
                   <!--<a href="#">(Смотреть победителей)</a>-->
                 </div>
               </div>
             </div>
          <?php
           }
         }
        ?>

      </div>

      <div class="navi-container flex-end">
        <div class="navigation-line step-5 line-5-project"><div class="navigation-line step-6"></div></div>
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
          <a class="" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>
          <a class="active" href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
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
					<a class="footer-link__tel" href="tel:<?php echo $tel; ?>"><?php echo $tel; ?></a>
					<?php
						$page_title = 'email';
						$email_page = get_page_by_title( $page_title);
						// print_r($email_page);
						$email = substr(strstr(strstr($email_page->post_content, '</p>', true), '<p>'), 3);
					?>
					<a class="footer-link__email" href="mailto:<?php echo $email; ?>?subject=Обращение с сайта Фотопозитив"><?php echo $email; ?></a>
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

		<?php
			// wp_enqueue_script( 'photopositive-script', get_template_directory_uri() . '/assets/script/projects.js', array(), _S_VERSION, true );
			// wp_enqueue_script( 'photopositive-index-line', get_template_directory_uri() . '/assets/script/projects-line.js', array(), _S_VERSION, true );
			wp_footer();
		?>
  </body>
</html>

<?php
/** get_sidebar(); */
/** get_footer(); */
