<?php

require_once 'models/db_connect.php';

class SQL_Level_Areas extends DB_Connect {

    public $level_areas_tbl_fields = array(
        'Area_Key',
        'Level_Code',
        'Level_Desc',
    );

    public $level_areas_columns = array(
        'Level_Desc',
        'Area_Code',
        'Area_Name',
    );

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_areas.php';
        $this->area_sql = new SQL_Areas;
    }

    public function getLevelAreaKey($area_key, $level_code)
    {
        $sql = "
            SELECT * 
            FROM level_areas
            WHERE Area_Key = {$area_key}
                AND Level_Code = '{$level_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Level_Area_Key'];
        }

        return $key;
    }

    public function getLevelAreaInfoFromKey($key)
    {
        $sql = "
            SELECT * 
            FROM level_areas
            WHERE Level_Area_Key = {$key}
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $info = empty($data) ? array() : $data[0];

        return $info;
    }

    public function getAreaInfoFromCode($level_code)
    {
        $sql = "
            SELECT * 
            FROM level_areas
            WHERE Level_Code = '{$level_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $info = empty($data) ? array() : $data[0];

        return $info;
    }

    public function getLevelsList()
    {
        $sql = "
            SELECT distinct Level_Code, Level_Desc
            FROM level_areas
            ORDER BY Level_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function getLevelAreaData($area_key)
    {
        $sql = "
            SELECT *
            FROM level_areas as t1
            LEFT JOIN areas as t2 
                ON t1.Area_Key = t2.Area_Key
            WHERE t1.Area_Key = {$area_key}
            ORDER BY Area_Code, Level_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function getLevelAreaList()
    {
        $sql = "
            SELECT *
            FROM level_areas as t1
            LEFT JOIN areas as t2 
                ON t1.Area_Key = t2.Area_Key
            ORDER BY Level_Area_Key

        ";        
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function getLevelList()
    {
        $sql = "
            SELECT *
            FROM level_areas 
            ORDER BY Level_Area_Key
        ";        
        $data = $this->getDataFromTable($sql);
        $list = array();
        foreach ($data as $row) {
            $list[$row['Level_Code']] = $row['Level_Desc'];
        }

        return $list;
    }

    public function getProgramLevelList()
    {
        $sql = "
            SELECT *
            FROM programs 
            ORDER BY Program_Key
        ";        
        $data = $this->getDataFromTable($sql);
        $list = array();
        foreach ($data as $row) {
            $list[$row['Program_Code']] = $row['Level_Code'];
        }

        return $list;
    }

    public function getProgramLevel($program_code)
    {
        $sql = "
            SELECT * 
            FROM programs
            WHERE Program_Code = '{$program_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = '';
        foreach ($data as $row) {
            $key = $row['Level_Code'];
        }

        return $key;

    }

    public function saveProgramLevel($program_code, $level_code)
    {
        global $_PROGRAMS;
        $check = $this->getProgramLevel($program_code);
        if ($check == '') {
            $program_name = $_PROGRAMS[$program_code];
            $sql = "
                INSERT INTO programs (Program_Code, Program_Name, Level_Code) 
                VALUES ('{$program_code}', '{$program_name}', '{$level_code}')
            ";
        } else {
            $sql = "
                UPDATE programs
                SET Level_Code = '{$level_code}'
                WHERE Program_Code = '{$program_code}'
            ";
        }
        //print "<pre> $sql\n"; 
        if ($this->db->query($sql) === true) {
            $success = true;
        } else {
            $success = $this->db->error;
        }
        //var_dump($success);exit;
    }

    public function getLevelAreas($level_code)
    {
        $sql = "
            SELECT *
            FROM level_areas as t1
            LEFT JOIN areas as t2 
                ON t1.Area_Key = t2.Area_Key
            WHERE t1.Level_Code = '{$level_code}'
            ORDER BY t2.Area_Key
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveLevelAreas($input)
    {
        $table = 'level_areas';
        $columns = $this->level_areas_tbl_fields;
        $data = array();
        $res = $this->insertTableRow($table, $columns, $data);
        foreach ($input as $values) {
            if ($values['Level_Code'] == '') continue;
            $values['Area_Key'] = $this->area_sql->getAreaKey($values['Area_Code']);
            $key = $this->getLevelAreaKey($values['Area_Key'], $values['Level_Code']);
            if ($key > 0) continue;
            $this->createLevelAreaFolder($values['Area_Code'], $values['Level_Code']);
            $row = array();
            foreach ($columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
        }
        //print "<pre>"; print_r($input); print_r($data); print_r($columns);
        if (!empty($data)) {
            $res = $this->insertTableRow($table, $columns, $data);
        }

        return $res;
    }

    public function createLevelAreaFolder($area_code, $level_code)
    {
        $dir = AACCUP_FILES.'/LEVEL-'.$level_code;     
        createDir($dir);
        $dir .= '/AREA-'.$area_code;
        createDir($dir);
    }

    public function createProgramFolders()
    {        
        $dir  = "PARAM-".$data['Parameter_Code'];
        $dir .= "/".$data['Benchmark_Code'];
        $dir .= "/".$data['Benchmark_Code'];
        $dir .= "/AY".$data['Benchmark_Code'];
    }
    

    public function getLevelPrograms($level_code)
    {
        $sql = "
            SELECT *
            FROM programs 
            WHERE Level_Code = '{$level_code}'
            ORDER BY Program_Code
        ";
        $data = $this->getDataFromTable($sql);
        $list = array();
        foreach ($data as $row) {
            $list[$row['Program_Code']] = $row['Program_Name'];
        }

        return $list;
    }

}

?>