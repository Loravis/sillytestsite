<?php
    define('LOGGEDIN', 'loggedin');    

    function isLoggedIn() {
        return isset($_SESSION[LOGGEDIN]) && $_SESSION[LOGGEDIN] === true;
    }

    function login($username, $password) {
        set_include_path('/var/www/phpincludes/rooms');
        require 'env.php';
        require 'sql_config.php';

        $sql = "SELECT * FROM admins WHERE username = \"" . $username . "\" AND passwd = \"" . $password . "\";";

        error_log($sql);

        $result = mysqli_query($conn, $sql);

        $assoc = mysqli_fetch_assoc($result);

        if ($assoc) {
            $_SESSION[LOGGEDIN] = true;
            return true;
        } 

        return false;
    }

    function logout() {
        session_unset();
        session_destroy();
    }
?>