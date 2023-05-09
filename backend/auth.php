<?php

session_start();

include_once '../model/user.php';

validate();

function validate() {
        $user = new User();
        $name = $_POST['name'];
        $email = $_POST ['email'];
        $password = $_POST['password'];
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match ($pattern, $email) ){
            if ($_POST['auth'] === 'login') {
                $_SESSION['login_email_error'] = "E-mailaddress is not valid*";
            } else if ($_POST['auth'] === 'signup') {
                $_SESSION['signup_form'] = true;
                $_SESSION['signup_email_error'] = "E-mailaddress is not valid*";
            }

            header('Location: /authentication');
            exit;
        }

        if ($_POST['auth'] === 'login') {
            $user->loginUser($email, $password);
        }

        if ($_POST['auth'] === 'signup') {
            $user->createUser($name, $email, $password);
        }
    }
?>
