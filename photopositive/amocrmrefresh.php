<?php
  // echo "REFRESH начало";
  $subdomain = 'zakirov'; //Поддомен нужного аккаунта
  $link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса
  $token = explode("/",file_get_contents("amointegrationapi.json"));
  $refresh_token = json_decode($token[0], true)['refresh_token'];
  /** Соберем данные для запроса */
  $data = [
    'client_id' => '145a978e-14ca-401e-bf78-439b60893021',
    'client_secret' => 'eGP2D72XV8eriINHUFQkOLrTGbnqBahnveJQEssjrVj8X9FwrPJ4hlcOssoE5zEd',
    'grant_type' => 'refresh_token',
    'refresh_token' => $refresh_token,
    'redirect_uri' => 'https://pv-foto.ru/',
  ];

  /**
   * Нам необходимо инициировать запрос к серверу.
   * Воспользуемся библиотекой cURL (поставляется в составе PHP).
   * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
   */
  $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
  /** Устанавливаем необходимые опции для сеанса cURL  */
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
  curl_setopt($curl,CURLOPT_URL, $link);
  curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
  curl_setopt($curl,CURLOPT_HEADER, false);
  curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
  curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
  $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
  // echo $out;
  $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);
  /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
  $code = (int)$code;
  $errors = [
  	400 => 'Bad request',
  	401 => 'Unauthorized',
  	403 => 'Forbidden',
  	404 => 'Not found',
  	500 => 'Internal server error',
  	502 => 'Bad gateway',
  	503 => 'Service unavailable',
  ];

  try
  {
  	/** Если код ответа не успешный - возвращаем сообщение об ошибке  */
  	if ($code < 200 || $code > 204) {
  		throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
  	}
  }
  catch(\Exception $e)
  {
  	// die('Файл: amoreffesh Строка: 57 Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
      echo "Не удалось обновить токен";
      echo $out;
  }
  // сохраняем ответ от сервера в файл.
  unlink("amointegrationapi.json");
  $addtofile = $out.'/{"until":'. ($_SERVER['REQUEST_TIME'] + 86400) .'}';
  $handle = fopen("amointegrationapi.json", "a");
  fwrite($handle, $addtofile);
  fclose($handle);
  // echo "REFRESH конец";
?>
