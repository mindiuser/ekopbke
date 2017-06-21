<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('my_url')) {
    function my_url()
    {
        return base_url()."/index.php";
    }
}

?>