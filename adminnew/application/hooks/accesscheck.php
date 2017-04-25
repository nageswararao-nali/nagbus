<?php

class Accesscheck {

    var $CI;

    public function index($param) {
        $this->CI = & get_instance();
        $base_url = $GLOBALS['CFG']->config['base_url'];
        $routing = & load_class('Router');
        $class = $routing->fetch_class();
        $method = $routing->fetch_method();
        $directory = trim($routing->fetch_directory(), "/");
        $admin_session = $this->CI->session->userdata('admin_session');
        if ($class == 'welcome') {
            return true;
        } else {
            if (empty($admin_session)) {
                redirect($base_url . "welcome/logout");
                return false;
            }
        }
        return true;
    }

}

?>