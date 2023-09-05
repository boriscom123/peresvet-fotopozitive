<?php

/** Настройка первичной интеграции - получение токена  */
function get_access_token($data)
{
    $link = 'https://' . $data['domain'] . '.amocrm.ru/oauth2/access_token';

    /** Соберем данные для запроса */
    $request = [
        'client_id' => $data['client_id'],
        'client_secret' => $data['client_secret'],
        'grant_type' => 'authorization_code',
        'code' => $data['code'],
        'redirect_uri' => $data['redirect_uri'],
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
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

    try {
        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
        if ($code < 200 || $code > 204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
        }
    } catch (\Exception $e) {
        echo 'Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode() . PHP_EOL;
        var_dump(json_decode($out, true));
        return false;
    }
    $out = json_decode($out, true);
    $data['until'] = $_SERVER['REQUEST_TIME'] + $out['expires_in'];
    $data['access_token'] = $out['access_token'];
    $data['refresh_token'] = $out['refresh_token'];
//    $data[]
//    $result = file_put_contents($file_name, json_encode($data, JSON_UNESCAPED_UNICODE));
    return $data;
}

/** Обновление токена  */
function refresh_access_token($data)
{
    $link = 'https://' . $data['domain'] . '.amocrm.ru/oauth2/access_token';

    /** Соберем данные для запроса */
    $request = [
        'client_id' => $data['client_id'],
        'client_secret' => $data['client_secret'],
        'grant_type' => 'refresh_token',
        'refresh_token' => $data['refresh_token'],
        'redirect_uri' => $data['redirect_uri'],
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
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

    try {
        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
        if ($code < 200 || $code > 204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
        }
    } catch (\Exception $e) {
        echo 'Не удалось обновить токен' . PHP_EOL;
        echo 'Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode() . PHP_EOL;
        var_dump(json_decode($out, true));
        return false;
    }
    $out = json_decode($out, true);
    $data['until'] = $_SERVER['REQUEST_TIME'] + $out['expires_in'];
    $data['access_token'] = $out['access_token'];
    $data['refresh_token'] = $out['refresh_token'];
    return $data;
// сохраняем ответ от сервера в файл.
//    $data['until'] = $_SERVER['REQUEST_TIME'] + 86400;
//    $result = file_put_contents($file_name, json_encode($data, JSON_UNESCAPED_UNICODE));
}

/** Проверка доступности аккаунта АМО СРМ  */
function check_amo_account($data)
{
    $link = 'https://' . $data['domain'] . '.amocrm.ru/api/v4/account';

    /** Формируем заголовки */
    $headers = [
        'Authorization: Bearer ' . $data['access_token']
    ];
    $curl = curl_init();
    /** Устанавливаем необходимые опции для сеанса cURL  */
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
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

    try {
        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
        if ($code < 200 || $code > 204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
        }
    } catch (\Exception $e) {
        echo 'Функция: check_amo_account. Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode() . PHP_EOL;
        var_dump(json_decode($out, true));
        return false;
    }
    $out = json_decode($out, true);
    return $out;
}

/** Добавляем пользователя в АМО СРМ */
function add_contact($data, $user_tel)
{
    /** Формируем заголовки */
    $headers = [
        'Authorization: Bearer ' . $data['access_token']
    ];
//    $link = 'https://' . $data['domain'] . '.amocrm.ru/api/v2/account';
//
//    $curl = curl_init();
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
//    curl_setopt($curl, CURLOPT_URL, $link);
//    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//    curl_setopt($curl, CURLOPT_HEADER, false);
//    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
//    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
//    $out = curl_exec($curl);
//    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//    curl_close($curl);
//    $code = (int)$code;
//    $errors = [
//        400 => 'Bad request',
//        401 => 'Unauthorized',
//        403 => 'Forbidden',
//        404 => 'Not found',
//        500 => 'Internal server error',
//        502 => 'Bad gateway',
//        503 => 'Service unavailable',
//    ];
//
//    try {
//        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
//        if ($code < 200 || $code > 204) {
//            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
//        }
//    } catch (\Exception $e) {
//        echo 'Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode() . PHP_EOL;
//        var_dump(json_decode($out, true));
//        return false;
//    }

    /** Добавление сделки */
    $lead_link = 'https://' . $data['domain'] . '.amocrm.ru/api/v4/leads';
    /** Номер необходимой воронки */
    $pipeline_id = 3841165;
    /** Запрос на добавление */
    $request = [
        [
            "name" => 'Сделка с сайта Фотопозитив',
            "pipeline_id" => $pipeline_id,
        ],
    ];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $lead_link);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
    curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $out = curl_exec($curl);
    $out_link = json_decode($out, true);
    $id_link = $out_link['_embedded']['leads'][0]['id'];

    /** Дополнительные поля контакта */
    $link = 'https://' . $data['domain'] . '.amocrm.ru/api/v4/contacts/custom_fields';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    /** Добавление контакта */
    $contact_link = 'https://' . $data['domain'] . '.amocrm.ru/api/v4/contacts';
    $id = json_decode($out, true);
    $id_tel = $id['_embedded']['custom_fields'][1]['id'];
    $request = '[
    {"first_name" : "' . $user_tel . '", "custom_fields_values": [
      {"field_id": ' . $id_tel . ', "values": [
        {"value": "' . $user_tel . '", "enum_code": "HOME"}
        ] }
      ] }
    ]';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($curl, CURLOPT_URL, $contact_link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $out_contact = json_decode($out, true);
    $id_contact = $out_contact['_embedded']['contacts'][0]['id'];
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

    try {
        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
        if ($code < 200 || $code > 204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
        }
    } catch (\Exception $e) {
        echo 'Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode() . PHP_EOL;
        var_dump(json_decode($out, true));
        return false;
    }

    /** Дополнительные поля контакта */
    $link = 'https://' . $data['domain'] . '.amocrm.ru/api/v4/leads/' . $id_link . '/link';
    $request = '[{"to_entity_id": ' . $id_contact . ', "to_entity_type": "contacts"}]';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
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

    try {
        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
        if ($code < 200 || $code > 204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
        }
    } catch (\Exception $e) {
        echo 'Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode() . PHP_EOL;
        var_dump(json_decode($out, true));
        return false;
    }
    return true;
}