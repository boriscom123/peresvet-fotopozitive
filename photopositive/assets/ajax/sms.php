<?php
  if(isset($_POST['tel'])) {
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
    require_once 'sms.ru.php';

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
      echo $pass;
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
  }
?>
