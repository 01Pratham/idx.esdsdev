<?php
session_start();
require("database.php");

if ($_POST['action'] == 'Delete') {
  mysqli_query($con, "DELETE FROM `tbl_saved_estimates` WHERE id = {$_POST['post_data']}");
}

function saveEstmt()
{
  if (empty($_POST['version'])) {
    $version = 1;
  } else {
    $version = $_POST['version'];
  }

  $project_name = $_POST['project_name'];
  $date = new DateTime();
  $date->setTimezone(new DateTimeZone("Asia/Kolkata"));
  $time = $date->format('Y-m-d H:i:sa');
  $date = $date->format('Y-m-d');

  $data = $_POST['data'];

  global $con;

  if ($_POST['action'] == "save") {
    $query = mysqli_query(
      $con,
      "INSERT INTO `tbl_saved_estimates`( 
      `emp_code`, 
      `pot_id`, 
      `project_name`, 
      `version` , 
      `owner`,
      `last_changed_by`,
      `date_created`, 
      `date_updated`, 
      `contract_period`, 
      `total_upfront`, 
      `data`) 
      VALUES ('{$_POST["emp_id"]}',
      '{$_POST["pot_id"]}',
      '{$project_name}', 
      '{$version}',
      '{$_SESSION['emp_code']}',
      '{$_SESSION['emp_code']}',
      '{$date}',
      '{$time}',
      '{$_POST["period"]}',
      '{$_POST["total"]}' , 
      '{$data}')"
    );
  } elseif ($_POST['action'] == 'save_as') {
    $version = $version + 1;
    $query = mysqli_query(
      $con,
      "INSERT INTO `tbl_saved_estimates`( 
    `emp_code`, 
    `pot_id`, 
    `project_name`, 
    `version` , 
    `owner` , 
    `last_changed_by`,
    `date_created`, 
    `date_updated`, 
    `contract_period`, 
    `total_upfront`, 
    `data`) VALUES (
    '{$_POST['emp_id']}',
    '{$_POST['pot_id']}',
    '{$project_name}',
    '{$version}',
    '{$_SESSION['emp_code']}',
    '{$_SESSION['emp_code']}',
    '{$date}',
    '{$time}',
    '{$_POST['period']}',
    '{$_POST['total']}' , 
    '{$data}')"
    );

  } elseif ($_POST['action'] == 'update') {
    $Total = (isset($_POST['total']))?"`total_upfront`='{$_POST['total']}' ," : (''); 
    if (!empty($_POST['old_pot'])) {
      $version = 1;
    }
    $query = mysqli_query(
      $con,
      "UPDATE `tbl_saved_estimates` SET 
      {$Total}
    `pot_id` = '{$_POST['pot_id']}', 
    `version` = '{$version}',
    `last_changed_by` = '{$_SESSION['emp_code']}',
    `date_updated`='{$time}',
    `contract_period`='{$_POST['period']}',
    `data`='{$data}'
    WHERE `id` = '{$_SESSION['edit_id']}' "
    );
  }
  if ($query) {
    echo "Data Stored Successfully";
  } else {
    // echo "Error while storing DATA \n";

    echo 
    "UPDATE `tbl_saved_estimates` SET 
    ".(isset($_POST['total']))? "`total_upfront`='{$_POST['total']}'" : ('') . "
    `pot_id` = '{$_POST['pot_id']}', 
    `version` = '{$version}',
    `last_changed_by` = '{$_SESSION['emp_code']}',
    `date_updated`='{$time}',
    `contract_period`='{$_POST['period']}',
    `data`='{$data}'
    WHERE `id` = '{$_SESSION['edit_id']}' ";
  }
}
saveEstmt();