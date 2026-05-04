<?php
    session_start();
        if ($_SESSION['Role'] != 'admin') {
            header('Location: ../Dashboard.php');
            exit();
        }

    require_once '../../Models/User.php';
    $userid = $_GET['UserId'];
    $user = User::getById($userid);
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
                    echo '<a href="../Contribution/index.php">Contributie Beheer</a>';
                    echo '<a href="../Membertype/index.php">Membertype Beheer</a>';
                }

                if ($_SESSION['Role'] == 'admin'){
                    echo '<a href="index.php">User Beheer</a>';
                }
                
            ?>
        </div>
        <div class="body_main">
            <div class="body_main_title">
                <h2>Users Bewerken</h2>
            </div>

            <div class="body_main_users_edit">
                <form action="../../Controllers/UserController.php" method="post">
                    <h2>User <?php echo $user['Username']; ?>  </h2>
                    <label for="">Username:</label>
                    <input type="text" name="username" required placeholder="<?php echo $user['Username']; ?>">
                    <label for="">New Password:</label>
                    <input id="password" name="password" required type="password">
                    <label hidden for="" >role:</label>
                    <input hidden id="role" name="role" required type="text" value="">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo $user['UserId']; ?>">
                    <button type="submit">Uitvoeren</button>
                </form>
            </div>


        </div>
    
    </div>
            
    
</body>
</html>