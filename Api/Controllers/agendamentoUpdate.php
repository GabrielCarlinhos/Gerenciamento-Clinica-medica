
<?php
require '../Models/Agendamento.php';
$request = json_decode(file_get_contents("php://input"), true);
$agendamento = new Agendamento($request);
$agendamento->hr_agendamento = substr_replace($agendamento->hr_agendamento, ':', 2, 0);
$agendamento->dt_agendamento = date_format(date_create_from_format('dmY', $agendamento->dt_agendamento), "Y-m-d");
$agendamento->update($_GET['id']);
