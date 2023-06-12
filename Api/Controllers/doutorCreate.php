<?php
$request = json_decode(file_get_contents('php://input'), true);
require '../Models/Doutor.php';
$doutor = new Doutor($request);
$doutor->create();