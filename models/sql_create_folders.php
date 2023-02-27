<?php

require_once 'config.php';
require_once 'models/db_connect.php';

class SQL_Create_Folders extends DB_Connect {

    
    public $db_tbl_folders = array(
        'Level_Code', 
        'Area_Code', 
        'Program_Code', 
        'Parameter_Code', 
        'Benchmark_Code', 
        'Academic_Year', 
        'Folders'
    );

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_indicators.php';
        $this->folder_sql = new SQL_Indicators;
        require_once 'models/sql_areas.php';
        $this->area_sql = new SQL_Areas;
        require_once 'models/sql_level_areas.php';
        $this->level_sql = new SQL_Level_Areas;
        require_once 'models/sql_indicators.php';
        $this->indicator_sql = new SQL_Indicators;

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
            $dir = AACCUP_FILES.'/LEVEL-'.$level_code;
            //createDir($dir);
            $fname = $files['name'][$i];
            $token = explode('_', $fname);

            # Area
            if (!preg_match('/^AREA-'.$area_code.'/', $token[0])) {
                //$results['error'][$fname][] = "Invalid file name. Incorrect AREA Code, should be {$area_code}.";
                $results['error'][$fname][] = "File '{$fname}' has invalid filename format. Invalid file name. Incorrect AREA Code, should be {$area_code}.";
                continue;
            }
            $dir .= '/AREA-'.$area_code;           
            //createDir($dir);

            # Program
            $program_code = $token[1];
            if (!isset($_PROGRAMS[$program_code])) {
                //$results['error'][$fname][] = "PROGRAM Code ($program_code) is not supported.";
                $results['error'][$fname][] = "File '{$fname}' has invalid filename format. PROGRAM Code ($program_code) is not supported.";
                continue;
            }
            $dir .= '/'.$program_code;         
            //createDir($dir);

            # Parameter
            $param_code = $token[2];
            if (!preg_match('/^PARAM-([A-Z])/', $token[2])) {
                //$results['error'][$fname][] = "Incorrect PARAMETER Code format, should be 'PARAM-x'.";
                $results['error'][$fname][] = "File '{$fname}' has invalid filename format. Incorrect PARAMETER Code format, should be 'PARAM-x'.";
                continue;
            }
            $dir .= '/'.$param_code;         
            //createDir($dir);

            # Benchmark
            $benchmark_code = $token[3];
            if (!isset($_BENCHMARKS[$benchmark_code])) {
                //$results['error'][$fname][] = "BENCHMARKS Code ($benchmark_code) is not supported.";
                $results['error'][$fname][] = "File '{$fname}' has invalid filename format. BENCHMARKS Code ($benchmark_code) is not supported.";
                continue;
            }
            $dir .= '/'.$benchmark_code;         
            //createDir($dir);

            # Academic Year
            $academic_yr = $token[4];
            if (!preg_match('/^([0-9]{4,4})-([0-9]{4,4})$/', $token[4])) {
                //$results['error'][$fname][] = "Incorrect ACADEMIC YEAR format, should be '20xx-20xx'.";
                $results['error'][$fname][] = "File '{$fname}' has invalid filename format. Incorrect ACADEMIC YEAR format, should be '20xx-20xx'.";
                continue;
            }
            $dir .= '/'.$academic_yr;  
            //print "<pre>$dir\n";  exit;
            if (!is_dir($dir)) {
                $results['error'][$fname][] = "Indicator folders for Academic Year {$academic_yr} is not yet created. Please contact admin!";
                continue;
            }

            # Indicator
            $indicator_code = preg_replace('/\.pdf$/', '', $token[5]);
            $path = $dir.'/'.$indicator_code;    
            //print "<pre>$path\n";  exit;
            if (!is_dir($path)) {
                $tmp = explode('.', $indicator_code);
                $base_dir = $tmp[0].'.'.$tmp[1];
                $path = $dir.'/'.$base_dir;

                for ($index=2; $index<count($tmp); $index++) {
                    $base_dir = $base_dir.'.'.$tmp[$index];
                    $path .= '/'.$base_dir;
                }
                if (!is_dir($path)) {
                    $path = $this->getIndicatorFolder($dir, $indicator_code); 
                } 
            }
            
