<?php
	header("content-type:text/html;charset=utf-8");
	include'connectsql.php';
	$sql="select * from topic";
	$result=$db->query($sql);
	while($obj = $result->fetch_object()){
		$arr[]=$obj->special;
	}
	echo json_encode($arr);
?> 
