<?php
//var_dump($_SESSION);
?>

<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="../assets/css/account.css">

        <title>Account</title>
    </head>
    <body>
        <div class="container p-0">
            <div class="flex-row">
                <a href="/"><i class="material-icons">house</i></a>
                <h1 class="h3 mb-3"><?php echo $_SESSION['name'] ?></h1>
            </div>
            <div class="row">
                <div class="col-md-5 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Settings</h5>
                        </div>
                        <div class="list-group list-group-flush" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-toggle="list" id="a-account" href="#account" role="tab">
                                Account
                            </a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" id="a-password" href="#password" role="tab">
                                Password
                            </a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" id="a-deleteAccount" href="#deleteAccount" role="tab">
                                Delete account
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-xl-8">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Public info</h5>
                                    <div class="success-msg">
                                        <?php
                                            if (isset($_SESSION['update_account_success'])) {
                                                echo 'Account successfully updated';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="../backend/account.php">
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                                        <input type="hidden" name="account" value="updateUser">
                                        <div class="form-group">
                                            <label for="inputUsername">Naam</label>
                                            <input type="text" class="form-control" name="name" id="inputUsername" value="<?php echo $_SESSION['name'] ?>" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUsername">E-mailaddress</label>
                                            <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $_SESSION['email'] ?>" placeholder="E-mailaddress">
                                            <?php
                                                if (isset($_SESSION['update_email_error'])) {
                                            ?>
                                            <span class="signup_error_message">
                                                <?php echo $_SESSION['update_email_error']; ?>
                                            </span>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Password </h5>
                                    <div class="success-msg">
                                        <?php
                                            if (isset($_SESSION['update_password_success'])) {
                                                echo 'Account successfully updated';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="../backend/account.php">
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                                        <input type="hidden" name="account" value="updatePassword">
                                        <div class="form-group">
                                            <label for="inputPasswordCurrent">Current password</label>
                                            <input type="password" name="oldPassword" class="form-control" id="inputPasswordCurrent">
                                            <?php
                                                if (isset($_SESSION['update_password_old_error'])) {
                                            ?>
                                            <span class="signup_error_message">
                                                <?php echo $_SESSION['update_password_old_error']; ?>
                                            </span>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPasswordNew">New password</label>
                                            <input type="password" name="newPassword" class="form-control" id="inputPasswordNew">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPasswordNew2">Verify password</label>
                                            <input type="password" name="newPasswordConf" class="form-control" id="inputPasswordNew2">
                                            <?php
                                                if (isset($_SESSION['update_password_conf_error'])) {
                                            ?>
                                            <span class="signup_error_message">
                                                <?php echo $_SESSION['update_password_conf_error']; ?>
                                            </span>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="deleteAccount" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Delete account</h5>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="../backend/account.php">
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                                        <input type="hidden" name="account" value="deleteUser">
                                        <div class="form-group">
                                            <label for="inputPasswordNew2">Deleting your account will be permanent and can not be reversed!</label>
                                        </div>
                                        <button type="submit" class="btn btn-danger">Delete account</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript"></script>
    </body>
    <?php
    if (isset($_SESSION['update_password_form'])) {
        ?>
        <script>
            console.log(<?php echo $_SESSION['update_password_form']?>)
            if (<?php echo $_SESSION['update_password_form']; ?> === 1) {
                let oldElement = document.getElementById('account')
                let oldAElement = document.getElementById('a-account')
                oldElement.classList.remove('active', 'show')
                oldAElement.classList.remove('active')
                let newElement = document.getElementById('password')
                let newAElement = document.getElementById('a-password')
                newElement.classList.add('active', 'show')
                newAElement.classList.add('active')
            }
        </script>
        <?php
    }
    ?>
</html>