            if (!is_dir($path)) {
                $results['error'][$fname][] = "INDICATOR Code {$indicator_code} for {$fname} does not exist. Please contact admin!";
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

    public function createProgramDefaultFolders($academic_years, $program_code) 
    {
        global $_BENCHMARKS;
        global $_PROGRAMS;
        global $_TREE_ICONS;
        $path = AACCUP_FILES;      
        require_once 'models/sql_parameters.php';
        $param_sql = new SQL_Parameters;               

        $level_code = $_SESSION['arms']['program_level_list'][$program_code];
        $area_list = $this->level_sql->getLevelAreas($level_code);
        $ay_list = explode(',', $academic_years);            
        $values = array();
        $values['Level_Code'] = $level_code; 
        $values['Program_Code'] = $program_code;
        foreach ($area_list as $area) {
            $area_code = $area['Area_Code'];
            $values['Area_Code'] = $area['Area_Code'];
            $dir  = $path.'/LEVEL-'.$level_code;
            $dir .= '/AREA-'.$area['Area_Code'];
            //print "<pre>$dir\n"; 
            createDir($dir);
            $dir .= '/'.$program_code;
            //print "<pre>$dir\n"; 
            createDir($dir);
            $program_dir = $dir;  
            $parameters = $param_sql->getAreaParameters($area['Area_Code']);  
            $param_tree = array();
            $param_i = 0;
            foreach ($parameters as $param_code => $param) {       
                $param_code = $param['Parameter_Code'];
                $values['Parameter_Code'] = $param_code;
                $indicators = $this->indicator_sql->getIndicatorData($param['Parameter_Key']);
                $dir = $program_dir.'/PARAM-'.$param_code;
                //print "<pre>$dir\n"; 
                createDir($dir);
                $param_dir = $dir;
                $indicator_tree_list = array();
                foreach ($indicators as $indicator) {  
                    //print "<pre>Indicator\n"; print_r($indicator);
                    $benchmark_code = $indicator['Benchmark_Code'];
                    $values['Benchmark_Code'] = $benchmark_code;
                    $dir = $param_dir.'/'.$benchmark_code;
                    //print "<pre>$dir\n"; 
                    createDir($dir);       
                    $benchmark_dir = $dir;  

                    $folders = json_decode($indicator['Indicator_Folder'], true);  
                    //print "<pre>Folders\n"; print_r($folders);
                    $acad_yr_list = array();
                    foreach ($ay_list as $acad_yr) {
                        $acad_yr = trim($acad_yr);
                        if (preg_match('/^\d{4,4}-\d{4,4}$/', $acad_yr)) {
                            $values['Academic_Year'] = $acad_yr;
                            $default_folders[$program_code]['PARAM-'.$param_code][$benchmark_code][$acad_yr] = array(); 
                            $dir = $benchmark_dir.'/'.$acad_yr;
                            //print "<pre>$dir\n"; 
                            createDir($dir);        
                            $acadyr_dir = $dir;
                            $values['Folders'] = '';
                            $parent_indicator = '-';
                            foreach ($folders as $folder) {
                                $folder = rtrim($folder, '.');
                                $dir = $acadyr_dir.'/'.$folder;
                                //print "<pre>$dir\n"; 
                                createDir($dir);       
                                $indicator_dir = $dir;
                                $values['Folders'] = $dir;
                                $values['Folder_Unique'] = md5($values['Folders']);                                
                                $values['Indicator_Code'] = $parent_indicator;
                                $base_code = basename($folder);
                                $indicator_tree_list[$indicator['Benchmark_Code']][$acad_yr][$parent_indicator][$dir] = $dir;
                                //print "<pre>"; print_r($values);        
                                $this->saveDefaultFolders($values);
                                $parent_indicator = $base_code;
                            }
                            $acad_yr_list[] = $acad_yr;
                        }
                    }
                }      
                $this->parameter_key = $param['Parameter_Key'];
                //print "<pre>"; print_r($indicator_tree_list); exit;    
                $param_tree[$param_i] = array(
                    'text' => 'Parameter '.$param_code.': '.$param['Parameter_Desc'],
                    'icon' => $_TREE_ICONS['PARAM'],
                    'nodes' => array()
                );
                $param_tree[$param_i]['nodes'][] = array(
                    'text' => 'SIP: '.$_BENCHMARKS['SIP'],
                    'icon' => $_TREE_ICONS['BENCHMARK'],
                    'nodes' => $this->getBenchmarkTreeData($indicator_tree_list['SIP'])
                );
                $param_tree[$param_i]['nodes'][] = array(
                    'text' => 'IMP: '.$_BENCHMARKS['IMP'],
                    'icon' => $_TREE_ICONS['BENCHMARK'],
                    'nodes' => $this->getBenchmarkTreeData($indicator_tree_list['IMP'])
                );
                $param_tree[$param_i]['nodes'][] = array(
                    'text' => 'OUT: '.$_BENCHMARKS['OUT'],
                    'icon' => $_TREE_ICONS['BENCHMARK'],
                    'nodes' => $this->getBenchmarkTreeData($indicator_tree_list['OUT'])
                ); 
                //print "<pre>"; print_r($param_tree); exit;    
                $param_i++;
            }
            $program_tree = array(
                'text' => $_PROGRAMS[$program_code],
                'icon' => $_TREE_ICONS['PROGRAM'],
                'nodes' => $param_tree
            );
            //print "<pre>"; print_r($program_tree); exit;   
            $this->saveAreaTreeData($level_code, $area_code, $program_code, $program_tree);
        } 
    }   

    public function getBenchmarkTreeData($data)
    {
        global $_TREE_ICONS;
        $tree = array();
        foreach ($data as $ay => $ay_tree) {    
            $tree[] = array(
                'text' => 'A.Y.'.$ay,
                'icon' => $_TREE_ICONS['ACAD_YEAR'],
                'nodes' => $this->getIndicatorTreeData($ay_tree, '-')
            );
        }

        return $tree;
    }

    public function getIndicatorTreeData($data, $parent_code='-')
    {        
        global $_TREE_ICONS;

        $tree = array();        
        $i = 0;
        foreach ($data[$parent_code] as $folder) {  
            $code = basename($folder);
            $indicator_desc = $this->indicator_sql->getIndicatorDesc($this->parameter_key, $code);
            $text = $code.' '.$indicator_desc;
            if (isset($data[$code])) {
                // Has sub folder
                $tree[] = array(
                    'text' => $text,
                    'icon' => $_TREE_ICONS['INDICATOR'],
                    'nodes' => $this->getIndicatorTreeData($data, $code)
                );
            } else {
                $tree[] = array(
                    'text' => $text,
                    'icon' => $_TREE_ICONS['INDICATOR'],
                    'class' => 'file-folder',
                    'id' => $folder,
                    'nodes' => $folder
                );
            }

        }

        return $tree;
    }

    public function getDefaultFolderKey($values)
    {
        $sql = "
            SELECT * 
            FROM folders
            WHERE Folder_Unique = '{$values['Folder_Unique']}'
                AND Academic_Year = '{$values['Academic_Year']}'
                AND Level_Code = '{$values['Level_Code']}'
                AND Area_Code = '{$values['Area_Code']}'
                AND Program_Code = '{$values['Program_Code']}'
                AND Parameter_Code = '{$values['Parameter_Code']}'
                AND Benchmark_Code = '{$values['Benchmark_Code']}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Folder_Key'];
        }

