<?php
    $url = "127.0.0.1";     //连接数据库的地址
    $user = "root";         //账号
    $password = "123456";   //密码
    $con = mysqli_connect($url,$user,$password);

    /*
     * 写成一条方式
     *
     * $link = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');
     */

//    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $password);

    if(!$con){ die("连接失败".mysqli_error());}

    mysqli_select_db($con,"vue_todo");

    //新增数据
//    if(empty($_GET[$todoText])){
//        echo '数据不能为空';
//        exit;
//    }

    // $todoText = $_GET[todoText];
    $time=time();


    $sql = "INSERT INTO todo (todoText,time) VALUES ('$_GET[todoText]',$time)";

    //执行SQL语句 
    mysqli_query($con,$sql);

    //关闭资源 
    mysqli_close($con);
?>
