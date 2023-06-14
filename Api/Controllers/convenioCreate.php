<?php
require '../Models/Convenio.php';
$request = json_decode(file_get_contents('php://input'), true);
$convenio = new Convenio($request);
$convenio->create();
