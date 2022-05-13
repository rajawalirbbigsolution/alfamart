<?php

class CekToken
{
    function do_cek_token() {
        $CI =& get_instance();
        $CI->load->model('M_token'); 
        $CI->load->helper(['jwt', 'authorization', 'decodedata', 'generate_token']); 

        $data = AUTHORIZATION::verify_request();
        $id = decodedata(str_replace(' ', '+', $data->id));
        $cek = $CI->M_token->cekTokenMember($data->token,  $id);
        $new_token = generate_token();
        if(count($cek) > 0){
            $update_token = $CI->M_token->updateTokenMember($new_token,  $id);
            if ($update_token > 0) {
                return AUTHORIZATION::generateToken(['id' => $data->id, 'username' => $data->username, 'token' => $new_token]);
            }else{
                return false;
            }
        } else {
            return false;
        }
    }
}
