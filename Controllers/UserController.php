<?php
    session_start();
    if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'admin') {
        header('Location: ../Views/Dashboard.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    $username = htmlspecialchars($_POST['username']);
    $role = htmlspecialchars($_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    require_once '../Models/User.php';

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


    // // Create User
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //     $username = htmlspecialchars($_POST['username']);
    //     $role = htmlspecialchars($_POST['role']);
    //     $password = htmlspecialchars($_POST['password']);
    //     $password = password_hash($password, PASSWORD_DEFAULT); 

    //     require_once '../Models/User.php';
    //     User::createUser($username, $role, $password);
    //     header('Location: ../Views/User/index.php');
    //     exit();
    // }

    // // Edit User
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $username = htmlspecialchars($_POST['username']);
    //     $role = htmlspecialchars($_POST['role']);
    //     $password = htmlspecialchars($_POST['password']);
    //     $password = password_hash($password, PASSWORD_DEFAULT); 

    //     require_once '../Models/User.php';
    //     User::updateUser($username, $role, $password);
    //     header('Location: ../Views/User/index.php');
    //     exit();
    // }
    // // Delete User


?>