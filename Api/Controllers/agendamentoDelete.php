<?php
require '../Models/Agendamento.php';
Agendamento::delete($_GET['id'],$_GET['motivo']);