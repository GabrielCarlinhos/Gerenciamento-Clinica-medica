<?php
require '../Models/Paciente.php';
$request = json_decode(file_get_contents("php://input"), true);
$paciente = new Paciente($request);
$paciente->dt_nascimento = date_format(date_create_from_format('dmY', $paciente->dt_nascimento), "Y-m-d");
$paciente->create();
