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
                <h2> Preliminary Survey Visit </h2>
                <p style="font-size:15px ;">During this stage, the programs or institutions undergo a preliminary
check on the eligibility of the program for accreditation review based on certain
conditions or requirements set by the accrediting agency.</p>
                <hr>
            </div>
        </section>
        <div class="px-5 tree">
            <div class="contain">
                <div class="content">
                    <div class="row">
                        <div class="col-md-12 pt-1">
                            <div id="tree">
                            </div>
                        </div>
                    </div>
                </div>
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