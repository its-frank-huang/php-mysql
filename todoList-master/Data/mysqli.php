<?php
header('Content-type:text/html;charset=utf-8');
/*
 * 创建表
 *
 * CREATE TABLE `user3`(
 * id int unsigned primary key auto_increment,
 * name varchar(64) not null default '',
 * pwd char(32) not null default '',
 * email varchar(64) unique not null,
 * birthday date not null
 * ) charset = utf8 engine = MyISAM;
 *
 * INSERT INTO `user3` VALUES(null,'张三',md5('abc'),'zs@163.com',current_date());
 * INSERT INTO `user3` VALUES(null,'张三',md5('abc'),'zs@163.com',current_date());
 *
 * mysql 1366 不支持中文输入
*/


/*
 * Mysqli
 *
 * @param String host 主机地址
 * @param String username 用户名
 * @param String passwd 密码
 * @param String db_name 数据库名
 * @param String port 端口号(可选)
 *
 * */

// 1.创建mysqli连接

$mysqli = new mysqli('localhost','root','123456','user_test');

//echo "<pre>";
//var_dump($mysqli);

/*
 * 1.1.判断是否连接成功
 *
 * connect_errno 返回错误编码
 * 成功返回 0,失败返回对应错误号
 *
 * connect_error 返回错误信息
 *
 */

if($mysqli->connect_errno){
    die('链接出错,错误信息是:'.$mysqli->connect_error);
}else{
    echo '链接成功';
}

// 2.设置字符集

$mysqli->set_charset('utf8');

// 3.sql语句
// 能使用单引号就使用单引号,单引号不会解析$符,效率会高些

$sql = 'select * from user3';

// 4.执行sql语句
$res = $mysqli->query($sql);

// 5.显示查询数据
// fetch_assoc  返回关联数组

/*
 * mysqli使用细节说明
 *
 * 1.如果执行的是一个dml语句,成功返回true,失败返回false;
 * dml:增删改
 * dql:(查)select
 *
 * $sql = "INSERT INTO `user3` VALUES (null,'wangwu','2000-10-01')";
 * $sql = "UPDATE `user3` set email='aaa@163.com' WHERE id='王五'";
 *
 *
 * if($mysql->query($sql)){
 *     echo `<br> 执行成功`;
 * }else{
 *     echo `<br> 执行失败 sql语句是` . $sql;
 *     echo `<br> 执行失败的原因是` .$mysql->error;
 * }
 *
 * -------------------------------------------------------------------
 *
 * 2.执行dql语句,返回的是 $mysqli->result 结果集
 *
 * --------------------------------------------------------------------
 *
 * 3.取值有四种方法
 *
 * 3.1 $res->fetch_assoc()  返回关联数组 [推荐使用]
 * 3.2 $res->fetch_row()    返回索引数组
 * 3.3 $res->fetch_array()  返回索引数组+关联数组
 * 3.4 $res->fetch_object() 返回对象
 *
 * data_seek() 设置结果集数据指针位置
 * data_seek(0); 相当于放到结果集第一条
 *
 * -------------------------------------------------------------------
 *
 * 4.判断一下是否真正影响我们的表  affected_rows
 *
 * if($mysqli-> affected_rows > 0 ){
 *      echo '改变';
 * }else{
 *      echo '没改变';
 * }
 *
 * -------------------------------------------------------------------
 *
 * 5.获取自增长的ID值 (最后/刚刚插入的值)
 *
 * $mysqli->insert_id;
 *
 * -------------------------------------------------------------------
 *
 *
 */

//while($row = $res->fetch_assoc()){
//    echo '<pre>';
//    var_dump($row);
//    echo 'ID:'.$row['id'];
//}

//while($row = $res->fetch_row()){
//    echo '<pre>';
//    var_dump($row);
//    echo 'ID:'.$row[0];
//}

while($row = $res->fetch_array()){
    echo '<pre>';
    var_dump($row);
//    echo 'ID:'.$row[0];
    echo 'ID:'.$row['id'];
}

// 6.关闭资源

$res->free();
//$res->close();

$mysqli->close();
