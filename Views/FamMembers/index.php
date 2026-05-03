<?php
    session_start();
        if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'secretaris') {
            header('Location: ../Dashboard.php');
            exit();
        }
        require_once '../../Models/Family.php';
        require_once '../../Models/FamMember.php';
        
        $famid = $_GET['Famid'];
        $familie = Family::getById($famid);
        var_dump($famid);
        
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
                <h2>Familie Leden</h2>
                
            </div>

            <div class="body_main_families">
                <?php  
                    
                    
                    echo "<table>";
                            echo "<tr>";    
                                echo "<th>Familie naam:</th>";
                                echo "<th>Adres</th>";
                                echo "<th>Dorp/Stad</th>";
                                echo "<th>Postcode</th>";
                                echo "<th>Land</th>";
                            echo "</tr>"; 
                    
                        echo "<tr class='tr_family'>";
                            echo "<th>" . 'Famname' . "</th>";
                            echo "<td>" . 'Adress'. "</td>";
                            echo "<td>" . 'City' . "</td>";
                            echo "<td>" . 'Postcode' . "</td>";
                            echo "<td>" . 'Country' . "</td>";
                        echo "</tr>";
                    
                    echo "</table>";
                    // $fammembers = FamMember::getFamMembers($family['FamId']);


                ?>
                <a href="create.php"><Button>familie Toevoegen</Button></a>
            </div>


        </div>
    
    </div>
            
    
</body>
</html>