<?php

include_once('database.php');
class User
{

    public $db;
    public function __construct() {
        $this->db = new Database();

    }

    function getUser(string $type, mixed $value) {
        return $this->db->execute("select * from user where $type = '$value'");
    }

    function emailExists(string $email, string $request, int $id = null) {
        $user = $this->getUser('email', $email);
        if ($user->num_rows === 1 && $request === 'create') {
            return true;
        } else if ($user->num_rows === 1 && $request === 'update') {
            $result = $user->fetch_array();
            if ($result['id'] === $id) {
                return false;
            } else if ($result['id'] !== $id) {
                return true;
            }
        } else if ($user->num_rows === 0 && ($request === 'create' || $request === 'update')) {
            return false;
        }
    }

    function passwordVerify(string $password, string $type, mixed $value) {
        $user = $this->getUser($type, $value);

        if (password_verify($password, $user->fetch_array()['password'])) {
            return true;
        } else if (!password_verify($password, $user->fetch_array()['password'])) {
            return false;
        }
    }

    function loginUser(string $formEmail, string $formPassword) {
        $login = $this->getUser('email', $formEmail);
        if ($login->num_rows === 1){
            $result = $login->fetch_array();
            $id = $result['id'];
            $name = $result['name'];
            $email = $result['email'];
            $hashed_password = $result['password'];

            $passwordVerified = $this->passwordVerify($formPassword, 'id', $id);

            if ($passwordVerified) {
                session_start();

                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;

                header("location: ../../");
                exit;
            } else {
                $_SESSION['login_password_error'] = "Password does not match given e-mailaddress*";
                header('Location: /authentication');
                exit;
            }
        } else {
            $_SESSION['login_email_error'] = "No user found with given e-mailaddress*";
            header('Location: /authentication');
            exit;
        }
    }

    function createUser(string $formName, string $formEmail, string $formPassword) {
        $_SESSION['signup_form'] = true;

        $data = [
            'name' => $formName,
            'email' => $formEmail,
            'password' => password_hash($formPassword, PASSWORD_DEFAULT),
        ];

        $emailExists = $this->emailExists($data['email'], 'create');

        if ($emailExists) {
            $_SESSION['signup_email_error'] = "E-mailaddress is already registered to an account*";
            header('Location: /authentication');
            exit;
        }

        $signup = $this->db->insert('user', $data);

        if ($signup->error === '') {
            $this->loginUser($data['email'], $formPassword);
        }
    }

    function updateUser(int $formId, string $formName, string $formEmail) {
        $data = [
            'name' => $formName,
            'email' => $formEmail
        ];

        $where = [
            'id' => $formId
        ];

        $emailExists = $this->emailExists($data['email'], 'update', $where['id']);

        if ($emailExists) {
            $_SESSION['update_email_error'] = "E-mailaddress is already registered to an account*";
            header('Location: /account');
            exit;
        }

        $updateUser = $this->db->update('user', $data, $where);

        if ($updateUser->error === '') {
            session_destroy();
            session_start();

            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $formId;
            $_SESSION["name"] = $data['name'];
            $_SESSION["email"] = $data['email'];
            $_SESSION['update_account_success'] = true;

            header('Location: /account');
        }
    }

    function updatePassword(int $formId, string $formOldPassword, string $formNewPassword) {
        unset($_SESSION['update_password_conf_error']);

        $data = [
            'password' => password_hash($formNewPassword, PASSWORD_DEFAULT)
        ];

        $where = [
            'id' => $formId
        ];

        $passwordVerified = $this->passwordVerify($formOldPassword, 'id', $where['id']);

        if (!$passwordVerified) {
            $_SESSION['update_password_old_error'] = "Old password does not match*";
            header('Location: /account');
            exit;
        } else if (isset($_SESSION['update_password_old_error'])) {
            unset($_SESSION['update_password_old_error']);
        }

        $updatePassword = $this->db->update('user', $data, $where);

        if ($updatePassword->error === '') {
            $_SESSION['update_password_success'] = true;
            header('Location: /account');
        }
    }

    function deleteUser(int $formId) {
        $where = [
            'id' => $formId
        ];

        $deleteUser = $this->db->delete('user', $where);

        if ($deleteUser->error === '') {
            session_destroy();

            header('Location: /logout');
        }

    }
}