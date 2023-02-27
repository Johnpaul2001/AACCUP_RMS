
<?php 
    $accordion_id = $_POST['area_code']."_program_accordion" 

?>

<div id="<?php echo $accordion_id ?>">
    <?php foreach ($_SESSION['arms']['level_folders'.$_POST['level_code']][$_POST['area_code']] as $program_code => $tree_json): ?>
        <?php 
            $id = $_POST['area_code'].'_'.$program_code;
            $_POST['program_code'] = $program_code;
            $program_name = $_PROGRAMS[$program_code];
            $_POST['tree_list'][] = array(
                'id' => $id,
                'level_code' => $_POST['level_code'],
                'area_code' => $area['Area_Code'],
                'program_code' => $program_code,
                'tree_json' => $tree_json
            );
        ?>
        <div class="card">
            <div class="card-header" id="<?php echo $id ?>">
                <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" 
                    id="<?php echo $id ?>"
                    data-target="#<?php echo $id ?>" aria-expanded="false" aria-controls="<?php echo $id?>">
                    <i class="<?php echo $_TREE_ICONS['PROGRAM'] ?>" aria-hidden="true"></i>
                    Area <?php echo $_POST['area_code']?>: <?php echo $program_name?>
                </button>
                </h5>
            </div>
        
            <div id="<?php echo $id ?>" class="collapse" aria-labelledby="<?php echo $id ?>" data-parent="#<?php echo $accordion_id ?>">   
                <div id="tree_<?php echo $id ?>">
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>