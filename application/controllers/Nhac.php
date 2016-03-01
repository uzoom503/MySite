<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
class Nhac extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Nhac_model');
	    $this->load->library('session');
	}
	public function index()
	{
		$this->load->model('Nhac_model');
		// this page_data is passed to model
		$page_data['q'] = '';	
		$page_data['data'] = array();
		$this->load->view('common/header');
		$this->load->view('nhac/nhac_view',$page_data);
		$this->load->view('common/footer');      
	}
	public function search()
	{
		$this->load->model('Nhac_model');
		$q = $this->input->post('q');
		$page_data['q'] = $q;
		$page_data['data'] = $this->Nhac_model->find($q,'');
		// this page_data is passed to model
		$this->load->view('common/header');
		$this->load->view('nhac/nhac_view',$page_data);
		$this->load->view('common/footer');      
	}
	// Service for Ajax
	public function getSearchSvc($q)	 {
		$this->load->model('Nhac_model');
		header('Content-Type: application/json');
		// url decode, ie, like "*" was decoded.
		$data = $this->Nhac_model->find(urldecode($q),'');
		//var_dump($data);
		// this json_encode have problem with unicode.
		echo json_encode($data);
	}
	public function postSearchSvc()	 {
		$this->load->model('Nhac_model');
		$q = $this->input->post('q');
		$data = $this->Nhac_model->find($q,'');
		//var_dump($data);
		// this json_encode have problem with unicode.
		header('Content-Type: application/json');		
		echo json_encode($data);
	}	
}
?>
