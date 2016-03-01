<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Movie_model extends CI_Model {	
	    private $filteredArray;		
		
		public function __construct()
		{	
			parent::__construct();
			$this->filteredArray = array();			
		}
	
		function find($q, $folder) {
			if ($folder == '') {
				//echo "search value=" . $q;
				$folder = $this->config->item('movie_folder');							
			}
			$fileArray = scandir($folder);
		
			foreach ($fileArray as $file) {
				if ($file === '.' or $file === '..') continue;
		
				if (is_dir($folder . '/' . $file)) {
					$this->find($q,$folder . '/' . $file);
				}
				else {
					if ( fnmatch( '*'. $q . '*', $file, FNM_CASEFOLD)){
						//echo 'match '. $file;
						$this->filteredArray[$file] = str_replace($this->config->item('movie_folder'), 
																	$this->config->item('movie_url'), 
																	$folder) . '/' . $file;
					}
				}
			}
			return $this->filteredArray;
		}		
	}
?>
