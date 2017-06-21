<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Loader extension to hook database loading & automatically use template
//
class MY_Loader extends CI_Loader {

    function __construct() {
        parent::__construct();
    }

    function templated_view($name, $data = array(), $return = FALSE) {
		$data_template['content'] = $this->view($name, $data, TRUE);
		return $this->view('template/index', $data_template, $return);
	}

}
