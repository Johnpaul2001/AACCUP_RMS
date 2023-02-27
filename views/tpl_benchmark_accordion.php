<?php $accordion_id = $area['Area_Code']."_benchmark_accordion" ?>

<div id="<?php echo $accordion_id ?>">
    <?php foreach ($_BENCHMARKS as $benchmark_code => $benchmark_name): ?>
        <?php $id = $area['Area_Code'].'_'.$_POST['program_code'].'_'.$_POST['param_code'].'_'.$benchmark_code ?>
        <div class="card">
            <div class="card-header" id="<?php echo $id ?>">
                <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#<?php echo $id ?>" aria-expanded="false" aria-controls="<?php echo $id?>">
                    <i class="<?php echo $_TREE_ICONS['BENCHMARK'] ?>" aria-hidden="true"></i>
                    Area <?php echo $area['Area_Code']?>: <?php echo $_POST['program_code'] ?> Parameter <?php echo $_POST['param_code'] ?> > <?php echo $benchmark_name ?>
                </button>
                </h5>
            </div>
        
            <div id="<?php echo $id ?>" class="collapse" aria-labelledby="<?php echo $id ?>" data-parent="#<?php echo $accordion_id ?>">
                <div class="card-body">
                    <?php require 'views/tpl_acad_year_accordion.php' ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>