<?php
/*
Template Name: ByNextPr - User Actions
*/
?>
<?php
// проверка перехода с сердечка для лайка или дизлайка
if (isset($_POST)) {
	// обрабатываем нажатие лайков
	if (isset($_POST['user_id'])) {
	  // все значения только цифровые
	  $like_user_id = $_POST['user_id'];
	  if(is_numeric($like_user_id)) {
	    if(isset($_POST['dislike'])) {
	      $dislike_post_id = $_POST['dislike'];
	      if(is_numeric($dislike_post_id)) {
	        $dislikes = $wpdb->query("DELETE FROM wp_foto_likes WHERE post_id=$dislike_post_id AND user_id=$like_user_id");
					echo "dislike";
					// print_r($_POST);
	      }
	    }
	    if(isset($_POST['like'])) {
	      $like_post_id = $_POST['like'];
	      if(is_numeric($like_post_id)) {
	        // проверяем наличие такой записи в БД и если нет - добавляем
	        $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$like_post_id AND user_id=$like_user_id");
	        if($user_like[0]->user_like === '0') {
	          $table = 'wp_foto_likes';
	          $data = array("user_id" => $like_user_id, "post_id" => $like_post_id);
	          $format = array("%d", "%d");
	          $likes = $wpdb->insert($table, $data, $format);
						echo "like";
						// print_r($_POST);
	        } else {
						// echo "already";
					}
	      }
	    }
	  }
		else {
			// echo 'Пользователь не залогинен';
		}
	}
	// проверка наличия указанного логина(телефона) в БД
	if(isset($_POST['tel'])) {
		// echo 'проверяем номер телефона '. $_POST['tel'] .' на присутствие в БД в файле user-actions.php';
		// значение телефна должно состоять только из цифр
		if(is_numeric($_POST['tel']) or strlen($_POST['tel']) > 11) {
			// echo 'номер телефона подходит: '.$_POST['tel'];
			$userlogin = $_POST['tel'];
			if ( username_exists( $userlogin ) ) {
				// логин - номер телефона занят
				// просим либо использовать другой номер либо войти под этим номером
				echo 'false';
			} else {
				// логин - номер телефона не занят
				// генерируем новый пароль для указанного номера телефона
				// подготавливаем номер телефона
				$user_tel = $_POST['tel'];
				if($user_tel[0] == 8){
				 $user_tel = '7'.substr($user_tel, 1);
				} elseif($user_tel[0] == 9){
				 $user_tel = '7'.$user_tel;
				}
				// генерируем простой пароль
				function gen_password($length = 6){
				$password = '';
				$arr = array(
					'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
					'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
					'1','2','3','4','5','6','7','8','9','0'
					);
					for ($i = 0; $i < $length; $i++) {
						$password .= $arr[random_int(0, count($arr) - 1)];
					}
					return $password;
				}
				$pass = gen_password();
				// высылаем сгенерированный пароль в смс
				require_once 'assets/ajax/sms.ru.php';
				$smsru = new SMSRU('7C452DB3-6DDA-D66B-F068-F1332632E48B'); // Ваш уникальный программный ключ, который можно получить на главной странице
				$data = new stdClass();
				$data->to = $user_tel;
				$data->text = $pass; // Текст сообщения
				$data->from = 'PERESVET'; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
				// $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
				// $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
				// $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
				// $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
				$sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

				if ($sms->status == "OK") { // Запрос выполнен успешно
					// echo $pass;
					// echo "Сообщение отправлено успешно. ";
					// echo "ID сообщения: $sms->sms_id. ";
					// echo "Ваш новый баланс: $sms->balance";
				} else {
					echo "Сообщение не отправлено. Телефон: ".$user_tel." Пароль: ".$pass;
					echo "Код ошибки: $sms->status_code. ";
					echo "Текст ошибки: $sms->status_text.";
				}
				// print_r($smsru);
				// echo $pass;
				// echo $user_tel;
				// создаем запись с указанным номером телефона и генерированным паролем
				$userdata = array(
					'user_login' => $_POST['tel'],
					'user_pass'  => $pass,
					'display_name'    => '*'.substr($_POST['tel'], -4),
					'nickname'        => '*'.substr($_POST['tel'], -4),
				);
				$user_id = wp_insert_user( $userdata ) ;
				if( ! is_wp_error( $user_id ) ) {
					// новый пользователь успешно добавлен
					// добавляем лайк к посту по ID поста и ID пользователя
					if(isset($_POST['post-id'])) {
			      $like_post_id = $_POST['post-id'];
			      if(is_numeric($like_post_id)) {
			        // проверяем наличие такой записи в БД и если нет - добавляем
			        $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$like_post_id AND user_id=$user_id");
			        if($user_like[0]->user_like === '0') {
			          $table = 'wp_foto_likes';
			          $data = array("user_id" => $user_id, "post_id" => $like_post_id);
			          $format = array("%d", "%d");
			          $likes = $wpdb->insert($table, $data, $format);
								// echo 'Лайкнули пост '.$like_post_id;
			        } else {
								// echo "already";
							}
			      }
			    }
					// отправляем запрос на добавление новой сделки в амо срм
					// интеграция amoCRM
					if(!file_exists('amointegrationapi.json')){
						 // echo "Делаем новую интеграцию";
						 include 'amocrm.php';
						} else {
						 // echo "Используем имеющийся токен";
						 $token = explode("/",file_get_contents("amointegrationapi.json"));
						 if(json_decode($token[1], true)['until'] < $_SERVER['REQUEST_TIME']){
							 // echo "Токен просрочен";
							 include 'amocrmrefresh.php';
							 // echo "Токен обновлен";
						 }
						 // $access_token = json_decode($token[0], true)['access_token'];
						 // echo "Отправляем в Амо";
						 include 'addcontact.php';
						 // echo "Добавление прошло";
					 }
					echo 'true';
				} else {
					// ошибка при добавлении нового пользователя
					return $user_id->get_error_message();
				}
			}
		} else {
			echo 'Используйте только цифры';
		}
		if(isset($_POST['u-pass'])){
			// echo 'Необходимо изменить пароль пользователа на: '.$_POST['u-pass'];
			$user = get_user_by('login', $_POST['tel']);
			// print_r($user);
			$userdata = [
				'ID'              => $user->ID,
				'user_pass'       => $_POST['u-pass'],
			];
			wp_update_user($userdata);
		}
	}
	// восстановление забытого пароля
	if(isset($_POST['reg-tel']) && isset($_POST['foget-password-submit'])) {
		// echo 'Восстановление забытого пароля';
		// значение телефна должно состоять только из цифр
		if(is_numeric($_POST['reg-tel'])) {
			// print_r($_POST);
			$userlogin = $_POST['reg-tel'];
			// проверяем наличие указанного номера в базе
			if ( username_exists( $userlogin ) )
			{
				// echo 'Такой номер телефона есть в базе';
				// генерируем новый пароль для входа
				// подготавливаем номер телефона
				$user_tel = $_POST['reg-tel'];
				if($user_tel[0] == 8){
				 $user_tel = '7'.substr($user_tel, 1);
				} elseif($user_tel[0] == 9){
				 $user_tel = '7'.$user_tel;
				}
				// генерируем простой пароль
				function gen_password($length = 6){
				$password = '';
				$arr = array(
					'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
					'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
					'1','2','3','4','5','6','7','8','9','0'
					);
					for ($i = 0; $i < $length; $i++) {
						$password .= $arr[random_int(0, count($arr) - 1)];
					}
					return $password;
				}
				$pass = gen_password();
				// высылаем сгенерированный пароль в смс
				require_once 'assets/ajax/sms.ru.php';
				$smsru = new SMSRU('7C452DB3-6DDA-D66B-F068-F1332632E48B'); // Ваш уникальный программный ключ, который можно получить на главной странице
				$data = new stdClass();
				$data->to = $user_tel;
				$data->text = $pass; // Текст сообщения
				$data->from = 'PERESVET'; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
				// $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
				// $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
				// $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
				// $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
				$sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

				if ($sms->status == "OK") { // Запрос выполнен успешно
					// echo $pass;
					// echo "Сообщение отправлено успешно. ";
					// echo "ID сообщения: $sms->sms_id. ";
					// echo "Ваш новый баланс: $sms->balance";
				} else {
					echo "Сообщение не отправлено. Телефон: ".$user_tel." Пароль: ".$pass;
					echo "Код ошибки: $sms->status_code. ";
					echo "Текст ошибки: $sms->status_text.";
				}
				// обновляем данные пользователя в БД
				$field = 'login';
				$value = $_POST['reg-tel'];
				$user = get_user_by( $field, $value );
				// print_r($user->ID);
				$current_user_id = $user->ID;
				wp_update_user( [ 'ID' => $current_user_id, 'user_pass' => $pass] );
				echo 'true';
			} else {
				// echo 'Такого номера телефона нет в базе';
				echo 'false';
			}
		}
	}
	// 	// подготавливаем номер телефона
	// 	$user_tel = $_POST['tel'];
	// 	if($user_tel[0] == 8){
	// 	 $user_tel = '7'.substr($user_tel, 1);
	// 	} elseif($user_tel[0] == 9){
	// 	 $user_tel = '7'.$user_tel;
	// 	}
	// 	// генерируем простой пароль
	// 	function gen_password($length = 6){
	// 	$password = '';
	// 	$arr = array(
	// 		'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
	// 		'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
	// 		'1','2','3','4','5','6','7','8','9','0'
	// 		);
	// 		for ($i = 0; $i < $length; $i++) {
	// 			$password .= $arr[random_int(0, count($arr) - 1)];
	// 		}
	// 		return $password;
	// 	}
	// 	$pass = gen_password();
	// 	require_once get_template_directory_uri().'/assets/ajax/sms.ru.php';
	//
	// 	$smsru = new SMSRU('7C452DB3-6DDA-D66B-F068-F1332632E48B'); // Ваш уникальный программный ключ, который можно получить на главной странице
	//
	// 	$data = new stdClass();
	// 	$data->to = $user_tel;
	// 	$data->text = $pass; // Текст сообщения
	// 	$data->from = 'PERESVET'; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
	// 	// $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
	// 	// $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
	// 	// $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
	// 	// $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
	// 	$sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную
	//
	// 	if ($sms->status == "OK") { // Запрос выполнен успешно
	// 		echo $pass;
	// 		// echo "Сообщение отправлено успешно. ";
	// 		// echo "ID сообщения: $sms->sms_id. ";
	// 		// echo "Ваш новый баланс: $sms->balance";
	// 	} else {
	// 		echo "Сообщение не отправлено. Телефон: ".$user_tel." Пароль: ".$pass;
	// 		echo "Код ошибки: $sms->status_code. ";
	// 		echo "Текст ошибки: $sms->status_text.";
	// 	}
	// 	// print_r($smsru);
	// 	// echo $pass;
	// 	// echo $user_tel;
	// }
	// проверка логина и пароля пользователя + логин пользователя
	// if(isset($_POST['login-pass']) && isset($_POST['login-tel'])){
	// 	echo 'Логинем пользователя: логин: '.$_POST['login-tel'].' пароль: '.$_POST['login-pass'];
	// 	$credentials = array(
	// 				'user_login'    => $_POST['login-tel'],
	// 				'user_password' => $_POST['login-pass'],
	// 				'remember'      => true,
	// 				);
	// 	$secure_cookie = '';
	// 	$user = wp_signon( $credentials);
	// 	if ( is_wp_error($user) ) {
	// 		echo 'Не удалось залогинить';
	// 		echo $user->get_error_message();
	//  	} else {
	// 		echo 'Все прошло отлично';
	// 		// wp_redirect( 'https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/', 302 );
	// 		exit;
	//  	}
	// }
} else {
	echo "Обрабатываем запрос";
}

?>
