<?php
  	require('dbtuil.php');
	$searchValue = $_GET["SearchValue"];
	$searchField = $_GET["optionFilter"];
	
	echo 'SearchValue=' . $searchValue;
	
	$filter = sprintf(' having `%s` '  .  " like '%%%s%%' ",$searchField,  $searchValue);
	$sql='SELECT PE.ID, PE.LastName, PE.FirstName'
							  . ", CONCAT(PE.LastName, ', ' , PE.FirstName) as FullName " 
							  . ', PE.DOB '
							  . ', A.AddressLn1 '
							  . ', A.City '						  
							  . ', A.State '						  
							  . ', A.Zip '						  
							  . 'FROM test.person PE '						   
							  . ' join test.address A '
							  . ' on (PE.AddressID = A.ID) ';	
				
	$array = GetDataFromSQL($sql + $filter);
    var_dump($array);
	
?>