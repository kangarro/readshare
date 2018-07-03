<?php
    header("content-type:text/html;charset=utf-8");
    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    

    $nickname=$_POST['nickname'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    $resp = new Resp();

    if (isset($nickname)) {
        $sql = "INSERT INTO user(username, nickname, password) VALUES('$username','$nickname','$password')";
        $result = $db->query($sql);

        $resp->result = 0;
        
    } else {
        $sql = "select * from user where username='$username' and password='$password'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $resp->data = $result->fetch_object();
            $resp->result = 0;
            //save session on server
            session_start();
            $_SESSION['uid'] = $resp->data->uid;
        } else {
            $resp->data = $result->fetch_object();
            $resp->result = -1;
        }

    }
    // 后面那个参数是为了防止中文乱码
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>