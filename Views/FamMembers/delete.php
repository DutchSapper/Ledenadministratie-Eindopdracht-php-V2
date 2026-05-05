<?php
    session_start();
    if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'secretaris') {
        header('Location: ../Dashboard.php');
        exit();
    }
    require_once '../../Models/FamMember.php';
    $famMemId = $_GET['FamMemId'];
    $famid = $_GET['Famid'];
    $members = FamMember::getMemberById($famMemId);
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
            <h2>Familielid Verwijderen</h2>
            <p>Weet je zeker dat je <strong><?php echo $members['Name']; ?></strong> wilt verwijderen?</p>
            <form method="POST" action="../../Controllers/FamMemController.php">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $famMemId; ?>">
                <input type="hidden" name="famid" value="<?php echo $famid; ?>">
                <button type="submit" class="delete">Verwijderen</button>
                <a href="index.php?Famid=<?php echo $famid; ?>"><button type="button">Annuleren</button></a>
            </form>
        </div>
    </div>
</body>
</html>