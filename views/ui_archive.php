
<?php

    session_start();
    require_once('header.php');
    require_once('head.php');
    require_once('nav.php');

?>

<div id="layoutSidenav_content">
    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> ARCHIVE </h2>
                <p>Archive for the AACCUP records management system</p>
            </div>
        </section>
        <div class="bg-light d-flex flex-row justify-content-between" style="width: 100% !important;">
            <div class="px-2">
                <p class="px-2" style="color: gray;">Items in the archive are listed permanently.</p>
            </div>
            <button type="button" class="btn btn-outline-secondary px-2"  style="width: 100px !important; height:40px !important; margin-right:30px !important;">Empty Bin</button>
        </div>
        <hr>
        <?php require_once('archive_pic.php'); ?>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Bohol Island State University - Balilihan Campus AACCUP 2023</div>
            </div>
        </div>
    </footer>
    </div>
</div>

<?php

    require_once('footer.php');

?>



