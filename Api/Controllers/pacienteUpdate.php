<?php
require '../Models/Paciente.php';
$request = json_decode(file_get_contents("php://input"), true);
$paciente = new Paciente($request);
$paciente->update($_GET['id']);