<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class psaconnector extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function connect_to_psa_simulation($fields, $url) {
        log_message('info', 'Inside connecto to PSA>>');
        $fields_string = "";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'PSA Integration',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'username' => $fields['username'],
                'password' => $fields['password']
            )
        ));

        $result = curl_exec($curl);

        curl_close($curl);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . $result);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . json_encode($result));
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . json_decode($result));
        $new_result = json_decode($result);
        $formated_result = $new_result[0];
        //log_message('info', 'Is it an array???????'. is_array($result));
        return $formated_result;
    }

    public function authenticate_details($fields) {
        // $url = ("http://54.209.44.17:8280/getdata/validate");
        // $url = htmlspecialchars("http://swifta.co/binutraining/mobi/pharma-public/index.php/sys_admin/user_authorization/test_method");
        $url = htmlspecialchars("http://swifta.co/binutraining/mobi/pharma-public/index.php/mobile/mobile_controller/loginauthorization");
        log_message('info', $url . '>>>>><<<<<Inside the authenticate details');
        log_message('info', 'After dumping the array');
        // $fields = array();




        $result = $this->connect_to_psa_simulation($fields, $url);
        return $result;
    }

    public function initiate_cashin($fields) {
        $url = htmlspecialchars("http://54.164.96.105:8283/perform/moneytransfer");

        log_message('info', $url . '>>>>><<<<<Inside the authenticate details');
        log_message('info', 'After dumping the array');

        $result = $this->connect_to_psa_post_url($fields, $url);

        return $result;
    }

    public function initiate_cashout($fields) {
        $url = htmlspecialchars("http://54.164.96.105:8283/perform/moneytransfer");

        log_message('info', $url . '>>>>><<<<<Inside the authenticate details');
        log_message('info', 'After dumping the array');

        $result = $this->connect_to_psa_post_url($fields, $url);

        return $result;
    }

    public function connect_to_psa_post_url($fields, $url) {
        log_message('info', 'Inside connecto to PSA>>');

        $log_my_error = var_export($fields, TRUE);
        $log_my_error = str_replace(array("\r", "\n"), '', $log_my_error);
        log_message('info', 'LOGGED ARRAY OF FIELDS>>>>>>>>>>' . $log_my_error);

        log_message('info', 'Inside connecto to PSA>> after init');
        $headers = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Accept: application/json",
            "Authorization: Basic YWRtaW46YWRtaW4="
        );

        $ch = curl_init();
        $fields_string = "";

        foreach ($fields as $key => $value) {
            $fields_string[] = $key . '=' . $value;
        }
        $final_url = $url . '?' . implode('&', $fields_string);
        $data = '';

        log_message('info', $final_url);
        curl_setopt($ch, CURLOPT_URL, $final_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        if (!curl_errno($ch)) {
            $info = curl_getinfo($ch);
            log_message('info', 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']);
        }
        log_message('info', 'Inside connecto to PSA>> after executing curl');

        curl_close($ch);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . $result);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . json_encode($result));

        $new_result = json_decode($result);

        return $new_result;
    }

    public function connect_to_psa_post_payload($fields, $url) {
        log_message('info', 'Inside connecto to PSA>>');

        $log_my_error = var_export($fields, TRUE);

        $log_my_error = str_replace(array("\r", "\n"), '', $log_my_error);
        log_message('info', 'LOGGED ARRAY OF FIELDS>>>>>>>>>>' . $log_my_error);

        log_message('info', 'Inside connecto to PSA>> after init');

        $headers = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Accept: application/json",
            "Authorization: Basic YWRtaW46YWRtaW4="
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'PSA Integration',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $fields,
        ));

        log_message('info', 'Inside connecto to PSA>> after setting the options');

        $result = curl_exec($curl);

        if (!curl_errno($curl)) {
            $info = curl_getinfo($curl);
            log_message('info', 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']);
        }
        log_message('info', 'Inside connecto to PSA>> after executing curl');

        curl_close($curl);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . $result);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . json_encode($result));

        $new_result = json_decode($result);

        return $new_result;
    }

    public function connect_to_psa_get($fields, $url) {
        $fields_string = "";

        foreach ($fields as $key => $value) {
            $fields_string[] = $key . '=' . $value . '&';
        }
        $urlStringData = $url . '?' . implode('&', $fields_string);


        $ch = curl_init();
        $headers = array(
            "Accept: application/json",
            "Authorization: Basic YWRtaW46YWRtaW4="
        );

        log_message('info', $urlStringData);
        curl_setopt($ch, CURLOPT_HEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_URL, $urlStringData);
        $result = curl_exec($ch);
        if (!curl_errno($ch)) {
            $info = curl_getinfo($ch);
            log_message('info', print_r($info));
            echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
        }
        log_message('info', 'Inside connecto to PSA>> after executing curl');
        curl_close($ch);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . $result);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . json_encode($result));
        //   log_message('info', 'the response is >>>>>>>>>>>>>>>' . json_decode($result));
        $new_result = json_decode($result);

        return $new_result;
    }

}

?>
