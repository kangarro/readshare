<?php
    header("content-type:text/html;charset=utf-8");

    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    $sql="select * from topic";

//    $searchKey = $_GET['searchKey'];
//    if (isset($searchKey)) {
//        $sql = $sql + " WHERE title like '%searchKey%' "
//    }
    $resp = new Resp();
    $result = $db->query($sql);
    while($obj = $result->fetch_object()){
        $arr[]=$obj;
    }

    $resp->data = $arr;
    $resp->result = 0;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>