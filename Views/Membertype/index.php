<?php
    session_start();
    if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester') {
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
                    echo '<a href="../Families/index.php">Familie Beheer</a>';
                    echo '<a href="../Families/create.php">Familie Toevoegen</a>';
                }
                if ($_SESSION['Role'] == 'admin' || $_SESSION['Role'] == 'penningmeester'){
                    echo '<a href="../Contribution/index.php">Contributie Beheer</a>';
                    echo '<a href="index.php">Membertype Beheer</a>';
                }
                if ($_SESSION['Role'] == 'admin'){
                    echo '<a href="../User/index.php">User Beheer</a>';
                }
            ?>
        </div>
        <div class="body_main">
            <div class="body_main_title">
                <h2>Membertype Beheer</h2>
            </div>
            <br>
            <div class="body_main_families">
                <?php
                    require_once '../../Models/Membertype.php';
                    $membertypes = Membertype::getAll();

                    echo "<table>";
                        echo "<tr>";
                            echo "<th>Type</th>";
                            echo "<th>Korting %</th>";
                            echo "<th></th>";
                            echo "<th></th>";
                        echo "</tr>";
                    foreach ($membertypes as $type) {
                        echo "<tr class='tr_family'>";
                            echo "<td>" . $type['Description'] . "</td>";
                            echo "<td>" . $type['DiscountPercentage'] . "%</td>";
                            echo "<td><a href='edit.php?MemTypId=" . $type['MemTypId'] . "'><button>Bewerken</button></a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
                <br>
                <a href="create.php"><button>Membertype Toevoegen</button></a>
            </div>
        </div>
    </div>
</body>
</html>