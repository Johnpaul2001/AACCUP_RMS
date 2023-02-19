<?php $accordion_id = $area['Area_Code']."_param_accordion" ?>

<div id="<?php echo $accordion_id ?>">
    <?php foreach ($_POST['area_parameters'][$area['Area_Code']] as $param_code => $param): ?>
        <?php $id = $area['Area_Code'].'_'.$program_code.'_'.$param_code ?>
        <div class="card">
            <div class="card-header" id="<?php echo $id ?>">
                <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?php echo $id ?>" aria-expanded="false" aria-controls="<?php echo $id?>">
                    <i class="<?php echo $_TREE_ICONS['PARAM'] ?>" aria-hidden="true"></i>
                    Area <?php echo $area['Area_Code']?>: <?php echo $program_code ?> Parameter <?php echo $param['Parameter_Code'] ?>: <?php echo $param['Parameter_Desc'] ?>
                </button>
                </h5>
            </div>
        
            <div id="<?php echo $id ?>" class="collapse" aria-labelledby="<?php echo $id ?>" data-parent="#<?php echo $accordion_id ?>">
                <div class="card-body">
                    <?php require 'views/tpl_benchmark_accordion.php' ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>