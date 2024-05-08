<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "qr-code";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("connection failed : " . mysqli_connect_error());
    }