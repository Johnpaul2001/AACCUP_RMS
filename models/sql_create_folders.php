<?php

require_once 'config.php';
require_once 'models/db_connect.php';

class SQL_Create_Folders extends DB_Connect {

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_indicators.php';
        $this->folder_sql = new SQL_Indicators;
        require_once 'models/sql_areas.php';
        $this->area_sql = new SQL_Areas;
        require_once 'models/sql_level_areas.php';
        $this->level_sql = new SQL_Level_Areas;

        $this->area_dirs = array();
        $this->param_dirs = array();
        $this->folder_dirs = array();        
    }

    public function getAcademicYearList()
    {

    }

    public function createDefaultFoldersForAY($academic_yr, $structure, $level_area)
    {
        if (preg_match('/\_/', $level_area)) {
            //print "<pre>"; print_r($structure); exit;;
            //$this->academic_yr = trim($academic_yr);
            $this->academic_yr_list = explode(',', $academic_yr);
            $token = explode('_', $level_area);
            $level_code = $token[0];
            $area_code = $token[1];
            if (isset($structure[$area_code])) {
                //print "<pre>$level_code - $area_code\n"; exit;
                $this->createMainFolders($level_code, $area_code, $structure[$area_code]);
            }
        }
    }

    public function createMainFolders($level_code, $area_code, $param_list) 
    {
        $benchmark_codes = array(
            'S' => 'SIP',
            'I' => 'IMP',
            'O' => 'OUT',
        );
        # Area > Program > Parameter > Benchmark > AcademicYear > Indicators (folders)
        $folders = array();
        $path = AACCUP_FILES;        
        $this->createLevelAreaProgramFolders($level_code, $area_code);
        //print "<pre>"; print_r($this->program_dirs); print_r($param_list);  exit;
        if (!empty($this->program_dirs)) {
            foreach ($param_list as $param_code => $folder_list) {
                $this->param_dirs = array();
                foreach ($this->program_dirs as $program_dir) {
                    # Parameter Folder
                    $param_dir = $program_dir.'/PARAM-'.$param_code;
                    //print "<pre>Param: $param_dir\n";
                    createDir($param_dir);
                    if (is_dir($param_dir)) {
                        $this->param_dirs[] = $param_dir;
                    }
                }
                //print "<pre>"; print_r($this->param_dirs); print_r($folder_list);  exit;
                if (!empty($this->param_dirs)) {
                    foreach ($this->param_dirs as $param_dir) {   
                        $this->folder_dirs = array();    
                        foreach ($folder_list as $folder => $subfolders) {           
                            $folder = trim($folder);                            
                            $code = substr($folder, 0, 1);                            
                            if (!isset($benchmark_codes[$code])) {
                                if ($code == '0') {
                                    $code = 'O';
                                } else {
                                    continue;
                                }
                            }
                            $benchmark = $benchmark_codes[$code];

                            # Parameter > Benchmark Folder
                            $benchmark_dir = $param_dir.'/'.$benchmark;
                            createDir($benchmark_dir);
                            if (!is_dir($benchmark_dir)) {
                                continue;
                            }
    

                            foreach ($this->academic_yr_list as $academic_yr) {
                                $academic_yr = trim($academic_yr);
                                if (preg_match('/^\d{4,4}-\d{4,4}$/', $academic_yr)) {

                                    # Parameter > Benchmark > Academic-Year Folder
                                    $acad_year_dir = $benchmark_dir.'/'.$academic_yr;
                                    createDir($acad_year_dir);
                                    if (!is_dir($acad_year_dir)) {
                                        continue;
                                    }  

                                    # Parameter > Benchmark > Academic-Year > Indicator Folder
                                    $folder = preg_replace('/\.$/', '', $folder);
                                    $main_dir = $acad_year_dir.'/'.$folder;
                                    //print "<pre>Main: $main_dir\n";
                                    createDir($main_dir);
                                    if (is_dir($main_dir)) {
                                        $sub1_dir = '';
                                        $base_dir = $main_dir;
                                        //print "<pre>"; print_r($subfolders);  continue;
                                        foreach ($subfolders as $sub) {
                                            $sub[0] = trim($sub[0]);
                                            # First level sub-folder
                                            if (!empty($sub[0])) {
                                                $sub[0] = preg_replace('/\.$/', '', $sub[0]);
                                                $sub1_dir = $main_dir.'/'.$sub[0];
                                                //print "<pre>Sub1 Dir: $sub1_dir\n";
                                                createDir($sub1_dir);
                                                if (is_dir($sub1_dir)) {
                                                    $base_dir = $sub1_dir;
                                                    $this->folder_dirs[] = $sub1_dir;  
                                                }
                                            } elseif (!empty($sub1_dir)) {
                                                $base_dir = $sub1_dir;
                                            }

                                            if (isset($sub[1])) {
                                                $sub[1] = trim($sub[1]);
                                                # Second level sub-folder                                
                                                if (!empty($sub[1])) {
                                                    $sub[1] = preg_replace('/\.$/', '', $sub[1]);
                                                    $sub2_dir = $base_dir.'/'.$sub[1];
                                                    //print "<pre>Sub2 Dir: $sub2_dir\n";
                                                    createDir($sub2_dir);
                                                    if (is_dir($sub2_dir)) {
                                                        $this->folder_dirs[] = $sub2_dir;  
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    public function createLevelAreaProgramFolders($level_code, $area_code)
    {        
        global $_PROGRAMS;
        $this->program_dirs = array();
        $path = AACCUP_FILES;
        # Create Level Folder
        $level_dir = $path.'/LEVEL-'.$level_code;
        //print "<pre>Level: $level_dir\n";
        createDir($level_dir);
        if (is_dir($level_dir)) {
            # Create Level > Area Folder
            $area_dir = $level_dir.'/AREA-'.$area_code;
            //print "<pre>Area: $area_dir\n";
            createDir($area_dir);
            if (is_dir($area_dir)) {
                foreach ($_PROGRAMS as $program_code => $program_name) {
                    # Create Level > Area > Program Folder
                    $program_dir = $area_dir.'/'.$program_code;
                    //print "<pre>Program: $program_dir\n";
                    createDir($program_dir);
                    if (is_dir($program_dir)) {
                        $this->program_dirs[] = $program_dir;
                    }
                }
            }
        }
    }

    public function saveUploadedFiles($files)
    {
        global $_PROGRAMS;
        global $_BENCHMARKS;
    
        $level_code = $_GET['level_code'];
        $area_code = $_GET['area_code'];
        $results = array();
        foreach ($files['tmp_name'] as $i => $file) {
            # Only accept image file
            if (preg_match('/^image/', $files['type'][$i])) {
                $dir = AACCUP_FILES.'/LEVEL-'.$level_code;
                //createDir($dir);
                $fname = $files['name'][$i];
                $token = explode('_', $fname);
    
                # Area
                if (!preg_match('/^AREA-'.$area_code.'/', $token[0])) {
                    $results['error'][$fname][] = "Incorrect AREA Code, should be {$area_code}.";
                    continue;
                }
                $dir .= '/AREA-'.$area_code;           
                //createDir($dir);
    
                # Program
                $program_code = $token[1];
                if (!isset($_PROGRAMS[$program_code])) {
                    $results['error'][$fname][] = "PROGRAM Code ($program_code) is not supported.";
                    continue;
                }
                $dir .= '/'.$program_code;         
                //createDir($dir);
    
                # Parameter
                $param_code = $token[2];
                if (!preg_match('/^PARAM-([A-Z])/', $token[2])) {
                    $results['error'][$fname][] = "Incorrect PARAMETER Code format, should be 'PARAM-x'.";
                    continue;
                }
                $dir .= '/'.$param_code;         
                //createDir($dir);
    
                # Benchmark
                $benchmark_code = $token[3];
                if (!isset($_BENCHMARKS[$benchmark_code])) {
                    $results['error'][$fname][] = "BENCHMARKS Code ($benchmark_code) is not supported.";
                    continue;
                }
                $dir .= '/'.$benchmark_code;         
                //createDir($dir);
    
                # Academic Year
                $academic_yr = $token[4];
                if (!preg_match('/^([0-9]{4,4})-([0-9]{4,4})$/', $token[4])) {
                    $results['error'][$fname][] = "Incorrect ACADEMIC YEAR format, should be '20xx-20xx'.";
                    continue;
                }
                $dir .= '/'.$academic_yr;  
                //print "<pre>$dir\n";  exit;
                if (!is_dir($dir)) {
                    $results['error'][$fname][] = "Indicator folders for Academic Year {$academic_yr} is not yet created. Please contact admin!";
                    continue;
                }
    
                # Indicator
                $indicator_code = $token[5];
                $path = $dir.'/'.$indicator_code;    
                //print "<pre>$path\n";  exit;
                if (!is_dir($path)) {
                    $tmp = explode('.', $indicator_code);
                    $path = $dir.'/'.$tmp[0].'.'.$tmp[1];
                    print "<pre>$path\n";  exit;

                    for ($index=2; $index<count($tmp); $index++) {
                        $path .= '/'.$tmp[$index];
                    }
                    if (!is_dir($path)) {
                        $path = $this->getIndicatorFolder($dir, $indicator_code); 
                    }
                }
                
                if (!is_dir($path)) {
                    $results['error'][$fname][] = "File folder for INDICATOR Code {$indicator_code} does not exist. Please contact admin!";
                    continue;
                }
    
                # Check if existing file
                $new_file = $path.'/'.$fname;
                if (is_file($new_file)) {
                    $results['error'][$fname][] = "Existing file {$fname}.";
                    continue;
                }
                # Copy file
                $success = copy($file, $new_file);
                if ($success) {
                    $results['success'][] = $fname;
                } else {
                    $results['error'][$fname][] = "An error is encountered when uploading the file {$fname}.";
                }
            }
        }
        //print "<pre>"; print_r($results); exit;
    
        return $results;
    }
    
    public function getIndicatorFolder($dir, $indicator_code) 
    {
        $path = '';
        $this->folders = array();
        $this->getIndicatorFolderList($dir, $indicator_code);
        if (isset($this->folders[$indicator_code])) {
            $path = $this->folders[$indicator_code];
        }
    
        return $path;
    }
    
    public function getIndicatorFolderList($dir) 
    {
        $path = rtrim($dir, '/');
        if (is_dir($path)) { 
            $files = scandir($path);
            foreach($files as $file) {
                if ($file != '.' && $file != '..') {
                    $file_path = $path.'/'.$file;  
                    $basename = basename($file);
                    if (is_dir($file_path)) {    
                        $this->folders[$basename] = $file_path;
                        $this->getIndicatorFolderList($file_path);
                    } 
                }
            }
        }
    }    

}

?>