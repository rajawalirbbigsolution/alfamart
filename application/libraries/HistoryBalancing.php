<?php

class HistoryBalancing
{
    function do_insert($user_id, $balancing_before, $balancing_after, $status, $code, $relation_id, $created_by) {
        $CI =& get_instance();
        $CI->load->model('M_requesttopup');  

        $history_balancing = [
		    				'user_id' => $user_id,
		    				'balancing_before' => $balancing_before,
		    				'balancing_after' => $balancing_after,
		    				'status' => $status,
		    				'code' => $code,
		    				'relation_id' => $relation_id,
		    				'created_by' => $created_by,
		    				'created_date' => date('Y-m-d H:i:s')
	    				];
		return $CI->M_requesttopup->addHistoryBalancing($history_balancing);
    }
}
