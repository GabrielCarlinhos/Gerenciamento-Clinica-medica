<?php
require '../Models/Consulta.php';
$request = json_decode(file_get_contents("php://input"),true);
$consulta = new Consulta($request);
$consulta->create();