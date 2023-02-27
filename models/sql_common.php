<?php

require_once 'models/db_connect.php';

class SQL_Common extends DB_Connect {

    function __construct() 
    {
        Parent::__construct();
    }

    public function isValidUser($username, $password)
    {
        $sql = "
            SELECT * 
            FROM task_force as t1
            LEFT JOIN areas as t2
                ON t1.Area_Key = t2.Area_Key
            WHERE Pass_Word = '".hashPassword($password)."'
                AND User_Name = '".$username."'
        ";
        $res = $this->getDataFromTable($sql);
        //print "<pre>$sql"; var_dump($res); exit;
        $user = array();
        if ($res) {            
            $user = $res[0];
            $user['areas'] = array();
            foreach ($res as $row) {
                $user['areas'][$row['Area_Code']] = $row['Area_Key'];
            }
        }

        return $user;
    }

    public function deleteFile()
    {
        $sql = "
            SELECT * 
            FROM task_force as t1
            LEFT JOIN areas as t2
                ON t1.Area_Key = t2.Area_Key
            WHERE Pass_Word = '".hashPassword($password)."'
                AND User_Name = '".$username."'
        ";
        $res = $this->getDataFromTable($sql);
        //print "<pre>$sql"; var_dump($res); exit;
        
    }
    
}

?>