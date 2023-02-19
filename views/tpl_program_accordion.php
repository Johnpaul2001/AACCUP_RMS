
<?php $accordion_id = $area['Area_Code']."_program_accordion" ?>

<div id="<?php echo $accordion_id ?>">
    <?php foreach ($_PROGRAMS as $program_code => $program_name): ?>
        <?php $id = $area['Area_Code'].'_'.$program_code ?>
        <div class="card">
            <div class="card-header" id="<?php echo $id ?>">
                <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?php echo $id ?>" aria-expanded="false" aria-controls="<?php echo $id?>">
                    <i class="<?php echo $_TREE_ICONS['PROGRAM'] ?>" aria-hidden="true"></i>
                    Area <?php echo $area['Area_Code']?>: <?php echo $program_name?>
                </button>
                </h5>
            </div>
        
            <div id="<?php echo $id ?>" class="collapse" aria-labelledby="<?php echo $id ?>" data-parent="#<?php echo $accordion_id ?>">
                <div class="card-body">
                    <?php require 'views/tpl_params_accordion.php' ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>