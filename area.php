<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';
require_once 'helper.php';

if ($_GET['m'] == 'area') {    
    require_once 'models/sql_parameters.php';
    $param_sql = new SQL_Parameters;
    $area_code = $_POST['area_code'];
    $_POST['area_parameters'] = $param_sql->getAreaParameters($area_code); 
    require_once 'views/tpl_area.php';
} elseif ($_GET['m'] == 'program') {
    require_once 'views/tpl_params_accordion.php';
}

?>