<?php 
	include("module.php");

	function getMaterialList($searchKey = "", $ids = "0")
	{
		global $con; 

		if($searchKey != "")
		{
			$key 		= "%".$_GET['key']."%";

			$getItems	= 	$con->prepare("	SELECT material_id,
													material_name,
													material_metric			
										 	FROM lib_materials 
										 	WHERE material_name LIKE ?
										 	AND material_id NOT IN (" . $ids . ")
									 		ORDER BY material_name");
			$getItems	->bind_param("s", $searchKey);
		}
		else
		{
			$getItems	= 	$con->prepare("	SELECT material_id,
														material_name,
														material_metric			
											 	FROM lib_materials 
											 	WHERE material_id NOT IN (" . $ids . ")
										 		ORDER BY material_name");
		}

		$getItems->execute();
		
		return $getItems;
	}
	
?>