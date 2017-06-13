<?php
    setcookie('user_id', '', 1);
    setcookie('name', '', 1);
    setcookie('role', '', 1);
    $home_url = 'http://' . $_SERVER['HTTP_HOST'];
    header('Location: ' . $home_url);
?>