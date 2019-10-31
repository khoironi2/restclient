<?php 


function check_access($level)
{
    $check = get_instance();

    $result = $check->db->get_where('tbl_user', [
        'level' => $level
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}