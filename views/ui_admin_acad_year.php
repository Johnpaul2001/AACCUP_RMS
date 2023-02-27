<?php 
    require_once('header.php');
    require_once('head.php');
    require_once('nav_setting.php'); 

    $disable = false;
    //print "<pre>"; print_r(array_keys($_SESSION['arms'])); exit;
    if (empty($_SESSION['arms']['program_level_list'])) {
        $disable = true;
    }

?> 


    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2>DEFAULT FOLDERS</h2>
                <p>Pre-create default folders for the selected Program for the specified Academic Years.</p>
            </div>
        </section>
        <section class="px-2">
            <?php if ($disable): ?>
                <div class="alert alert-warning">
                    <strong>Warning!</strong> Set Accrediation Level to Programs Available
                </div>
            <?php endif; ?>
            <?php require 'views/ui_alert.php' ?>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <form action="admin.php?m=acad_year" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-8">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select id="program" name="program" placeholder="Select Program" class="form-control selectpicker">
                                                <?php foreach ($_SESSION['arms']['program_level_list'] as $program_code => $level_code): ?>                                           
                                                    <?php 
                                                        $level_desc = $level_code != 'PSV' ? 'Level '.$level_code : $level_code;
                                                        $display = $program_code.': '.$_PROGRAMS[$program_code].' ('.$level_desc.')' 
                                                    ?>
                                                    <option value="<?php echo $program_code ?>" 
                                                        <?php if (isset($_POST['program']) && $program_code == $_POST['program']): ?>
                                                            selected
                                                        <?php endif; ?>
                                                    >
                                                        <?php echo $display ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="program">Select Program</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="academic_yr" name="academic_yr" placeholder="Academic Year"
                                                <?php if (isset($_POST['academic_yr'])): ?>
                                                    value="<?php echo $_POST['academic_yr'] ?>"
                                                <?php endif; ?>
                                            >
                                            <label for="academic_yr">Academic Year List(e.g 2019-2020,2020-2021)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row g-3">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary py-4 px-5" type="submit" name="create" value="ay_folders">Create Folders</button>
                                        <button class="btn btn-primary py-4 px-5" type="submit" name="view" value="ay_folders">View Folders</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php require 'views/tpl_table.php' ?>
            <hr>
        </section>
    </main>

<?php require_once('footer.php'); ?>