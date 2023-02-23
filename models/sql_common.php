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
            FROM task_force 
            WHERE Pass_Word = '".hashPassword($password)."'
                AND User_Name = '".$username."'
        ";
        $res = $this->getDataFromTable($sql);
        //print "<pre>$sql"; var_dump($res); exit;
        $user = array();
        if ($res) {                               
            $user = $res[0];
        }

        return $user;
    }
    
}

?>