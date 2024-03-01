<?php
// print_page.php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    date_default_timezone_set('Asia/Manila');

    // Retrieve form data from URL parameters
    $roomId = isset($_GET['roomId']) ? $_GET['roomId'] : '';
    $roomName = isset($_GET['roomName']) ? $_GET['roomName'] : '';
    $fullName = isset($_GET['fullName']) ? $_GET['fullName'] : '';
    $college = isset($_GET['college']) ? $_GET['college'] : '';
    $activityName = isset($_GET['activityName']) ? $_GET['activityName'] : '';
    $numOfAttendees = isset($_GET['numOfAttendees']) ? $_GET['numOfAttendees'] : '';
    $userEmail = isset($_GET['userEmail']) ? $_GET['userEmail'] : '';
    $recipientName = isset($_GET['recipientName']) ? $_GET['recipientName'] : '';
    $organization = isset($_GET['org']) ? $_GET['org'] : '';
    $categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : '';
    $userType = isset($_GET['userType']) ? $_GET['userType'] : '';
    $activityType = isset($_GET['activityType']) ? $_GET['activityType'] : '';
    $date = isset($_GET['date']) ? $_GET['date'] : '';
    $timeSlot = isset($_GET['timeSlot']) ? $_GET['timeSlot'] : '';
    $endTime = isset($_GET['endTime']) ? $_GET['endTime'] : '';
    $speakerName = isset($_GET['speakerName']) ? $_GET['speakerName'] : '';
    $remarks = isset($_GET['remarks']) ? $_GET['remarks'] : '';
    $reservationId = isset($_GET['reservationId']) ? $_GET['reservationId'] : '';
    $submissionTime = isset($_GET['submissionTime']) ? $_GET['submissionTime'] : '';
    $uploadFilePath = isset($_GET['uploadFilePath']) ? $_GET['uploadFilePath'] : '';
    $selectedItems = isset($_GET['selectedItems']) ? json_decode($_GET['selectedItems'], true) : null;
    
    
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #495057;
    }

    section.container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    h1 {
        color: #007bff;
    }

    h3 {
        color: #007bff;
    }

    .mb-3 {
        margin-bottom: 1.5rem !important;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover{
        filter: brightness(90%);
    }
    .btn-rectangle {
    border-radius: 20;
}
</style>
<body>
    <section class="container">
    <h1 class="mb-5">Form Data</h1>

    <!-- first row -->
    <div class="row mb-5">
        <!-- column for requestor details -->
        <div class="col-sm-6">
            <h3 class="mb-3">Requestor Details</h3>
            <p><strong>Reservation ID:</strong> <?php echo $reservationId?></p>
            <p><strong>Form submitted on:</strong> <?php echo $submissionTime?></p>
            <p><strong>Full Name:</strong> <?php echo $fullName?></p>
            <p><strong>User Type:</strong> <?php echo $userType?></p>
            <p><strong>Department/College:</strong> <?php echo $college?></p>
            <p><strong>Org:</strong> <?php echo $organization?></p>
            <strong>ID Picture:</strong>
            
            <div> <?php  if (!empty($uploadFilePath)) {
        echo "<img src='$uploadFilePath' alt='Uploaded Photo' style='max-width: 100%; height: auto;'>";
    } else {
        echo "<p>No uploaded photo.</p>";
    } ?></div>
        </div>

        <!-- column for activity details -->
        <div class="col-sm-6">
            <h3 class="mb-3">Activity Details</h3>
            <p><strong>Speaker's Name:</strong> <?php echo $speakerName?></p>
            <p><strong>Activity Name:</strong> <?php echo $activityName?></p>
            <p><strong>Activity Type:</strong> <?php echo $activityType?></p>
            <p><strong>Venue:</strong> <?php echo $roomName?></p>
            <p><strong>Number of Attendees:</strong> <?php echo $numOfAttendees?></p>
            <p><strong>Dates of Activity:</strong> <?php echo $date?></p>
            <p><strong>Time:</strong> <?php echo $timeSlot?></p>
            
            
          
        </div>
        </div>

    <div class="row">
        <div class="col-sm-6">
            <h3>Items Needed</h3>
           
            <div class="mb-3"> 
                <?php   if ($selectedItems !== null) {
        foreach ($selectedItems as $item) {
            echo "<li>{$item['item']} {$item['quantity']}</li>";
        }
    }?>
            </div>  
        <p><strong>Remarks:</strong> <?php echo $remarks?></p>
        </div>
    </div>

    <!-- Button to trigger printing -->
    <div class="row">
        <div class="col-sm-6">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
   
    </section>

</body>
</html>
