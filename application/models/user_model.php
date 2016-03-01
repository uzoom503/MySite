<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class User_model extends CI_Model {
		
		public function __construct()
		{	
			parent::__construct();
		}
		//   Description: verify that user/pass is correct 
		// 		
		///////////////////////////////////////////////////////////////////
		function IsUserExists($user_name)	{
			$this -> db -> select('1');
			$this -> db -> from('forumuser');
			$this -> db -> where('user_name', $user_name);
			$this -> db -> limit(1);

			// check matching user/pass
			$query = $this -> db -> get();

			return($query -> num_rows() == 1);
		}
	}
?>
