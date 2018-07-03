<?php
    header("content-type:text/html;charset=utf-8");
    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    $resp = new Resp();
    $eid = $_GET['eid'];
    $essaySql = "select * from essay e left join user u on u.uid = e.uid left join topic t on t.tid = e.tid where eid = $eid";
    $result = $db-> query($essaySql);
    $essay = $result->fetch_object();

    $commentSql = "select * from comment c left join user u on u.uid = c.uid where c.eid = $eid";
    $result = $db-> query($commentSql);
    while($obj = $result->fetch_object()) {
        $arr[] = $obj;
    }


    $resp->data = $essay;
    $resp->arrData = $arr;
    $resp->result = 0;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>