<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';
require_once 'helper.php';

require_once 'models/sql_common.php';
$sql = new SQL_Common;

$result = array();
if ($_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASS) {
    $_SESSION['arms']['logged'] = ADMIN_USERNAME;
    $result['success'] = true;
} else {
    $user = $sql->isValidUser($_POST['username'], $_POST['password']);
    if (!empty($user)) {
        $_SESSION['arms']['logged'] = $user;
        $result['success'] = true;
    } else {
        $_SESSION['arms']['logged'] = array();
        $result['success'] = false;
        $result['error'] = 'Invalid user credentials.';
    }
}

echo json_encode($result);

?>