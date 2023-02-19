<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once 'config.php';
require_once 'helper.php';

if (!isset($_GET['m'])) {
    $_GET['m'] = 'areas';
}

if ($_GET['m'] == 'areas') {    
    require_once 'models/sql_areas.php';
    $sql = new SQL_Areas;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveAreas($list);
                var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Areas saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_POST['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $sql->getAreasData()
    );
    //print "<pre>"; print_r($_POST['table']); exit;
    require_once 'views/ui_admin_areas.php';

# Area Levels
} elseif ($_GET['m'] == 'level_areas') {
    require_once 'models/sql_level_areas.php';
    $sql = new SQL_Level_Areas;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveLevelAreas($list);
                var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Level Areas saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_POST['table'] = array(
        'table_headers' => $sql->level_areas_columns,
        'table_data' => $sql->getLevelAreaList()
    );
    //print "<pre>"; print_r($_POST['table']); exit;
    require_once 'views/ui_admin_level_areas.php';

# Task Force
} elseif ($_GET['m'] == 'task_force') {
    require_once 'models/sql_taskforce.php';
    $sql = new SQL_TaskForce;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveTaskForce($list);
                //var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Task Force saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_POST['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $sql->getTaskForceData()
    );

    //print "<pre>"; print_r($_POST['table']); exit;
    require_once 'views/ui_admin_task_force.php';

# Parameters
} elseif ($_GET['m'] == 'parameters') {
    require_once 'models/sql_parameters.php';
    $sql = new SQL_Parameters;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveParameters($list);
                var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Parameters saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_POST['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $sql->getParametersData()
    );

    //print "<pre>"; print_r($_POST['table']); exit;
    require_once 'views/ui_admin_parameters.php';

# Benchmarks
} elseif ($_GET['m'] == 'benchmarks') {
    require_once 'views/ui_admin_benchmarks.php';

# Indicators
} elseif ($_GET['m'] == 'indicators') {
    require_once 'models/sql_indicators.php';
    $sql = new SQL_Indicators;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveIndicators($list);
                //var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Indicators saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_POST['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $sql->getIndicatorsData()
    );
    //print "<pre>"; print_r($_POST['table']); exit;
    require_once 'views/ui_admin_indicators.php';

# Programs
} elseif ($_GET['m'] == 'programs') {
    require_once 'views/ui_admin_programs.php';

# Academic Year, Default Folders
} elseif ($_GET['m'] == 'acad_year') {
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;
    if (isset($_POST['create']) && $_POST['create'] == 'ay_folders') {
        //print "<pre>"; print_r($_GET); print_r($_POST);  exit;
        $academic_yr = $_POST['academic_yr'];
        if (empty($academic_yr)) {
            $_POST['danger'] = 'No Academic Year entered.';   
        //} elseif (!preg_match('/^\d{4,4}-\d{4,4}$/', $academic_yr)) {
        //    $_POST['danger'] = 'Incorrect Academic Year format. Follow 20YY-20YY format (e.g 2022-2023).';   
        } else {
            if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
                $csv_file = $_FILES['upload_csv']['tmp_name'];
                //print "<pre>"; print_r($_FILES); exit;
                if (is_file($csv_file)) {
                    $structure = getFolderStructure($csv_file, "\t");
                    require_once 'models/sql_create_folders.php';
                    $sql = new SQL_Create_Folders;
                    $res = $sql->createDefaultFoldersForAY($academic_yr, $structure, $_POST['level_area']);
                }
            } else {
                $_POST['warning'] = 'No file selected.';
            }
            
        }
    }    
    require_once 'models/sql_level_areas.php';
    $area_sql = new SQL_Level_Areas;
    $_POST['level_areas'] = $area_sql->getLevelAreaList();
    //print "<pre>"; print_r($_POST); exit;
    require_once 'views/ui_admin_acad_year.php';

} else {

    require_once 'views/ui_admin_programs.php';
}

?>