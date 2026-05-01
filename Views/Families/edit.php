<?php
    session_start();
        if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'secretaris') {
            header('Location: ../Dashboard.php');
            exit();
        }
        require_once '../../Models/Family.php';
        $famid = $_GET['Famid'];
        $family = Family::getById($famid);
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
                    echo '<a href="index.php">Familie Beheer</a>';
                    echo '<a href="create.php">Familie Toevoegen</a>';
                }

                if ($_SESSION['Role'] == 'admin' || $_SESSION['Role'] == 'penningmeester'){
                    echo '<a href="../Contribution/index.php">Contributie Beheer</a>';
                }

                if ($_SESSION['Role'] == 'admin'){
                    echo '<a href="../User/index.php">User Beheer</a>';
                }
                
            ?>
        </div>
        <div class="body_main">
            <div class="body_main_title">
                <h2>Familie: </h2>
                
            </div>

            <div class="body_main_families_edit">
                <form action="../../Controllers/FamilyController.php" method="POST">
                    <h2><?php echo $family['Famname']; ?>  </h2>
                    <label for="">Achternaam:</label>
                    <input type="text" name="famname" required value="<?php echo $family['Famname']; ?>" placeholder="<?php echo $family['Famname']; ?>">
                    <br>
                    <label for="">Adres:</label>
                    <input type="text" name="adress" required placeholder="<?php echo $family['Adress']; ?>">
                    <br>
                    <label for="">Dorp/Stad:</label>
                    <input type="text" name="city" required placeholder="<?php echo $family['City']; ?>">
                    <br>
                    <label for="">Postcode:</label>
                    <input type="text" name="postcode" required placeholder="<?php echo $family['Postcode']; ?>">
                    <br>
                    <label for="">Land:</label>
                    <input type="text" name="country" required value="<?php echo $family['Country']; ?>" placeholder="<?php echo $family['Country']; ?>">
                    <br>
                    <button type="submit">Uitvoeren</button>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo $famid['famid']; ?>">
                </form>
                
            </div>


        </div>
    
    </div>
            
    
</body>
</html>