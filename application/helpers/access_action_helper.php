<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function access_action($url, $action){
		$CI =& get_instance();
		$CI->load->model('M_access');
		$CI->load->library('session');
		$CI->load->helper('decodedata');
		$value['url'] = $CI->M_access->getAction(decodedata(str_replace(' ', '+', $CI->session->userdata('userid'))), $url, $action);

		return count($value['url']);
}