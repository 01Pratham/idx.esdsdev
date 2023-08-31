<?php 
// session_start();
include '../model/database.php';
// print_r($_SESSION);
// require 'database.php';

if(isset($_SESSION['edit_id'])) {
  $query = mysqli_query($con, "SELECT * FROM  `tbl_saved_estimates` WHERE `id` = '{$_SESSION['edit_id']}'");
  $data_query = mysqli_fetch_assoc($query);
  if(!empty($data_query['id'])){
    $json_data = $data_query['data'];
    $Editable = json_decode($json_data,true);
  }
} 
elseif (isset($_SESSION['post_data'])){
    $Editable = $_SESSION['post_data'];
}
?>
