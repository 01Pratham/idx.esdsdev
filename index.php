<?php
session_start();

if(isset($_SESSION['uname'])){
    header('Location: estimate/index.php');
    require 'controller/Currency_Format.php';

} else{
    header('Location: login.php');
}

?>