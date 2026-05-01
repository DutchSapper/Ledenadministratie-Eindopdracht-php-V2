<?php
    session_start();
    if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'admin') {
        header('Location: ../Views/Dashboard.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    $famid = htmlspecialchars($_POST['FamId']);
    $famname = htmlspecialchars($_POST['Famname']);
    $adress = htmlspecialchars($_POST['Adress']);
    $city = htmlspecialchars($_POST['City']);
    $postcode = htmlspecialchars($_POST['Postcode']);
    $country = htmlspecialchars($_POST['Country']);

    require_once '../Models/User.php';

    if ($action === 'create') {
        Family::createFam($famid, $famname, $adress, $city, $postcode, $country);
    }

    if ($action === 'edit') {
        $famid = $_POST['famid'];
        Family::updateFam($famid, $famname, $adress, $city, $postcode, $country);
    }

    header('Location: ../Views/Families/edit.php?Famid= ?');
    exit();
}