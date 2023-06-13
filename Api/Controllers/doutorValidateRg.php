<?php
require '../Models/Doutor.php';
Doutor::validateDuplicate('nu_rg', $_GET['rg']);
