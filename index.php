<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';
require_once 'helper.php';
ini_set('max_execution_time', '0'); // for infinite time of execution 

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
        $results = $folder_sql->saveUploadedFiles($_FILES['upload_files']);
        if (!empty($results['success'])) {
            $_POST['success']  = "Successfuly uploaded the following file(s):</br>";
            foreach ($results['success'] as $msg) {
                $_POST['success'] .= '<span class="pl-4">'.$msg.'</span></br>';
            }
        } 
        if (!empty($results['error'])) {
            $_POST['danger'] = "File(s) not uploaded:</br>";
            foreach ($results['error'] as $file => $errors) {
                foreach ($errors as $err_msg) {
                    $_POST['danger'] .= '<span class="pl-4">'.$err_msg.'</span></br>';
                }
            }
        } 
        //print "<pre>"; print_r($_POST); exit;
    } else {
        $_POST['warning'] = 'No file selected.';
    }

    if ($_GET['level_code'] == 'PSV') {
        $_GET['m'] = 'PSV';
    } else {
        $_GET['m'] = 'L'.$_GET['level_code'];
    }

# Delete file
} elseif ($_GET['m'] == 'delete') {
    //print "<pre>"; print_r($_POST); exit;    
    if (isset($_POST['archive_file']) && is_file($_POST['archive_file'])) {
        $file = $_POST['archive_file'];
        $data = array(
            'Level_Code' => $_POST['level_code'],
            'Area_Code' => $_POST['area_code'],
            'File_Name' => basename($file),
            'File_Path' => $file,
            'File_Status' => 'A', // Archived
            'Updated_On' => time(),
            'Updated_By' => $_SESSION['arms']['logged']['Task_Force_Key']
        );
        $res = $folder_sql->archiveFile($data);
        if ($res) {            
            $path = AACCUP_FILES.'/ARCHIVE/';
            createDir($path);
            rename($file, $path.'/'.$data['File_Name']);
            $_POST['success'] = 'Successfully archived file '.$data['File_Name'];
        } else {            
            $_POST['danger'] = 'Something went wrong';
        }
        //print "<pre>"; print_r($_POST); exit;         
        if ($_POST['level_code'] == 'PSV') {
            $_GET['m'] = 'PSV';
        } else {
            $_GET['m'] = 'L'.$_POST['level_code'];
        }

    } elseif (isset($_POST['restore_file'])) {
        //print "<pre>"; print_r($_POST); exit; 
        $file = $_POST['File_Path'];
        $fname = basename($file);
        $res = $folder_sql->deleteFile($fname);
        if ($res) {            
            $path = AACCUP_FILES.'/ARCHIVE/';
            $source = $path.$fname;
            //print "<pre>$source - $file\n"; exit;
            if (is_file($source)) {
                rename($source, $file);
                $_POST['success'] = 'Successfully restored file '.$fname;
            } else { 
                $_POST['danger'] = 'The archived file is not found.';
            }
        } else {            
            $_POST['danger'] = 'Something went wrong';
        }
        //print "<pre>"; print_r($_POST); exit; 
        $_GET['m'] = 'archive';
        
    } elseif (isset($_POST['delete_file'])) {
        $file = $_POST['File_Path'];
        $fname = basename($file);
        $res = $folder_sql->deleteFile($fname);
        if ($res) {            
            $path = AACCUP_FILES.'/ARCHIVE/';
            $source = $path.$fname;
            //print "<pre>$source - $file\n"; exit;
            if (is_file($source)) {
                unlink($source);
                if (!is_file($source)) {
                    $_POST['success'] = 'Permanently deleted file '.$fname;
                } else {      
                    $_POST['danger'] = 'Something went wrong';
                }
            } else { 
                $_POST['danger'] = 'The archived file is not found.';
            }
        } else {            
            $_POST['danger'] = 'Something went wrong';
        }
        //print "<pre>"; print_r($_POST); exit;  
        $_GET['m'] = 'archive';
    }
}

