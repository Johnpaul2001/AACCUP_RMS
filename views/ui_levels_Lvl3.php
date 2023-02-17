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
                <h2> Level III Accreditation </h2>
                <p style="font-size:15px ;">Programs which have been reaccredited and which have met the additional criteria or guidelines set by FAAP.</p>
                <hr>
            </div>
        </section>
        <div>
            <div class="text-center">
                <img src="./img/error.png" width="500">
                <p>Oops! Sorry, this level of accreditation is not allowed to use. There is no programs in the campus that are passed as Level III Accreditation.</p>
            </div>
        </div>    
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