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
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Raumliste</h2>
                <?php create_table() ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    function create_table() {
        require 'env.php';
        require 'sql_config.php';

        $result = mysqli_query($conn, "SELECT * FROM roomlist ORDER BY roomnr ASC");
        
        $table = "<table><tr>
                            <th>Raumnummer</th>
                            <th>Etage</th>
                            <th>Kapazität</th>
                        </tr>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $table .= sprintf("<tr><td>%d</td><td>%d</td><td>%d</td>", $row["roomnr"], $row["floor"], $row["capacity"]);
        }
        $table .= "</table>";

        echo $table;
    }
?>

