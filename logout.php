<?php
//start session
session_start();
if(!isset($_SESSION['employee_id']))
    header('Location: index.php');
//unset
unset($_SESSION['employee_id']);
//destroy
session_destroy();
header('Location: index.php');
?>