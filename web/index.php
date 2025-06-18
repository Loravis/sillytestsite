<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SillyTestSite - Raumliste</title>
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
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title mb-4 text-center">Raumliste</h2>
                        <div class="table-responsive">
                            <?php
                                include 'roomstable.php'; 
                                echo create_table();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
