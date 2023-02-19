<?php

require_once 'models/db_connect.php';

class SQL_Level_Areas extends DB_Connect {

    public $level_areas_tbl_fields = array(
        'Area_Key',
        'Level_Code',
        'Level_Desc',
    );

    public $level_areas_columns = array(
        'Area_Code',
        'Area_Desc',
        'Level_Code',
        'Level_Desc',
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
            $key = $row['Level_Key'];
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
            ORDER BY Level_Code, t2.Area_Key

        ";        
        $data = $this->getDataFromTable($sql);

        return $data;
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
        foreach ($input as $values) {
            $values['Area_Key'] = $this->area_sql->getAreaKey($values['Area_Code']);
            $row = array();
            foreach ($columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
        }
        //print "<pre>"; print_r($input); print_r($data); print_r($columns);
        $res = $this->insertTableRow($table, $columns, $data);

        return $res;
    }

}

?>