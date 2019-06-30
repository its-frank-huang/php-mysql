<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/10/20
 * Time: 22:38
 */

$link = new mysqli('localhost','root','123456','vue_todo');
$link->set_charset('utf8');

//删除数据
$del_id=$_GET["todoId"];
$sql="delete from todo where todoId='$del_id'";

//$link->query($sql);



if($link->query($sql)){
    echo '执行成功!';
}else{
    echo '执行失败,sql语句是:'.$sql;
    echo '执行失败的原因是:'.$link->error;
//    执行失败,sql语句是:delete from todoTable where todoId='9'执行失败的原因是:Table 'vue_todo.todotable' doesn't exist
}

/*
 * mysql_num_rows() 和 mysql_affected_rows()的作用和区别?
 *
 * mysql_num_rows() 只对SELECT语句有效
 * 返回结果集中行的数目
 *
 * mysql_affected_rows() 对INSERT、UPDATE、DELETE操作所影响到的数目，都有效
 * 返回结果集中所影响的行的数目
 *
 * 相同点:都对mysql_query()结果集进行操作
 *
 */

echo $link->affected_rows; // 1


if($link->affected_rows > 0 ){
    echo '改变';
}else{
    echo '没改变';
}

$link->close();
