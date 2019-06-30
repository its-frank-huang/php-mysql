<?php
$link = new mysqli('localhost','root','123456','vue_todo');

if($link->connect_errno){
    echo '链接失败,错误信息是:'.$link->connect_error;
}
//else{
//    echo '链接成功!';
//}

$link->set_charset('utf8');

$sql = 'select * from `todo`';

$res = $link->query($sql);

while($row = $res->fetch_assoc()){
    $data[] = $row;
//    echo '<pre>';
//    var_dump($row);
//    echo json_encode($row);
}
//echo '<pre>';
echo json_encode($data);

$res->free();
$link->close();


//    $url = "127.0.0.1";//连接数据库的地址
//    $user = "root"; //账号
//    $password = "123456";//密码
//    $con = mysqli_connect($url,$user,$password);
//    if(!$con){ die("连接失败".mysql_error());}
//    mysqli_select_db($con,"vue_todo");

//    //查询数据
//    $sql="select * from `todo`";
//
//    //执行SQL语句
//    // mysql_query($sql,$con);
//    $res = mysqli_query($con,$sql);
//    // echo $res;
//    // $row=mysql_fetch_array($res);
//    // var_dump($row);
//    // echo json_encode($row);
//
//	if ($res && mysqli_num_rows($res)) {
//		while ( $row = mysqli_fetch_assoc($res)){
//			$data[] = $row;
//		}
//		echo json_encode($data);
//	};
//
//    //关闭资源
//    mysqli_close($con);
?> 