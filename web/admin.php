<?php
    session_start();
    set_include_path('/var/www/phpincludes/rooms');

    require_once "loginhandler.php";
    require "sql_config.php";

    // Handle login
    $error = '';
    if ($_POST && isset($_POST['login'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

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

    // Handle room deletion
    if ($_POST && isset($_POST['delete'])) {
        $sql = "DELETE FROM roomlist WHERE roomnr=" . intval($_POST['roomnr']) . ";";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $error = "Löschen fehlgeschlagen.";
        }
    }

    // Handle room addition
    if ($_POST && isset($_POST['save_add_room'])) {
        $stmt = $conn->prepare("INSERT INTO roomlist (roomnr, floor, capacity) VALUES (?, ?, ?)");

        if ($stmt) {
            try {
                $stmt->bind_param("iii", $_POST['add_new_roomnr'], $_POST['add_new_floor'], $_POST['add_new_capacity']);
                $stmt->execute();
            } catch (mysqli_sql_exception $e) {
                $error = sprintf(
                    "Ein Raum mit der Raumnummer %d existiert bereits. Der neue Raum wurde nicht hinzugefügt.",
                    $_POST['add_new_roomnr']
                );
            }
        } else {
            $error = sprintf("Ein interner SQL Fehler ist aufgetreten. Bitte kontaktieren Sie ihren Systemadministrator.");
        }
    }

    // Handle room edit
    if ($_POST && isset($_POST['save_edit_room'])) {
        $stmt = $conn->prepare("UPDATE roomlist SET roomnr = ?, floor = ?, capacity = ? WHERE roomnr = ?");

        if ($stmt) {
            try {
                $stmt->bind_param("iiii", $_POST['edit_new_roomnr'], $_POST['edit_new_floor'], $_POST['edit_new_capacity'], $_POST['edit_old_roomnr']);
                $stmt->execute();
            } catch (mysqli_sql_exception $e) {
                $error = sprintf(
                    "Ein Raum mit der Raumnummer %d existiert bereits. Der neue Raum wurde nicht hinzugefügt.",
                    $_POST['edit_new_roomnr']
                );
            }
        } else {
            $error = sprintf("Ein interner SQL Fehler ist aufgetreten. Bitte kontaktieren Sie ihren Systemadministrator.");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SillyTestSite - <?= isLoggedIn() ? "Admin Panel" : "Admin Login"?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <?php set_include_path('/var/www/phpincludes/rooms'); ?>
        <style>
            .fixed-width-addon {
                width: 125px;
            }
        </style>
        <script>
            <?php echo file_get_contents('/var/www/phpincludes/rooms/formhandler.js'); ?>
            <?php echo file_get_contents('/var/www/phpincludes/rooms/tablebuttonhandler.js'); ?>
        </script>
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

                                <?php if (!empty($error)): ?>
                                    <div class="alert alert-danger"><p><?= $error ?></p></div>
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
            <?php echo file_get_contents('/var/www/phpincludes/rooms/add_modal.html'); ?>
            <?php echo file_get_contents('/var/www/phpincludes/rooms/edit_modal.html'); ?>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 class="card-title mb-4 text-center">Raumliste</h2>
                                <?php if (!empty($error)): ?>
                                    <div class="alert alert-warning d-flex align-items-center justify-content-center" role="alert" style="min-height: 60px; padding: 0 1rem;">
                                        <p class="mb-0 text-center w-100"><?= $error ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="table-responsive">
                                    <?php 
                                        include 'roomstable.php';
                                        echo create_admin_table(); 
                                    ?>
                                </div>

                                <button type="button" name="add" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                    </svg> Hinzufügen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>
</html>
