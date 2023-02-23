<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';
require_once 'helper.php';

if (!isset($_GET['m'])) {
    $_GET['m'] = 'home';
}

# Login
if ($_GET['m'] == 'login') {  
    require_once 'views/ui_login.php';
    exit;
    
# Logout
} elseif ($_GET['m'] == 'logout') {
    logout();
}

if (!isset($_SESSION['arms']['logged']) || empty($_SESSION['arms']['logged'])) {
    header('Location: index.php?m=login');
    exit;
}
//print "<pre>"; print_r($_SESSION['arms']); exit;

require_once 'models/sql_level_areas.php';
$level_sql = new SQL_Level_Areas;
require_once 'models/sql_areas.php';
$sql = new SQL_Areas;
require_once 'models/sql_parameters.php';
$param_sql = new SQL_Parameters;
require_once 'models/sql_indicators.php';
$indicator_sql = new SQL_Indicators;
require_once 'models/sql_create_folders.php';
$folder_sql = new SQL_Create_Folders;

# Upload Files
if ($_GET['m'] == 'upload') {    
    if (isset($_FILES['upload_files']) && !empty($_FILES['upload_files']['tmp_name'])) {
        //print "<pre>"; print_r($_FILES); exit;
        $folder_sql->saveUploadedFiles($_FILES['upload_files']);
    } else {
        $_POST['warning'] = 'No file selected.';
    }

    if ($_GET['level_code'] == 'PSV') {
        $_GET['m'] = 'PSV';
    } else {
        $_GET['m'] = 'L'.$_GET['level_code'];
    }
}

# Get Folders Ajax
if ($_GET['m'] == 'folders') {
    //$folder_json = file_get_contents('tree.json');
    //$folders = json_decode($folder_json, true);
    //echo json_encode($folders);

    $folder_json = array();
    if (isset($_POST['path']) && is_dir($_POST['path'])) {
        //$dir = "{$path}/LEVEL-{$level_code}/AREA-{$area_code}";
        $dir = $_POST['path'];
        $folders = recursive_scan($dir);
        $level_code = $_POST['level_code'];
        $area_code = $_POST['area_code'];
        $param_code = $_POST['param_code'];
        //print "<pre> PATH: $dir\n"; print_r($folders); exit;   
        //$_POST['area_parameters'] = $param_sql->getAreaParameters($area_code); 
        $_POST['area_indicators'] = $indicator_sql->getAreaIndicators($area_code);
        //print "<pre>"; print_r($_POST); exit;   
        $folder_json = getIndicatorJSON($folders, $param_code);
    }
    echo json_encode($folder_json);

# Archive
} elseif ($_GET['m'] == 'archive') {
    require_once 'views/ui_archive.php';

# PSV
} elseif ($_GET['m'] == 'PSV') {
    $_POST['level_code'] = 'PSV';
    $_POST['area_list'] = $level_sql->getLevelAreas($_POST['level_code']);
    $_POST['area_folders'] = array(); 
    foreach ($_POST['area_list'] as $area) {    
        $area_code = $area['Area_Code'];
        $_POST['area_parameters'][$area_code] = $param_sql->getAreaParameters($area_code); 
    }
    require_once 'views/ui_level_psv.php';

# Level 1
} elseif ($_GET['m'] == 'LI') {
    $_POST['level_code'] = 'I';
    $_POST['area_list'] = $level_sql->getLevelAreas($_POST['level_code']);
    $_POST['area_folders'] = array(); 
    foreach ($_POST['area_list'] as $area) {    
        $area_code = $area['Area_Code'];
        $_POST['area_parameters'][$area_code] = $param_sql->getAreaParameters($area_code); 
    }
    require_once 'views/ui_level_1.php';

# Level 2
} elseif ($_GET['m'] == 'LII') {
    $_POST['level_code'] = 'II';
    $_POST['area_list'] = $level_sql->getLevelAreas($_POST['level_code']);
    $_POST['area_folders'] = array(); 
    foreach ($_POST['area_list'] as $area) {    
        $area_code = $area['Area_Code'];
        $_POST['area_parameters'][$area_code] = $param_sql->getAreaParameters($area_code); 
    }
    require_once 'views/ui_level_2.php';

# Level 3
} elseif ($_GET['m'] == 'LIII') {
    $_POST['level_code'] = 'III';
    $_POST['area_list'] = $level_sql->getLevelAreas($_POST['level_code']);
    $_POST['area_folders'] = array(); 
    foreach ($_POST['area_list'] as $area) {    
        $area_code = $area['Area_Code'];
        $_POST['area_parameters'][$area_code] = $param_sql->getAreaParameters($area_code); 
    }
    require_once 'views/ui_level_3.php';

# Level 4
} elseif ($_GET['m'] == 'LIV') {
    require_once 'views/ui_level_4.php';

} else {
    require_once 'views/ui_home.php';
}

?>