$_POST['level_ui'] = '';
# Get Folders Ajax
if ($_GET['m'] == 'area_folders') {
    ini_set('max_execution_time', '0'); // for infinite time of execution 
    $level_code = $_POST['level_code'];
    $area_code = $_POST['area_code'];
    $id = $_POST['id'];    
    //$_SESSION['arms']['level_folders'.$level_code] = array();
    if (!isset($_SESSION['arms']['level_folders'.$level_code][$id])) {
        $_SESSION['arms']['level_folders'.$level_code][$id] = $folder_sql->getAreaTreeData($level_code, $area_code);
    }
    $tree = $_SESSION['arms']['level_folders'.$level_code][$id];    
    echo json_encode($tree);

# Get Folders Ajax
} elseif ($_GET['m'] == 'folders') {
    ini_set('max_execution_time', '0'); // for infinite time of execution 
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
    $_POST['table'] = array(
        'table_headers' => array('Level_Code', 'Area_Code', 'File_Name', 'Deleted_On', 'Deleted_By','Actions'),
        'table_data' => $folder_sql->getArchiveFiles()
    );
    //print "<pre>"; print_r($_POST['table']); exit;
    require_once 'views/ui_archive.php';

# About
} elseif ($_GET['m'] == 'about') {
    require_once 'views/ui_about.php';
# PSV
} elseif ($_GET['m'] == 'PSV') {
    $_POST['level_code'] = 'PSV';
    $_POST['level_ui'] = 'ui_level_psv';

# Level 1
} elseif ($_GET['m'] == 'LI') {    
    $_POST['level_code'] = 'I';
    $_POST['level_ui'] = 'ui_level_1';

# Level 2
} elseif ($_GET['m'] == 'LII') {
    $_POST['level_code'] = 'II';
    $_POST['level_ui'] = 'ui_level_2';

# Level 3
} elseif ($_GET['m'] == 'LIII') {
    $_POST['level_code'] = 'III';
    $_POST['level_ui'] = 'ui_level_3';

# Level 4
} elseif ($_GET['m'] == 'LIV') {
    require_once 'views/ui_level_4.php';

} else {
    require_once 'views/ui_home.php';
}

if ($_POST['level_ui'] != '' && isset($_POST['level_code'])) {  
    $level_code = $_POST['level_code'];

    # Level Area List 
    if (!isset($_SESSION['arms']['area_list'.$level_code])) {
        $_SESSION['arms']['area_list'.$level_code] = array();
    }
    if (empty($_SESSION['arms']['area_list'.$level_code])) {
        $_SESSION['arms']['area_list'.$level_code] = $level_sql->getLevelAreas($level_code);
    }  
     
    if (!isset($_GET['area_code'])) {
        $_GET['area_code'] = '';
        foreach ($_SESSION['arms']['area_list'.$level_code] as $area) {
            $area_code = $area['Area_Code'];
            //if (!isset($_SESSION['arms']['level_folders'.$level_code][$id]) || empty($_SESSION['arms']['level_folders'.$level_code][$id])) {
                $_SESSION['arms']['level_folders'.$level_code][$area_code] = $folder_sql->getAreaTreeData($level_code, $area_code);
            //}
            
            //print "<pre>"; print_R($_SESSION['arms']['level_folders'.$_POST['level_code']]['II']['BS-CRIM']); 
            array_walk_recursive($_SESSION['arms']['level_folders'.$level_code][$area_code], 'checkUploadedFiles', $area);
            //print "<pre>"; print_R($_SESSION['arms']['level_folders'.$_POST['level_code']]['II']['BS-CRIM']); exit;
        }
    } else {
        $area_code = $_GET['area_code'];
        $_SESSION['arms']['level_folders'.$level_code][$area_code] = $folder_sql->getAreaTreeData($level_code, $area_code);
        $area = array(
            'Level_Code' => $level_code,
            'Area_Code' => $area_code,
        );
        array_walk_recursive($_SESSION['arms']['level_folders'.$level_code][$area_code], 'checkUploadedFiles', $area);        
    }
    //print "<pre>"; print_R($_SESSION['arms']['level_folders'.$_POST['level_code']]); exit;
    require_once 'views/'.$_POST['level_ui'].'.php';
}

function checkUploadedFiles(&$item, $key, $area)
{
    global $_TREE_ICONS;
    if ($key == 'nodes') {
        if (is_dir($item)) {
            $files = scandir($item);
            $tree = array();
            foreach($files as $fname) {
                $file = $item."/".$fname;
                if (is_file($file)) {
                    $delete_btn = '';
                    if ($_SESSION['arms']['logged'] != ADMIN_USERNAME && (isset($_SESSION['arms']['logged']['areas'][$area['Area_Code']]))) {
                        $delete_btn = '
                            <span class="float-right">
                                <button type="submit" class="btn btn-warning" name="archive_file"  value="'.$file.'" >ARCHIVE</button>
                            </span>
                        ';
                    }
                    $tree[] = array(
                        'text' => '
                            <form method="POST" action="index.php?m=delete&area_code='.$area['Area_Code'].'" class="m-0 p-0 pl-4">
                                <input type="hidden" name="level_code" value="'.$area['Level_Code'].'" />
                                <input type="hidden" name="area_code" value="'.$area['Area_Code'].'" />
                                <input type="hidden" name="file_path" value="'.$file.'" />
                                <i class="fa-solid fa-file ml-2"></i> <a href="'.$file.'" target="_blank">'.$fname.'</a>
                                '.$delete_btn.'
                            </form>
                        '
                    );
                }
            }
            //print "<pre>$item"; print_r($files); print_r($tree); exit;
            $item = $tree;
        }
    }

}

?>