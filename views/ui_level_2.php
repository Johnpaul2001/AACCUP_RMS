<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav.php');
?>

    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> Level II Accreditation</h2>
                <p style="font-size:15px ;">Programs which have at least been granted an initial accredited status by any of the member agencies of the FAAP, and whose status is certified by the latter. Level II Accreditation provides physicians with a further understanding of the administrative, legal, and medical aspects of workers' compensation.</p>
                <hr>
            </div>
        </section>
        <div class="pl-2">
            <div class="contain">
                <div class="content">
                    <h4><b>Accreditation</b></h4>
                    <?php require_once 'views/tpl_areas_tab_tree.php' ?>
                </div>
            </div>
        </div>  
    </main>

<?php require_once('footer.php'); ?>