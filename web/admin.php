<?php
    session_start();
    set_include_path('/var/www/phpincludes/rooms');

    require_once "loginhandler.php";

    // Handle login
    $error = '';
    if ($_POST && isset($_POST['login'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        echo $username;
        echo $password;
        
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
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                         <div class="container">
                            <h1>Admin Login</h1>
                            
                            <?php if ($error): ?>
                                <div class="error"><?php echo $error; ?></div>
                            <?php endif; ?>
                            
                            <form method="POST">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" id="username" name="username" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" name="password" required>
                                </div>
                                
                                <button type="submit" name="login" class="btn">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
           <p>Hello</p>
        <?php endif; ?>
    </body>
</html>