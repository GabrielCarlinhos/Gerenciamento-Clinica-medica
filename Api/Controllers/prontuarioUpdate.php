<?php
require '../Models/Prontuario.php';
$request = json_decode(file_get_contents("php://input"), true);
$prontuario = new Prontuario(($request));
$prontuario->update($_GET['id']);