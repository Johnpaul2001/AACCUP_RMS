<?php

require_once 'models/db_connect.php';

class SQL_Parameters extends DB_Connect {

    public $db_tbl_fields = array(
        'Area_Key',
        'Parameter_Code',
        'Parameter_Desc',
    );

    public $tbl_columns = array(
        'Area_Code',
        'Parameter_Code',
        'Parameter_Desc',
    );

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_areas.php';
        $this->area_sql = new SQL_Areas;
    }

    public function getParameterKey($area_key, $parameter_code)
    {
        $sql = "
            SELECT * 
            FROM parameters
            WHERE Area_Key = {$area_key}
                AND Parameter_Code = '{$parameter_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Parameter_Key'];
        }

        return $key;
    }

    public function getParametersData()
    {
        $sql = "
            SELECT *
            FROM parameters as t1
            LEFT JOIN areas as t2 
                ON t1.Area_Key = t2.Area_Key
            ORDER BY t1.Area_Key, Area_Name, Parameter_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveParameters($input)
    {
        $table = 'parameters';
        $columns = $this->db_tbl_fields;
        $data = array();
        foreach ($input as $values) {
            if ($values['Parameter_Code'] == '') continue;
            $values['Area_Key'] = $this->area_sql->getAreaKey($values['Area_Code']);
            $key = $this->getParameterKey($values['Area_Key'], $values['Parameter_Code']);
            if ($key > 0) continue;
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

    public function getAreaParameters($area_code)
    {
        $sql = "
            SELECT *
            FROM areas as t1
            LEFT JOIN parameters as t2 
                ON t1.Area_Key = t2.Area_Key
            WHERE Area_Code = '{$area_code}'
                AND Parameter_Code is not NULL
            ORDER BY Parameter_Key
        ";
        $data = $this->getDataFromTable($sql);
        $list = array();
        foreach ($data as $row) {
            $list[$row['Parameter_Code']] = $row;
        }

        return $list;
    }

}

?>