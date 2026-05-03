<?php
    session_start();
    if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'admin') {
        header('Location: ../Views/Dashboard.php');
        exit();
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    $famname = htmlspecialchars($_POST['famname']);
    $adress = htmlspecialchars($_POST['adress']);
    $city = htmlspecialchars($_POST['city']);
    $postcode = htmlspecialchars($_POST['postcode']);
    $country = htmlspecialchars($_POST['country']);
    
    require_once '../Models/Family.php';
    
    if ($action === 'create') {
        Family::createFam($famname, $adress, $city, $postcode, $country);
        header('Location: ../Views/Families/index.php');
        exit();
    }

        
    $famid = htmlspecialchars($_POST['id']);
    if ($action === 'edit') {
        Family::updateFam($famid, $famname, $adress, $city, $postcode, $country);
        header('Location: ../Views/FamMembers/create.php');
        exit();
    }
}