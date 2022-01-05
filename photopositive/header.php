<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photopositive
 */

?>
<?php
// session_start();
// print_r($_REQUEST, true);
// проверка перехода с формы логина или регистрации
// форма логина
if(isset($_POST['login-submit']) && isset($_POST['login']) && isset($_POST['pass'])) {
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
 } else {
	 // echo 'Успешно зашли';
	 // редирект на страницу личного кабинета
	 wp_redirect( 'https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/', 302 );
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
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_site_icon(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="main-header">
        <div class="d-none">
            <?php
                echo "Test";
                if(!file_exists('amointegrationapi.json')){
                // echo "Делаем новую интеграцию";
                include 'amocrm.php';
                }
                // проверка доступности аккаунта
                $token = explode("/",file_get_contents("amointegrationapi.json"));
                $access_token = json_decode($token[0], true)['access_token'];
                if(json_decode($token[1], true)['until'] < $_SERVER['REQUEST_TIME']){
                    // echo "Токен просрочен";
                    include 'amocrmrefresh.php';
                    // echo "Токен обновлен";
                }
                $token = explode("/",file_get_contents("amointegrationapi.json"));
                $access_token = json_decode($token[0], true)['access_token'];
                // echo $access_token;
                function check_account($subdomain, $access_token)
            {
                $link = 'https://' . $subdomain . '.amocrm.ru/api/v4/account'; //Формируем URL для запроса
                // echo $link;
                /** Формируем заголовки */
                $headers = [
                    'Authorization: Bearer ' . $access_token
                ];
                $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
                /** Устанавливаем необходимые опции для сеанса cURL  */
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($curl, CURLOPT_URL, $link);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
                $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
                $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                // print_r(json_decode($out, true));
                $code = (int)$code;
                // echo $code;
                $errors = [
                    400 => 'Bad request',
                    401 => 'Unauthorized',
                    403 => 'Forbidden',
                    404 => 'Not found',
                    500 => 'Internal server error',
                    502 => 'Bad gateway',
                    503 => 'Service unavailable',
                ];

                try {
                    /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
                    if ($code < 200 || $code > 204) {
                        // print $out;
                        throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
                    }
                } catch (\Exception $e) {
                    // print $out;
                    // die('Файл: amocrm-users check_account Строка: 44 Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
                }
                return json_decode($out, true);
            }
                $test_amo_account = check_account('zakirov', $access_token);
                // print_r($test_amo_account);
            ?>
        </div>
		<div class="main-header-bg-image">
			<?php
				// echo do_shortcode('[smartslider3 slider="3"]');
				$page_title = 'Фотопозитив';
				$main_header_bg = get_page_by_title( $page_title );
				$main_header_bg_image = get_the_post_thumbnail_url($main_header_bg, 'full');
				//print_r($left_bunner_image);
				//echo $left_bunner_link;
				echo "<img src='".$main_header_bg_image."' alt='bg'>";
			?>
		</div>
		<div class="main-header-opacity">
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
			<div class="header__video">
				<?php
					$page_title = 'Видео на главной странице';
					$video_page = get_page_by_title( $page_title );
					// $facebook = strstr(strstr($vk_page->post_content, 'http'), '">', true);
					print_r($video_page->post_content);
				?>
				<!-- <div class="">
					<i class="fas fa-play"></i>
				</div> -->
			</div>
			<!-- <h2 class="header__h2"><span>50 000</span>рублей</h2> -->
			<h2></h2>
			<div class="navi-container flex-start">
				<div class="navigation-line step-3"><div class="navigation-line step-4"></div></div>
			</div>
			<!-- <p class="header__p">за фотопозитив!</p> -->
			<p class="header__p"></p>
		</div>
	</header>
