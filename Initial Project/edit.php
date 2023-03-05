<?php
    include_once 'fixed/header.php';
    if (!isset($_SESSION['id']) && $_SESSION['role'] != 'Patient') {
        header('location: index.php');
    }

    $aValue = $_GET['a'];

    $qry = "SELECT * FROM appointments WHERE AppointmentEntry = '$aValue' LIMIT 1";
    $rs = $conns->query($qry);

    $user = $rs->fetch_assoc();
    $Entry = $user['AppointmentEntry'];
    $Date = $user['Datez'];
    $Time = $user['Timez'];
    $From = $user['AppointmentFrom'];
    $To = $user['AppointmentTo'];
    $Hospital = $user['Hospital'];
    $Department = $user['Department'];
    $Diagnosis = $user['Diagnosis'];
    $Payment = $user['Payment'];

    if (isset($_POST['updateappointment'])) {

        $pDate = $_POST['udate'];
        $pTime = $_POST['utime'];
        $pHospital = $_POST['hospital'];
        $pDepartment = $_POST['department'];
        $pDr = $_POST['Dr'];
        $pPay = $_POST['payment'];
        $pSymptoms = $_POST['symptoms'];

        $INSERT = "UPDATE appointments SET Datez = ?, Timez = ?, AppointmentTo = ?, Hospital = ?, Department = ?, Diagnosis = ?, Payment = ?
         WHERE appointmentEntry = '$aValue'";
        $stmt = $conns->prepare($INSERT);
        $stmt->bind_param("sssssss", $pDate, $pTime, $pDr, $pHospital, $pDepartment, $pSymptoms, $pPay);
        if ($stmt->execute()) {
            ?>
                <center>
                    <h1>Appointment updated successfully!!!</h1>
                </center>
            <?php    
        }
        exit(); 
    }
?>
    <form action="" method="post">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2">
            <div class="col">
                <div class="form-group">
                    <label>Date</label>
                    <input type="Date" value="<?php echo $Date; ?>" class="form-control" name="udate" required="required">
                </div>        
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Time</label>
                    <input type="Time" value="<?php echo $Time; ?>" class="form-control" name="utime" required="required">
                </div>        
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2">
            <div class="col">
                <div>
                    <label for="formFileMultiple" class="form-label">Hospital</label>
                    <select name="hospital" class="form-select" aria-label="Disabled select example" required>
                        <option selected value="<?php echo $Hospital; ?>"><?php echo $Hospital; ?></option>
                        <option value="PGH level 5">PGH level 5</option>
                        <option value="Mediheal HospitalNairobi Women">Mediheal HospitalNairobi Women</option>
                        <option value="Joe Ellen women's hospital">Joe Ellen women's hospital</option>
                        <option value="Equity Afya hospital">Equity Afya hospital</option>
                    </select>
                </div>        
            </div>
            <div class="col">
                <div>
                    <label for="formFileMultiple" class="form-label">Department</label>
                    <select name="department" class="form-select" aria-label="Disabled select example" required>
                        <option selected value="<?php echo $Department; ?>"><?php echo $Department; ?></option>
                        <option value="Dental care">Dental care</option>
                        <option value="Otology">Otology</option>
                        <option value="Cardiac">Cardiac</option>
                        <option value="Hepatology">Hepatology</option>
                        <option value="Outpatient">Outpatient</option>
                    </select>
                </div>        
            </div>
        </div>

        <div>
            <label for="formFileMultiple" class="form-label">Dr's Name</label>
            <select name="Dr" class="form-select" aria-label="Disabled select example" required>
                <option selected value="<?php echo $To; ?>"><?php echo $To; ?></option>
                <option value="Ian Murithi">Ian Murithi</option>
                <option value="Everline Wasike">Everline Wasike</option>
                <option value="Mercy Kerubo">Mercy Kerubo</option>
            </select>
        </div>
        
        <div>
            <label for="formFileMultiple" class="form-label">Mode of Payment</label>
            <select name="payment" class="form-select" aria-label="Disabled select example" required>
                <option selected value="<?php echo $Payment; ?>"><?php echo $Payment; ?></option>
                <option value="Cash">Cash</option>
                <option value="Insurance">Insurance</option>
                <option value="NHIF">NHIF</option>
            </select>
        </div>
        <div class="form-group">
            <label>Symptoms Description</label>
            <textarea name="symptoms" value="<?php echo $Diagnosis; ?>" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?php echo $Diagnosis; ?></textarea>
        </div>
        <div class="form-group mt-2">
            <center>
                <button type="submit" class="btn btn-primary btn-block btn-lg" name="updateappointment">Update</button>
                <button type="submit" class="btn btn-danger btn-block btn-lg" name="cancelappointment" onclick=location.href='home.php'>Discard</button>
            </center>
        </div>
    </form>

<?php include_once 'fixed/footer.php'; ?>