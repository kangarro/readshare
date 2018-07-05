<?php
    header("content-type:text/html;charset=utf-8");

    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    $resp = new Resp();
    session_start();
    $uid = $_SESSION['uid'];
    $sql = "select u.nickname,u.user_profile profile, (select count(1) from user_follow where follow_to_id = $uid) as followerCount, "
    		." (select count(1) from user_follow where follower_id = $uid) as followToCount "
    		." from user u  where u.uid = $uid";
    $result = $db->query($sql)->fetch_object();
    $resp->data = $result;
    $resp->result = 0;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>