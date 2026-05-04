<?php
    session_start();
    if (!isset($_SESSION['Username']) || ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester')) {
        header('Location: ../Views/Dashboard.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../Models/Contribution.php';
        require_once '../Models/FamMember.php';
        require_once '../Models/Membertype.php';
        $action = $_POST['action'];

        if ($action === 'edit') {
            $famMemIds = $_POST['famMemId'];
            $memTypIds = $_POST['memTypId'];
            $year = $_POST['year'];

            foreach ($famMemIds as $index => $famMemId) {
                $memTypId = $memTypIds[$index];
                
                // Korting ophalen van het gekozen membertype
                $membertype = Membertype::getById($memTypId);
                $discount = $membertype['DiscountPercentage'];
                
                // Bedrag berekenen: €100 - korting%
                $amount = 100 - (100 * $discount / 100);

                // MemberType updaten in FamMember
                FamMember::updateMemTyp($famMemId, $memTypId);

                // Bedrag updaten in Contribution
                Contribution::updateAmount($famMemId, $amount, $year);
            }
        }
        header('Location: ../Views/Contribution/index.php');
        exit();
    }
?>