<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';
require_once 'helper.php';

if (!isset($_GET['m'])) {
    $_GET['m'] = 'areas';
}

require_once 'models/sql_areas.php';
$sql = new SQL_Areas;
if (!isset($_SESSION['arms']['area_list'])) {
    $_SESSION['arms']['area_list'] = array();
}
if (empty($_SESSION['arms']['area_list'])) {
    $_SESSION['arms']['area_list'] = $sql->getAreasData();
} 

require_once 'models/sql_level_areas.php';
$level_sql = new SQL_Level_Areas;

if (!isset($_SESSION['arms']['level_area_list'])) {
    $_SESSION['arms']['level_area_list'] = array();
    $_SESSION['arms']['level_list'] = array();
}
if (empty($_SESSION['arms']['level_area_list'])) {
    $_SESSION['arms']['level_area_list'] = $level_sql->getLevelAreaList();
    $_SESSION['arms']['level_list'] = $level_sql->getLevelList();
}

require 'models/sql_taskforce.php';
$taskforce_sql = new SQL_TaskForce;
if (!isset($_SESSION['arms']['task_force_list'])) {
    $_SESSION['arms']['task_force_list'] = array();
}
if (empty($_SESSION['arms']['task_force_list'])) {
    $_SESSION['arms']['task_force_list'] = $taskforce_sql->getTaskForceData();
} 

require_once 'models/sql_parameters.php';
$param_sql = new SQL_Parameters;
if (!isset($_SESSION['arms']['parameters_list'])) {
    $_SESSION['arms']['parameters_list'] = array();
}
if (empty($_SESSION['arms']['parameters_list'])) {
    $_SESSION['arms']['parameters_list'] = $param_sql->getParametersData();
} 

require_once 'models/sql_indicators.php';
$indicator_sql = new SQL_Indicators;
if (!isset($_SESSION['arms']['indicator_list'])) {
    $_SESSION['arms']['indicator_list'] = array();
    $_SESSION['arms']['indicator_folders'] = array();
}
if (empty($_SESSION['arms']['indicator_list'])) {
    $_SESSION['arms']['indicator_list'] = $indicator_sql->getIndicatorsData();
}

require_once 'models/sql_level_areas.php';
$level_sql = new SQL_Level_Areas;  
if (empty($_SESSION['arms']['level_list'])) {
    $_SESSION['arms']['level_list'] = $level_sql->getLevelList();
}
if (!isset($_SESSION['arms']['program_level_list'])) {
    $_SESSION['arms']['program_level_list'] = array();
}
if (empty($_SESSION['arms']['program_level_list'])) {
    $_SESSION['arms']['program_level_list'] = $level_sql->getProgramLevelList();
}



