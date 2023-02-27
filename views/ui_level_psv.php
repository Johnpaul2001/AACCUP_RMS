<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav.php');
?> 
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
        <div class="contain">
            <div class="content">
                <p class="h4 string ml-2">Accreditation</p>
                <?php require_once 'views/tpl_areas_tab.php' ?>
            </div>
        </div>
    </main> 
    
<?php require_once('tpl_level_params.php'); ?>
<?php require_once('footer.php'); ?>