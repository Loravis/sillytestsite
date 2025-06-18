<?php
    function create_table() {
        require 'env.php';
        require 'sql_config.php';

        $result = mysqli_query($conn, "SELECT * FROM roomlist ORDER BY roomnr ASC");
        
        $table = '<table class="table table-striped table-bordered align-middle text-center">';
        $table .= '<thead class="table-dark"><tr>
                        <th>Raumnummer</th>
                        <th>Etage</th>
                        <th>Kapazität</th>
                    </tr></thead><tbody>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $table .= sprintf("<tr><td>%d</td><td>%d</td><td>%d</td></tr>", $row["roomnr"], $row["floor"], $row["capacity"]);
        }
        $table .= "</tbody></table>";

        echo $table;
    }
?>