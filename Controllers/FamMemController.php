<?php
    session_start();
    if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'secretaris') {
        header('Location: ../Views/Dashboard.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    $name = htmlspecialchars($_POST['name']);
    $dateofbirth = date('Y-m-d', strtotime($_POST['dateofbirth']));
    $memdes = htmlspecialchars($_POST['memdes']);
    $famid = ($_POST['famid']);

    require_once '../Models/FamMember.php';

    if ($action === 'create') {
        FamMember::createMember($name, $dateofbirth, $memdes, $famid);
        header('Location: ../Views/FamMembers/index.php?Famid=' . $famid);
        exit();
    }

    if ($action === 'edit') {
        $memberid = $_POST['id'];
        FamMember::updateMember($name, $dateofbirth, $memdes, $memberid);
        
        header('Location: ../Views/FamMembers/index.php?Famid=' . $famid);
        exit();
    }   
}

?>