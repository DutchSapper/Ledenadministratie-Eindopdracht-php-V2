<?php
   session_start();
    $_SESSION['bookingyear'] = $_GET['bookingyear'];
    header('Location: ../Views/Dashboard.php');
    exit();
    
?>