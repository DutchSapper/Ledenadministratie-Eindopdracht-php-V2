<?php
    session_start();
    if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'admin') {
        header('Location: ../Views/Dashboard.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../Models/User.php';
    $action = $_POST['action'];

    if ($action === 'delete') {
        $userid = $_POST['id'];
        User::deleteUser($userid);
    }

    $username = htmlspecialchars($_POST['username']);
    $role = htmlspecialchars($_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($action === 'create') {
        User::createUser($username, $role, $password);
    }

    if ($action === 'edit') {
        $userid = $_POST['id'];
        User::updateUser($userid, $username, $role, $password);
    }

    header('Location: ../Views/User/index.php');
    exit();
}

?>