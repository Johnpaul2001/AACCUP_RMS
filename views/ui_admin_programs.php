<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav_setting.php');

    $disable = false;
    //print "<pre>"; print_r(array_keys($_SESSION['arms'])); exit;
    if (empty($_SESSION['arms']['area_list']) ||         
        empty($_SESSION['arms']['level_list']) || 
        empty($_SESSION['arms']['level_area_list']) || 
        empty($_SESSION['arms']['parameters_list']) ||  
        empty($_SESSION['arms']['indicator_list']) ) {
        $disable = true;
    }

    $_POST['table'] = array();
    $_POST['table']['no_footer'] = true;
    $_POST['table']['table_headers'] = array('Program_Code', 'Program_Name', 'Level_Code', 'Save');
    $_POST['table']['table_data'] = array();
    foreach ($_PROGRAMS as $program_code => $program) {
        $level_select = '<select class="form-control selectpicker"  name="'.$program_code.'_Level">';
        foreach ($_SESSION['arms']['level_list'] as $level_code => $level_desc) {
            $selected = '';
            if (isset($_SESSION['arms']['program_level_list'][$program_code]) && $_SESSION['arms']['program_level_list'][$program_code] == $level_code) {
                $selected = ' selected ';
            }
            $level_select .= '<option value="'.$level_code.'" '.$selected.'>'.$level_desc.'</option>';
        }
        $level_select .= '</select>';
        $save_button = '
            <button type="submit" class="btn btn-primary d-flex flex-row" name= "save_level" value="'.$program_code.'"
        ';
        if ($disable) {
            $save_button .= ' disabled ';
        }
        $save_button .= ' value="program_levels"> Save
            </button>
        ';

        $_POST['table']['table_data'][] = array(
            'Program_Code' => $program_code, 
            'Program_Name' => $program,
            'Level_Code' => $level_select,
            'Save' => $save_button
        );
    }
?>
    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> PROGRAMS </h2>
                <p style="font-size:25px ;"><b>Available Programs</b></p>
            </div>
        </section>
        <?php if ($disable): ?>
            <div class="alert alert-warning">
                <strong>Warning!</strong> Upload Areas, Level Areas, Parameters, and Indicators Data First
            </div>
        <?php endif; ?>
        <div class="bg-light d-flex flex-column justify-content-between" style="width: 100% !important;">
            <form class="mb-3 px-4 d-flex flex-row" action="admin.php?m=programs" method="POST" enctype="multipart/form-data">
                <?php require 'views/tpl_table.php' ?>
            </form>
        </div>
        <hr>
    </main>

<?php require_once('footer.php'); ?>