<?php
	header('content-type:text/html;charset=utf-8');
	include'connectsql.php';
	$nickname=$_POST['nickname'];
	$username=$_POST['username'];
	$sql="select * from user where 1=1 ";
	if(!empty($nickname)){
		$sql=$sql."and nickname='$nickname' ";
	}
	if(!empty($username)){
		$sql=$sql."and username='$username'";
	}
	$re=$db->query($sql);
	$rows=$re->num_rows;
	if($rows!=0){
		while($obj=$re->fetch_object()){
			$arr[]=$obj->uid.",".$obj->username.",".$obj->nickname.",".$obj->password.",".$obj->user_profile;
		}
	}else{
		$arr[]="";
	}
	echo json_encode($arr);
?>