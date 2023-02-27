<?php if (isset($_POST['table']) && !empty($_POST['table'])): ?>
    <!-- DataTales -->
            <div class="table-responsive">
                <table class="table table-bordered" id="<?php echo $_POST['table']['table_id'] ?>" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <?php foreach ($_POST['table']['table_headers'] as $header): ?>
                                <th><?php echo $header; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <?php if (!isset($_POST['table']['no_footer']) || !$_POST['table']['no_footer']): ?>
                    <tfoot>
                        <tr>
                            <?php foreach ($_POST['table']['table_headers'] as $header): ?>
                                <th><?php echo $header; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                    <tbody>
                        <?php if (is_array($_POST['table']['table_data'])): ?>
                            <?php foreach ($_POST['table']['table_data'] as $row): ?>
                                <tr>
                                    <?php foreach ($_POST['table']['table_headers'] as $col): ?>
                                        <td>
                                            <?php if (isset($row[$col])): ?>
                                                <?php echo $row[$col]; ?>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
<?php endif; ?>