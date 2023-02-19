
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
                                
                        <?php require 'views/ui_alert.php' ?>
                        <div class="bg-light d-flex flex-column justify-content-between" style="width: 100% !important;">                        
                            <label for="formFile" class="form-label pl-2">
                                <p class="h6 text-primary">
                                    File Name Format: 
                                    <span class="strong">AREA-x_program_PARAM-x_benchmark_20xx-20xx_indicator_Pagex</span>
                                </p>
                                <p class="normal text-secondary pl-5">
                                    e.g. <span>AREA-I_BSIT_PARAM-A_SIP_2019-2020_S.5.6_Page1</span>                                      
                                </p>
                                <p class="normal text-primary ">
                                    <span>NOTE: Only accepts image files!</span>                                      
                                </p>
                            </label>
                            <form class="mb-4 px-4 d-flex flex-row" action="index.php?m=upload&level_code=<?php echo$_POST['level_code'] ?>&area_code=<?php echo $area['Area_Code'] ?>" 
                                method="POST" enctype="multipart/form-data">
                                <input class="form-control" type="file" id="formFile" name="upload_files[]" 
                                    accept="image/*" multiple="multiple">
                                <button type="submit" class="btn btn-primary d-flex flex-row" name="upload" value="file">
                                    <i class="fa-sharp fa-solid fa-upload px-2 py-1"></i>
                                    Upload
                                </button>
                            </form>
                        </div>                                
                        <div class="row">
                            <div class="col-md-12">
                                <?php require 'views/tpl_program_accordion.php' ?>
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