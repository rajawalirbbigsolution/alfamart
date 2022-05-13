<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function encodedata($id){
		$CI =& get_instance();
		$CI->load->library('encryption');
		$CI->encryption->initialize(
	        array(
	                'cipher' => 'aes-256',
	                'mode' => 'ctr',
	                'key' => $CI->config->item('encryption_key')
	        )
		);
        $enc = $CI->encryption->encrypt($id);
		return $enc;
	}