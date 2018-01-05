<?php

namespace Mikhalyuk\SmsAero;

class SmsAero
{

    private $url;
    private $login;
    private $password;
    private $sign;

    public function __construct()
    {
        $this->login = config('smsaero.login');
        $this->password = !empty(config('smsaero.password')) ? md5(config('smsaero.password')) : config('smsaero.md5Password');
        $this->sign = config('smsaero.sign');
        $this->url = config('smsaero.url');
    }

    /**
     * Creating a curl-request
     * @param string $url
     * @param array|null $post
     * @param array $options
     * @return mixed
     */
    private static function curl_post($url, array $post = null, $options = [])
    {
        $defaults = [
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => http_build_query($post)
        ];
        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        if(!$result = curl_exec($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    /**
     * Sending a single message
     * @param string $to - number
     * @param string $text - text
     * @return array
     */
    public function send($to, $text, $date = false, $digital = 0, $type = 2)
    {
        return json_decode(
            self::curl_post($this->url . '/send/',
                [
                    'user' => $this->login,
                    'password' => $this->password,
                    'to' => $to,
                    'text' => $text,
                    'from' => $this->sign,
                    'answer' => 'json'
                ]
            ), true
        );
    }

    /**
     * Message status
     * @param integer $id - message id
     * @return array
     */
    public function status ($id){
        return json_decode(
            self::curl_post($this->url . '/status/',
                [
                    'user' => $this->login,
                    'password' => $this->password,
                    'id' => $id,
                    'answer' => 'json'
                ]
            ), true
        );
    }

}
