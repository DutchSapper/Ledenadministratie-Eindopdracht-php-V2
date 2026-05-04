<?php
    session_start();
        if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'secretaris') {
            header('Location: ../Dashboard.php');
            exit();
        }
        require_once '../../Models/Family.php';
        $famid = $_GET['FamId'];
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
                    echo '<a href="../Families/create.php">Familie Toevoegen</a>';
                }

                if ($_SESSION['Role'] == 'admin' || $_SESSION['Role'] == 'penningmeester'){
                    echo '<a href="../Contribution/index.php">Contributie Beheer</a>';
                    echo '<a href="../Membertype/index.php">Membertype Beheer</a>';
                }

                if ($_SESSION['Role'] == 'admin'){
                    echo '<a href="../User/index.php">User Beheer</a>';
                }
                
            ?>
        </div>
        <div class="body_main">
            <div class="body_main_title">
                <h2>Familie lid toevoegen</h2>
            </div>

            <div class="body_main_users_edit">
                <form action="../../Controllers/FamMemController.php" method="post">
                    <h2></h2>
                    <label for="">Naam:</label>
                    <input type="text" name="name" required >
                    <label for="">Geboortedatum:</label>
                    <input id="dateofbirth" name="dateofbirth" placeholder="DD-MM-YYYY">
                    <label for="">Beschrijving</label>
                    <input id="memdes" name="memdes" placeholder="Vader, moeder, zoon, dochter">

                    <input type="hidden" name="famid" value="<?php echo $famid; ?>">
                    <input type="hidden" name="action" value="create">
                    <br>
                    <button type="submit">Uitvoeren</button>
                </form>
            </div>


        </div>
    
    </div>
            
    
</body>
</html>