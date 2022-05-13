<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function update_tokenDriver($token, $id){
		$CI =& get_instance();
		$CI->load->model('M_token');
        $enc = $CI->M_token->updateTokenDriver($token, $id);
		return $enc;
	}