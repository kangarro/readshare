<?php
	include'connectsql.php';
	$topic=$_GET['topic'];
	$sql="select essay.content,essay.writetime,essay.writer,topic.special from essay,topic_essay,topic where essay.eid=topic_essay.eid and topic_essay.tid=topic.tid and topic.special='$topic'";
	$result=$db->query($sql);
	//属于多类种如何处理
	if($obj=$result->fetch_object()){
		while($obj=$result->fetch_object()){
			$content[]=$obj->content.",".$obj->writetime.",".$obj->writer.",".$obj->special;
		}
		echo json_encode($content);
	}else{
		echo"false";
	}
	

?>