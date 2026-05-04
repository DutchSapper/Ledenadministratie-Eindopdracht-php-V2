<?php
    session_start();
        if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'secretaris') {
            header('Location: ../Dashboard.php');
            exit();
        }
        require_once '../../Models/Family.php';
        require_once '../../Models/FamMember.php';
        require_once '../../Models/Membertype.php';
        
        $famid = $_GET['Famid'];
        $family = Family::getById($famid);
        $fammembers = FamMember::getFamMembers($family['FamId']);
        $memtypes = Membertype::getMembertype($famid);
    
        
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
                <h2>Familie Leden</h2>
                
            </div>
            <br>
            <div class="body_main_families">
                <h2>Familie <?php echo $family['Famname'] ?> </h2>
                <?php  
                    
                    
                    echo "<table>";
                            echo "<tr>";    
                                echo "<th>Naam:</th>";
                                echo "<th>Geboorte datum:</th>";
                                echo "<th>Leeftijd:</th>";
                                echo "<th>Beschrijving</th>";
                                echo "<th>Soort Lid</th>";
                                echo "<th></th>";
                                echo "<th></th>";
                            echo "</tr>"; 
                    
                        echo "<tr class='tr_members'>";
                            foreach ($fammembers as $index => $member) {
                            echo "<tr class='tr_member'>";
                                echo "<td>" . $member['Name'] . "</td>";
                                echo "<td>" . date('d-m-Y', strtotime($member['DateOfBirth'])). "</td>";
                                echo "<td>" . Date('Y') - date('Y', strtotime($member['DateOfBirth'])) . "</td>";
                                echo "<td>" . $member['MemDes'] . "</td>";
                                echo "<td>" . $memtypes[$index]['Description'] . "</td>";
                                echo "<td><a href='edit.php?FamMemId=" . $member['FamMemId'] . "'><button>Bewerken</button></a></td>";
                            echo "</tr>";
                        }
                        echo "</tr>";
                    echo "</table>"
                    
                ?>
                <br>
                <a href="create.php?FamId=<?php echo $family['FamId']; ?>"><Button>Familie lid Toevoegen</Button></a>
            </div>
        </div>
    </div>
            
    
</body>
</html>