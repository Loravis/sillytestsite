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

        return $table;
    }

    function create_admin_table() {
        require 'env.php';
        require 'sql_config.php';

        $result = mysqli_query($conn, "SELECT * FROM roomlist ORDER BY roomnr ASC");
        
        $table = '<table class="table table-striped table-bordered align-middle text-center">';
        $table .= '<thead class="table-dark"><tr>
                        <th>Raumnummer</th>
                        <th>Etage</th>
                        <th>Kapazität</th>
                        <th></th>
                    </tr></thead><tbody>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $table .= sprintf("<tr><td>%d</td><td>%d</td><td>%d</td>", $row["roomnr"], $row["floor"], $row["capacity"]);
            ob_start();
            ?>          
            <td>
                <form method="POST" class="d-inline m-0 p-0">
                    <input type="hidden" name="roomnr" value="<?= $row["roomnr"]?>">
                    <button type="submit" name="delete" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </button>
                </form>
                
                <form name="open_edit_modal" class="d-inline m-0 p-0">
                    <input type="hidden" name="roomnr" value="<?= $row["roomnr"]?>">
                    <input type="hidden" name="floor" value="<?= $row["floor"]?>">
                    <input type="hidden" name="capacity" value="<?= $row["capacity"]?>">
                    <button type="button" name="edit" onclick="setFormValues(this)" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                        </svg>
                    </button>
                </form>

                </td><tr>
            <?php

            $table .= ob_get_clean();

        }
        $table .= "</tbody></table>";

        return $table;
    }
?>