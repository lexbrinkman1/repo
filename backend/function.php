<?php

function clearSession() {
    if (isset($_SESSION['update_account_success'])) {
        unset($_SESSION['update_account_success']);
    }

    if (isset($_SESSION['login_password_error'])) {
        unset($_SESSION['login_password_error']);
    }

    if (isset($_SESSION['login_email_error'])) {
        unset($_SESSION['login_email_error']);
    }

    if (isset($_SESSION['signup_email_error'])) {
        unset($_SESSION['signup_email_error']);
    }

    if (isset($_SESSION['update_email_error'])) {
        unset($_SESSION['update_email_error']);
    }

    if (isset($_SESSION['update_password_old_error'])) {
        unset($_SESSION['update_password_old_error']);
    }

    if (isset($_SESSION['update_password_conf_error'])) {
        unset($_SESSION['update_password_conf_error']);
    }

    if (isset($_SESSION['update_password_success'])) {
        unset($_SESSION['update_password_success']);
    }

    if (isset($_SESSION['update_password_form'])) {
        unset($_SESSION['update_password_form']);
    }

    if (isset($_SESSION['update_email_error'])) {
        unset($_SESSION['update_email_error']);
    }
}