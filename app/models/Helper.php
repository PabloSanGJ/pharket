<?php

class Helper
{
    /**
     * Calculates the value of an amount of a currency
     * 
     * @param integer $amount
     * @param string $from
     * @param string $to
     * @return float
     */
    public static function convert($amount, $from, $to){
        $data = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from&to=$to");
        preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        
        return round($converted, 2);
    }
    
    /**
     * Get the country where the change was done
     * 
     * @return string
     */
    public static function getCountry(){
        $country = '';
        $ip = self::getClientIP();
        if ($ip != '') {
            $data = file_get_contents('http://freegeoip.net/json/' . $ip);
            $response = json_decode($data);
            $country = $response->country_code;
        }
        
        return $country;
    }
    
    /**
     * Get user's IP
     * 
     * @return string
     */
    private static function getClientIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}