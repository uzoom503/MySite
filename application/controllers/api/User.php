<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
    }

    public function IsUserExist_get()
    {	
		//echo 'here';
		$this->load->model('user_model');
		// parameter from http GET
		$user_name = $this->get('user_name');
		//echo 'user_name=' . $user_name;
        if ($user_name != NULL)
        {
			 $this->response([ "exist" => $this->user_model->IsUserExists($user_name)],REST_Controller::HTTP_OK);
		}
		else {
			$this->response (["exist" => false],REST_Controller::HTTP_OK);
		}
	}
}
