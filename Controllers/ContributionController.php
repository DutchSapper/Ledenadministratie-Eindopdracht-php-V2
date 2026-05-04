<?php
    session_start();
    if (!isset($_SESSION['Username']) || ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester')) {
        header('Location: ../Views/Dashboard.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../Models/Contribution.php';
        $action = $_POST['action'];

        if ($action === 'edit') {
            $famMemIds = $_POST['famMemId'];
            $amounts = $_POST['amount'];
            $year = $_POST['year'];

            foreach ($famMemIds as $index => $famMemId) {
                Contribution::updateAmount($famMemId, $amounts[$index], $year);
            }
        }
        header('Location: ../Views/Contribution/index.php');
        exit();
    }
?>