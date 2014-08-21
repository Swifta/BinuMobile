<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class psaconnector extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function connect_to_psa($fields, $url) {
        log_message('info', 'Inside connecto to PSA>>');
        log_message('info', print_r($fields));
        $fields_string = "";

        foreach ($fields as $key => $value) {
            $fields_string[] = $key . '=' . $value;
        }
        $urlStringData = $url . '?' . implode('&', $fields_string);

        log_message('info', 'The url to be linked is ' . $urlStringData);

        $ch = curl_init();

        
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); # timeout after 10 seconds, you can increase it
        curl_setopt($ch, CURLOPT_URL, $urlStringData); #set the url and get string together
        $result = curl_exec($ch);
        $log_my_error = var_export($result, TRUE); // Or alternatively, print_r($my_array, TRUE);
// Then you might want to put it onto one line
        $log_my_error = str_replace(array("\r", "\n"), '', $log_my_error);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . $result);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . $log_my_error);
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . var_dump($result));
        log_message('info', 'the response is >>>>>>>>>>>>>>>' . print_r($result));
        curl_close($ch);
        return $result;
    }

    public function authenticate_details($fields) {
       // $url = ("http://54.209.44.17:8280/getdata/validate");
            $url = ("http://swifta.co/binutraining/mobi/pharma-public/index.php/sys_admin/user_authorization/test_method");
        log_message('info', $url . '>>>>><<<<<Inside the authenticate details');
        log_message('info', var_dump($fields));
        log_message('info', 'After dumping the array');
        // $fields = array();
       



        $result = $this->connect_to_psa($fields, $url);
   //     log_message('info', $result);
    }

}

?>
