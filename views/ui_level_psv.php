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
        <form class="mb-3 px-4 d-flex flex-row" action="index.php?m=areas" method="POST" enctype="multipart/form-data">
            <div class="px-5 tree">
                <div class="contain">
                    <div class="content">
                    <h4><b>Accreditation</b></h4>
                        <div class="row">
                            <div class="col-md-12 pt-1">
                                <div id="tree">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </form>
    </main>    

<?php require_once('footer.php'); ?>