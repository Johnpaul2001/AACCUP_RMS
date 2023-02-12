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
                <h2> Level IV Accreditation</h2>
                <p style="font-size:15px;">As stated in the AACCUP Accreditation Manual, “Level IV re-accredited status is awarded to programs which are highly respected as very high-quality academic programs in the Philippines and with prestige and authority comparable to similar programs in excellent foreign universities.”</p>
                <hr>
            </div>
        </section>
        <div>
            <div class="text-center">
                <img src="./img/error.png" width="550">
                <p>Oops! Sorry, this level of accreditation is not allowed to use. There is no programs in the campus that are passed as Level IV Accreditation.</p>
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