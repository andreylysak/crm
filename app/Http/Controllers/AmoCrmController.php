<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class AmoCrmController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public static function createContact($contacts) {
        $account = self::getAccount();
        if (isset($account['auth'])) {
            $auth_status['status'] = true;
            $auth_status['message'] = 'Авторизация прошла успешно';

            $subdomain = 'goodrobin58';
            $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/contacts';
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($contacts));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $out = curl_exec($curl);
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $code = (int) $code;
            $errors = array(
                301 => 'Moved permanently',
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable',
            );
            try {
                if ($code != 200 && $code != 204) {
                    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
                }
            } catch (Exception $E) {
                $Response = json_decode($out, true);
                echo '<pre>';
                print_r($Response);
                echo '</pre>';
                die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
            }
            
            $Response = json_decode($out, true);
            $Response = $Response['_embedded']['items'];

            /*
            $output = 'ID добавленных контактов: ' . PHP_EOL;
            foreach ($Response as $v) {
                if (is_array($v)) {
                    $output .= $v['id'] . PHP_EOL;
                }
            } */

            $contacts_ids = array();
            foreach ($Response as $v) {
                if (is_array($v)) {
                    $contacts_ids[] = $v['id'];
                }
            }
            return $contacts_ids;
        } else {
            $auth_status['status'] = false;
            $auth_status['message'] = 'Авторизация не удалась';
            return false;
        }
    }

    public static function createLead($leads) {
        $account = self::getAccount();
        if (isset($account['auth'])) {
            $auth_status['status'] = true;
            $auth_status['message'] = 'Авторизация прошла успешно';

            $subdomain = 'goodrobin58';
            $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads';
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($leads));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $out = curl_exec($curl);
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $code = (int) $code;
            $errors = array(
                301 => 'Moved permanently',
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable',
            );
            try {
                if ($code != 200 && $code != 204) {
                    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
                }
            } catch (Exception $E) {
                $Response = json_decode($out, true);
                echo '<pre>';
                print_r($Response);
                echo '</pre>';
                die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
            }
            
            $Response = json_decode($out, true);
            $Response = $Response['_embedded']['items'];

            $contacts_ids = array();
            foreach ($Response as $v) {
                if (is_array($v)) {
                    $contacts_ids[] = $v['id'];
                }
            }
            return $contacts_ids;
        } else {
            $auth_status['status'] = false;
            $auth_status['message'] = 'Авторизация не удалась';
            return false;
        }
    }

    public static function getAllContacts($limit_rows = NULL, $limit_offset = NULL) {
        $account = self::getAccount();
        if (isset($account['auth'])) {
            $auth_status['status'] = true;
            $auth_status['message'] = 'Авторизация прошла успешно';
            $subdomain = 'goodrobin58';
            
            if ($limit_rows > 0) {
                if ($limit_offset > 0) {
                    $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/contacts/?limit_rows='.$limit_rows.'&limit_offset='.$limit_offset;
                } else {
                    $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/contacts/?limit_rows='.$limit_rows;
                }
            } else if ($limit_offset > 0) {
                $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/contacts/?limit_offset='.$limit_offset;
            } else {
                $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/contacts/';
            }
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $out = curl_exec($curl);
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $code = (int) $code;
            $errors = array(
                301 => 'Moved permanently',
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable',
            );
            try {
                if ($code != 200 && $code != 204) {
                    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
                }
            } catch (Exception $E) {
                die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
            }

            $Response = json_decode($out, true);
            $Response = $Response['_embedded']['items'];

            return $Response;
        } else {
            $auth_status['status'] = false;
            $auth_status['message'] = 'Авторизация не удалась';
        }
    }

    public static function getAllLeads($limit_rows = NULL, $limit_offset = NULL) {
        $account = self::getAccount();
        if (isset($account['auth'])) {
            $auth_status['status'] = true;
            $auth_status['message'] = 'Авторизация прошла успешно';
            $subdomain = 'goodrobin58';
            
            if ($limit_rows > 0) {
                if ($limit_offset > 0) {
                    $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads/?limit_rows='.$limit_rows.'&limit_offset='.$limit_offset;
                } else {
                    $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads/?limit_rows='.$limit_rows;
                }
            } else if ($limit_offset > 0) {
                $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads/?limit_offset='.$limit_offset;
            } else {
                $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads/';
            }
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $out = curl_exec($curl);
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $code = (int) $code;
            $errors = array(
                301 => 'Moved permanently',
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable',
            );
            try {
                if ($code != 200 && $code != 204) {
                    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
                }
            } catch (Exception $E) {
                die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
            }

            $Response = json_decode($out, true);
            $Response = $Response['_embedded']['items'];

            return $Response;
        } else {
            $auth_status['status'] = false;
            $auth_status['message'] = 'Авторизация не удалась';
        }
    }

    public static function getContactLeads($contact_id) {
        $account = self::getAccount();
        if (isset($account['auth'])) {
            $auth_status['status'] = true;
            $auth_status['message'] = 'Авторизация прошла успешно';

            $subdomain = 'goodrobin58';
            $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/contacts?id='.$contact_id;
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $out = curl_exec($curl);
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $code = (int) $code;
            $errors = array(
                301 => 'Moved permanently',
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable',
            );
            try {
                if ($code != 200 && $code != 204) {
                    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
                }

            } catch (Exception $E) {
                $Response = json_decode($out, true);
                $Response = $Response['response'];
                echo '<pre>';
                print_r($Response);
                echo '</pre>';
                die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
            }
            
            $Response = json_decode($out, true);
            $Response = $Response['_embedded']['items'][0]['leads']['id'];
            return $Response;
        } else {
            $auth_status['status'] = false;
            $auth_status['message'] = 'Авторизация не удалась';
        }
    }

    public static function getAccount() {
        $user = array(
            'USER_LOGIN' => 'goodrobin58@gmail.com',
            'USER_HASH' => 'b04ab5a7672ea194946b8b9f62811dfbb521a963',
        );
        $subdomain = 'goodrobin58';
        $link = 'https://' . $subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($user));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname
            (__FILE__) . '/cookie.txt');
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname
            (__FILE__) . '/cookie.txt');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $out = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $code = (int) $code;
        $errors = array(
            301 => 'Moved permanently',
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
            502 => 'Bad gateway',
            503 => 'Service unavailable',
        );
        try {
            if ($code != 200 && $code != 204) {
                throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
            }

        } catch (Exception $E) {
            $Response = json_decode($out, true);
            $Response = $Response['response'];
            echo '<pre>';
            print_r($Response);
            echo '</pre>';
            die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
        }
        
        $Response = json_decode($out, true);
        $Response = $Response['response'];
        if (isset($Response['auth'])) {
            return $Response;
        } else {
            return false;
        }
    }
}