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
                <h2>Contributie</h2>
            </div>
            <br>

            <?php
                require_once '../../Models/Contribution.php';
                require_once '../../Models/Booking.php';
                require_once '../../Models/FamMember.php';

                // Jaarselectie
                $years = Booking::getAllYears();
                $selectedYear = $_SESSION['bookingyear'] ?? date('Y');

                if (isset($_POST['year'])) {
                    $selectedYear = $_POST['year'];
                    $_SESSION['bookingyear'] = $selectedYear;
                }
            ?>

            <form method="POST">
                <label>Jaar: </label>
                <select name="year">
                    <?php foreach ($years as $year): ?>
                        <option value="<?php echo $year['Year']; ?>" 
                            <?php echo $year['Year'] == $selectedYear ? 'selected' : ''; ?>>
                            <?php echo $year['Year']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Kiezen</button>
            </form>
            <br>

            <div class="body_main_families">
                <?php
                    $families = Contribution::FamContribution($selectedYear);

                    echo "<table>";
                        echo "<tr>";
                            echo "<th>Familie naam:</th>";
                            echo "<th>Contributie kosten:</th>";
                            echo "<th></th>";
                            echo "<th></th>";
                        echo "</tr>";

                    foreach ($families as $family) {
                        echo "<tr class='tr_family'>";
                            echo "<th>" . $family['Famname'] . "</th>";
                            echo "<td>€" . $family['TotalContribution'] . "</td>";
                            echo "<td><a href='edit.php?FamId=" . $family['FamId'] . "&year=" . $selectedYear . "'><button>Bewerken</button></a></td>";
                        echo "</tr>";

                        // Leden per familie tonen
                        $members = Contribution::MemberContribution($family['FamId'], $selectedYear);
                        foreach ($members as $member) {
                            echo "<tr class='tr_member'>";
                                echo "<td>" . $member['Name'] . "</td>";
                                echo "<td>€" . $member['ConAmount'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>