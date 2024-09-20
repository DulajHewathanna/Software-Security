<?php

session_start();

session_unset();
session_destroy();


header('Location: http://localhost/birth_certificate_system/admin_login.php');
exit();
?>
