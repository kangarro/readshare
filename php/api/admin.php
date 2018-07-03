<?php
  header('content-type:text/html;charset=utf-8');
  include'connectSql.php';
	$nickname=$_POST['nickname'];//判断login还是resign
	$uid=$_POST['email'];
	$password=$_POST['psw'];
	//注册
	if(isset($nickname)){
		header('location:www.baidu.com');
	}
	//登录
	else if(!isset($nickname)){
		$sql="select * from user where uid='$uid' and password='$password'";
		$result=$db->query($sql);
		if($obj=$result->fetch_object()){
			echo"成功";
		}else{
			echo"失败";
		}
	}
?>