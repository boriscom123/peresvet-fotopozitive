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
    // echo $user_login;
    $credentials = array(
        'user_login' => $user_login,
        'user_password' => $_POST['pass'],
        'remember' => true,
    );
    $secure_cookie = '';
    $user = wp_signon($credentials);
    if (is_wp_error($user)) {
        // echo 'Не зашли';
    } else {
        // echo 'Успешно зашли';
        // редирект на страницу личного кабинета
        wp_redirect('https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/', 302);
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
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_site_icon(); ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="main-header" id="line-start-block">
    <div class="d-none">
        <?php
        $amo_file = get_template_directory() . '/assets/amo_crm_integration/' . 'amo_crm_data.json';
        if (!file_exists($amo_file)) {
            echo 'Файл интеграции не найден' . PHP_EOL;
        } else {
            $amo_data = json_decode(file_get_contents($amo_file), true);
            include 'assets/amo_crm_integration/amo_functions.php';
            if ($amo_data['access_token'] === '') {
                echo 'Токен не найден. Необходимо обновить интеграцию';
                $result = get_access_token($amo_data);
                if ($result) {
                    file_put_contents($amo_file, json_encode($result, JSON_UNESCAPED_UNICODE));
                    echo 'Интеграция создана';
                    $amo_data = json_decode(file_get_contents($amo_file), true);
                }
            }
            /** Проверка необходимости обновления токена */
            if ($amo_data['access_token'] !== '' && $amo_data['until'] < $_SERVER['REQUEST_TIME']) {
                echo 'Необходимо обновить токен';
                $result = refresh_access_token($amo_data);
                if ($result) {
                    file_put_contents($amo_file, json_encode($result, JSON_UNESCAPED_UNICODE));
                    echo 'Токен обновлен';
                    $amo_data = json_decode(file_get_contents($amo_file), true);
                }
            }

            /** Проверка доступности аккаунта АМО СРМ */
//            $result = check_amo_account($amo_data);
        }
        ?>
    </div>
    <div class="main-header-bg-image">
        <?php
        // echo do_shortcode('[smartslider3 slider="3"]');
        $page_title = 'Фотопозитив';
        $main_header_bg = get_page_by_title($page_title);
        $main_header_bg_image = get_the_post_thumbnail_url($main_header_bg, 'full');
        //print_r($left_bunner_image);
        //echo $left_bunner_link;
        echo "<img src='" . $main_header_bg_image . "' alt='bg'>";
        ?>
    </div>
    <div class="main-header-opacity">
        <div class="header-flex">
            <div class="header-fixed">
                <div class="container">
                    <div class="header-logo">
                        <a class="logo-text" href="https://pv-foto.ru/">Фотопозитив</a>
                        <div class="header-logo-splitter"></div>
                        <a class="logo-image" href="http://peresvet-group.com/" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-image.svg"
                                 alt="logo">
                        </a>
                    </div>
                    <div class="header-nav">
                        <div class="link">
                            <a class="" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Смотреть
                                фото</a>
                            <div class="decoration"></div>
                        </div>
                        <div class="link">
                            <a class=""
                               href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
                            <div class="decoration"></div>
                        </div>
                    </div>
                    <div class="header-buttons">
                        <?php if (!is_user_logged_in()) : ?>
                            <div class="button-login">Войти</div>
                            <div class="button-registration">Принять участие</div>
                        <?php else: ?>
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
                                echo "<a href='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/'>" . $username . "</a>";
                            } else {
                                echo "<a href='https://pv-foto.ru/#forms'>Логин</a>";
                            }
                            ?>
                        <?php endif; ?>
                    </div>
                    <div class="header-burger">
                        <i class="fas fa-align-justify"></i>
                        <div class="burger-menu d-none">
                            <a class="logo-image" href="http://peresvet-group.com/" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-image.svg"
                                     alt="logo">
                            </a>
                            <div class="header-nav">
                                <div class="link">
                                    <a class="" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Смотреть
                                        фото</a>
                                    <div class="decoration"></div>
                                </div>
                                <div class="link">
                                    <a class=""
                                       href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
                                    <div class="decoration"></div>
                                </div>
                                <div class="link">
                                    <a class=""
                                       href="/личный-кабинет/">Личный кабинет</a>
                                    <div class="decoration"></div>
                                </div>
                            </div>
                            <?php if (is_user_logged_in()) : ?>
                                <div class="header-nav-exit">
                                    <a href="<?php echo wp_logout_url('https://pv-foto.ru/'); ?>">Выход</a>
                                    <div class="decoration"></div>
                                </div>
<!--                                --><?php
//                                echo '<div class=""><a href="';
//                                echo wp_logout_url('https://pv-foto.ru/');
//                                echo '">Выход</a></div>';
//                                ?>
                            <?php else : ?>
                                <div class="header-buttons">
                                    <a href="#" class="button-login">Войти</a>
                                    <a href="#" class="button-registration">Принять участие</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="line-box-block"></div>
</header>