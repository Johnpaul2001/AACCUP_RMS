<?php
    $_POST['tree_list'] = array();
?>
<hr class="hr-blurry" />
<div class="container">
    <ul class="nav nav-pills nav-fill m-0 p-0" id="myTab" role="tablist">
        <?php foreach ($_SESSION['arms']['area_list'.$_POST['level_code']] as $area): ?>
            <?php 
                $id = 'area_'.$_POST['level_code'].'_'.$area['Area_Code'];
            ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link area-tab" data-bs-toggle="tab" type="button" role="tab" aria-selected="false"                 
                    data-level_code="<?php echo $_POST['level_code'] ?>" data-area_code="<?php echo $area['Area_Code'] ?>"
                    id="area_<?php echo $_POST['level_code'].'_'.$area['Area_Code'] ?>" 
                    data-bs-target="#<?php echo $area['Area_Code'] ?>-pane" aria-controls="<?php echo $area['Area_Code'] ?>-pane" >
                    
                    <?php echo 'Area '.$area['Area_Code'] ?>                                               
                </button>
            </li>
        <?php endforeach; ?>
        <div class="container mt-4">
            <div class="tab-content" id="myTabContent">              
                <?php foreach ($_SESSION['arms']['area_list'.$_POST['level_code']] as $area): ?>                    
                    <div class="tab-pane fade "
                        id="<?php echo $area['Area_Code'] ?>-pane" role="tabpanel" aria-labelledby="<?php echo $area['Area_Code'] ?>" tabindex="0"
                    >  
                        <?php 
                            $_POST['area_code'] = $area['Area_Code'];
                            require 'views/tpl_area.php' 
                        ?>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <hr class="hr-blurry" />
    </ul>
</div>
<hr class="hr-blurry" />