<?php
init();

function init()
{

    $action = $_REQUEST["q"];
    if (!$action) {
        echo "error";
    }

    if ($action == "read") {
        read();
    } elseif ($action == "add") {
        add();
    } elseif ($action == "remove") {
        remove();
    } elseif ($action == "update") {
        update();
    }
}

function update()
{
    $data = json_decode($_REQUEST["data"]);
    mysqlRe("UPDATE todo SET 
            title='{$data->title}',
            content='{$data->content}' 
            WHERE id={$data->id}");
}

function remove()
{
    $data = json_decode($_REQUEST["data"]);

    mysqlRe("DELETE FROM todo WHERE id='{$data->id}'");
}

function read()
{
    $result = mysqlRe("SELECT * from todo");

    $arr = array();
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $arr[$i] = $row;
        $i++;
    }

    echo json_encode($arr);
}

function add()
{
    $data = json_decode($_REQUEST["data"]);

    mysqlRe("INSERT INTO 
            todo (title, content) 
            VALUES ('{$data->title}','{$data->content}')");
}

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
