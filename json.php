<?php
	header('Content-Type: application/json');
	$objConnect = mysqli_connect("localhost","root","");
	$objDB = mysqli_select_db($objConnect,"project");
	mysqli_query($objConnect,"SET NAMES UTF8");
	
	$strSQL = "SELECT * FROM place,place_category WHERE place.place_cate_id = place_category.place_cate_id  ";

	$objQuery = mysqli_query($objConnect,$strSQL);
	$resultArray = array();
	while($obResult = mysqli_fetch_array($objQuery))
	{
		array_push($resultArray,$obResult);
	}
	
	mysqli_close($objConnect);
	
	echo json_encode($resultArray);
?>