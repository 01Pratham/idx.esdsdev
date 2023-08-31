<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Registration Form</title>
  <link rel="stylesheet" href="style.css">
  <script src="jquery-3.6.4.js"></script>
</head>

<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="" method="post" id='self_form'>
      <div class="input-box">
        <input type="text" placeholder="Enter your First Name" required name="fname">
      </div>
      <div class="input-box">
        <input type="text" placeholder="Enter your Last Name" required name="lname">
      </div>
      <div class="input-box">
        <input type="number" placeholder="Enter your Employee ID" required name="emp_id" id="emp_id">
      </div>
      <div class="input-box">
        <input type="email" placeholder="Enter your email with @esds.co.in" required name="mail" id="mail">
      </div>
      <div class="input-box">
        <input type="password" placeholder="Create password" required id="pass_1" name="pass">
      </div>
      <div class="input-box">
        <input type="password" placeholder="Confirm password" required id="pass_2" name="conf_pass">
      </div>
      <div class="input-box button">
        <input type="button" value="Register" id="submit" name="register">
      </div>
    </form>
  </div>

  <script>
    $(document).ready(function() {
      $('#pass_1').on('input', function() {
        if ($('#pass_1').val() != '') {
          $('#pass_2').on('input', function() {
            if ($('#pass_1').val() != $('#pass_2').val()) {
              $('#pass_2').attr('style', "border-color: red")
            } else {
              $('#pass_2').attr('style', "border-color: #4070f4")
              $('#submit').attr('type', 'submit');
            }
          })
          if ($('#pass_1').val() != $('#pass_2').val()) {
            $('#pass_2').attr('style', "border-color: red")
          } else {
            $('#pass_2').attr('style', "border-color: #4070f4")
            $('#submit').attr('type', 'submit');
          }
        }
      })

      // $('#emp_id').on('input' function(){
      //   if($('#emp_id').val() > 9999){
      //     $('')
      //   }
      // })

      $('#submit').click(function() {
        if (($('#pass_1').val() != $('#pass_2').val())) {
          alert("Please Enter valid Password");
        } 
        // if($('#')){

        // }
      })

    })
  </script>

</body>

</html>


<?php

if (isset($_POST['register'])) {
  // print_r($_POST);
  require_once '../../model/database.php';
  $check = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `login_master` WHERE `email` = '{$_POST['mail']}'"));
  if (empty($check['email'])) {
    $pass = md5($_POST['conf_pass']);
    $save = mysqli_query(
      $con,
      " INSERT INTO `login_master`
            (`employee_code`, 
            `first_name`, 
            `last_name`, 
            `email`, 
            `password`,
            `user_role`) 
            VALUES (
            '{$_POST['emp_id']}',
            '{$_POST['fname']}',
            '{$_POST['lname']}',          
            '{$_POST['mail']}',
            '{$pass}',
            'UR')"
    );
    if ($save) {
      echo "<script> alert('Data Saved Successfully') 
        window.location.href = 'index.php'
      </script>";
    } else {
      echo "<script> alert('Error while saving the Data') </script>";
    } 
  }else{
    echo "<script> alert('Data Has Already been Stored') 
    window.location.href = 'index.php'
    </script>";
  }
}

?>