        return $key;
    } 

    public function saveDefaultFolders($values)
    {
        $table = 'folders';
        $columns = $this->db_tbl_folders;
        $columns[] = 'Indicator_Code';
        $columns[] = 'Folder_Unique';
        $data = array();
        $key = $this->getDefaultFolderKey($values);
        if ($key < 1) {
            //print "<pre>"; print_r($values); exit;
            $row = array();
            foreach ($columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
            //print "<pre>INSERT: "; print_r($values); print_r($data); print_r($columns);
            $res = $this->insertTableRow($table, $columns, $data);    
            //var_dump($res);
        } else {
            $data['Folders'] = $values['Folders'];
            $and = array();
            foreach ($values as $col => $val) {
                if ($col == 'Folders' || $col == 'Folder_Unique') continue;
                $and[$col] = "{$col}='{$val}'";
            }
            //print "<pre>UPDATE: "; print_r($values); print_r($data); print_r($columns); print_r($and);
            $res = $this->updateTableRow($table, array('Folders'), $data, 1, '', $and);
            //var_dump($res);
        }
    } 

    public function getAreaTreeKey($values)
    {
        $sql = "
            SELECT * 
            FROM area_trees
            WHERE Level_Code = '{$values['Level_Code']}'
                AND Area_Code = '{$values['Area_Code']}'
                AND Program_Code = '{$values['Program_Code']}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Area_Tree_Key'];
        }

        return $key;
    } 

    public function saveAreaTreeData($level_code, $area_code, $program_code, $program_tree)
    {
        $values = array(
            'Level_Code' => $level_code,
            'Area_Code' => $area_code,
            'Program_Code' => $program_code,
            'Tree_Json' => json_encode($program_tree),
        );
        $table = 'area_trees';
        $columns = array_keys($values);
        $data = array();
        $key = $this->getAreaTreeKey($values);
        if ($key < 1) {
            //print "<pre>"; print_r($values); exit;
            $row = array();
            foreach ($columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
            //print "<pre>INSERT: "; print_r($values); print_r($data); print_r($columns);
            $res = $this->insertTableRow($table, $columns, $data);    
            //var_dump($res);
        } else {
            $data['Tree_Json'] = $values['Tree_Json'];
            $and = array();
            foreach ($values as $col => $val) {
                if ($col == 'Tree_Json') continue;
                $and[$col] = "{$col}='{$val}'";
            }
            //print "<pre>UPDATE: "; print_r($values); print_r($data); print_r($columns); print_r($and);
            $res = $this->updateTableRow($table, array('Tree_Json'), $data, 1, '', $and);
            //var_dump($res);
        }
    } 

    public function getAreaTreeData($level_code, $area_code)
    {
        $sql = "
            SELECT * 
            FROM area_trees
            WHERE Level_Code = '{$level_code}'
                AND Area_Code = '{$area_code}'
            ORDER by Program_Code
        ";
        $data = $this->getDataFromTable($sql);   
        //print "<pre>< $sql\n";  print_R($data); exit;
        $tree = array();
        foreach ($data as $row) {
            //$id = 'area_'.$level_code.'_'.$row['Area_Code'];
            $json = json_decode($row['Tree_Json'], true);
            $tree[$row['Program_Code']] = $json['nodes'];
        }

        return $tree;
    }

    public function getDefaultFolders($program_code)
    {
        $sql = "
            SELECT * 
            FROM folders
            WHERE Level_Code = '{$level_code}'
                AND Area_Code = '{$area_code}'
                AND Program_Code = '{$program_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Folder_Key'];
        }

        return $key;
    } 

    public function getProgramDefaultFolders($program_code)
    {
        $sql = "
            SELECT * 
            FROM folders
            WHERE Program_Code = '{$program_code}'
            ORDER BY Academic_Year, Folder_Key
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function getIndicatorFolderTree($level_code, $area_code, $id)
    {        
        global $_TREE_ICONS;
        global $_BENCHMARKS;
        $_SESSION['arms']['level_folders'.$level_code][$id] = array();

        require_once 'models/sql_level_areas.php';
        $level_sql = new SQL_Level_Areas;
        require_once 'models/sql_parameters.php';
        $param_sql = new SQL_Parameters;
        

        $programs = $level_sql->getLevelPrograms($level_code);  
        $_SESSION['arms']['level_folders'.$level_code][$id] = array();
        foreach ($programs as $program_code => $program_name) {
            # TREE Area Program level
            $parameters = $param_sql->getAreaParameters($area_code); 
            if (is_array($parameters) && !empty($parameters)) {
                $param_tree = array();
                foreach ($parameters as $param) {
                    # TREE Paramater Level
                    $parameter_code = $param['Parameter_Code'];
                    $benchmark_tree = array();
                    $param_text = $program_code;
                    foreach ($_BENCHMARKS as $benchmark_code => $benchmark_name) {
                        # TREE Benchmark Level
                        $acadyr_tree = array();
                        $benchmark_text = $param_text.' > Param '.$parameter_code.' > '.$benchmark_code;  
                        /*
                        $sql = "
                            SELECT *
                            FROM indicators
                            WHERE Parameter_Key = {$param['Parameter_Key']}
                                AND Benchmark_Code = '{$benchmark_code}'
                            ORDER BY Indicator_Code
                        ";
                        */
                            
                        $base_sql = "
                            SELECT * 
                            FROM folders 
                            WHERE Level_Code = '{$level_code}'
                                AND Area_Code = '{$area_code}'
                                AND Program_Code = '{$program_code}'
                                AND Parameter_Code = '{$parameter_code}'
                                AND Benchmark_Code = '{$benchmark_code}'
                        ";
                        $sql = $base_sql ."
                                AND Indicator_Code = ''
                            ORDER BY Indicator_Code
                        ";
                        $data = $this->getDataFromTable($sql);
                        foreach ($data as $row) {   
                            $ay = $row['Academic_Year'];
                            if (!isset($acadyr_tree[$ay])) {
                                $acadyr_tree[$ay] = array();
                                $acadyr_tree[$ay] = array(
                                    'text' => $benchmark_text.' > A.Y. '.$ay,
                                    'icon' => $_TREE_ICONS['ACAD_YEAR'],
                                    'nodes' => array()
                                );
                            }
                            $indicator_code = basename($row['Folders']);
                            $indicator_desc = $this->indicator_sql->getIndicatorDesc($param['Parameter_Key'], $indicator_code);
                            $acadyr_tree[$ay]['nodes'][] = array(
                                'text' => $indicator_code.' '.$indicator_desc,
                                'icon' => $_TREE_ICONS['INDICATOR'],
                                'nodes' => $this->getSubIndicatorFolders($base_sql, $param['Parameter_Key'], $indicator_code)
                            );

                        }

                        if (empty($acadyr_tree)) {
                            $benchmark_tree[] = array(
                                'text' => $benchmark_text.': '.$benchmark_name,
                                'icon' => $_TREE_ICONS['BENCHMARK']
                            );
                        } else {
                            $benchmark_tree[] = array(
                                'text' => $benchmark_text,
                                'icon' => $_TREE_ICONS['BENCHMARK'],
                                'nodes' => array_values($acadyr_tree)
                            );
                        }
                    }
                    //print "<pre>"; print_r($benchmark_tree);
                    $param_tree[] = array(
                        'text' => 'Parameter '.$parameter_code.': '.$param['Parameter_Desc'],
                        'icon' => $_TREE_ICONS['PARAM'],
                        'nodes' => $benchmark_tree
                    );
                }
                //print "<pre>"; print_r($param_tree);
                $_SESSION['arms']['level_folders'.$level_code][$id][] = array(
                    'text' => $program_name,
                    'icon' => $_TREE_ICONS['PROGRAM'],
                    'nodes' => $param_tree
                );
            }
        }           
    }

    public function getSubIndicatorFolders($base_sql, $parameter_key, $indicator_code)
    {        
        global $_TREE_ICONS;        

        $tree = array();
        $sql = $base_sql."
                AND Indicator_Code = '{$indicator_code}'
            ORDER BY Indicator_Code
        ";
        $data = $this->getDataFromTable($sql);
        foreach ($data as $row) {  
            $sub_indicator_code = basename($row['Folders']);
            $sub_indicator_desc = $this->indicator_sql->getIndicatorDesc($parameter_key, $sub_indicator_code);
            $sub_tree = $this->getSubIndicatorFolders($base_sql, $parameter_key, $sub_indicator_code);
            if (empty($sub_tree)) {
                $tree[] = array(
                    'text' => $sub_indicator_code.' '.$sub_indicator_desc,
                    'icon' => $_TREE_ICONS['INDICATOR'],
                    'nodes' => $sub_tree
                );
            } else {
                $tree[] = array(
                    'text' => $sub_indicator_code.' '.$sub_indicator_desc,
                    'icon' => $_TREE_ICONS['INDICATOR'],
                    'class' => 'file-folder',
                    'id' => 'folder_'.$row['Folder_Key']
                );

            }
        }

        return $tree;
    }

    public function getDeletedFileKey($values)
    {
        $sql = "
            SELECT * 
            FROM files
            WHERE Level_Code = '{$values['Level_Code']}'
                AND Area_Code = '{$values['Area_Code']}'
                AND File_Name = '{$values['File_Name']}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['File_Key'];
        }

        return $key;
    } 

    public function deleteFile($fname) 
    {
        $sql = "
            DELETE 
            FROM files
            WHERE File_Name = '{$fname}'
        ";
        //print "<pre>$sql\n"; exit;
        if ($this->db->query($sql) === true) {
            $success = true;
        } else {
            $success = $this->db->error;
        }
        //print "<pre>$sql\n"; var_dump($success);

        return $success;
    }

    public function archiveFile($values)
    {
        $table = 'files';
        $columns = array_keys($values);
        $data = array();
        $key = $this->getDeletedFileKey($values);
        if ($key < 1) {
            //print "<pre>"; print_r($values); exit;
            $row = array();
            foreach ($columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
            //print "<pre>INSERT: "; print_r($values); print_r($data); print_r($columns);
            $res = $this->insertTableRow($table, $columns, $data);    
            //var_dump($res);
        } else {
            $data['File_Status'] = $values['File_Status'];
            $data['Updated_On'] = $values['Updated_On'];
            $and = array();
            foreach ($values as $col => $val) {
                if ($col == 'File_Status' || $col == 'Updated_On') continue;
                $and[$col] = "{$col}='{$val}'";
            }
            //print "<pre>UPDATE: "; print_r($values); print_r($data); print_r($columns); print_r($and);
            $res = $this->updateTableRow($table, array('File_Status', 'Updated_On'), $data, 1, '', $and);
            //var_dump($res);
        }

        return $res;
    } 

    public function getArchiveFiles()
    {
        $sql = "
            SELECT t1.*,
                FROM_UNIXTIME(t1.Updated_On) as Deleted_On,
                concat(First_Name, ' ', Last_Name) as Deleted_By
            FROM files as t1
            LEFT JOIN task_force as t2
                ON t1.Updated_By = t2.Task_Force_Key
            ORDER By Updated_On
        ";
        $data = $this->getDataFromTable($sql);
        $list = array();
        foreach ($data as $row) {
            if ($_SESSION['arms']['logged'] != ADMIN_USERNAME && (isset($_SESSION['arms']['logged']['areas'][$row['Area_Code']]))) {            
                $row['Actions'] = '
                    <form method="POST" action="index.php?m=delete&area_code='.$row['Area_Code'].'" class="m-0 p-0 pl-4">      
                        <input type="hidden" name="File_Path" value="'.$row['File_Path'].'" />     
                        <span class="float-center m-1">
                            <button type="submit" class="btn btn-success" name="restore_file"  value="restore" >RESTORE</button>
                        </span>     
                        <span class="float-center m-1">
                            <button type="submit" class="btn btn-danger" name="delete_file"  value="restore" >DELETE</button>
                        </span>
                    </form>
                ';
            } else {
                $row['Actions'] = '';
            }
            $row['File_Name'] = '<a href="'.$row['File_Path'].'" target="_blank">'.$row['File_Name'].'</a>';
            $list[] = $row;
        }

        return $list;
    } 

}

?>