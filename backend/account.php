<?php

session_start();

include_once '../model/user.php';

validate();

function validate() {
    $user = new User();
    $id = $_POST['id'];

    if ($_POST['account'] === 'updateUser') {
        $name = $_POST['name'];
        $email = $_POST ['email'];
        validateEmail($email);

        $user->updateUser($id, $name, $email);
    }

    if ($_POST['account'] === 'updatePassword') {
        $_SESSION['update_password_form'] = true;
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $newpasswordConf = $_POST['newPasswordConf'];
        validateNewPassword($newPassword, $newpasswordConf);

        $user->updatePassword($id, $oldPassword, $newPassword);
    }

    if ($_POST['account'] === 'deleteUser') {
        $user->deleteUser($id);
    }
}

function validateEmail(string $email) {
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    if (!preg_match ($pattern, $email) ) {
        $_SESSION['update_email_error'] = "E-mailaddress is not valid*";
        header('Location: /account');
        exit;
    }
}

function validateNewPassword(string $newPassword, string $newPasswordConf) {
    if ($newPassword !== $newPasswordConf) {
        $_SESSION['update_password_conf_error'] = "New passwords do not match*";
        header('Location: /account');
        exit;
    }
}
?>