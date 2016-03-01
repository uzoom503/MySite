<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
class Movie extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Movie_model');
	    $this->load->library('session');
	}
	public function index()
	{
		// this page_data is passed to model
		$page_data['data']  = array();
		$page_data['q'] = '';			
		$this->load->view('common/header');
		$this->load->view('movie/movie_view',$page_data);
		$this->load->view('common/footer');      
	}
	public function search()
	{
		$this->load->model('Movie_model');
		$q = $this->input->post('q');
		$page_data['q'] = $q;
		$page_data['data'] = $this->Movie_model->find($q,'');
		// this page_data is passed to model
		$this->load->view('common/header');
		$this->load->view('movie/movie_view',$page_data);
		$this->load->view('common/footer');      
	}	
}
?>
