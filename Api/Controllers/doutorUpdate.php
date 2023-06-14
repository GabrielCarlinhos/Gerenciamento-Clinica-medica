<?php
require '../Models/Doutor.php';
$request = json_decode(file_get_contents('php://input'),true);
$doutor = new Doutor($request);
$doutor->update($_GET['crm']);