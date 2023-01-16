<?php
/*
Template Name: ByNextPr - User Actions
*/
?>
<?php
if (isset($_POST)) {
	if (isset($_POST['user_id'])) {
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
	        }
	      }
	    }
	  }
	}

	if(isset($_POST['tel'])) {
		if(is_numeric($_POST['tel']) or strlen($_POST['tel']) > 11) {
			$userlogin = $_POST['tel'];
			if ( username_exists( $userlogin ) ) {
				echo 'false';
			} else {
				$user_tel = $_POST['tel'];
				if($user_tel[0] == 8){
				 $user_tel = '7'.substr($user_tel, 1);
				} elseif($user_tel[0] == 9){
				 $user_tel = '7'.$user_tel;
				}
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
				require_once 'assets/ajax/sms.ru.php';
                $file_name = 'amointegrationapi.json';
                $data = json_decode(file_get_contents($file_name), true);
				$smsru = new SMSRU($data['smsru']);
				$data = new stdClass();
				$data->to = $user_tel;
				$data->text = $pass;
				$data->from = 'PERESVET';
				$sms = $smsru->send_one($data);

				if ($sms->status == "OK") {

				} else {
					echo "Сообщение не отправлено. Телефон: ".$user_tel." Пароль: ".$pass;
					echo "Код ошибки: $sms->status_code. ";
					echo "Текст ошибки: $sms->status_text.";
				}

				$userdata = array(
					'user_login' => $_POST['tel'],
					'user_pass'  => $pass,
					'display_name'    => '*'.substr($_POST['tel'], -4),
					'nickname'        => '*'.substr($_POST['tel'], -4),
				);
				$user_id = wp_insert_user( $userdata ) ;
				if( ! is_wp_error( $user_id ) ) {
					if(isset($_POST['post-id'])) {
			      $like_post_id = $_POST['post-id'];
			      if(is_numeric($like_post_id)) {
			        $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$like_post_id AND user_id=$user_id");
			        if($user_like[0]->user_like === '0') {
			          $table = 'wp_foto_likes';
			          $data = array("user_id" => $user_id, "post_id" => $like_post_id);
			          $format = array("%d", "%d");
			          $likes = $wpdb->insert($table, $data, $format);
			        }
			      }
			    }
					if(!file_exists('amointegrationapi.json')){
						 include 'amocrm.php';
						} else {
						$file_name = 'amointegrationapi.json';
						$data = json_decode(file_get_contents($file_name), true);

						 if($data['until'] < $_SERVER['REQUEST_TIME']){
							 include 'amocrmrefresh.php';
						 }
						 include 'addcontact.php';
					 }
					echo 'true';
				} else {
					return $user_id->get_error_message();
				}
			}
		} else {
			echo 'Используйте только цифры';
		}
		if(isset($_POST['u-pass'])){
			$user = get_user_by('login', $_POST['tel']);
			$userdata = [
				'ID'              => $user->ID,
				'user_pass'       => $_POST['u-pass'],
			];
			wp_update_user($userdata);
		}
	}

	if(isset($_POST['reg-tel']) && isset($_POST['foget-password-submit'])) {
		if(is_numeric($_POST['reg-tel'])) {
			$userlogin = $_POST['reg-tel'];
			if ( username_exists( $userlogin ) )
			{
				$user_tel = $_POST['reg-tel'];
				if($user_tel[0] == 8){
				 $user_tel = '7'.substr($user_tel, 1);
				} elseif($user_tel[0] == 9){
				 $user_tel = '7'.$user_tel;
				}
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
				require_once 'assets/ajax/sms.ru.php';
                $file_name = 'amointegrationapi.json';
                $data = json_decode(file_get_contents($file_name), true);
				$smsru = new SMSRU($data['smsru']);
				$data = new stdClass();
				$data->to = $user_tel;
				$data->text = $pass;
				$data->from = 'PERESVET';
				$sms = $smsru->send_one($data);

				if ($sms->status == "OK") {
				} else {
					echo "Сообщение не отправлено. Телефон: ".$user_tel." Пароль: ".$pass;
					echo "Код ошибки: $sms->status_code. ";
					echo "Текст ошибки: $sms->status_text.";
				}

				$field = 'login';
				$value = $_POST['reg-tel'];
				$user = get_user_by( $field, $value );
				$current_user_id = $user->ID;
				wp_update_user( [ 'ID' => $current_user_id, 'user_pass' => $pass] );
				echo 'true';
			} else {
				echo 'false';
			}
		}
	}
} else {
	echo "Обрабатываем запрос";
}
?>
