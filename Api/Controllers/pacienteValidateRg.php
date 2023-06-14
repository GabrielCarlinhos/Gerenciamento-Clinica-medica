<?php
require '../Models/Paciente.php';
Paciente::validateDuplicate('nu_rg',$_GET['rg']);