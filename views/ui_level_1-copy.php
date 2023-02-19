<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav.php');
?> 

    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> Level I Accreditation </h2>
                <p style="font-size:15px ;">From accreditation level 1 (Level I) onwards, educational institutions no longer need to apply for an SO number from the CHED for that study programme.</p>
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

    <script>
        var area_list = <?php echo json_encode($_POST['area_list']); ?>;
        var area_folders = <?php echo json_encode($_POST['area_folders']); ?>;
    </script>

<?php require_once('footer.php'); ?>