if ($_GET['m'] == 'areas') {   
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;
    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveAreas($list);
                $_SESSION['arms']['area_list'] = $sql->getAreasData();
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
    if (!isset($_SESSION['arms']['area_list'])) {
        $_SESSION['arms']['area_list'] = array();
    }
    if (empty($_SESSION['arms']['area_list'])) {
        $_SESSION['arms']['area_list'] = $sql->getAreasData();
    } 
    $_POST['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $_SESSION['arms']['area_list']
    );
    //print "<pre>"; print_r($_POST); exit;
    require 'views/ui_admin_areas.php';

# Area Levels
} elseif ($_GET['m'] == 'level_areas') {
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;
    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $level_sql->saveLevelAreas($list);
                $_SESSION['arms']['level_area_list'] = $level_sql->getLevelAreaList();
                $_SESSION['arms']['level_list'] = $level_sql->getLevelList();
                //var_dump($created);
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
    if (!isset($_SESSION['arms']['level_area_list'])) {
        $_SESSION['arms']['level_area_list'] = array();
        $_SESSION['arms']['level_list'] = array();
    }
    if (empty($_SESSION['arms']['level_area_list'])) {
        $_SESSION['arms']['level_area_list'] = $level_sql->getLevelAreaList();
        $_SESSION['arms']['level_list'] = $level_sql->getLevelList();
    }
    $_POST['table'] = array(
        'table_headers' => $level_sql->level_areas_columns,
        'table_data' => $_SESSION['arms']['level_area_list']
    );
    //print "<pre>"; print_r($_POST['table']); exit;
    require 'views/ui_admin_level_areas.php';

# Task Force
} elseif ($_GET['m'] == 'task_force') {  
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;
    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $taskforce_sql->saveTaskForce($list);
                $_SESSION['arms']['task_force_list'] = $taskforce_sql->getTaskForceData();
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
    if (!isset($_SESSION['arms']['task_force_list'])) {
        $_SESSION['arms']['task_force_list'] = array();
    }
    if (empty($_SESSION['arms']['task_force_list'])) {
        $_SESSION['arms']['task_force_list'] = $taskforce_sql->getTaskForceData();
    } 

    $_POST['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $_SESSION['arms']['task_force_list']
    );

    //print "<pre>"; print_r($_POST['table']); exit;
    require 'views/ui_admin_task_force.php';

# Parameters
} elseif ($_GET['m'] == 'parameters') {
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $param_sql->saveParameters($list);
                $_SESSION['arms']['parameters_list'] = $param_sql->getParametersData();
                //var_dump($created);
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
    if (!isset($_SESSION['arms']['parameters_list'])) {
        $_SESSION['arms']['parameters_list'] = array();
    }
    if (empty($_SESSION['arms']['parameters_list'])) {
        $_SESSION['arms']['parameters_list'] = $param_sql->getParametersData();
    } 
    $_POST['table'] = array(
        'table_headers' => $param_sql->tbl_columns,
        'table_data' => $_SESSION['arms']['parameters_list']
    );

    //print "<pre>"; print_r($_POST['table']); exit;
    require 'views/ui_admin_parameters.php';

# Benchmarks
} elseif ($_GET['m'] == 'benchmarks') {
    require 'views/ui_admin_benchmarks.php';

# Indicators
} elseif ($_GET['m'] == 'indicators') {
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;
    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $indicator_sql->saveIndicators($list);
                $_SESSION['arms']['indicator_list'] = $indicator_sql->getIndicatorsData();
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
    if (!isset($_SESSION['arms']['indicator_list'])) {
        $_SESSION['arms']['indicator_list'] = array();
        $_SESSION['arms']['indicator_folders'] = array();
    }
    if (empty($_SESSION['arms']['indicator_list'])) {
        $_SESSION['arms']['indicator_list'] = $indicator_sql->getIndicatorsData();
    }
    $_POST['table'] = array(
        'table_headers' => $indicator_sql->tbl_columns,
        'table_data' => $_SESSION['arms']['indicator_list']
    );
    //print "<pre>"; print_r($_POST['table']); exit;
    require 'views/ui_admin_indicators.php';

# Programs
} elseif ($_GET['m'] == 'programs') {  
    require_once 'models/sql_level_areas.php';
    $level_sql = new SQL_Level_Areas;  
    if (isset($_POST['save_level'])) {
        //print "<pre>"; print_r($_POST); exit;
        $program_code = $_POST['save_level'];
        $created = $level_sql->saveProgramLevel($program_code, $_POST[$program_code.'_Level']);
        $_SESSION['arms']['program_level_list'] = $level_sql->getProgramLevelList();
        if ($created === true) {
            $_POST['success'] = 'Indicators saved.';
        } else {
            $_POST['danger'] = 'Something went wrong.';
        }
    }
    if (empty($_SESSION['arms']['level_list'])) {
        $_SESSION['arms']['level_list'] = $level_sql->getLevelList();
    }
    if (!isset($_SESSION['arms']['program_level_list'])) {
        $_SESSION['arms']['program_level_list'] = array();
    }
    if (empty($_SESSION['arms']['program_level_list'])) {
        $_SESSION['arms']['program_level_list'] = $level_sql->getProgramLevelList();
    }
    //print "<pre>"; print_r($_SESSION['arms']['level_list']); exit;  
    require 'views/ui_admin_programs.php';

# Academic Year, Default Folders
} elseif ($_GET['m'] == 'acad_year') {
    require 'models/sql_create_folders.php';
    $folders_sql = new SQL_Create_Folders;
    

    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;
    if (isset($_POST['create']) && $_POST['create'] == 'ay_folders') {
        //print "<pre>"; print_r($_GET); print_r($_POST);  exit;
        $academic_yr = $_POST['academic_yr'];
        if (empty($academic_yr)) {
            $_POST['danger'] = 'No Academic Year entered.'; 
        } else {     
            //print "<pre>";  print_r($_POST); exit;
            $default_folders = $folders_sql->createProgramDefaultFolders($academic_yr, $_POST['program']);
            $_SESSION['arms']['default_folders_'.$_POST['program']] = $folders_sql->getProgramDefaultFolders($_POST['program']);
        }
    } elseif (!isset($_POST['view'])) {              
        $programs = array_keys($_SESSION['arms']['program_level_list']);   
        $_POST['program'] = $programs[0];
    }

    $_SESSION['arms']['default_folders_'.$_POST['program']] = array();
    if (!isset($_SESSION['arms']['default_folders_'.$_POST['program']])) {
        $_SESSION['arms']['default_folders_'.$_POST['program']] = array();
    }
    if (empty($_SESSION['arms']['default_folders_'.$_POST['program']])) {
        $_SESSION['arms']['default_folders_'.$_POST['program']] = $folders_sql->getProgramDefaultFolders($_POST['program']);
    }
    $_POST['table'] = array(
        'table_headers' => $folders_sql->db_tbl_folders,
        'table_data' => $_SESSION['arms']['default_folders_'.$_POST['program']]
    );
    //print "<pre>"; print_r($_POST['table']); exit;
    require 'views/ui_admin_acad_year.php';

} else {
    require 'views/ui_admin_programs.php';
}

?>