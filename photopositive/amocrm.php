<?php
  $subdomain = 'zakirov'; //Поддомен нужного аккаунта
  $link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса
  /** Соберем данные для запроса */
  $data = [
  	'client_id' => '145a978e-14ca-401e-bf78-439b60893021',
  	'client_secret' => '5GaRtrNV8VmwP6799g6z329HFBFM6imRpfDXBKx0BG3kvwu5ThMSqBmHyEb4eKn7',
  	'grant_type' => 'authorization_code',
  	'code' => 'def502007f4cb81fc04628f87f1d552506063d93da7109b795890633e89c8be0998d474128345af70b465b502b13614a96a2d01ddf86f137ed3f923df7634746509c8e2a28e723863e13020449d50b7149276a7c207e64324a1351c3f77b7609ce3961fdb531132f8b67490e02622d4edfa2e8059df91b760f84a1b20b6ad64ff3fa1caf4690180a9fd99aefb298c1cf0f07f7393b748c809ad692eb5288a2f02c69c3dab4bc3b0ed18ba619720ad5818c55616b6a0310cb3e9e62552be4f5a569b6fe74de656805a0a793260a683c72dc1ea3e8e8299a857fedf84a903fe564206103ebac61f92ff30a52acccfb427f43221774c1f990b196369f483f2b848910124ea54bedf51ffab359363078780658b3d2fc95c5742ddfcb5e75c7ed668ebac6afcdcaea34ea0ea6e6bdb4ea0d49e963107a0aa70f3155c093874741890c43b015fb853428b5ee4784e6f29f05d2e43d95b9bd8b70aa18f767646ee3f72e89d7454a69a421725904eb5eb47723af90b1bee0dad3da41dbd28c136afc046d6889f374e52b79b710e4f9c3386b2de014bc1f3b400d51172f6a201ecb7bb60435b75bda751bb1a509de8f101b84757fd8a8dbaaf0c57f5d98a98387c267',
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
    // die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode())
    // echo $out;
  }
  // сохраняем ответ от сервера в файл.
  $addtofile = $out.'/{"until":'. ($_SERVER['REQUEST_TIME'] + 86400) .'}';
  $handle = fopen("amointegrationapi.json", "a");
  fwrite($handle, $addtofile);
  fclose($handle);
  // echo "Токен Получен";
?>
