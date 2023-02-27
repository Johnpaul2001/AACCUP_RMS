<?php

    ini_set('max_execution_time', '0'); // for infinite time of execution 
    ini_set('memory_limit', '-1'); 

    define("ADMIN_USERNAME", 'admin');
    define("ADMIN_PASS", 'admin');
    define("DB_NAME", 'arms_final');
    define("DB_HOST", 'localhost');
    define("DB_USER", "bisu");
    define("DB_PASS", "B!su");
    //define("DB_USER", "root");
    //define("DB_PASS", "");
    define("AACCUP_FILES", './AACCUP_FILES');

    $FILE_LIST = array();

    $_BENCHMARKS = array(
        'SIP' => 'SYSTEM INPUTS AND PROCESSES',
        'IMP' => 'IMPLEMENTATION',
        'OUT' => 'OUTCOME/S',
    );

    $_PROGRAMS = array(
        'BSIT'      => 'Bachelor of Science in Information Technology',
        'BSCS'      => 'Bachelor of Science in Computer Science',
        'BS-ELEX'   => 'Bachelor of Science in Electronics',
        'BS-ELEC'   => 'Bachelor of Science in Electrical',
        'BSIT-FPSM' => 'Bachelor of Science in Industrial Technology - Food Preparation and Service Management',
        'BS-CRIM'   => 'Bachelor of Science in Criminology',
    );

    $_TREE_ICONS = array(
        'PROGRAM'   => 'fa-solid fa-box-open',
        'PARAM'     => 'fa-solid fa-book',
        'BENCHMARK' => 'fa-solid fa-folder',
        'ACAD_YEAR' => 'fa-solid fa-calendar',
        'INDICATOR' => 'fa-solid fa-folder-open',
        'FILE'      => 'fa-solid fa-file',
    );

?>
