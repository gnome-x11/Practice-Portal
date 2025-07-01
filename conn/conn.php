<?php

    $servername = "localhost";
    $username = "root";
    $password = '';
    $db_name = "32074_tunasan";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if ($conn -> connect_errno) {
       die ("Connection error . $conn->connect_error");
    }

    echo "Connected Successfully";

?>
