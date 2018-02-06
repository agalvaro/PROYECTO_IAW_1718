<?php
$connection = new mysqli("localhost", "root", "Admin2015","web", 3316);


if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
?>
