<?php
include_once 'fixed/header.php';
if (!isset($_SESSION['id']) && $_SESSION['role'] != 'Patient') {
    header('location: index.php');
}
?>

    <form action="main.php" method="post">
        <div class="abt">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2">
                <div class="col">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="Date" class="form-control" name="udate" required="required">
                    </div>        
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Time</label>
                        <input type="Time" class="form-control" name="utime" required="required">
                    </div>  
                </div>
            </div>
        </div>
        <div class="abt">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2">
                <div class="col">
                    <div>
                        <label for="formFileMultiple" class="form-label">Hospital</label>
                        <select name="hospital" class="form-select" aria-label="Disabled select example" required>
                            <option selected value="PGH level 5">PGH level 5</option>
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
                            <option selected value="Dental care">Dental care</option>
                            <option value="Otology">Otology</option>
                            <option value="Cardiac">Cardiac</option>
                            <option value="Hepatology">Hepatology</option>
                            <option value="Outpatient">Outpatient</option>
                        </select>
                    </div>  
                </div>
            </div>
        </div>
        <div>
            <label for="formFileMultiple" class="form-label">Dr's Name</label>
            <select name="Dr" class="form-select" aria-label="Disabled select example" required>
                <option selected value="Ian Murithi">Ian Murithi</option>
                <option value="Everline Wasike">Everline Wasike</option>
                <option value="Mercy Kerubo">Mercy Kerubo</option>
            </select>
        </div>
        <div>
            <label for="formFileMultiple" class="form-label">Mode of Payment</label>
            <select name="payment" class="form-select" aria-label="Disabled select example" required>
                <option selected value="Cash">Cash</option>
                <option value="Insurance">Insurance</option>
                <option value="NHIF">NHIF</option>
            </select>
        </div>
        <div class="form-group">
            <label>Symptoms Description</label>
            <textarea name="symptoms" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        <div class="form-group mt-2">
            <center>
                <button type="submit" class="btn btn-primary btn-block btn-lg" name="appointment">Book Appointment</button>
                <button type="submit" class="btn btn-danger btn-block btn-lg" name="cancelappointment" onclick=location.href='home.php'>Cancel</button>
            </center>
        </div>
    </form>

<?php include_once 'fixed/footer.php'; ?>