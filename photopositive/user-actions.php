<?php
/*
Template Name: ByNextPr - User Actions
*/
?>
<?php

function prepareUserLogin($tel)
{
    $user_login = '';
    for ($i = 0; $i < mb_strlen($tel); $i++) {
        if ($i === 0 && $tel[0] === '+' && $tel[1] === '7') {
            $user_login .= 8;
            $i = 2;
        }
        if ($i === 0 && $tel[1] === '7') {
            $user_login .= 8;
            $i = 1;
        }
        if ($tel[$i] === '0') {
            $user_login .= '0';
            continue;
        }
        if (is_int((int)$tel[$i])) {
            $user_login .= $tel[$i];
        }
    }
    return $user_login;
}

function prepareTel($tel)
{
    $user_tel = $tel;
    if ($user_tel[0] == 8) {
        $user_tel = '7' . substr($user_tel, 1);
    } elseif ($user_tel[0] == 9) {
        $user_tel = '7' . $user_tel;
    }
    return $user_tel;
}

function gen_password($length = 6)
{
    $password = '';
    $arr = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
    );
    for ($i = 0; $i < $length; $i++) {
        $password .= $arr[random_int(0, count($arr) - 1)];
    }
    return $password;
}

function sendSms($tel, $text)
{
    require_once 'assets/ajax/sms.ru.php';
    $smsru = new SMSRU('7C452DB3-6DDA-D66B-F068-F1332632E48BB');
    $data = new stdClass();
    $data->to = $tel;
    $data->text = $text;
    $data->from = 'PERESVET';
    try {
        $sms = $smsru->send_one($data);
    } catch (Exception $e) {
        return $e->getMessage();
    }

    if ($sms->status == "OK") {
        return true;
    } else {
        return "Сообщение не отправлено. Код ошибки: " . $sms->status_code . "Текст ошибки: " . $sms->status_text;
    }
}

