<?php

require_once 'models/db_connect.php';

class SQL_Indicators extends DB_Connect {

    public $db_tbl_fields = array(
        'Parameter_Key',
        'Benchmark_Code',
        'Indicator_Code',
        'Indicator_Desc',
    );

    public $tbl_columns = array(
        'Area_Code',
        'Parameter_Code',
        'Benchmark_Code',
        'Indicator_Code',
        'Indicator_Desc',
    );

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_areas.php';
        $this->area_sql = new SQL_Areas;
    
        require_once 'models/sql_parameters.php';
        $this->parameter_sql = new SQL_Parameters;
    }

    public function getIndicatorsData()
    {
        $sql = "
            SELECT *
            FROM indicators as t1
            LEFT JOIN parameters as t2
                ON t1.Parameter_Key = t2.Parameter_Key
            LEFT JOIN areas as t3
                ON t2.Area_Key = t3.Area_Key
            ORDER BY Area_Code, Parameter_Code, Indicator_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveIndicators($input)
    {
        $table = 'indicators';
        $columns = $this->db_tbl_fields;
        $data = array();
        foreach ($input as $values) {
            $values['Area_Key'] = $this->area_sql->getAreaKey($values['Area_Code']);
            $values['Parameter_Key'] = $this->parameter_sql->getParameterKey($values['Area_Key'], $values['Parameter_Code']);
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

    public function getAreaIndicators($area_code)
    {
        $sql = "
            SELECT *
            FROM areas as t1
            LEFT JOIN parameters as t2
                ON t2.Area_Key = t1.Area_Key
            LEFT JOIN indicators as t3
                ON t3.Parameter_Key = t2.Parameter_Key
            WHERE Area_Code = '{$area_code}'
        ";
        $data = $this->getDataFromTable($sql);
        $list = array();
        foreach ($data as $row) {
            $code = $row['Parameter_Code'].'_'.$row['Indicator_Code'];
            $list[$code] = $row;
        }

        return $list;
    }


}

?>