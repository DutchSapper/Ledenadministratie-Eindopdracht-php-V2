<?php
    session_start();
        if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'secretaris') {
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
        <a href="../../index.php">Logout <?php session_abort(); ?></a>
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
                <h2>Families</h2>
                
            </div>
            <br>
            <div class="body_main_families">
                <?php  
                    require_once '../../Models/Family.php';
                    require_once '../../Models/FamMember.php';
                    $families = Family::getAll();

                    
                    echo "<table>";
                            echo "<tr>";    
                                echo "<th>Familie naam:</th>";
                                echo "<th>Adres</th>";
                                echo "<th>Dorp/Stad</th>";
                                echo "<th>Postcode</th>";
                                echo "<th>Land</th>";
                            echo "</tr>"; 
                    foreach ($families as $family){
                        echo "<tr class='tr_family'>";
                            echo "<th>" . $family['Famname'] . "</th>";
                            echo "<td>" . $family['Adress'] . "</td>";
                            echo "<td>" . $family['City'] . "</td>";
                            echo "<td>" . $family['Postcode'] . "</td>";
                            echo "<td>" . $family['Country'] . "</td>";
                            echo "<td><a href='edit.php?Famid=" . $family['FamId'] . "'><button>Bewerken</button></a></td>";
                            echo "<td><a href='../FamMembers/index.php?Famid=" . $family['FamId'] . "'><button>Leden beheren</button></a></td>";
                            echo "<td><a href=''.php?Famid=" . $family['FamId'] . "'><button class='delete'>Verwijderen</button></a></td>";
                        echo "</tr>";

                        $fammembers = FamMember::getFamMembers($family['FamId']);
                        foreach ($fammembers as $member) {
                            echo "<tr class='tr_member'>";
                                echo "<td>" . $member['Name'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                    


                ?>
                <a href="create.php"><Button>familie Toevoegen</Button></a>
            </div>


        </div>
    
    </div>
            
    
</body>
</html>