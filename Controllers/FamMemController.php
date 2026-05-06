<?php
    session_start();
    if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'secretaris') {
        header('Location: ../Views/Dashboard.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once '../Models/FamMember.php';
    $action = $_POST['action'];

    $name = htmlspecialchars($_POST['name']);
    $dateofbirth = date('Y-m-d', strtotime($_POST['dateofbirth']));
    $memdes = htmlspecialchars($_POST['memdes']);
    $famid = ($_POST['famid']);
    $memberid = $_POST['id'];


    if ($action === 'create') {
        $famMemId = FamMember::createMember($name, $dateofbirth, $memdes, $famid);
        FamMember::assignMemTypByAge($famMemId, $dateofbirth);
        header('Location: ../Views/FamMembers/index.php?Famid=' . $famid);
        exit();
    }

    if ($action === 'edit') {
        FamMember::updateMember($name, $dateofbirth, $memdes, $memberid);
        FamMember::assignMemTypByAge($memberid, $dateofbirth);
        header('Location: ../Views/FamMembers/index.php?Famid=' . $famid);
        exit();
    }  

    if ($action === 'delete') {
        $famMemId = $_POST['id'];
        FamMember::deleteMember($famMemId);
        header('Location: ../Views/FamMembers/index.php?Famid=' . $famid);
        exit();
    }
}

?>