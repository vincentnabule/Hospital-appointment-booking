<?php
    require 'conf.php';

    if (!isset($_SESSION['id']) && $_SESSION['role'] != 'Doctor') {
        header('location: index.php');
    }

    $aValue = $_GET['res'];
    $val = 'Accepted';

    $INSERT = "UPDATE appointments SET Statuss = ? WHERE AppointmentEntry = '$aValue'";
    $stmt = $conns->prepare($INSERT);
    $stmt->bind_param("s", $val);
    $stmt->execute();
    if($stmt->execute()){
        echo $val;
        echo $aVal;
    }

    header('location: home.php');
?>