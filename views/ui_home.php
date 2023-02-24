<?php
    require_once('header.php');
    require_once('head.php');
    require_once('nav.php');
?>
 
    <main>
        <header class="masthead">
                <div class="logo"><img src="./img/bisubal.png" width="300px" alt=""></div>
                <div class="container position-relative topp">
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-md-5 col-lg-4 col-xl-7">
                            <div class="site-heading">
                                <img src="./img/logo.png" width="700px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="foot">
                <div class="d-flex flex-row justify-content-evenly py-4">
                    <a class="icons" href="index.php?m=about#param">
                        <div class="nav-link-icon d-flex flex-row justify-content-center"><i class=" fa-sharp fa-solid fa-folder-open bigg"></i></div>
                        Areas and their Parameters
                    </a>
                    <a class="icons" href="index.php?m=about#per">
                        <div class="nav-link-icon d-flex flex-row justify-content-center"><i class="fa-sharp fa-solid fa-user-tie bigg"></i></div>
                        List of Task-force
                    </a>
                    <a class="icons" href="index.php?m=about#sys">
                        <div class="nav-link-icon d-flex flex-row justify-content-center"><i class="fa-solid fa-gears bigg"></i>                                    </div>
                        About the System 
                    </a>
                    <a class="icons" href="index.php?m=about#res">
                        <div class="nav-link-icon d-flex flex-row justify-content-center"><i class="fa-sharp fa-solid fa-users bigg"></i></i></div>
                        About the Researchers
                    </a>
                </div>
            </div>
        </header>
    </main>

<?php require_once('footer.php'); ?>