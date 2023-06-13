<?php
require '../Models/Doutor.php';

Doutor::validateDuplicate('nu_crm',$_GET['crm']);