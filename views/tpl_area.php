    <?php if ($_SESSION['arms']['logged'] != ADMIN_USERNAME && (isset($_SESSION['arms']['logged']['areas'][$_POST['area_code']]))): ?>
    <?php require 'views/tpl_alert_msg.php' ?>
    <div class="bg-light d-flex flex-column justify-content-between" style="width: 100% !important;">                        
        <label for="formFile" class="form-label pl-2">
            <p class="h6 text-primary">
                File Name Format: 
                <span class="strong">AREA-x_PROGRAM_PARAM-x_BENCHMARK_20xx-20xx_INDICATOR</span>
            </p>
            <p class="normal text-secondary pl-5">
                e.g. <span>AREA-I_BSIT_PARAM-A_SIP_2019-2020_S.5.6</span>                                      
            </p>
            <p class="normal text-primary ">
                <span>NOTE: Only accepts PDF files!</span>
            </p>
        </label>
        <form class="mb-4 px-4 d-flex flex-row" action="index.php?m=upload&level_code=<?php echo $_POST['level_code'] ?>&area_code=<?php echo $_POST['area_code'] ?>"  
            id="upload_form_"<?php echo $_POST['area_code'] ?>" 
            method="POST" enctype="multipart/form-data">
            <input class="form-control" type="file" id="upload_file" name="upload_files[]" 
                accept="application/pdf" multiple="multiple">
            <button type="submit" class="btn btn-primary d-flex flex-row" 
                name="upload" id="<?php echo $_POST['area_code'] ?>-upload" value="file">
                <i class="fa-sharp fa-solid fa-upload px-2 py-1"></i>
                Upload
            </button>
        </form>
    </div>  
    <?php endif; ?>                              
    <div class="row">
        <div class="col-md-12">
            <?php require 'views/tpl_program_accordion.php' ?>
        </div>
    </div>