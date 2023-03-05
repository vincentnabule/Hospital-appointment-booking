<?php

session_start();
require 'conf.php';
//Registration
if (isset($_POST['Register'])) {

    $pEml = $_POST['email'];
    $Pswd1 = $_POST['password'];
    $Pswd2 = $_POST['cpassword'];

    if ($Pswd1 !== $Pswd2) {
        ?>
            <center>
                <h1>Passwords do not match try again!!!</h1>
            </center>
        <?php
        header("refresh: 2; index.php");
    } else {
        $SELECT = "SELECT Useremail FROM clients where Useremail = ? Limit 1";
        $stmt = $conns->prepare($SELECT);
        $stmt->bind_param("s", $pEml);
        $stmt->execute();
        $reslts = $stmt->get_result();
        $rnum = $reslts->num_rows;

        if ($rnum === 0) {
            $PswdF = password_hash($Pswd1, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(50));
            $dates = date('yy/m/d');
            $Role = $_POST['rolex'];
            $Gender = $_POST['gender'];
            $Name = $_POST['username'];

            $stmt->close();
            $INSERT0 = "INSERT INTO clients (UserName, Gender, Useremail, Userrole, Userpassword, Registrationdate, Token) VALUES(?, ?, ?, ?, ?, ?, ?)";
            $stmt0 = $conns->prepare($INSERT0);
            $stmt0->bind_param("sssssss", $Name, $Gender, $pEml, $Role, $PswdF, $dates, $token);
            if ($stmt0->execute()) {
                $_SESSION['id'] = $token;
                $_SESSION['username'] = $Name;
                $_SESSION['email'] = $pEml;
                $_SESSION['role'] = $Role;
                $_SESSION['gender'] = $Gender;

                header('location: home.php');

                $stmt0->close();
                exit();
            } else {
                ?>
                    <center>
                        <h1>Mysqli error</h1>
                    </center>
                <?php
                header("refresh: 3; index.php");
            }
        } else {
            ?>
                <center>
                    <h1>Someone else already registered using that email address</h1>
                </center>
            <?php
            header("refresh: 2; index.php");
        }

        $conns->close();
    }
}
//Loging In
elseif (isset($_POST['Request'])) {
    $pEml = $_POST['email'];
    $Pswd = $_POST['password'];


    $SELECT = "SELECT * FROM clients WHERE Useremail =? LIMIT 1";
    $stmt = $conns->prepare($SELECT);
    $stmt->bind_param("s", $pEml);
    $stmt->execute();
    $reslts = $stmt->get_result();
    $rnum = $reslts->num_rows;

    $user = $reslts->fetch_assoc();
    if (password_verify($Pswd, $user['Userpassword'])) {
        $_SESSION['id'] = $user['Token'];
        $_SESSION['username'] = $user['UserName'];
        $_SESSION['role'] = $user['Userrole'];
        $_SESSION['gender'] = $user['Gender'];
        $_SESSION['email'] = $user['Useremail'];
        $_SESSION['register'] = $user['Registrationdate'];

        header('location: home.php');
        $stmt->close();
        exit();
    } else {
        ?>
            <center>
                <h1>Incorrect email address or Password</h1>
            </center>
        <?php
        header("refresh: 2; index.php");
    }
}
//Booking appointment
elseif (isset($_POST['appointment'])) {
    $pOwner = $_SESSION['username'];
    $pMail = $_SESSION['email'];
    $pDate = $_POST['udate'];
    $pTime = $_POST['utime'];
    $pHospital = $_POST['hospital'];
    $pDepartment = $_POST['department'];
    $pDr = $_POST['Dr'];
    $pPay = $_POST['payment'];
    $pSymptoms = $_POST['symptoms'];

    $clientInfo = 'Name: ' . $pOwner . 'Email: ' . $pMail;

    $SELECT = "SELECT * FROM appointments where Datez = ? AND AppointmentFrom = ? AND AppointmentTo = ? AND Hospital = ? AND Diagnosis = ? AND Payment = ? Limit 1";
    $stmt = $conns->prepare($SELECT);
    $stmt->bind_param("ssssss", $DatenTime, $pMail, $pDr, $pHospital, $pSymptoms, $pPay);
    $stmt->execute();

    $reslts = $stmt->get_result();
    $rnum = $reslts->num_rows;

    if ($rnum === 0) {

        $INSERT = "INSERT INTO appointments (Datez, Timez, AppointmentFrom, AppointmentTo, ClientInfo, Hospital, Department, Diagnosis, Payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt->close();
        $stmt = $conns->prepare($INSERT);
        $stmt->bind_param("sssssssss", $pDate, $pTime, $pMail, $pDr, $clientInfo, $pHospital, $pDepartment, $pSymptoms, $pPay);
        if ($stmt->execute()) {
            ?>
                <center>
                    <h1>Appointment booked successfully!!!</h1>
                </center>
            <?php
            header("refresh: 2; home.php");
        }
    } else {
        ?>
            <center>
                <h1>Entry Already exists!!!</h1>
            </center>
        <?php
        header("refresh: 2; home.php");
    }
}
//Cancel
elseif (isset($_POST['cancelappointment'])) {
    header('location: home.php');
}
//Sending sms
elseif(isset($_POST['sendsms'])){ 
    $mFrom = $_SESSION['username'];
    $mTo = $_POST['mTo'];
    $sms = $_POST['sms'];
    $dates = date('yy/m/d');

    $INSERT = "INSERT INTO messages (Datez, Sender, Receiver, Messages) VALUES (?, ?, ?, ?)";
    $stmt = $conns->prepare($INSERT);
    $stmt->bind_param("ssss",$dates, $mFrom, $mTo, $sms);
    if ($stmt->execute()) {
        header("refresh: 2; home.php");
    }
}

//Log out of the systema
elseif (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['role']);
    unset($_SESSION['username']);

    header('location: index.php');
    exit();
}

?>