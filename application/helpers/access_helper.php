<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function access($url){
		$CI =& get_instance();
		$CI->load->model('M_access');
		$CI->load->library('session');
		$CI->load->helper('decodedata');
		$value['url'] = $CI->M_access->getUrl(decodedata(str_replace(' ', '+', $CI->session->userdata('userid'))), $url);

		return count($value['url']);
}