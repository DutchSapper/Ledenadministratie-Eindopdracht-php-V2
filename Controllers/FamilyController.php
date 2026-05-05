<?php
    session_start();
    if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'admin') {
        header('Location: ../Views/Dashboard.php');
        exit();
    }
    require_once '../Models/Family.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $famid = htmlspecialchars($_POST['id']);
    if ($action === 'delete') {
            Family::deleteFam($famid);
            header('Location: ../Views/Families/index.php');
            exit();
        }

    $famname = htmlspecialchars($_POST['famname']);
    $adress = htmlspecialchars($_POST['adress']);
    $city = htmlspecialchars($_POST['city']);
    $postcode = htmlspecialchars($_POST['postcode']);
    $country = htmlspecialchars($_POST['country']);
    
  
    
    if ($action === 'create') {
        Family::createFam($famname, $adress, $city, $postcode, $country);
        header('Location: ../Views/FamMembers/create.php');
        exit();
    }
   
    if ($action === 'edit') {
        Family::updateFam($famid, $famname, $adress, $city, $postcode, $country);
        header('Location: ../Views/Families/index.php');
        exit();
    }

    
}