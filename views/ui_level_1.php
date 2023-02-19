<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav.php');
    $_POST['tree_list'] = array();
?> 

    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> Level I Accreditation </h2>
                <p style="font-size:15px ;">From accreditation level 1 (Level I) onwards, educational institutions no longer need to apply for an SO number from the CHED for that study programme.</p>
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

    <script>
        var tree_list = <?php echo json_encode($_POST['tree_list']); ?>;
    </script>

<?php require_once('footer.php'); ?>