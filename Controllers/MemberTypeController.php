<?php
    session_start();
    if (!isset($_SESSION['Username']) || ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester')) {
        header('Location: ../Views/Dashboard.php');
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../Models/Membertype.php';
        $action = $_POST['action'];
        if ($action === 'create') {
            Membertype::create($_POST['description'], $_POST['discount']);
        }
        if ($action === 'edit') {
            Membertype::update($_POST['id'], $_POST['description'], $_POST['discount']);
        }
        header('Location: ../Views/Membertype/index.php');
        exit();
    }   
?>