$response = [];
if (isset($_POST)) {
    $response['request'] = $_POST;

    if (isset($_POST['user_id'])) {
        $like_user_id = $_POST['user_id'];
        if (is_numeric($like_user_id)) {
            if (isset($_POST['dislike'])) {
                $dislike_post_id = $_POST['dislike'];
                if (is_numeric($dislike_post_id)) {
                    $dislikes = $wpdb->query("DELETE FROM wp_foto_likes WHERE post_id=$dislike_post_id AND user_id=$like_user_id");
                    echo "dislike";
                    // print_r($_POST);
                }
            }
            if (isset($_POST['like'])) {
                $like_post_id = $_POST['like'];
                if (is_numeric($like_post_id)) {
                    // проверяем наличие такой записи в БД и если нет - добавляем
                    $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$like_post_id AND user_id=$like_user_id");
                    if ($user_like[0]->user_like === '0') {
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

    if (isset($_POST['tel'])) {
        if (is_numeric($_POST['tel']) or strlen($_POST['tel']) > 11) {
            $userlogin = $_POST['tel'];
            if (username_exists($userlogin)) {
                echo 'false';
            } else {
                $user_tel = $_POST['tel'];
                if ($user_tel[0] == 8) {
                    $user_tel = '7' . substr($user_tel, 1);
                } elseif ($user_tel[0] == 9) {
                    $user_tel = '7' . $user_tel;
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
                    echo "Сообщение не отправлено. Телефон: " . $user_tel . " Пароль: " . $pass;
                    echo "Код ошибки: $sms->status_code. ";
                    echo "Текст ошибки: $sms->status_text.";
                }

                $userdata = array(
                    'user_login' => $_POST['tel'],
                    'user_pass' => $pass,
                    'display_name' => '*' . substr($_POST['tel'], -4),
                    'nickname' => '*' . substr($_POST['tel'], -4),
                );
                $user_id = wp_insert_user($userdata);
                if (!is_wp_error($user_id)) {
                    if (isset($_POST['post-id'])) {
                        $like_post_id = $_POST['post-id'];
                        if (is_numeric($like_post_id)) {
                            $user_like = $wpdb->get_results("SELECT COUNT(id) as user_like FROM wp_foto_likes WHERE post_id=$like_post_id AND user_id=$user_id");
                            if ($user_like[0]->user_like === '0') {
                                $table = 'wp_foto_likes';
                                $data = array("user_id" => $user_id, "post_id" => $like_post_id);
                                $format = array("%d", "%d");
                                $likes = $wpdb->insert($table, $data, $format);
                            }
                        }
                    }
                    $amo_file = get_template_directory() . '/assets/amo_crm_integration/' . 'amo_crm_data.json';
                    if (!file_exists($amo_file)) {
                        include 'amocrm.php';
                    }
                    echo 'true';
                } else {
                    return $user_id->get_error_message();
                }
            }
        } else {
            echo 'Используйте только цифры';
        }
        if (isset($_POST['u-pass'])) {
            $user = get_user_by('login', $_POST['tel']);
            $userdata = [
                'ID' => $user->ID,
                'user_pass' => $_POST['u-pass'],
            ];
            wp_update_user($userdata);
        }
    }

    if (isset($_POST['reg-tel']) && isset($_POST['foget-password-submit'])) {
        if (is_numeric($_POST['reg-tel'])) {
            $userlogin = $_POST['reg-tel'];
            if (username_exists($userlogin)) {
                $user_tel = $_POST['reg-tel'];
                if ($user_tel[0] == 8) {
                    $user_tel = '7' . substr($user_tel, 1);
                } elseif ($user_tel[0] == 9) {
                    $user_tel = '7' . $user_tel;
                }
                function gen_password($length = 6)
                {
                    $password = '';
                    $arr = array(
                        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
                        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
                        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
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
                    echo "Сообщение не отправлено. Телефон: " . $user_tel . " Пароль: " . $pass;
                    echo "Код ошибки: $sms->status_code. ";
                    echo "Текст ошибки: $sms->status_text.";
                }

                $field = 'login';
                $value = $_POST['reg-tel'];
                $user = get_user_by($field, $value);
                $current_user_id = $user->ID;
                wp_update_user(['ID' => $current_user_id, 'user_pass' => $pass]);
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'user-login') {
            $response['result'] = false;
            if ($_POST['user-tel'] && $_POST['user-pass']) {
                $user_login = prepareUserLogin($_POST['user-tel']);
                $credentials = array(
                    'user_login' => $user_login,
                    'user_password' => $_POST['user-pass'],
                    'remember' => true,
                );
                $secure_cookie = '';
                $user = wp_signon($credentials);
                if (is_wp_error($user)) {
                    $response['message'] = 'Не правильный логин или пароль';
                } else {
                    if ($_POST['add-amo-contact']) {
                        /** Необходимо добавить контакт в АМО СРМ */
                        $amo_file = get_template_directory() . '/assets/amo_crm_integration/' . 'amo_crm_data.json';
                        if (file_exists($amo_file)) {
                            $amo_data = json_decode(file_get_contents($amo_file), true);
                            include 'assets/amo_crm_integration/amo_functions.php';
                            $response['amo_result'] = add_contact($amo_data, $_POST['user-tel']);
                        }
                    }
                    $response['message'] = 'Все отлично';
                    $response['result'] = true;
                }
            } else {
                $response['message'] = 'Не получен логин или пароль';
                $response['result'] = true;
            }

            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        if ($_POST['action'] === 'user-reg-tel-check') {
            $response['result'] = false;

            if ($_POST['user-tel']) {
                $user_login = prepareUserLogin($_POST['user-tel']);
                $response['user_login'] = $user_login;
                if (username_exists($user_login)) {
                    $response['message'] = 'Данный номер телефона уже используется';
                } else {

                    $limit = 11;
                    if (mb_strlen($user_login) <= $limit) {

                        $tel = prepareTel($user_login);
                        $pass = gen_password();
                        $response['sms_result'] = sendSms($tel, $pass);
                        $result = true;

                        $user_data = array(
                            'user_login' => $user_login,
                            'user_pass' => $pass,
                            'display_name' => '*' . substr($user_login, -4),
                            'nickname' => '*' . substr($user_login, -4),
                        );
                        $user_id = wp_insert_user($user_data);

                        if (!is_wp_error($user_id) && $result) {

                            $response['message'] = 'Введите пароль из СМС';
                            $response['result'] = true;
                        } else {
                            $response['message'] = 'Не удалось отправить пароль.';
                        }

                    } else {
                        $response['message'] = 'Номер телефона длиннее 11 цифр';
                    }
                }
            }


            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        if ($_POST['action'] === 'user-forget') {
            $response['result'] = false;

            if ($_POST['user-tel']) {
                $user_login = prepareUserLogin($_POST['user-tel']);
                $response['user_login'] = $user_login;
                if (username_exists($user_login)) {
                    /** Обновляем пароль пользователя */
                    $tel = prepareTel($user_login);
                    $pass = gen_password();
                    $response['sms_result'] = sendSms($tel, $pass);
                    $result = true;

                    $field = 'login';
                    $value = $_POST['user-tel'];
                    $user = get_user_by($field, $value);
                    $current_user_id = $user->ID;
                    wp_update_user(['ID' => $current_user_id, 'user_pass' => $pass]);

                    $response['result'] = true;
                } else {
                    $response['message'] = 'Данный номер телефона не найден';
//                    if (is_numeric($_POST['user-tel']) || strlen($_POST['user-tel']) > 11) {
//
//                        $tel = prepareTel($_POST['user-tel']);
//                        $pass = gen_password();
//                        $result = sendSms($tel, $pass);
//                        $result = true;
//
//                        $userdata = array(
//                            'user_login' => $_POST['user-tel'],
//                            'user_pass' => $pass,
//                            'display_name' => '*' . substr($_POST['user-tel'], -4),
//                            'nickname' => '*' . substr($_POST['user-tel'], -4),
//                        );
//                        $user_id = wp_insert_user($userdata);
//
//                        if (!is_wp_error($user_id) && $result) {
//
//                            $response['message'] = 'Введите пароль из СМС';
//                            $response['result'] = true;
//                        } else {
//                            $response['message'] = 'Не удалось отправить пароль.';
//                        }
//
//                    } else {
//                        $response['message'] = 'Используйте только цифры';
//                    }
                }
            }


            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
} else {
    echo "Обрабатываем запрос";
}
?>
