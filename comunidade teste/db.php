<?php

$con = mysqli_connect("localhost", "root", "", "comunidade");

if (!$con) {
    die("Conexão falhou: " . mysqli_connect_error());
}

?>
