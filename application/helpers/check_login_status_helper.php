<?php 
function check_login_status(){
    $CI =&get_instance(); 
    if($CI->session->userdata('Login')){
        return TRUE;
    } else {
        return FALSE;
        
    }
}