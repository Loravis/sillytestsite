<?php
    define('LOGGEDIN', 'loggedin');    

    function isLoggedIn() {
        return isset($_SESSION[LOGGEDIN]) && $_SESSION[LOGGEDIN] === true;
    }

    function login($username, $password) {
        set_include_path('/var/www/phpincludes/rooms');
        require 'env.php';
        require 'sql_config.php';

        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND passwd = ?;");
        try {
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $assoc = $result->fetch_assoc();

            if ($assoc) {
                $_SESSION[LOGGEDIN] = true;
                return true;
            } 

            return false;

        } catch (mysqli_sql_exception $ex) {
            return false;
        }
        
    }

    function logout() {
        session_unset();
        session_destroy();
    }
?>