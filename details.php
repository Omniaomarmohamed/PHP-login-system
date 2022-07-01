<?php session_start();
$employee_id = $_SESSION['employee_id'];
if (!isset($_SESSION['employee_id'])) {
    // not logged in
    header('Location: index.php');
    exit(); //  to prevent the user for openning the pages without login  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="bootstrap-4.5.0-dist/css/bootstrap.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- navbar start -->

    <ul>
        <li><a>
                <h2 class="text-danger text-capitalize">dunder</h2>
            </a></li>

        <li style="float:right; color: #000;"><a href="logout.php">logout(<?php echo $_SESSION['firstname'] . " " . $_SESSION['surname']; ?>)</a></li>
        <li style="float:right "><a><?php echo date("d-m-Y") ?></a></li>
    </ul>
    <!-- navbar end -->
    <?php
    include_once("confg.php");

    $review_id = $_GET['review_id'];
    $sql = "SELECT * FROM  review WHERE review_id='$review_id'";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    $user_data = mysqli_fetch_array($result);
    $date = new DateTime();
    $time = $date->getTimezone();
    $employee_id = $user_data['employee_id']; //test
    $review_year = $user_data['review_year'];
    $completed = $user_data['completed'];
    $job_knowledge = $user_data['job_knowledge'];
    $work_quality = $user_data['work_quality'];
    $initiative = $user_data['initiative'];
    $communication = $user_data['communication'];
    $dependability = $user_data['dependability'];
    $additional_comment = $user_data['additional_comment'];
    $accepted = $user_data['accepted'];
    $date_completed = $user_data['date_completed'];
    $date_accepted = $user_data['date_accepted'];


    ?>
    <section class="container-b" style="margin-bottom: 3rem !important;align-items:center !important;justify-content:center !important;display:flex !important;">
        <div style="width: 100% !important;">
            <div class="card-header font-weight-bolder text-danger"><h3>Review-details</h3></div>
            <div class="card-body ">
                <ul class="">
                    <li><?php echo $employee_id; ?></li><br>
                    <li><?php echo $review_year; ?></li><br>
                    <li><?php echo $completed; ?></li><br>
                    <li><?php echo $job_knowledge; ?></li><br>
                    <li><?php echo $work_quality; ?></li><br>
                    <li><?php echo $initiative; ?></li><br>
                    <li><?php echo $communication; ?></li><br>
                    <li><?php echo $dependability; ?></li><br>
                    <li><?php echo $additional_comment; ?></li><br>
                    <li><?php echo $accepted; ?></li><br>
                    <li><?php echo $date_completed; ?></li><br>
                    <li><?php echo  $date_accepted; ?></li><br>
                </ul>
            </div>
        </div>
    </section>

    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
</body>

</html>