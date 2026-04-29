<?php
    session_start();
        if ($_SESSION['Role'] != 'secretaris' && $_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester') {
            header('Location: ../index.php');
            exit();
        }
    $selectedYear = $_SESSION['bookingyear'] ?? date('Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/style.css">
    <title>Ledenadministratie</title>
</head>
<body>
    <div class="title">
        <h1>Ledenadministratie</h1>
    </div>
    <div class="title_right">
        <a href="../index.php">Logout <?php session_abort(); ?></a>
    </div>
    <div class="body_container">
        <div class="body_side">
            <?php 
                if ($_SESSION['Role'] == 'admin' || $_SESSION['Role'] == 'secretaris'){
                    echo '<a href="Families/index.php">Familie Beheer</a>';
                    echo '<a href="Families/create.php">Familie Toevoegen</a>';
                    echo '<a href="FamMembers/index.php">Familie Leden</a>';
                }

                if ($_SESSION['Role'] == 'admin' || $_SESSION['Role'] == 'penningmeester'){
                    echo '<a href="Contribution/index.php">Contributie Beheer</a>';
                }

                if ($_SESSION['Role'] == 'admin'){
                    echo '<a href="User/index.php">User Beheer</a>';
                }
                
            ?>
        </div>
        <div class="body_main">
            <div class="body_main_title">
                <h2>Hier staat ook wat</h2>
            </div>
        </div>
    
    </div>
            
    
</body>
</html>