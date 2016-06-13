<?php namespace Widgit\Lib;

class Curl {



    public function  getCurlData($url) {

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array("User-Agent: php-curl"));

        $response = curl_exec($curl);

        $info = curl_getinfo($curl);

        if ($info['http_code'] == 200) {

            curl_close($curl);
            if (empty($response)) {

                return false;

            } else {
                return json_decode($response, true);
            }
        } else {

            echo "Curl Error: " . curl_error($curl);
        }
    }


}