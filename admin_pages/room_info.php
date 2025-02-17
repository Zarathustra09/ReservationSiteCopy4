<?php
include '../config/connection.php';

session_start();




// Fetch room data based on the selected room ID
if (isset($_GET['room_id'])) {
    $roomId = $_GET['room_id'];

    // Fetch room data based on the selected room ID
    $roomInfoQuery = "SELECT room_name, room_description, room_img_path, category_id FROM rooms WHERE id = $roomId";
    $roomInfoResult = $connection->query($roomInfoQuery);

    if ($roomInfoResult) {
        $roomInfoData = $roomInfoResult->fetch_assoc();
        $roomName = $roomInfoData['room_name'];
        $roomDescription = $roomInfoData['room_description'];
        $roomImgPath = $roomInfoData['room_img_path'];
        $pageTitle = "$roomName";
        $categoryId =  $roomInfoData["category_id"];
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NULR Admin | Room Info</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Flatpicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/UI_Pages.css">

     <!-- Top Navbar Back Button Styles -->
     <style>
  .backArrow {
    background-color: #708090;
    height: 70px; /* Reduced height for fitting into the top navbar */ 
    display: flex;
    align-items: center;
    padding-right: 10px; /* Adjust the padding as needed */
  }

  .back-button {
    color: white;
    border: none !important;
    padding: 5px; /* Reduced padding */
    transition: background-color 0.5s, transform 0.5s;
  }

.back-button:hover {
    background-color: rgba(255, 255, 255, 0.8);
    color: black;
    transform: translateX(-3px);
    box-shadow: 3px 0px 10px 0px rgba(105,105,105,0.8);
}

  /* Added CSS for positioning the back button */
  .backArrow button {
    margin-left: 10px; /* Adjust margin as needed */
  }
</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'navitems.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div class="backArrow">
                        <div>
                            <a href="manage_rooms.php">
                                <button class="btn btn-xs back-button">
                                    <span><i class="fa fa-arrow-left fa-2x"></i></span>
                                </button>
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto"></ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                            <h2 class="room-info-header">Room Information</h2>

                        <div id="roomCarousel" class="carousel slide" data-bs-theme="dark">
                            <div class="carousel-inner">
                                <?php

                                // Define the path to the room images folder
                            $roomImagesPath = "$roomImgPath";

                            // Get a list of image files in the folder
                            $images = glob($roomImagesPath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                                // Display room images in the carousel
                                foreach ($images as $index => $image) {
                                    echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';
                                    echo '<img src="' . $image . '" class="d-block" alt="Room Image ' . ($index + 1) . '">';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                            <div class="container room-info-container py-3">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h2><?php echo $roomName; ?></h2>
                                        <p class="text-left"><?php echo $roomDescription; ?></p>
                                    </div>
                                    <div class="col-sm-4 text-end" >
                                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Reserve Now!
                        </button>


                                    </div>

                                    <div class="alert-container" style="display: none;"></div>


                                </div>
                            </div><div class="modal" id="loadingModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1"  aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Request Form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <!--  REQUEST FORM -->
                                    <form id="myForm" action="../vendor/send-to-signatory.php" method="POST" enctype="multipart/form-data" onsubmit="handleFormSubmission(event)">

                                    <input type="hidden" name="room_id" value="<?php echo isset($roomId) ? $roomId : ''; ?>">
                                    <input type="hidden" name="category_id" value="<?php echo isset($categoryId) ? $categoryId : ''; ?>">
                        <input type="hidden" name="room_name" value="<?php echo isset($roomName) ? $roomName : ''; ?>">
                            <div class="row">
                            <div class="col-6 mb-3">

                            <label for="fullName" class="form-label"> Full Name <span class="required">*</span></label>
                                <input  class="form-control" id="fullName" name="fullName" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="email" class="form-label">E-mail <span class="required">*</span></label>
                            <input  type="email" class="form-control" id="email" name="email" required >
                            </div>
                        <div class="mb-3">
                            <label for="usertype" class="form-label">Select User Type: <span class="required">*</span></label>
                            <select class="form-select" id="usertype" name="userType" required>
                                <option value="" disabled selected>Select One</option>
                                <option value="student">Student</option>
                                <option value="employee">Employee</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3" id="collegeDiv">
                            <label for="college" class="form-label">College<span class="required">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="college" name="college" required>
                            <option value="" disabled selected>Select One</option>
                                <?php
                                // Fetch colleges from the database
                                $query = "SELECT name FROM colleges";
                                $result = mysqli_query($connection, $query);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $collegeName = $row['name'];
                                        echo "<option value='$collegeName'>$collegeName</option>";
                                    }
                                } else {
                                    echo "<option disabled>No colleges found</option>";
                                }
                                ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="room" class="form-label">Room</label>
                                            <select class="form-select" aria-label="Default select example" id="room" name="room" required>
                                                <option selected>None</option>
                                                <?php
                                                // Fetch rooms from the database
                                                $query = "SELECT name FROM rooms";
                                                $result = mysqli_query($connection, $query);
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $roomName = $row['name'];
                                                        echo "<option value='$roomName'>$roomName</option>";
                                                    }
                                                } else {
                                                    echo "<option disabled>No rooms found</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3" id="orgDiv">
                                            <label for="org" class="form-label">Organization</label>
                                            <select class="form-select" aria-label="Default select example" id="org" name="org" required>
                                                <option selected>None</option>
                                                <?php
                                                // Fetch colleges from the database
                                                $query = "SELECT name FROM organizations";
                                                $result = mysqli_query($connection, $query);
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $orgName = $row['name'];
                                                        echo "<option value='$orgName'>$orgName</option>";
                                                    }
                                                } else {
                                                    echo "<option disabled>No colleges found</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3" id="adviserEmailContainer">
                                            <label for="adviserEmail" class="form-label">Adviser's E-mail <span class="required">*</span></label>
                                            <input class="form-control" id="adviserEmail" name="adviserEmail" required>
                                        </div>

                                        <hr>
                                        <h4>Activity Details</h4>
                                        <div class="mb-3">
                                            <label for="activityType" class="form-label">Activity Type<span class="required">*</span></label>
                                            <select class="form-select" aria-label="Default select example" id="activityType" name="activityType" required>
                                                <option value="" disabled selected>Select One</option>
                                                <option value="Course Activity">Course Activity</option>
                                                <option value="Org Activity">Org Activity</option>
                                                <option value="Event">Event</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="activityName" class="form-label">Activity Name <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="activityName" name="activityName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="numOfAttendees" class="form-label">No. of Attendees <span class="required">*</span></label>
                                            <input type="number" class="form-control" id="numOfAttendees" name="numOfAttendees" required min="1" value="1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="datepicker" class="form-label">Date(s) <span class="required">*</span></label>
                                            <input class="form-control" type="text" id="datepicker" name="reservation-date1" required>
                                            <small class="text-secondary">Select the same date twice for one day. Select two different dates for multiple days.</small>
                                        </div>

                                        <input type="hidden" id="reservation-date" name="reservation-date" />

                                        <div id="timeSlot" class="mb-3">
                                            <label class="form-label" for="timeSlotSingle" id="timeSlotSingleLabel">Select Time:</label>
                                            <select id="timeSlotSingle" class="form-control custom-select" multiple required></select>
                                            <small class="text-secondary" id="small-text">Click for one time slot. Click and drag for multiple time slots.</small>
                                            <br>
                                            <label class="form-label" for="selectedTimeSingle" id="selectedTimeSingleLabel">Selected Time Range: <span class="required">*</span></label>
                                            <input type="text" id="selectedTimeSingle" class="form-control" readonly name="time-slot" required>
                                        </div>

                                        <div id="timeSlotMultiDateContainer" style="display: none;">
                                            <!-- Dynamically generated time slot inputs will be added here -->
                                        </div>
                                        <input type="hidden" id="hiddenTimeRanges" name="time-slot" />

                                        <div class="mb-3">
                                            <label for="speakerName" class="form-label">Speaker's Name</label>
                                            <input type="text" class="form-control" id="speakerName" name="speakerName">
                                        </div>

                                        <hr>
                                        <h4>Items Needed</h4>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label for="items" class="form-label">Select Items</label>
                                                <select class="form-select" aria-label="Default select example" id="items" onchange="toggleOthersInput()" name="selectedItem">
                                                    <option disabled selected>Choose Item</option>
                                                    <option value="table">Table</option>
                                                    <option value="chairs">Chairs</option>
                                                    <option value="bulletin-board">Bulletin Board</option>
                                                    <option value="sound-system">Sound System</option>
                                                    <option value="flag">Flag</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <div class="d-flex">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <input type="number" class="form-control pr-3" id="quantity" name="quantity" min="1" value="1">
                                                        </div>
                                                        <div class="col-3">
                                                            <button type="button" class="btn btn-primary addBtn">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3" id="othersInputContainer" style="display: none;">
                                            <label for="othersInput" class="form-label">Specify Other Item</label>
                                            <input type="text" class="form-control" id="othersInput" name="othersInput">
                                        </div>
                                        <div class="mb-3">
                                            <p>Selected Items:</p>
                                            <ul id="selectedItemsList"></ul>
                                        </div>

                                        <input class="d-none" name="selectedItems" id="selectedItemsInput" />

                                        <div class="mb-3">
                                            <label for="fileUpload" class="form-label">Upload Photo of School ID <span class="required">*</span></label>
                                            <input type="file" class="form-control" id="fileUpload" name="fileUpload" accept="image/*" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                                        </div>

                                        <div class="text-end">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>
   

    <!-- jQuery library -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>