<?php
require '../Models/Doutor.php';

Doutor::validateDuplicate('nu_cpf',$_GET['cpf']);