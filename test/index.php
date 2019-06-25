<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php

    $servername = "my9866499.xincache2.cn";
    $username = "my9866499";
    $password = "rootroot";
    $dbname = "my9866499";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * from todo");

    $arr = array();
    $i = 0;
    // 将返回的每一条数据装填到数组
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[$i] = $row;
        $i++;
    }
    // json格式化数组并返回数组
    echo json_encode($arr);

    $conn->close();
    ?>
</body>

</html>