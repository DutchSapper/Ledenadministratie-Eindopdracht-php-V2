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
                <h2>Users</h2>
                
            </div>

            <div class="body_main_Users">
                <?php  
                    require_once '../../Models/User.php';
                    $users = User::getAllUsers();

                    echo "<table>";
                        echo "<tr>";    
                            echo "<th>User id:</th>";
                            echo "<th>Username:</th>";
                            echo "<th>Role:</th>";
                            echo "<th>Hashed Password:</th>";
                        echo "</tr>";

                        foreach ($users as $user){
                            echo "<tr>";
                                echo "<td>". $user['UserId']."</th>";
                                echo "<td>". $user['Username']."</th>";
                                echo "<td>". $user['Role']."</th>";
                                echo "<td>". $user['Password']."</th>";
                                echo "<td><a href='edit.php?Userid=" . $user['UserId'] . "'><button>Bewerken</button></a></td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                    
                ?>
                <a href="User/create"><Button>User Toevoegen</Button></a>
            </div>


        </div>
    
    </div>
            
    
</body>
</html>