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
            <a href="Dashboard.php">Dashboard</a>
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
                <h2>Contributie</h2>
                <form action="../Controllers/BookingYearController.php" method="GET">
                      <label for="bookingyear"> Jaar:</label>
                      <select name="bookingyear">
                        <?php
                            require_once '../Models/Booking.php';
                            $years = Booking::getAllYears();
                            $selectedYear = $_SESSION['bookingyear'] ?? date('Y');  
                            foreach ($years as $year) {
                            $selected = ($year['Year'] == $selectedYear) ? 'selected' : '';
                                echo "<option value='{$year['Year']}' $selected>{$year['Year']}</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="Kiezen">
                </form>
            </div>
            <div class="body_main_contribution">
                <?php 
                        echo "<table>";
                            echo "<tr>";    
                                echo "<th>Familie naam:</th>";                      // Family name
                                echo "<th>Familie Leden:</th>";                     // Family Members
                                echo "<th>Contributie kosten:</th>";                // Total Contribut
                            echo "</tr>"; 
                                    require_once '../Models/Contribution.php';
                                    require_once '../Models/FamMember.php';
                                    $selectedYear = $_SESSION['bookingyear'] ?? date('Y');
                                    $families = Contribution::FamContribution($selectedYear);

                                    if ($_SESSION['Role'] == 'admin'){
                                        foreach ($families as $family) {
                                            echo "<tr class='tr_family'>";
                                                echo "<td>" . $family['Famname'] . "</td>";
                                                echo "<td> </td>";
                                                echo "<td>€" . $family['TotalContribution'] . "</td>";
                                                echo "<td><a href='Families/edit.php?Famid=" . $family['FamId'] . "'><button>Bewerken</button></a></td>";
                                                echo "<td><a href='Contribution/edit.php?Famid=" . $family['FamId'] . "'><button>Contributie Beheren</button></a></td>";
                                            echo "</tr>";
                                            
                                            $fammembers = FamMember::getFamMembers($family['FamId']);
                                            foreach ($fammembers as $member) {
                                                echo "<tr class='tr_member'>";
                                                    echo "<td></td>";
                                                    echo "<td>" . $member['Name'] . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                    if ($_SESSION['Role'] == 'secretaris'){
                                        foreach ($families as $family) {
                                            echo "<tr class='tr_family'>";
                                                echo "<td>" . $family['Famname'] . "</td>";
                                                echo "<td> </td>";
                                                echo "<td>€" . $family['TotalContribution'] . "</td>";
                                                echo "<td><a href='Families/edit.php?Famid=" . $family['FamId'] . "'><button>Bewerken</button></a></td>";
                                            echo "</tr>";
                                            
                                            $fammembers = FamMember::getFamMembers($family['FamId']);
                                            foreach ($fammembers as $member) {
                                                echo "<tr class='tr_member'>";
                                                    echo "<td></td>";
                                                    echo "<td>" . $member['Name'] . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                    if ($_SESSION['Role'] == 'penningmeester'){
                                        foreach ($families as $family) {
                                            echo "<tr class='tr_family'>";
                                                echo "<td>" . $family['Famname'] . "</td>";
                                                echo "<td> </td>";
                                                echo "<td>€" . $family['TotalContribution'] . "</td>";
                                                echo "<td><a href='Contribution/edit.php?Famid=" . $family['FamId'] . "'><button>Contributie Beheren</button></a></td>";
                                            echo "</tr>";
                                            
                                            $fammembers = FamMember::getFamMembers($family['FamId']);
                                            foreach ($fammembers as $member) {
                                                echo "<tr class='tr_member'>";
                                                    echo "<td></td>";
                                                    echo "<td>" . $member['Name'] . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                    echo "</table>";
                ?>
            </div>
        </div>
    
    </div>
            
    
</body>
</html>