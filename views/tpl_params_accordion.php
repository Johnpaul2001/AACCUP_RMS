<?php $accordion_id = $_POST['area_code']."_param_accordion" ?>

<div id="<?php echo $accordion_id ?>">
    <?php foreach ($_POST['area_parameters'][$_POST['area_code']] as $param_code => $param): ?>
        <?php 
            $id = $_POST['area_code'].'_'.$_POST['program_code'].'_'.$param_code;            
            $_POST['param_code'] = $param_code;
        ?>
        <div class="card">
            <div class="card-header" id="<?php echo $id ?>">
                <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?php echo $id ?>" aria-expanded="false" aria-controls="<?php echo $id?>">
                    <i class="<?php echo $_TREE_ICONS['PARAM'] ?>" aria-hidden="true"></i>
                    Area <?php echo $_POST['area_code']?>: <?php echo $_POST['program_code'] ?> Parameter <?php echo $param['Parameter_Code'] ?>: <?php echo $param['Parameter_Desc'] ?>
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