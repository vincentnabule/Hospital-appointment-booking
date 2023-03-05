<?php 
include_once 'fixed/header1.php';
if(!isset($_SESSION['id']) && $_SESSION['role'] != 'Doctor'){
    header('location: index.php');
} 
?>
        <div class="whiteBG">
            <ul class="nav nav-pills nav-fill mb-3 mt-2 ml-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="index.php"><button class="nav-link" type="button" role="tab" aria-selected="false">Home</button></a>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Appointments</button>
                </li>
                <!--li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-messages-tab" data-bs-toggle="pill" data-bs-target="#pills-messages"
                        type="button" role="tab" aria-controls="pills-messages" aria-selected="false">Messages</button>
                </li-->
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-pro-tab" data-bs-toggle="pill" data-bs-target="#pills-pro"
                        type="button" role="tab" aria-controls="#" aria-selected="false" onclick=location.href='main.php?logout=1'>Log Out</button>
                </li>
            </ul>
        </div>
        <div>
            <h5>Welcome, Dr Evans</h5>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <?php         
                    $user = $_SESSION['email'];
                    $fetch ="SELECT * FROM appointments WHERE AppointmentTo LIKE '$user'";
                    $rs = $conns->query($fetch);
                    $rnum = $rs->num_rows;
                    if($rnum > 0){
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Date and Time</th>
                                <th scope="col">Symptoms</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                        <?php
                        $fetchAllData = $rs->fetch_all(MYSQLI_ASSOC);
                        foreach($fetchAllData as $eList){
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $eList['Datez']. ' '.$eList['Timez']; ?></td>
                                    <td><?php echo $eList['Hospital']; ?></td>
                                    <td><?php echo $eList['Diagnosis']; ?></td>
                                    <td><?php echo $eList['AppointmentTo']; ?></td>
                                    <td><?php echo $eList['Payment']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary mt-2" onclick=location.href="<?php echo 'edit.php?a='.$eList['AppointmentEntry'].''?>">Modify</button>
                                        <button type="button" class="btn btn-danger mt-2" onclick=location.href="<?php echo 'delete.php?val='.$eList['AppointmentEntry'].''?>">Cancel</button>
                                    </td>
                                </tr>
                            <?php
                        }      
                    }
                    else{
                        ?>
                            <center>
                                <h2>No Appointments available</h2>
                            </center>
                        <?php
                    }
                    ?>
                            </tbody>
                        </table>
                    <?php
                ?>

                <div>
                    <center>
                        <button type="submit" class="btn btn-primary btn-block btn-lg" onclick=location.href="appointment.php">Make New Appointment</button>
                    </center>  
                </div>

                <h3>Previous appointments.</h3>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Client Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="tab-pane fade" id="pills-messages" role="tabpanel" aria-labelledby="pills-profile-tab">
                tab 2 messages
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                tab 3
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-contact-tab">
                <center>
                    <p>Name: <?php echo $_SESSION['username']?></p>
                    <p>Gender: <?php echo $_SESSION['gender']?></p>
                    <p>Email: <?php echo $_SESSION['email']?></p>
                    <p>Role: <?php echo $_SESSION['role']?></p>
                    <p>Member since: <?php echo $_SESSION['register']?></p>
                    <p></p>
                </center>
            </div>
        </div>

            
<?php include_once 'fixed/footer.php'; ?>