<?php
require '../Models/Especialidade.php';

$request = json_decode(file_get_contents('php://input'), 1);
$especialidade = new Especialidade($request);
$especialidade->create();
