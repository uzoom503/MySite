<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
class Forum extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Forum_model');
	}
	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'Username','required|trim|xss_clean');
		$this->form_validation->set_rules('user_pass', 'Password', 'required|trim|md5');
		
		$user_name = $this->input->post('user_name');
		$user_pass = $this->input->post('user_pass');

		// Validate form, check user/pass
		if 	(($this->form_validation->run() == true)
			&& ($this->Forum_model->check_user($user_name, $user_pass)) )
		{
			redirect('Forum/board', 'refresh');
			return TRUE;
		}
		else{
			$this->form_validation->set_message('username_check', 'Either user name or password does not match');
			$this->load->view('common/header');
			//$this->load->view('forum/sidebar');
			$this->load->view('forum/login_view');
			$this->load->view('common/footer');      		
			return FALSE;			
		}		
	}
	public function logout()	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('Forum/login', 'refresh');
	}
	public function register()
	{
		$this->load->view('common/header');
		//$this->load->view('forum/sidebar');
		$this->load->view('forum/register_view');
		$this->load->view('common/footer');      
	}
	public function register_submit() {
		$message = 'Please complete your registration..';
		$user_email = $this->input->post('user_email');
		$user_name = $this->input->post('user_name');
		$user_pass = $this->input->post('user_pass');	
		
		//$this->Forum_model->sendMail($message, $user_email);
		$this->Forum_model->add_user($user_name, $user_pass, $user_email);					
		if ($this->Forum_model->check_user($user_name, $user_pass)) 
		{
			redirect('Forum/board', 'refresh');
			return TRUE;
		}			
	}
	public function board()	{
		if($this->session->userdata('logged_in') == false) {
			redirect('Forum/login', 'refresh');
			return;
		}
		//var_dump($this->session->userdata('logged_in'));
		$page_data['logged_in'] = $this->session->userdata('logged_in');
	    $page_data['records'] = $this->Forum_model->load_board();
		
		$this->load->view('common/header');
		//$this->load->view('forum/sidebar');
		$this->load->view('forum/forum_view', $page_data);
		$this->load->view('common/footer');      	
	}
	///////////////////////////////////////////////////////////////////
	//   Description: show topic
	// 		
	///////////////////////////////////////////////////////////////////
	public function new_topic($board_id) {
		if($this->session->userdata('logged_in') == false) {
			redirect('Forum/login', 'refresh');
			return;
		}
		// Submit - new topic
		if ($this->input->post('submit_button') == 'Add') {
			$topic_subject = $this->input->post('topic_subject');
			$topic_message = $this->input->post('topic_message');		
			
			$this->Forum_model->add_topic($board_id,$topic_subject, $topic_message );
			redirect('Forum/board', 'refresh');
		}
		else {
			// add new topic
			$page_data['board_id'] = $board_id;
			$this->load->view('common/header');
			//$this->load->view('forum/sidebar');
			$this->load->view('forum/new_topic_view', $page_data);
			$this->load->view('common/footer');      	
		}
	}
	public function topic($topic_id, $page=1) {
		if($this->session->userdata('logged_in') == false) {
			redirect('Forum/login', 'refresh');
			return;
		}
		// load replies for given topic
		$page_data = $this->Forum_model->load_replies($topic_id, $page);
		$page_data['current_page'] = $page;
		
		$this->load->view('common/header');
		//$this->load->view('forum/sidebar');
		$this->load->view('forum/topic_view', $page_data);
		$this->load->view('common/footer');      	
	}
	public function reply_topic() {
		if($this->session->userdata('logged_in') == false) {
			redirect('Forum/login', 'refresh');
			return;
		}
		$topic_id = $this->input->post('topic_id');
		$reply_message = $this->input->post('reply_message');
		$this->Forum_model->add_reply_message($topic_id, $reply_message);
		redirect(sprintf('Forum/topic/%d', $topic_id), 'refresh');		
	}
}
?>
