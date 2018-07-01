<?php
	header('content-type:text/html;charset=utf-8');
	include'connectsql.php';
	$content=$_POST['content'];
	$sql="select essay.content,essay.writetime,essay.writer,topic.special from essay,topic_essay,topic where content LIKE '%$content%' and essay.eid=topic_essay.eid and topic_essay.tid=topic.tid ";
	$result=$db->query($sql);
	
		while($obj=$result->fetch_object()){
			$con[]=$obj->content.",".$obj->writetime.",".$obj->writer.",".$obj->special;
		}
		echo $con;
	
//	else{
//		echo"false";
//	}
	
?>