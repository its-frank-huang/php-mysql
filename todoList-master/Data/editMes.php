<?php  
    error_reporting(E_ALL ^ E_DEPRECATED);
    $url = "127.0.0.1";//连接数据库的地址 
    $user = "root"; //账号 
    $password = "123456";//密码  
    $con = mysql_connect($url,$user,$password); 
    if(!$con){ die("连接失败".mysql_error());} 
    mysql_select_db("vue_todo"); 

    ///修改数据
    $edit_id=$_GET["todoId"];
    $edit_Text=$_GET["todoText"];  
    $sql="update todo set todoText='$edit_Text' where todoId='$edit_id'";

    echo $sql;

    //执行SQL语句 
    mysql_query($sql,$con); 

    //关闭资源 
    mysql_close($con); 
?> 