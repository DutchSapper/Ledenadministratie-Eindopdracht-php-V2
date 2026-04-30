<?php
    session_start();
    if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'admin') {
        header('Location: ../Views/Dashboard.php');
        exit();
    }

    // Create User
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $role = htmlspecialchars($_POST['role']);
        $password = htmlspecialchars($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT); 

        require_once '../Models/User.php';
        User::createUser($username, $role, $password);
        header('Location: ../Views/User/index.php');
        exit();
    }

    // Edit User
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $role = htmlspecialchars($_POST['role']);
        $password = htmlspecialchars($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT); 

        require_once '../Models/User.php';
        User::updateUser($username, $role, $password);
        header('Location: ../Views/User/index.php');
        exit();
    }
    // Delete User


?>