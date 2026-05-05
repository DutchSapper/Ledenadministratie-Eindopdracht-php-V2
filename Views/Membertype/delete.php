<?php
    session_start();
    if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester') {
        header('Location: ../Dashboard.php');
        exit();
    }
    require_once '../../Models/Membertype.php';
    $type = Membertype::getById($_GET['MemTypId']);
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
    <div class="title"><h1>Ledenadministratie</h1></div>
    <div class="body_container">
        <div class="body_main">
            <h2>Membertype Verwijderen</h2>
            <p>Weet je zeker dat je <strong><?php echo $type['Description']; ?></strong> wilt verwijderen?</p>
            <form method="POST" action="../../../Controllers/MemberTypeController.php">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $type['MemTypId']; ?>">
                <button type="submit" class="delete">Verwijderen</button>
                <a href="index.php"><button type="button">Annuleren</button></a>
            </form>
        </div>
    </div>
</body>
</html>