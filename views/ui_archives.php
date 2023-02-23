
<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav.php');
?>
    <main class="fade-in-down">
        <section class="px-2">
            <div class="section-title">
                <h2> ARCHIVE </h2>
                <p>Archive for the AACCUP records management system</p>
            </div>
        </section>
        <div class="bg-light d-flex flex-row justify-content-between" style="width: 100% !important;">
            <div class="px-2">
                <p class="px-2" style="color: gray;">Items in the archive are deleted permanently.</p>
            </div>
            <button type="button" class="btn btn-outline-secondary px-2"  style="width: 100px !important; height:40px !important; margin-right:30px !important;">Empty Bin</button>
        </div>
        <hr>
        <div class="px-5">
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Level</th>
                <th scope="col">Area</th>
                <th scope="col">File Name</th>
                <th scope="col">Deleted By</th>
                <th scope="col">Deleted On</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Level I</td>
                    <td>Area 1</td>
                    <td>AREA-I_BSCS_PARAM-A_SIP_2020-2021_S.1_Page11</td>
                    <td>Riame Tuico</td>
                    <td>February 25, 2023</td>
                </tr>
                <tr>
                    <td>Level II</td>
                    <td>Area 3</td>
                    <td>AREA-I_BSCS_PARAM-A_SIP_2020-2021_S.1_Page2</td>
                    <td>Riame Tuico</td>
                    <td>February 22, 2023</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Mark</td>
                    <td>AREA-I_BSCS_PARAM-A_SIP_2020-2021_S.1_Page2</td>
                    <td>Marc Benigno Olaguir</td>
                    <td>February 21, 2023</td>
                </tr>
            </tbody>
        </table>
        </div>
    </main>

<?php

    require_once('footer.php');

?>



