<?php
    session_start();
    if ($_SESSION['Role'] != 'admin' && $_SESSION['Role'] != 'penningmeester') {
        header('Location: ../Dashboard.php');
        exit();
    }
    require_once '../../Models/Contribution.php';
    require_once '../../Models/Membertype.php';

    $famid = $_GET['FamId'];
    $year = $_GET['year'];
    $members = Contribution::MemberContribution($famid, $year);
    $membertypes = Membertype::getAll();
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
                }
                if ($_SESSION['Role'] == 'admin' || $_SESSION['Role'] == 'penningmeester'){
                    echo '<a href="index.php">Contributie Beheer</a>';
                    echo '<a href="../Membertype/index.php">Membertype Beheer</a>';
                }
                if ($_SESSION['Role'] == 'admin'){
                    echo '<a href="../User/index.php">User Beheer</a>';
                }
            ?>
        </div>
        <div class="body_main">
            <div class="body_main_title">
                <h2>Contributie Bewerken</h2>
            </div>
            <br>
            <form method="POST" action="../../Controllers/ContributionController.php">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="year" value="<?php echo $year; ?>">
                <table>
                    <tr>
                        <th>Naam</th>
                        <th>Soort Lid</th>
                        <th>Huidig bedrag</th>
                    </tr>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?php echo $member['Name']; ?></td>
                            <td>
                                <input type="hidden" name="famMemId[]" value="<?php echo $member['FamMemId']; ?>">
                                <select name="memTypId[]">
                                    <?php foreach ($membertypes as $type): ?>
                                        <option value="<?php echo $type['MemTypId']; ?>"
                                            <?php echo $type['MemTypId'] == $member['MemTypId'] ? 'selected' : ''; ?>>
                                            <?php echo $type['Description']; ?> 
                                            (<?php echo $type['DiscountPercentage']; ?>% korting)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>€<?php echo $member['ConAmount']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br>
                <button type="submit">Opslaan</button>
                <a href="index.php"><button type="button">Annuleren</button></a>
            </form>
        </div>
    </div>
</body>
</html>