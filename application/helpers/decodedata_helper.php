<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
	function decodedata($id){
		$CI =& get_instance();
		$CI->load->library('encryption');
		$CI->encryption->initialize(
	        array(
	                'cipher' => 'aes-256',
	                'mode' => 'ctr',
	                'key' => $CI->config->item('encryption_key')
	        )
		);
        $enc = $CI->encryption->decrypt($id);
		return $enc;
	}
