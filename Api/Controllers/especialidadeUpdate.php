<?php
require '../Models/Especialidade.php';
$request = json_decode(file_get_contents('php://input'), true);
$especialidade = new Especialidade($request);
$especialidade->update($_GET['id']);