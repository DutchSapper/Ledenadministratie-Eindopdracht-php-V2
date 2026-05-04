<?php
    session_start();
    if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester') {
        header('Location: ../Dashboard.php');
        exit();
    }
    require_once '../../Models/Membertype.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $description = $_POST['description'];
        $discount = $_POST['discount'];
        Membertype::create($description, $discount);
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/style.css">
    <title>Ledenadministratie</title>
</head>
<body>
    <div class="title">
        <h1>Ledenadministratie</h1>
    </div>
    <div class="title_right">
        <a href="../../index.php">Logout <?php session_abort(); ?></a>
    </div>
    <div class="body_container">
        <div class="body_side">
            <a href="../Dashboard.php">Dashboard</a>
            <?php 
                if ($_SESSION['Role'] == 'admin' || $_SESSION['Role'] == 'secretaris'){
                    echo '<a href="../Families/index.php">Familie Beheer</a>';
                }
                if ($_SESSION['Role'] == 'admin' || $_SESSION['Role'] == 'penningmeester'){
                    echo '<a href="../Contribution/index.php">Contributie Beheer</a>';
                    echo '<a href="index.php">Membertype Beheer</a>';
                }
                if ($_SESSION['Role'] == 'admin'){
                    echo '<a href="../User/index.php">User Beheer</a>';
                }
            ?>
        </div>
        <div class="body_main">
            <div class="body_main_title">
                <h2>Membertype Toevoegen</h2>
            </div>
            <br>
            <form method="POST" action="../../Controllers/MemberTypeController.php">
                <label>Omschrijving:</label><br>
                <input type="text" name="description" required><br><br>
                <label>Korting %:</label><br>
                <input type="number" name="discount" min="0" max="100" required><br><br>
                <input type="hidden" name="action" value="create">
                <button type="submit">Opslaan</button>
                <a href="index.php"><button type="button">Annuleren</button></a>
            </form>
        </div>
    </div>
</body>
</html>