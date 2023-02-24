<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                    <a class="nav-link 
                        <?php if ($_GET['m'] == 'home'): ?>
                            active
                        <?php endif; ?>
                        " href="index.php" >
                        <div class="sb-nav-link-icon"><i class="fas fa-house"></i></div>
                        Home
                    </a>
                    <?php if ($_SESSION['arms']['logged'] != ADMIN_USERNAME): ?>
                        <a class="nav-link
                            <?php if ($_GET['m'] == 'archive'): ?>
                                active
                            <?php endif; ?>
                            " href="index.php?m=archive">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-trash"></i></div>
                            Archive
                        </a>
                    <?php endif; ?>
                    <a class="nav-link
                            <?php if ($_GET['m'] == 'about'): ?>
                                active
                            <?php endif; ?>
                            " href="index.php?m=about">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-info"></i></div>
                            About
                        </a>
                <div class="sb-sidenav-menu-heading">Accreditation</div>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'PSV'): ?>
                            active
                        <?php endif; ?>
                        " href="index.php?m=PSV">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                        PSV
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'LI'): ?>
                            active
                        <?php endif; ?>
                        " href="index.php?m=LI">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                        Level I
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'LII'): ?>
                            active
                        <?php endif; ?>
                        " href="index.php?m=LII">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                        Level II
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'LIII'): ?>
                            active
                        <?php endif; ?>
                        " href="index.php?m=LIII">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                        Level III
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'LIV'): ?>
                            active
                        <?php endif; ?>
                        " href="index.php?m=LIV">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                        Level IV
                    </a>
                </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?php if ($_SESSION['arms']['logged'] == ADMIN_USERNAME): ?>
                AACCUP-RMS Administrator
            <?php else: ?>
                <?php echo $_SESSION['arms']['logged']['First_Name'].' '.$_SESSION['arms']['logged']['Last_Name'] ?>
            <?php endif; ?>
        </div>
    </nav>
</div>

<div id="layoutSidenav_content">