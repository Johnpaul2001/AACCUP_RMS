<?php


function logout()
{
    unset($_SESSION['logged']['arms']);
    $_SESSION['logged']['arms'] = array();
    header('Location: index.php?m=login');
    exit;
}

function hashPassword($pwd)
{
    $hashed = md5('bisu-bc-arms_'.$pwd);

    return $hashed;
}

function getCSVFileData($file, $separator=",") 
{
    $data = array();
    if (is_file($file)) {
        $fd = fopen($file, "r");
        if ($fd == null) {
            die("Command 'fopen' failed for $file.");
        }
        $line = trim(fgets($fd));
        $headers = explode($separator, $line);
        //print "<pre>"; print_r($headers);
        while (!feof($fd)) {
            $line = trim(fgets($fd));
            if (empty($line)) continue;
            $token = explode($separator, $line);
            $row = array();
            foreach ($headers as $i => $header) {
                $row[$header] = isset($token[$i]) ? $token[$i] : '';
            }
            $data[] = $row;
        }
        fclose($fd);
    }

    return $data;
}

function getFoldersFromDir($path) 
{
    $files = scandir($path);
    $folders = array();
    foreach($files as $file) {
        if ($file == '.' || $file == '..') continue;
        if (is_dir($path.'/'.$file)) {
            $folders[] = $file;
        }
    }

    return $folders;
}

function getImagesFromDir($path) 
{
    $files = scandir($path);
    $images = array();
    foreach($files as $file) {
        $fpath = $path.'/'.$file;
        if (is_file($fpath)) {
            $type = mime_content_type($fpath);
            if (preg_match('/^image/', $type)) {
                $base_fn = preg_replace('/\..+$/', '', $file);
                $images[$base_fn] = dirname($fpath).'/'.$file;
            }
        }
    }

    return $images;
}

function getFolderStructure($file, $separator=",")
{
    
    $data = array();
    if (is_file($file)) {
        $fd = fopen($file, "r");
        if ($fd == null) {
            die("Command 'fopen' failed for $file.");
        }
        $line = trim(fgets($fd));
        //$headers = explode($separator, $line);
        while (!feof($fd)) {
            $line = fgets($fd);
            if (empty($line)) continue;
            $token = explode($separator, $line);
            # Area Code
            $area_code = array_shift($token);
            $area_code = trim($area_code);
            if (!empty($area_code)) {
                $area_code_cur = $area_code;
            }
            # Parameter Code
            $param_code = array_shift($token);
            $param_code = trim($param_code);
            if (!empty($param_code)) {
                $param_code_cur = $param_code;
            }
            # Main Folder
            $main_folder = array_shift($token);
            $main_folder = trim($main_folder);
            if (!empty($main_folder)) {
                $main_folder_cur = $main_folder;
            }

            $data[$area_code_cur][$param_code_cur][$main_folder_cur][] = $token;
        }
        fclose($fd);
    }

    return $data;
}

function createDir($dir)
{
    if ($dir != '' && !is_dir($dir)) {
        $ret = mkdir($dir);
        if (!$ret) {
            print "<pre>$dir\n";
        }
    }
}

/**
 * 
 * @function recursive_scan
 * @description Recursively scans a folder and its child folders
 * @param $path :: Path of the folder/file
 * 
 * */
function recursive_scan($path)
{
    $list = array();
    $path = rtrim($path, '/');
    if (is_dir($path)) { 
        $files = scandir($path);
        foreach($files as $file) {
            if ($file != '.' && $file != '..') {
                $file_path = $path.'/'.$file;  
                $basename = basename($file);
                if (is_dir($file_path)) {                     
                    $list[$basename] = recursive_scan($file_path);
                } else {
                    $list[$basename] = $file_path;
                }
            }
        }
    }

    return $list;
}

function getAreaFolderJSON($folders)
{
    global $_PROGRAMS;
    global $_BENCHMARKS;
    global $_TREE_ICONS;
    $folder_json = array();
    foreach ($folders as $program => $program_data) {
        # PROGRAM folders
        $program_json = array();
        $program_json['text'] = $_PROGRAMS[$program];
        $program_json['icon'] = $_TREE_ICONS['PROGRAM'];
        $program_json['nodes'] = array();
        //print "<pre>"; print_r($program_json); continue;
        //$program_data = array();
        foreach ($program_data as $param => $param_data) {
            # PARAMETER folders
            $param_code = preg_replace('/PARAM-/', '', $param);
            $param_json = array();
            $param_json['text'] = 'Parameter '. $param_code.': '.$_POST['area_parameters'][$param_code]['Parameter_Desc'];
            $param_json['icon'] = $_TREE_ICONS['PARAM'];
            $param_json['nodes'] = array();
            //print "<pre>"; print_r($param_json); continue;
            //$param_data = array();
            foreach ($param_data as $benchmark => $benchmark_data) {
                # BENCHMARK folders
                $benchmark_json = array();
                $benchmark_json['text'] = $_BENCHMARKS[$benchmark];
                $benchmark_json['icon'] = $_TREE_ICONS['BENCHMARK'];
                $benchmark_json['nodes'] = array();
                //print "<pre>"; print_r($benchmark_json); continue;
                //$benchmark_data = array();
                foreach ($benchmark_data as $ay => $ay_data) {
                    # ACADEMIC YEAR folders
                    $ay_json = array();
                    $ay_json['text'] = 'A.Y. '.$ay;
                    $ay_json['icon'] = $_TREE_ICONS['ACAD_YEAR'];
                    foreach ($ay_data as $indicator => $indicator_data) {
                        # INDICATOR folders
                        if (is_array($indicator_data)) {    
                            $nodes = getIndicatorJSON($indicator_data, $param_code);            
                            if (!empty($nodes)) {
                                $ay_json['nodes'] = $nodes;    
                            }
                        }
                    }
                    $benchmark_json['nodes'][] = $ay_json;
                }
                $param_json['nodes'][] = $benchmark_json;
            }
            $program_json['nodes'][] = $param_json;
        }
        $folder_json[] = $program_json;
    }
    //print "<pre>"; print_r($folder_json); exit;

    return $folder_json;
}

function getIndicatorJSON($data, $param_code)
{
    global $_TREE_ICONS;
    $indicator_json = array();   
    foreach ($data as $indicator => $indicator_data) {
        # SUB-INDICATOR folders
        $code = $param_code.'_'.$indicator;
        $json = array();
        if (is_array($indicator_data)) {  
            if (isset($_POST['area_indicators'][$code])) {
                $json['text'] = $indicator.' '.$_POST['area_indicators'][$code]['Indicator_Desc'];
            } else {
                $json['text'] = $indicator;
            }
            $json['icon'] = $_TREE_ICONS['INDICATOR'];     
            $nodes = getIndicatorJSON($indicator_data, $param_code);            
            if (!empty($nodes)) {
                $json['nodes'] = $nodes;    
            }          
        } else {
            $fname = basename($indicator_data);
            $json['text'] = '
                    <a href="'.$indicator_data.'">'.$fname.'</a>
                    <span class="float-right">
                        <button type="submit" class="btn btn-danger" name="delete" value="'.$indicator_data.'" >DELETE</button>
                    </span>
            ';
            $json['icon'] = $_TREE_ICONS['FILE']; 
        }
        $indicator_json[] = $json;
    }

    return $indicator_json;
}

?>