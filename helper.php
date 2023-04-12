<?php
function set_flash_message($name, $message) {

    // if exist then remove
    if (isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
    }

    $_SESSION[$name] = $message;
}


function get_flash_name($name) {

    if (isset($_SESSION[$name])) {
        return $name;
    }
    return "";
}

function get_flash_message($name) {

    if (isset($_SESSION[$name])) {
        $message = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $message;
    } else {
        return '';
    }
}

function redirect($url) {
    header("Location:".$url, true, 301);
    exit();
}