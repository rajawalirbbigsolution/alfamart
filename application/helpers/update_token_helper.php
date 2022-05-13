<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function update_token($token, $id){
		$CI =& get_instance();
		$CI->load->model('M_token');
        $enc = $CI->M_token->updateTokenMember($token, $id);
		return $enc;
	}