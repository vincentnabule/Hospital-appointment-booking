<?php require 'main.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Reservation</title>
    <link rel="stylesheet" href="index.css" />
    <link rel="icon" href="images/download.jpg" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper container">
        <div class="header">
            <div class="bg-primary">
                <div class="cen">
                    <img src="images/download.jpg" alt="" width="50" height="50" class="d-inline-block align-text-top">
                    <h1 id="sTitle">
                        Hospital reservation system
                    </h1>
                </div>
            </div>
            <div class="whiteBG">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php#serve">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php#cont">Contacts</a>
                    </li>
                    <?php
                        if (isset($_SESSION['id'])) {
                            ?>
                            <li class="nav-item">
                                        <a class="nav-link active" href="home.php">Dashboard</a>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#Modal1">Appointments</a>
                            </li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <section>
            <!-- Modal -->
            <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <ul class="nav nav-pills nav-fill mb-3 mt-2 ml-2" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Log In</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Sign up</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <!--Log in form-->
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="signup-form">
                                        <form action="main.php" method="post">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" name="email" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" required="required">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block btn-lg" name="Request">Log In</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--Sign up form-->
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="signup-form">
                                        <form action="main.php" method="post">
                                            <div class="form-group">
                                                <label>Names (First Middle Last)</label>
                                                <input type="text" class="form-control" name="username" required="required">
                                            </div>
                                            <div>
                                                <label for="formFileMultiple" class="form-label">Gender</label>
                                                <select name="gender" class="form-select" aria-label="Disabled select example" required>
                                                    <option selected value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="formFileMultiple" class="form-label">Role</label>
                                                <select name="rolex" class="form-select" aria-label="Disabled select example" required>
                                                    <option selected value="Patient">Patient</option>
                                                    <option value="Doctor">Doctor</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" name="email" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="cpassword" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block btn-lg" name="Register">Sign Up</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>