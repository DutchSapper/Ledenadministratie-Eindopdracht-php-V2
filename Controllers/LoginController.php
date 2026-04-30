<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['Username'];
        $password = $_POST['Password'];

        require_once '../Models/User.php';

        $user = User::findByUsername($username);
        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['Role'] = $user['Role'];

            header('Location: ../Views/Dashboard.php');
            exit();
        } else {
            echo 'Ongeldige gebruikersnaam of wachtwoord.';
        }
    }
?>