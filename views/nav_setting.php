<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-house"></i></div>
                        Home
                    </a>
                    <div class="sb-sidenav-menu-heading">MANAGE</div>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'areas'): ?>
                            active
                        <?php endif; ?>
                        " href="admin.php?m=areas">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-box-open"></i></div>
                        Areas
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'level_areas'): ?>
                            active
                        <?php endif; ?>
                        " href="admin.php?m=level_areas">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                        Level Areas
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'task_force'): ?>
                            active
                        <?php endif; ?>
                        " href="admin.php?m=task_force">
                        <div class="sb-nav-link-icon"><i class="fa-sharp fa-solid fa-users"></i></div>
                        Task-forces
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'parameters'): ?>
                            active
                        <?php endif; ?>
                        " href="admin.php?m=parameters">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                        Parameters
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'benchmarks'): ?>
                            active
                        <?php endif; ?>
                        " href="admin.php?m=benchmarks">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                        Benchmarks
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'indicators'): ?>
                            active
                        <?php endif; ?>
                        " href="admin.php?m=indicators">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder-open"></i></div>
                        Indicators
                    </a>
                    <a class="nav-link
                        <?php if ($_GET['m'] == 'programs'): ?>
                            active
                        <?php endif; ?>
                        " href="admin.php?m=programs">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-school"></i></div>
                        Programs
                    </a>

                    <a class="nav-link
                        <?php if ($_GET['m'] == 'acad_year'): ?>
                            active
                        <?php endif; ?>
                        " href="admin.php?m=acad_year">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar"></i></div>
                        Default Folders
                    </a>
                </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            AACCUP Administrator
        </div>
    </nav>
</div>

<div id="layoutSidenav_content">