<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/10/19
 * Time: 20:52
 *
 *
 * 编码设置
 *
 * 1.php header(Content-type:text/html;charset=utf-8);
 * 2.php文件编码
 * 3.设置通信编码 setnames
 * 4.数据库
 * 5.表
 *
 * ----------------------------------------------------------------------
 *
 * mysql_connect()
 * 成功返回资源,失败返回false;该函数不在推荐使用,会报警告错误;
 * 加@符就不会报错了;
 *
 *
 * mysqli扩展
 *
 * 基本介绍:
 *
 * 1.mysqli扩展和mysql扩展都可以完成对mysql数据库的做作;
 * 2.mysqli扩展可以看做是mysql扩展的升级版;
 * 3.mysqli扩展的性能比mysql扩展好,现在一般使用mysqli扩展和PDO;(以后不会再项目中使用,PHP7已经干掉);
 * 4.mysqli扩展支持面向对象,也支持面向过程;
 *
 *
 * mysqli OOP(面向对象用法)
 *
 *
 *
 * mysqli 面向过程用法
 *
 * $link = mysqli_connect('localhost','root','123456','my_db');
 *
 *
 * ----------------------------------------------------------------------
 *
 * 解析结果集常用函数
 *
 * mysql_fetch_assoc(); 每次取一条数据,直到位false
 * mysql_fetch_assoc(); 返回关联数组结果集,并继续移动内部数据指针(根据取到的数据一条一条往下读)
 *
 * 通常这样写
 * 	while ( $row = mysqli_fetch_assoc($res)){
 *     $data[] = $row;
 *  }
 *
 *
 * mysql_fetch_array(); 从结果集中取一行作为关联数组/数字数字/二者都是
 *
 *
 * mysql_num_rows(); 取得结果集中的数目(也就是看一共有多少条数据)
 *
 *
 * json_encode(); 将数据以json格式输出返回
 *
 *
 */

$link = @mysql_connect('localhost','root','123456');
//Deprecated: mysql_connect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead in F:\wamp\www\yxapp\vue\test.php on line 25
if(!$link){
    echo '连接失败' ;
}


mysql_select_db('vue_todo');


/*
 * mysqli
 *
 * @param String 主机地址
 * @param String 主机地址
 * @param String 主机地址
 * @param String 主机地址
 * @param String 主机地址
 *
 */
//新的mysqli和有什么区别mysqli_connect？我知道执行查询是不同的;
//例如：mysqli->query()和mysqli_query()
//为什么有两种不同类型的，什么是需要区别？

//https://stackoverflow.com/questions/15707696/new-mysqli-vs-mysqli-connect

//一个用于程序样式编程，另一个用于OOP样式编程。两者都有同样的目的;Open a new connection to the MySQL server
//
//OOP样式用法
//
//$mysqli = new mysqli('localhost', 'my_user', 'my_password', 'my_db');
//程序样式用法
//
//$link = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');

//OOP Style usage
//
//$mysqli = new mysqli('localhost', 'my_user', 'my_password', 'my_db');
//Procedural Style usage
//
//$link = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');

$mysqli = new mysqli('localhost','root','123456','vue_todo');
echo '<pre>';
var_dump($mysqli);