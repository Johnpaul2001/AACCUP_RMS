<?php 
    require_once('header.php');
    require_once('head.php');
    require_once('nav_setting.php'); 
?> 


    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2>ACADEMIC YEAR</h2>
                <p>Pre-create default folders for the specified Academic Year and Level - Area.</p>
            </div>
        </section>
        <section class="px-2">
            <?php require 'views/ui_alert.php' ?>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <form action="admin.php?m=acad_year" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="academic_yr" name="academic_yr" placeholder="Course Code"
                                        <?php if (isset($_POST['academic_yr'])): ?>
                                            value="<?php echo $_POST['academic_yr'] ?>"
                                        <?php endif; ?>
                                    >
                                    <label for="academic_yr">Academic Year (e.g 2022-2023)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select id="level_area" name="level_area" placeholder="Select" class="form-control selectpicker">
                                        <?php foreach ($_POST['level_areas'] as $area): ?>                                           
                                            <?php $level_area = $area['Level_Code'].'_'.$area['Area_Code']?>
                                            <option value="<?php echo $level_area ?>" 
                                                <?php if (isset($_POST['level_area']) && $level_area == $_POST['level_area']): ?>
                                                    selected
                                                <?php endif; ?>
                                            >
                                                <?php echo $area['Level_Desc'] ?> - Area <?php echo $area['Area_Code'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="level_area">Select</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <p class="text-primary text-uppercase mb-2">Select TSV (Tab Separated Values) file containing the folder structure</p>
                                <input type="file" name="upload_csv" accept="text/tsv" class="form-control form-control-lg" id="upload_csv" />
                            </div>
                            <div class="col-md-3 text-center">
                                <input type="hidden" name="create" value="ay_folders" />
                                <button class="btn btn-primary py-4 px-5" type="submit" name="create" value="ay_folders">Create Folders</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php require_once 'views/tpl_table.php' ?>
            <hr>
        </section>
    </main>

<?php require_once('footer.php'); ?>