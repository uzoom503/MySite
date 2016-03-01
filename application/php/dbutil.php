<?php
    $conn_str = 'mysql:host=localhost;port=3307;dbname=test;charset=utf8';
	$db_user = 'root';
	$db_pwd = '';
	$db = new PDO($conn_str, $db_user, $db_pwd);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	// Get column names
	function GetColumnNames($sql_txt) {
		global $db;
		$qry = $db->query($sql_txt);
		$total_column = $qry->columnCount();
		
		for ($i=0; $i < $total_column; $i++) {
			$meta = $qry->getColumnMeta($i);
			$column[] = $meta['name'];
		}
		return $column;
	}
	function GetDataFromSQL($sql_txt) {
		global $db;
		try {
						
			$select = $db->query($sql_txt);					  							         
			$column_name = GetColumnNames( $sql_txt);
			

			$result =array();
			foreach($select as $row) {
				$aRecord = array();
				// go through column name
				for ($i=0; $i < count($column_name); $i++) {
					$aRecord[$column_name[$i]] = $row[$column_name[$i]];
				}
				$result[] = $aRecord;
			}			
			return $result;
          
			
		}
		catch (PDOException $e){
			echo "An error occurred connecting: " . $e->getMessage() . " < br / > \n " ;
		}
	}
	function UpdateDataFromSQL($sql_txt) {
		global $conn_str, $db_user, $db_pwd;
		$db = new PDO($conn_str, $db_user, $db_pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		$db->exec($sql_txt);
		return array("status" => "success", "message" => $sql_txt);
    }		
?>