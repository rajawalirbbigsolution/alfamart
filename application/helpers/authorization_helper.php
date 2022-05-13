<?php

class AUTHORIZATION
{

    public static function validateTimestamp($token)
    {
        $CI =& get_instance();
        $token = self::validateToken($token);
        if ($token != false && (now() - $token->timestamp < ($CI->config->item('token_timeout') * 60))) {
            return $token;
        }
        return false;
    }

    public static function validateToken($token)
    {
        $CI =& get_instance();
        return JWT::decode($token, $CI->config->item('encryption_key'));
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        return JWT::encode($data, $CI->config->item('encryption_key'));
    }

    public static function verify_request()
    {
        $CI =& get_instance();
        try {
            $headers = $CI->input->request_headers();
            $tokens = $headers['Authorization'];
            $result = self::validateToken($tokens);
            if ($result == null || $result == false || $result == "") {
                return false;
            }else{
                return $result;
            }
            return self::validateToken($tokens);
        } catch (Exception $e) {
            return false;
        }
    }

}