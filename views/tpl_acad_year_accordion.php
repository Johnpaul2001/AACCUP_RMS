<?php

$dir = AACCUP_FILES;
$dir .= '/LEVEL-'.$_POST['level_code'];
$dir .= '/AREA-'.$area['Area_Code'];
$dir .= '/'.$program_code;
$dir .= '/PARAM-'.$param_code;
$dir .= '/'.$benchmark_code;
$academic_years = array();
//print "<pre>DIR: $dir\n"; 
if (is_dir($dir)) {
    $academic_years = getFoldersFromDir($dir);
    //print "<pre>"; print_r($academic_years); exit;
}

?>

<?php $accordion_id = $area['Area_Code']."_ay_accordion" ?>

<div id="<?php echo $accordion_id ?>">
    <?php foreach ($academic_years as $acad_yr): ?>
        <?php 
            $id = $area['Area_Code'].'_'.$program_code.'_'.$param_code.'_'.$benchmark_code.'_'.$acad_yr;
            $_POST['tree_list'][] = array(
                'id' => $id,
                'path' => $dir.'/'.$acad_yr,
                'level_code' => $_POST['level_code'],
                'area_code' => $area['Area_Code'],
                'program_code' => $program_code,
                'param_code' => $param_code,
                'benchmark_code' => $benchmark_code,
                'academic_yr' => $acad_yr,
            );
        ?>
        <div class="card">
            <div class="card-header" id="<?php echo $id ?>">
                <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#<?php echo $id ?>" aria-expanded="false" aria-controls="<?php echo $id?>">
                    <i class="<?php echo $_TREE_ICONS['ACAD_YEAR'] ?>" aria-hidden="true"></i>
                    Area <?php echo $area['Area_Code']?>: <?php echo $program_code ?> Parameter <?php echo $param_code ?> > <?php echo $benchmark_code ?>: AY <?php echo $acad_yr ?>
                </button>
                </h5>
            </div>
        
            <div id="<?php echo $id ?>" class="collapse" aria-labelledby="<?php echo $id ?>" data-parent="#<?php echo $accordion_id ?>">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div id="spinner_<?php echo $id ?>" class="spinner-border text-primary text-center" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div id="tree_<?php echo $id ?>">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>