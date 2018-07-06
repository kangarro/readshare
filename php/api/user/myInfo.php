<?php
    header("content-type:text/html;charset=utf-8");

    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    $resp = new Resp();
    $uidTemp = $_GET['uid'];
    session_start();
    $currentUid = $_SESSION['uid'];
    $uid = 0;
    if (isset($uidTemp)) {
        $uid = $uidTemp;
        $boolSql = "select CASE WHEN count(1) <= 0 THEN 'N' ELSE 'Y' END isFollow from user_follow where follow_to_id = $uidTemp and follower_id = $currentUid";
        $data2 = $db->query($boolSql)->fetch_object()->isFollow;
        $resp->pageData = $data2;

    }else {
        $uid = $currentUid;
    }
    $sql = "select u.nickname,u.user_profile profile, (select count(1) from user_follow where follow_to_id = $uid) as followerCount, "
    		." (select count(1) from user_follow where follower_id = $uid) as followToCount "
    		." from user u  where u.uid = $uid";
    $result = $db->query($sql)->fetch_object();
    $resp->data = $result;
    $resp->result = 0;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>