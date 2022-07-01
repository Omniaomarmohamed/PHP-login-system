<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <section style="margin-bottom:50px ; padding: 70px 0px 70px 0px; margin: auto;">
    <form style="width:50%; margin: auto; padding: 70px 0px 70px 0px;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" class="contactForm py-5 container">
      <div style="padding: 20px 0px 20px 0px">
        <h1  style="color: #101d3d; font-size: 38px;">Employee <span style="color: #e8465a"> form:</h1>
      </div>

      <div style="display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap; margin-right: -5px; margin-left: -5px;">
        <div style=" margin-bottom: 1rem; position: relative;width: 100%; padding-right: 15px; padding-left: 15px;">
          <label class="main " style="color: #101d3d; font-weight: 700!important;"> ID:</label>
          <input id="id" type="text" name="employee_id"   placeholder="" data-rule="minlen:4" data-msg="Please enter at least 4 chars" style="border-radius: 0.25rem!important; display: block; "/>
         
        </div>
      </div>

      <div style="display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap; margin-right: -5px; margin-left: -5px;">
        <div style=" margin-bottom: 1rem; position: relative; width: 100%; padding-right: 15px; padding-left: 15px; ">
          <label class="main" style="color: #101d3d; font-weight: 700!important;"> password:</label>
          <input id="password" type="password"  name="password" placeholder="" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" style="border-radius: 0.25rem!important;display: block;"/>
         
        </div>
      </div>

      <div data-aos="fade-up" class=" my-2">
        <button class="submit"  name="submit" type="submit">submit</button>
      </div>


    </form>

  </section>
  <?php
  session_start();
  if(isset($_SESSION['isLoggedIn']))
  {
    if($_SESSION['isLoggedIn'] == true)
    {
      header("Location:chooseReview.php");
    }
  }
  if(isset($_POST['submit'])) {
    
          $employee_id = $_POST['employee_id']; 
          $password = $_POST['password']; 
          $hashedPass =  hash('sha256', $password);


      
          include_once("confg.php");
          $sql="select * from employee  where employee_id='$employee_id' and password='$hashedPass'";//// table name "employee"

          $res=mysqli_query($mysqli,$sql);
    
          if (mysqli_num_rows($res) > 0) 
          {
            $row = mysqli_fetch_assoc($res); // check if employee_id is already exists , you will not to login 
            if($employee_id==isset($row['employee_id']))
            {
                $firstname = $row['firstname'];
                $surname = $row['surname'];            
                $_SESSION['employee_id']=$employee_id;
                $_SESSION['firstname']=$firstname;
                $_SESSION['surname']=$surname;
                $_SESSION['isLoggedIn']=true;
                header("Location:chooseReview.php");
            }
          }
          else{echo "Username Or Password Is Incorrect";}
      }

?>
</body>

</html>