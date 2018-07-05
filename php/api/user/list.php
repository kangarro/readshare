<?php
	header("content-type:text/html;charset=utf-8");

    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    // var_dump($sql);
    $type = $_GET['type'];
    session_start();
    $uid = $_SESSION['uid'];
    $sql = "";
    if ($type == '1'){
    	
    	$sql = $sql."select u.nickname, u.uid, CASE WHEN uf2.follow_to_id IS NULL THEN 'N' ELSE 'Y' END isFollow from user u inner join user_follow uf on uf.follower_id = u.uid "
    			."left join user_follow uf2 on uf.follower_id = uf2.follow_to_id and uf2.follower_id = $uid where  uf.follow_to_id = $uid";
	} else {
		$sql = $sql."select u.nickname, u.uid from user u inner join user_follow uf on uf.follow_to_id = u.uid where uf.follower_id = $uid";
	}
	$resp = new Resp();
    $result = $db->query($sql);
    while($obj = $result->fetch_object()){
        $arr[]=$obj;
    }

    $resp->data = $arr;
    $resp->result = 0;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>