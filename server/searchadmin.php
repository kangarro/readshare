<?php
	header('content-type:text/html;charset=utf-8');
	include'connectsql.php';
	$aid=$_POST['aid'];
	$auser=$_POST['auser'];
	$sql="select * from admin where 1=1 ";
//	aid 0 不用empty
	if(isset($aid)&&$aid!=""){
		$sql=$sql."and aid=$aid ";
	}
	if(!empty($auser)){
		$sql=$sql."and auser='$auser'";
	}
//	echo$sql;
	$re=$db->query($sql);
	$rows=$re->num_rows;
	if($rows!=0){
		while($obj=$re->fetch_object()){
			$arr[]=$obj->aid.",".$obj->auser.",".$obj->apass.",".$obj->aid;
		}
	}else{
		$arr[]="";
	}
	echo json_encode($arr);
?>