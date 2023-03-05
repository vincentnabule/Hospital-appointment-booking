<?php
    require 'conf.php';

    if (!isset($_SESSION['id']) && $_SESSION['role'] != 'Patient') {
        header('location: index.php');
    }

    $aValue = $_GET['val'];
    $value = 'Cancel';

    $INSERT = "UPDATE appointments SET Statuss = ? WHERE AppointmentEntry = '$aValue'";
    $stmt = $conns->prepare($INSERT);
    $stmt->bind_param("s", $value);
    $stmt->execute();

    header('location: home.php');
?>