<?php
    session_start();
        if ($_SESSION['Role'] != 'admin') {
            header('Location: ../Dashboard.php');
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
        <a href="../index.php">Logout <?php session_abort(); ?></a>
    </div>
    <div class="body_container">
        <div class="body_side">
            <a href="../Dashboard.php">Dashboard</a>
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
                    echo '<a href="index.php">User Beheer</a>';
                }
                
            ?>
        </div>
        <div class="body_main">
            <div class="body_main_title">
                <h2>User toevoegen</h2>
            </div>
            <br>
            <div class="body_main_Users_create">
                <form action="../../Controllers/UserController.php" method="post">    
                <label for="">Username:</label>
                <input type="text" name="username" placeholder="username">
                <label for="">role:</label>
                <input id="role" name="role" type="text" placeholder="Role">
                <label for="">Password:</label>
                <input id="password" name="password" type="text">
                <input type="hidden" name="action" value="create">
                <button type="submit">Create</button>
            </form>
            </div>


        </div>
    
    </div>
            
    
</body>
</html>