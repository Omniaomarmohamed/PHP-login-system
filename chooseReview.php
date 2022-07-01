<?php   session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="text-capitalize">



<ul>
  <li><a><h2 class="text-danger text-capitalize">dunder</h2></a></li>
  
  <li style="float:right; color: #000;"><a href="logout.php">logout(<?php echo $_SESSION['firstname'] ." ". $_SESSION['surname'];?>)</a></li>
  <li style="float:right "><a><?php echo date("d-m-Y") ?></a></li>
</ul>
    <?php
    include_once("confg.php");
    $employee_id = $_SESSION['employee_id'];

    $sql_MyReviews = "SELECT * FROM  review where employee_id='$employee_id'";
    $result_MyReviews = mysqli_query($mysqli, $sql_MyReviews) or die( mysqli_error($mysqli));

    $sql_EmployeesReviewsCompleted = "SELECT * FROM `review` inner JOIN employee on employee.employee_id = review.employee_id where employee.supervisor_id ='$employee_id' and completed ='Y'";
    $result_EmployeesReviewsCompleted = mysqli_query($mysqli, $sql_EmployeesReviewsCompleted) or die( mysqli_error($mysqli));

    $sql_EmployeesReviewsNotCompleted = "SELECT * FROM `review` inner JOIN employee on employee.employee_id = review.employee_id where employee.supervisor_id ='$employee_id' and completed = 'N'";
    $result_EmployeesReviewsNotCompleted = mysqli_query($mysqli, $sql_EmployeesReviewsNotCompleted) or die( mysqli_error($mysqli));

    $sql_IsSupervisor = "SELECT * FROM `department` where department_head ='$employee_id'";
    $result_IsSupervisor = mysqli_query($mysqli, $sql_IsSupervisor) or die( mysqli_error($mysqli));
     
    $date = new DateTime();
    $time = $date->getTimezone();
?>



<div class="container-b">
<section class="  ">
    <h2 class="text-danger my-5 mt-5" >My Reviews</h2>
            <table class=" table" width="100">
                <thead class="text-danger">
                    <th>review id</th>
                    <th>employee id</th>
                    <th>review year</th> 
                    <th>completed</th> 
                    <th>additional comment</th>
                    <th>accepted</th>
                    <th>date completed</th>
                    <th>date accepted</th>
                </thead>
            <?php 
                while($user_data = mysqli_fetch_array($result_MyReviews)) {
                    
                    echo " <tbody>";
                    echo " <td> <a ' href='details.php?review_id=$user_data[review_id]'>".$user_data['review_id']."</a></td>";
                    echo "<td>".$user_data['employee_id']."</td>";
                    echo "<td>".$user_data['review_year']."</td>";
                    echo "<td>".$user_data['completed']."</td>";
                    echo "<td>".$user_data['additional_comment']."</td>";
                    echo "<td>".$user_data['accepted']."</td>";
                    echo "<td>".$user_data['date_completed']."</td>";
                    echo "<td>".$user_data['date_accepted']."</td>";
                     echo " </tbody>";
                  
      }
            ?>       
        
        </table>
    
          
      
    </section>
    <?php
    // check if employee is a supervisor or not
        if(mysqli_num_rows($result_IsSupervisor)>0)
        {
            ?>
            <section class="py-5  ">
            <div class = "row">
                <div class="col-6">
                <h6 class="text-danger my-5 mt-5">Employees Reviews(Completed)</h6>
                <table class=" table table-responsive" width="100">
                        <thead class="text-danger">
                            <th>Surname</th>
                            <th>Firstname</th>
                            <th>year of review</th> 
                            <th>review id</th> 
                            <th>employee id</th>
                            <th>completed</th>
                            <th>date completed</th>
                        </thead>
                        <tbody>
                <?php 
                    while($user_data = mysqli_fetch_array($result_EmployeesReviewsCompleted)) {
                        
                        echo " <tr>";
                        echo " <td > <a'href='details.php?review_id=$user_data[review_id]'>".$user_data['surname']."</a></td>";
                        echo "<td>".$user_data['firstname']."</td>";
                        echo "<td>".$user_data['review_year']."</td>";
                        echo "<td >".$user_data['review_id']."</td>";
                        echo "<td>".$user_data['employee_id']."</td>";
                        echo "<td>".$user_data['completed']."</td>";
                        echo "<td>".$user_data['date_completed']."</td>";
                        echo " </tr>";
                    
                    }
                ?>       
                </tbody>
                </table>
                    </div>
                    <div class="col-6">
                    <h6 class="text-danger my-5 mt-5">Employees Reviews(Not Completed)</h6>
                    <table class=" table table-responsive" width="100">
                    <thead class="text-danger">
                        <th>Surname</th>
                        <th>Firstname</th>
                        <th>year of review</th> 
                        <th >review id</th> 
                        <th>employee id</th>
                        <th>completed</th>
                        <th>date completed</th>
                        
                    </thead>
                    <tbody>
                
                
                
                <?php 
                    while($user_data = mysqli_fetch_array($result_EmployeesReviewsNotCompleted)) {
                        
                        echo " <tr>";
                        echo " <td> <a'href='details.php?review_id=$user_data[review_id]'>".$user_data['surname']."</a></td>";
                        echo "<td>".$user_data['firstname']."</td>";
                        echo "<td>".$user_data['review_year']."</td>";
                        echo "<td >".$user_data['review_id']."</td>";
                        echo "<td>".$user_data['employee_id']."</td>";
                        echo "<td>".$user_data['completed']."</td>";
                        echo "<td>".$user_data['date_completed']."</td>";
                        echo " </tr>";
                    
                    }
                ?>       
                </tbody>
                </table>
                    </div>
            </div>
            </div>
    </section>
        <?php } ?>
    
</div>
</body>

</html>