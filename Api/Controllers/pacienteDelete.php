<?php
require '../Models/Paciente.php';
Paciente::delete($_GET['id']);