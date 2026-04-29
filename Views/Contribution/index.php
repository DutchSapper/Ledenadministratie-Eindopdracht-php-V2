<?php
    session_start();
        if ($_SESSION['Role'] != 'secretaris' && $_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester') {
            header('Location: ../index.php');
            exit();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/style.css">
    <title>Ledenadministratie</title>
</head>
<body>
    <div class="title">
        <h1>Ledenadministratie</h1>
    </div>
        Test contributie Beheer
    </div>
    
</body>
</html>