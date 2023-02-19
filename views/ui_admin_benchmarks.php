<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav_setting.php');

    $_POST['table'] = array();
    $_POST['table']['no_footer'] = true;
    $_POST['table']['table_headers'] = array('Benchmark_Code', 'Benchmark_Desc');
    $_POST['table']['table_data'] = array();
    foreach ($_BENCHMARKS as $code => $value) {
        $_POST['table']['table_data'][] = array('Benchmark_Code' => $code, 'Benchmark_Desc' => $value);
    }
?>
    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> BENCHAMRKS </h2>
                <p style="font-size:25px ;"><b>Available Benchmarks</b></p>
            </div>
        </section>
        <div class="bg-light d-flex flex-column justify-content-between" style="width: 100% !important;">
            <?php require_once 'views/tpl_table.php' ?>
        </div>
        <hr>
    </main>

<?php require_once('footer.php'); ?>