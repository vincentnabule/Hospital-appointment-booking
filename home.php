<?php 
include_once 'fixed/header1.php';
if(!isset($_SESSION['id'])){
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
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-messages-tab" data-bs-toggle="pill" data-bs-target="#pills-messages"
                        type="button" role="tab" aria-controls="pills-messages" aria-selected="false">Messages</button>
                </li>
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
            <?php
                    if($_SESSION['role'] == 'Patient'){
                        $gen = $_SESSION['gender'];
                        if($gen == 'Male'){
                            ?>
                            <h5>Welcome, <?php echo 'Mr. '.$_SESSION['username']; ?></h5>
                            <?php
                        }elseif($gen == 'Female'){
                            ?>
                            <h5>Welcome, <?php echo 'Mrs. '.$_SESSION['username']; ?></h5>
                            <?php                            
                        }else{
                            ?>
                            <h5>Welcome, <?php echo $_SESSION['username']; ?></h5>
                            <?php   
                        }
                    }elseif($_SESSION['role'] == 'Doctor'){
                        ?>
                            <h5>Welcome, <?php echo 'Dr. '.$_SESSION['username']; ?></h5>
                        <?php
                    }
            ?>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <!--Appointments-->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <?php
                    if($_SESSION['role'] == 'Patient'){//Patient dashboard
                        $user = $_SESSION['email'];
                        $fetch ="SELECT * FROM appointments WHERE AppointmentFrom = '$user' AND Statuss = 'Pending' OR Statuss = 'Accepted'";
                        $rs = $conns->query($fetch);
                        $rnum = $rs->num_rows;
                        if($rnum > 0){
                            ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Hospital</th>
                                        <th scope="col">Symptoms</th>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Status</th>
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
                                                <?php
                                                    if($eList['Statuss'] == 'Pending'){
                                                        ?>
                                                            <div class="btn btn-secondary"><?php echo $eList['Statuss'];?></div>
                                                        <?php
                                                    }elseif($eList['Statuss'] == 'Accepted'){
                                                        ?>
                                                            <div class="btn btn-success"><?php echo $eList['Statuss'];?></div>
                                                        <?php
                                                    }
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                    if($eList['Statuss'] == 'Pending'){
                                                    ?>
                                                        <button type="button" class="btn btn-primary mt-2" onclick=location.href="<?php echo 'edit.php?a='.$eList['AppointmentEntry'].''?>">Modify</button>
                                                        <button type="button" class="btn btn-danger mt-2" onclick=location.href="<?php echo 'delete.php?val='.$eList['AppointmentEntry'].''?>">Cancel</button>
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <div class="btn btn-info">Wait for Appointment date</div-->
                                                    <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                }
                        }else{
                            ?>
                                <center>
                                    <h2>No Appointments available</h2>
                                </center>
                            <?php
                        }
                            ?>
                                </tbody>
                            </table>
                            
                        <div>
                            <center>
                                <button type="submit" class="btn btn-primary btn-block btn-lg" onclick=location.href="appointment.php">Make New Appointment</button>
                            </center>  
                        </div>

                        <h3>Previous appointments.</h3><!--Previous Appointments-->
                        <?php
                            $fetch ="SELECT * FROM appointments WHERE AppointmentFrom = '$user' AND Statuss != 'Pending' AND Statuss != 'Accepted'";
                            $rs = $conns->query($fetch);
                            $rnum = $rs->num_rows;
                            if($rnum > 0){
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Hospital</th>
                                        <th scope="col">Symptoms</th>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                <?php
                                $fetchAllData = $rs->fetch_all(MYSQLI_ASSOC);
                                foreach($fetchAllData as $eList){
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $eList['Datez']; ?></td>
                                            <td><?php echo $eList['Hospital']; ?></td>
                                            <td><?php echo $eList['Diagnosis']; ?></td>
                                            <td><?php echo $eList['AppointmentTo']; ?></td>
                                            <td>
                                                        <?php
                                                            $status = $eList['Statuss'];
                                                            if($status == 'Done'){
                                                                ?>
                                                                <div  class="btn btn-success">Done</div>
                                                                <?php
                                                            }elseif($status == 'Cancel'){
                                                                ?>
                                                                <div class="btn btn-danger">Canceled</div>
                                                                <?php
                                                            }
                                                        ?>
                                            
                                            <td>
                                        </tr>
                                    <?php
                                }      
                            }
                            else{
                                ?>
                                    <center>
                                        <h2>No Previous appointments available</h2>
                                    </center>
                                <?php
                            }
                        ?>
                            </tbody>
                        </table>
                    
                    <?php
                    }elseif($_SESSION['role'] == 'Doctor'){//Doctor dashboard
                        $currentUser = $_SESSION['username'];
                        $fetch ="SELECT * FROM appointments WHERE AppointmentTo = '$currentUser' AND Statuss = 'Pending' OR Statuss = 'Accepted'";
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
                                            <td><?php echo $eList['Diagnosis']; ?></td>
                                            <td><?php echo $eList['ClientInfo']; ?></td>
                                            <td><?php echo $eList['Payment']; ?></td>
                                            <td>
                                                <?php
                                                    if($eList['Statuss'] == 'Pending'){
                                                    ?>
                                                        <button type="button" class="btn btn-primary mt-2" onclick=location.href="<?php echo 'accept.php?res='.$eList['AppointmentEntry'].''?>">Accept</button>
                                                        <button type="button" class="btn btn-danger mt-2" onclick=location.href="<?php echo 'delete.php?val='.$eList['AppointmentEntry'].''?>">Decline</button>
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <button type="button" class="btn btn-info mt-2" onclick=location.href="<?php echo 'meet.php?met='.$eList['AppointmentEntry'].''?>">Meeting Happened</button>
                                                    <?php
                                                    }
                                                ?>
                                                
                                            </td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php
                        }else{
                            ?>
                                <center>
                                    <h2>No Appointments available</h2>
                                </center>
                            <?php
                            }
                            ?>
                            
                            <h3>Previous appointments.</h3><!--Previous Appointments-->
                            <?php         
                                $user = $_SESSION['username'];
                                $fetch ="SELECT * FROM appointments WHERE AppointmentTo = '$currentUser' AND Statuss != 'Pending' AND Statuss != 'Accepted'";
                                $rs = $conns->query($fetch);
                                $rnum = $rs->num_rows;
                                if($rnum > 0){
                                    ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Hospital</th>
                                            <th scope="col">Symptoms</th>
                                            <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $fetchAllData = $rs->fetch_all(MYSQLI_ASSOC);
                                        foreach($fetchAllData as $eList){
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $eList['Datez']; ?></td>
                                                    <td><?php echo $eList['Hospital']; ?></td>
                                                    <td><?php echo $eList['Diagnosis']; ?></td>
                                                    <td>
                                                        <?php
                                                            $status = $eList['Statuss'];
                                                            if($status == 'Done'){
                                                                ?>
                                                                <div class="btn btn-success">Done</div>
                                                                <?php
                                                            }elseif($status == 'Cancel'){
                                                                ?>
                                                                <div class="btn btn-danger">Canceled</div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                        } 
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php    
                                }
                                else{
                                    ?>
                                        <center>
                                            <h2>No Previous appointments available</h2>
                                        </center>
                                    <?php
                                }        
                    }
                ?>
            </div>
            <!--Messages-->
            <div class="tab-pane fade" id="pills-messages" role="tabpanel" aria-labelledby="pills-messages-tab">
                <div>
                    <?php
                        $user = $_SESSION['username'];
                        $fetch ="SELECT * FROM messages WHERE Sender = '$user' OR Receiver = '$user'";
                        $rs = $conns->query($fetch);
                        $rnum = $rs->num_rows;
                        if($rnum > 0){
                            ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                        <th scope="col">Message</th>
                                    </tr>
                                </thead>
                                <?php
                                    $fetchAllData = $rs->fetch_all(MYSQLI_ASSOC);
                                    foreach($fetchAllData as $eList){
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $eList['Datez']; ?></td>
                                            <td><?php echo $eList['Sender']; ?></td>
                                            <td><?php echo $eList['Receiver']; ?></td>
                                            <td><?php echo $eList['Messages']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>                                    
                                    </tbody>
                            </table>
                            <?php
                        }else{
                            ?>
                            <center>
                                <h2>You have no messages!!!</h2>
                            </center>
                            <?php
                        }
                    ?>
                </div>

                <center>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        New Message
                    </button>
                </center>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create New Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="main.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="Text" value="<?php echo $_SESSION['username']; ?>" class="form-control" name="mFrom" required="required" disabled>
                                    </div>
                                    <div>
                                        <label for="formFileMultiple" class="form-label">To</label>
                                        <select name="mTo" class="form-select" aria-label="Disabled select example" required>
                                            <option value="">Select Receiver</option>
                                            <?php
                                                $fetch = "SELECT * FROM clients";
                                                $rs = $conns->query($fetch);
                                                $rnum = $rs->num_rows;
                                                if($rnum > 0){
                                                    $fetchAllData = $rs->fetch_all(MYSQLI_ASSOC);
                                                    foreach($fetchAllData as $eList){
                                                        ?>
                                                        <option value="<?php echo $eList['UserName']; ?>"><?php echo $eList['UserName']; ?></option>
                                                        <?php 
                                                    }      
                                                }
                                                else{
                                                    echo 'No User available';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Messages</label>
                                        <textarea name="sms" class="form-control" id="exampleFormControlTextarea1" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="sendsms">Send</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--Profile-->
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