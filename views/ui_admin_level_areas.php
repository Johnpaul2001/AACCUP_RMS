<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav_setting.php');

    $disable = false;
    if (empty($_SESSION['arms']['area_list'])) {
        $disable = true;
    }
?>
    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> LEVEL AREAS</h2>
                <p style="font-size:25px ;"><b>Manage Level Areas List</b></p>
            </div>
        </section>
        
        <?php if ($disable): ?>
            <div class="alert alert-warning">
                <strong>Warning!</strong> Upload Areas Data First
            </div>
        <?php endif; ?>
        <div class="bg-light d-flex flex-column justify-content-between" style="width: 100% !important;">
            <label for="formFile" class="form-label"><p class="px-2" style="color: blue; font-size: 20px;">Select the TSV (Tab Separated Value) file to Upload List of Levels</p></label>
            <form class="mb-3 px-4 d-flex flex-row" action="admin.php?m=level_areas" method="POST" enctype="multipart/form-data">
                <input class="form-control" type="file" id="formFile" name="upload_csv">
                <button type="submit" class="btn btn-primary d-flex flex-row" name="save" 
                    <?php if ($disable): ?>
                        disabled
                    <?php endif; ?>
                    value="level_areas">
                    <i class="fa-sharp fa-solid fa-upload px-2 py-1"></i>Upload
                </button>
            </form>
        </div>
        <?php require 'views/tpl_table.php' ?>
        <hr>
    </main>

<?php require_once('footer.php'); ?>