
<hr class="hr-blurry" />
<div class="container">
    <ul class="nav nav-pills nav-fill m-0 p-0" id="myTab" role="tablist">
        <?php foreach ($_POST['area_list'] as $area): ?>
        <li class="nav-item" role="presentation">
            <button class="nav-link 
                " data-bs-toggle="tab" type="button" role="tab" aria-selected="false" 
                id="area_<?php echo $area['Area_Code'] ?>" data-bs-target="#<?php echo $area['Area_Code'] ?>-pane" aria-controls="<?php echo $area['Area_Code'] ?>-pane" >
                <?php echo 'Area '.$area['Area_Code'] ?>                                               
            </button>
        </li>
        <?php endforeach; ?>
        <div class="container mt-4">
            <div class="tab-content" id="myTabContent">              
                <?php foreach ($_POST['area_list'] as $area): ?>
                    <div class="tab-pane fade
                        " id="<?php echo $area['Area_Code'] ?>-pane" role="tabpanel" aria-labelledby="<?php echo $area['Area_Code'] ?>" tabindex="0"
                    >  

                        <div class="row">
                            <div class="col-md-12">
                                <div id="tree_<?php echo $area['Area_Code'] ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <hr class="hr-blurry" />
    </ul>
</div>
<hr class="hr-blurry" />