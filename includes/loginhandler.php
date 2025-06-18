<?php
    // TEMPORARY TESTING. To be removed at the nearest convenience!
    define('ADMINUSER', 'admin');
    define('ADMINPASS', '1234567');
    define('LOGGEDIN', 'loggedin');    

    function isLoggedIn() {
        return isset($_SESSION[LOGGEDIN]) && $_SESSION[LOGGEDIN] === true;
    }

    function login($username, $password) {
        if ($username === ADMINUSER && $password === ADMINPASS) {
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