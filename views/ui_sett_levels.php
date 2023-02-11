<?php

    session_start();
    require_once('header.php');
    require_once('head.php');
    require_once('nav_setting.php');

?>

<div id="layoutSidenav_content">
    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> LEVELS </h2>
                <p style="font-size:25px ;"><b>Manage Level List</b></p>
            </div>
        </section>
        <div class="bg-light d-flex flex-column justify-content-between" style="width: 100% !important;">
            <label for="formFile" class="form-label"><p class="px-2" style="color: blue; font-size: 20px;">Select the TSV (Tab Separated Value) file to Upload List of Levels</p></label>
            <form class="mb-3 px-4 d-flex flex-row">
                <input class="form-control" type="file" id="formFile">
                <button type="button" class="btn btn-primary d-flex flex-row"><i class="fa-sharp fa-solid fa-upload px-2 py-1"></i>Upload</button>
            </form>
        </div>
        <hr>
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