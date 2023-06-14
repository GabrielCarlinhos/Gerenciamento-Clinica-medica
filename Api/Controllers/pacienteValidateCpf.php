<?php
require '../Models/Paciente.php';
Paciente::validateDuplicate('nu_cpf',$_GET['cpf']);