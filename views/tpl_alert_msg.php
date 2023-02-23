    <div class="mt-2">
        <?php if (isset($_POST['warning']) && $_POST['warning'] != ''): ?>
            <div class="alert alert-warning">
                <strong>Warning!</strong> <?php echo $_POST['warning'] ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_POST['danger']) && $_POST['danger'] != ''): ?>
            <div class="alert alert-danger">
                <strong>Error!</strong> <?php echo $_POST['danger'] ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_POST['success']) && $_POST['success'] != ''): ?>
            <div class="alert alert-success">
                <strong>Success!</strong> <?php echo $_POST['success'] ?>
            </div>
        <?php endif; ?>
    </div>