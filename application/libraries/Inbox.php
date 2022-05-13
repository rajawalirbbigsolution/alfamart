<?php

class Inbox
{
    function do_insert($user_id, $code, $relation_id, $subject, $message) {
        $CI =& get_instance();
        $CI->load->model('M_api_home');  

        $inbox = [
		    				'user_id' => $user_id,
		    				'code' => $code,
		    				'relation_id' => $relation_id,
		    				'subject' => $subject,
							'message' => $message,
							'flag' => 1,
							'is_read' => 0,
		    				'created_date' => date('Y-m-d H:i:s')
	    				];
		return $CI->M_api_home->insertInbox($inbox);
    }
}
