
<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav.php');
?>
    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> ARCHIVE </h2>
                <p>Archive for the AACCUP records management system</p>
            </div>
        </section>
        <?php require 'views/tpl_alert_msg.php' ?>
        <!--
        <div class="bg-light d-flex flex-row justify-content-between" style="width: 100% !important;">
            <div class="px-2">
                <p class="px-2" style="color: gray;">Items in the archive are deleted permanently.</p>
            </div>
            <button type="button" class="btn btn-outline-secondary px-2"  style="width: 100px !important; height:40px !important; margin-right:30px !important;">Empty Bin</button>
        </div>
        -->
        <hr>
        <?php //require_once('archive_pic.php'); ?>      
        <?php require 'views/tpl_table.php' ?>
    </main>

<?php

    require_once('footer.php');

?>



