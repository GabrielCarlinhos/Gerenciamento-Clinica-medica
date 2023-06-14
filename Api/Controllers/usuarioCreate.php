<?php
require '../Models/Usuario.php';
$request = json_decode(file_get_contents('php://input'), true);
$usuario = new Usuario($request);
$usuario->create();
