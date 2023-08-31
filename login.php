<?php
session_start();
require "model/database.php";
if (isset($_SESSION['uname'])) {
    header('Location: index.php');
}
if (isset($_GET['SignUp'])) {
    header('Location: view/sign_up');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurator | Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="asset/logo.png" type="image/x-icon">

</head>

<body>

    <div class="container" style="position: absolute; 
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          padding: 10px;">
        <div class="d-flex justify-content-center">
            <div class="panel border bg-white">

                <?php
                function Login()
                { ?>


                    <div class="panel-heading">
                        <!-- <img src="asset/logo.jpg" alt=""> -->
                        <h3 class="pt-3 font-weight-bold">Login</h3>
                    </div>
                    <div class="panel-body p-3">
                        <form action="controller/process.php" method="POST">
                            <div class="form-group py-2">
                                <div class="input-field">
                                    <span class="far fa-user p-2"></span>
                                    <input type="text" placeholder="Username" required name='login_uname'>
                                </div>
                            </div>
                            <div class="form-group py-1 pb-2">
                                <div class="input-field">
                                    <span class="fas fa-lock px-2" id="eye" onclick="ToogleClass($(this).prop('id') , 'pass')"></span>
                                    <input type="password" placeholder="Password" required id="pass" name='login_pass' autocomplete="on">
                                    <!--    <span class="far fa-eye-slash " id="eye"></span>-->
                                </div>
                            </div>
                            <div class="form-inline">
                                <a href="?forgetPass" id="forgot" class="font-weight-bold">Forgot password ?</a>
                            </div>

                            <input type="submit" value="Login" class="btn btn-primary btn-block mt-3" name="login_btn" id="login_btn">
                            <!-- <div class="text-center pt-4 text-muted">Don't have an account? <a href="#">Sign up</a> -->
                        </form>
                    </div>

                <?php    }

                function Forget()
                {
                    global $con;
                ?>


                    <div class="panel-heading">
                        <h3 class="pt-3 font-weight-bold">Forget Password</h3>
                    </div>
                    <div class="panel-body p-3">
                        <form action="login.php" method="POST">
                            <div class="form-group py-2">
                                <div class="input-field">
                                    <span class="far fa-user p-2"></span>
                                    <input type="text" placeholder="Username" required name='login_uname' autocomplete="on">
                                </div>
                            </div>
                            <div class="form-group py-1 pb-2">
                                <div class="input-field">
                                    <span class="fas fa-lock px-2" id="lock1" onclick="ToogleClass($(this).prop('id') , 'pass')"></span>
                                    <input type="password" placeholder="Password" required id="pass" name='login_pass' autocomplete="on">
                                </div>
                            </div>

                            <div class="form-group py-1 pb-2">
                                <div class="input-field">
                                    <span class="fas fa-lock px-2" id="lock2" onclick="ToogleClass($(this).prop('id') , 'conf_pass')"></span>
                                    <input type="password" placeholder="Confirm Password" required id="conf_pass" name='conf_login_pass' autocomplete="on">
                                </div>
                            </div>
                            <div class="form-inline">
                                <a href="login.php" id="forgot" class="font-weight-bold">Back to Login ?</a>
                            </div>

                            <input type="submit" value="Reset" class="btn btn-primary btn-block mt-3" name="reset_btn" id="reset_btn">
                            <!-- <div class="text-center pt-4 text-muted">Don't have an account? <a href="#">Sign up</a> -->
                        </form>
                    </div>

                <?php


                }


                if (isset($_GET['forgetPass'])) {
                    Forget();
                } else {
                    Login();
                }

                if (isset($_POST['reset_btn'])) {
                    if ($_POST['conf_login_pass'] == $_POST['login_pass']) {
                        $pass = md5($_POST['conf_login_pass']);
                        $Validation = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `login_master` WHERE `username` = '{$_POST['login_uname']}'"));
                        if (!empty($Validation["employee_code"])) {
                            mysqli_query($con, "UPDATE `login_master` SET `password` = '{$pass}' WHERE `employee_code` = '{$Validation['employee_code']}' ");
                        } else {
                            echo "<script>alert('Please Enter Valid Usernames')</script>";
                        }
                    } else {
                        echo "<script>alert('Please Enter Valid Password')</script>";
                    }
                }



                ?>


            </div>
        </div>

    </div>
    </div>

    <script>
        function ToogleClass(eye, pass) {
            if ($("#" + eye).hasClass('fa-lock')) {
                $("#" + eye).removeClass('fa-lock');
                $("#" + eye).addClass('fa-unlock');
                $("#" + pass).attr("type", "text")
            } else if ($("#" + eye).hasClass('fa-unlock')) {
                $("#" + eye).removeClass('fa-unlock');
                $("#" + eye).addClass('fa-lock');
                $("#" + pass).attr("type", "password")
            }
        }

        $("#pass , #conf_pass").on("input", function() {
            if ($("#pass").val() != $("#conf_pass").val()) {
                $("#conf_pass").parent().addClass("border-danger");
            } else if ($("#conf_pass").val() != $("#pass").val()) {
                $("#pass").parent().addClass("border-danger");
            } else {
                $("#conf_pass").parent().removeClass("border-danger")
            }
        })


        $(document).keypress(function(event) {
            // return event.key == "Enter";
            // console.log(event.keyCode)
            if (event.keyCode === 13) {
                $('#login_btn').click()
            }
        });
    </script>

</body>

</html>