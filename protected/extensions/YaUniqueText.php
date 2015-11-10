<?php
/**
 * Created by PhpStorm.
 * User: ivanvodanov
 * Date: 27.10.14
 * Time: 12:34
 * @property string $id
 */

class YaUniqueText {

    CONST SITE_ID = 4408370;
    CONST APP_ID = '24d92b7ebc0e4168a6d99dee1ec3295d'; //айди приложения
    CONST APP_PASSWORD = '17f06a883c314449bacf843c98a482af'; //пароль
    CONST APP_CALLBACKURI = 'http://sovets.net/?r=test/oauth'; //CALLBACK_URI
    CONST DEBUG = false;

    private $_authUrl = 'https://oauth.yandex.ru/authorize?response_type=code&client_id=%s';
    private $_authUrlDebug = 'https://oauth.yandex.ru/authorize?response_type=token&client_id=%s';
    private $_data;
    private $_token = ''; //тестовый токен

    public static function getToken()
    {
        $cookies = Yii::app()->request->cookies;

        if(!empty($cookies['ya_access_token']))
        {
            return $cookies['ya_access_token'];
        }
    }

    public function token()
    {

        $redirect = base64_encode(Yii::app()->request->requestUri);

        if(!empty($this->_token))
            return $this->_token;

        $token = self::getToken();
        if($token)
            return $token;

        $url = self::DEBUG ? $this->_authUrlDebug : $this->_authUrl;
        $url = sprintf($url,self::APP_ID).'&state='.$redirect;
        header('Location: '.$url);
        Yii::app()->end();
    }

    public function send($str, $url='')
    {
        $token = $this->token();

        $text = strip_tags($str);
        $text = htmlspecialchars($text);
        $text = urlencode($text);
        $data = "<original-text><content>{$text}</content></original-text>";

        $headers = array(
            'Authorization: OAuth '.$token,
        );


        $curl = curl_init('http://webmaster.yandex.ru/api/v2/hosts/'.self::SITE_ID.'/original-texts/');
        curl_setopt_array($curl,array(
           CURLINFO_HEADER_OUT=>1,
           CURLOPT_HTTPHEADER => $headers,
           CURLOPT_RETURNTRANSFER => 1,
           CURLOPT_POST => 1,
           CURLOPT_POSTFIELDS => $data,
        ));
        $result = curl_exec($curl);
        $code = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        $header = curl_getinfo($curl,CURLINFO_HEADER_OUT);
        curl_close($curl);

        /*echo '<pre>';
        echo $header.'<br>';
        echo $code.'<br>';
        echo '<br>';
        echo '<div style="padding:20px;background: #ccc">';
        echo $data.'<br><br>';
        var_dump($result);
        echo '</div>';
        exit;*/
        
        if($code==201)
            return true;
        else
            return false;
    }

    public function __get($key)
    {
        if(property_exists($this->_data, $key))
            return $this->_data->{$key};
    }



    private function _getAT($str)
    {
        $b = array ();
        preg_match_all('/<td>.*?<\/td>/sm', $str, $b);
        if (!empty($b[0]))
            return preg_replace('/[^\.0-9]/', '', array_pop($b[0]));
        else
            return 0;
    }

    private function _getWord($str)
    {
        $b = array ();
        $c = array ();
        preg_match_all('/<td.*?>.*?<\/td>/sm', $str, $b);
        if (!empty($b[0]))
        {
            $i = 0;
            do
            {
                if (!empty($b[0][$i]) && !empty($b[0][$i + 2]))
                    $c[preg_replace('/<.*?>/', '', $b[0][$i])] = preg_replace('/<.*?>/', '', $b[0][$i + 2]);
                $i += 3;
            } while ($b[0] && $i < 15);
            return json_encode($c);
        }
        else
            return '';
    }

} 