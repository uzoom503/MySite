<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Nhac_model extends CI_Model {
        
	    private $filteredArray;
		
		public function __construct()	{
			parent::__construct();		
			$this->filteredArray = array();
		}	   
	
		function find($q, $folder) {
			if ($folder == '') {
				//echo "search value=" . $q;
				$folder = $this->config->item('music_folder');
							
			}
			$fileArray = scandir($folder);
		
			foreach ($fileArray as $file) {
				if ($file === '.' or $file === '..') continue;
		
				if ( fnmatch( '*'. $q . '*', $file, FNM_CASEFOLD) && pathinfo($file, PATHINFO_EXTENSION) == 'mp3'){
					//echo 'match '. $file;
					$this->filteredArray[$file] = str_replace($this->config->item('music_folder'),
															  $this->config->item('nhac_url'), 
															  $folder) . '/' . $file;
				}
				if (is_dir($folder . '/' . $file)) {
					$this->find($q,$folder . '/' . $file);
				}
			}
			return $this->filteredArray;	
		}
	}
?>
