<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Forum_model extends CI_Model {
		
		public function __construct()
		{	
			parent::__construct();
		}
		///////////////////////////////////////////////////////////////////
		//   Description: send email for new user registration
		// 		
		///////////////////////////////////////////////////////////////////
		function sendMail($message, $to)
		{
			// To send email through google like this require change in gmail setting
			// 1. Set 'Off' to "2-step verification"
			// 2. Allow less secure apps: ON (or enable)
			$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			//'smtp_host' => 'ssl://smtp.googlemail.com',			
			'smtp_port' => 465,
			'smtp_user' => '',
			'smtp_pass' => '', // change it to yours pass
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE);
	
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('example@gmail.com'); // change it to yours
			$this->email->to($to);// change it to yours
			$this->email->subject('Comlete Registration');
			$this->email->message($message);
			if($this->email->send()) {
				echo 'Email sent.';
			}
			else{
				show_error($this->email->print_debugger());
			}
		}
		///////////////////////////////////////////////////////////////////
		//   Description: add user to db 
		// 	 	
		///////////////////////////////////////////////////////////////////
		function add_user($user_name, $user_pass, $user_email){
			$data = array('user_name'=>$user_name, 
			              'user_password' => $user_pass,
			              'email' => $user_email);
			// This insert could cause duplicate user name
			$this->db->insert('forumuser', $data);			
		}
		
		///////////////////////////////////////////////////////////////////
		//   Description: verify that user/pass is correct 
		// 		
		///////////////////////////////////////////////////////////////////
		function check_user($user_name, $user_pass)	{
			$this -> db -> select('id, user_name, user_password');
			$this -> db -> from('forumuser');
			$this -> db -> where('user_name', $user_name);
			$this -> db -> where('user_password', $user_pass);
			$this -> db -> limit(1);

			// check matching user/pass
			$query = $this -> db -> get();

			if($query -> num_rows() == 1)	{
				$result = $query->result(); 
				foreach($result as $row) {
					$sess_array = array('user_id' => $row->id, 'username' => $row->user_name);
					$this->session->set_userdata('logged_in', $sess_array);				
				}
				return true;
			}
			else			{
				return false;
			}
			
		}
		///////////////////////////////////////////////////////////////////
		//   Description: show all board and its topic
		// 		
		///////////////////////////////////////////////////////////////////
		function load_board() {
			$this -> db -> select('cat_name, cat_descp, '
									. ' forumboard.id as board_id, '
									. ' topic_subject, forumtopic.id as topic_id, forumtopic.add_dt as add_dt, '
									. '(select count(*) from test.forumreplies r where r.topic_id=forumtopic.id) as num_replies, '
									. ' user_name, email ');
			$this -> db -> from('forumboard');
			$this -> db -> join('forumtopic','forumtopic.board_id=forumboard.id', 'left');
			$this -> db -> join('forumuser','forumtopic.user_id=forumuser.id', 'left');			
			$this -> db ->order_by('forumboard.cat_name');
			
			$query = $this->db->get();
			//var_dump($query->list_fields());
			return $query->result();
		}
		///////////////////////////////////////////////////////////////////
		//   Description: 
		// 	 Add new topic to given board
		///////////////////////////////////////////////////////////////////
		function add_topic($board_id, $topic_subject, $topic_message) {
			$user_id = $this->session->userdata('logged_in')['user_id'];			
			$data = array('board_id'=>$board_id, 
			              'topic_subject' => $topic_subject,
			              'topic_message' => $topic_message,
						  'user_id' => $user_id);
			$this->db->insert('forumtopic', $data);					
		}
		function load_replies($topic_id, $page) {
			$items_per_page = 4;
			$offset = ($page-1) * $items_per_page;
			// number of records
			$result = array();
			$this->db->where('topic_id',$topic_id);			
			$result['num_pages'] = ceil($this->db->count_all_results('forumreplies') / $items_per_page);
			
			//$this->db->limit($offset, $items_per_page);
			$this->db->limit($items_per_page, $offset);			
			
			$this -> db -> select('cat_name, forumtopic.id as topic_id, topic_subject, topic_message,'
								. ' user_name, email, reply_content, forumreplies.id as reply_id ');
			$this -> db -> from('forumtopic');	
			$this -> db -> join('forumboard', 'forumtopic.board_id=forumboard.id');				
			$this -> db -> join('forumreplies','forumreplies.topic_id=forumtopic.id', 'left');					
			$this -> db -> join('forumuser','forumreplies.user_id=forumuser.id', 'left');
			$this->db->where('forumtopic.id', $topic_id);			
			$this->db->order_by('forumreplies.add_dt');
			$query = $this->db->get();
			//var_dump($query->list_fields());
			
			$result['records'] = $query->result();
			return $result;			
		}
		function add_reply_message($topic_id, $reply_message) {
			$user_id = $this->session->userdata('logged_in')['user_id'];
			$data = array('topic_id'=>$topic_id, 
			              'reply_content' => $reply_message,
						  'user_id' => $user_id);
			$this->db->insert('forumreplies', $data);					
			
		}
	}
?>
