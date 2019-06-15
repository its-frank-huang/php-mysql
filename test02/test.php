<?php
// 启动 函数
init();
// 启动函数
function init()
{
    // 获取行为
    $action = $_REQUEST["q"];
    // 如果没有行为则返回error
    if (!$action) {
        echo "error";
    }
    // 根据行为调用函数
    // 读取与搜索 为同一个函数 用bool值区分
    if ($action == "read") {
        read(false);
    } elseif ($action == "add") {
        add();
    } elseif ($action == "remove") {
        remove();
    } elseif ($action == "update") {
        update();
    } elseif ($action == "search") {
        read(true);
    }
}
// 更新函数
function update()
{   
    // 将数据解析并存入变量
    $data = json_decode($_REQUEST["data"]);
    // 数据库请求，将更新的数据放入sql
    mysqlRe("UPDATE todo SET 
            title='{$data->title}',
            content='{$data->content}' 
            WHERE id={$data->id}");
}
// 删除函数
function remove()
{
    // 将数据解析并存入变量
    $data = json_decode($_REQUEST["data"]);
    // 数据库请求，将更新的数据放入sql
    mysqlRe("DELETE FROM todo WHERE id='{$data->id}'");
}
// 读取或搜索函数
function read($bool)
{
    // 如果是搜索
    if ($bool) {
        // 将数据解析并存入变量
        $data = json_decode($_REQUEST["data"]);
        // 发送数据库请求，并将返回结果存入result变量
        $result = mysqlRe("SELECT * FROM todo WHERE id={$data->query}");
        // 如果没搜索到数据则返回错误
        if ($result->num_rows == 0) {
            echo "error";
        };
    } else {
        // 如果是读取
        // 发送数据库请求，并将返回结果存入result变量
        $result = mysqlRe("SELECT * from todo");
    }
    // 设置数组变量
    $arr = array();
    $i = 0;
    // 将返回的每一条数据装填到数组
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[$i] = $row;
        $i++;
    }
    // json格式化数组并返回数组
    echo json_encode($arr);
}
// 添加函数
function add()
{
    // 将数据解析并存入变量
    $data = json_decode($_REQUEST["data"]);
    // 数据库请求，将更新的数据放入sql
    mysqlRe("INSERT INTO 
            todo (title, content) 
            VALUES ('{$data->title}','{$data->content}')");
}
// 数据库请求函数
function mysqlRe($sql)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test-todo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn->query($sql);

    $conn->close();
};
