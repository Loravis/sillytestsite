<?php
    session_start();
    set_include_path('/var/www/phpincludes/rooms');

    require_once "loginhandler.php";

    // Handle login
    $error = '';
    if ($_POST && isset($_POST['login'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        error_log($username);
        error_log($password);

        if (login($username, $password)) {
            header('Location: admin.php');
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    }

    // Handle logout
    if ($_POST && isset($_POST['logout'])) {
        logout();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SillyTestSite - Admin Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <?php set_include_path('/var/www/phpincludes/rooms'); ?>
    </head>

    <body>
        <?php
            include 'header.php';
            echo create_header();
        ?>
        
        <?php if (!isLoggedIn()): ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 class="card-title mb-4 text-center">Admin Login</h2>

                                <?php if ($error): ?>
                                    <div class="alert alert-danger"><?php echo $error; ?></div>
                                <?php endif; ?>
                                
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" required>
                                    </div>
                                    
                                    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 class="card-title mb-4 text-center">Raumliste</h2>
                                <div class="table-responsive">
                                    <?php 
                                        include 'roomstable.php';
                                        create_table(); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>
</html>
