
<?php 
 
// Include the database configuration file 
include_once '../model/database.php'; 
 
// Get current page URL 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 

$user_current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']; 
 
// Get server related info 
$user_ip_address = $_SERVER['REMOTE_ADDR']; 
$emp_code = $_SESSION['emp_code']; 
$uname = $_SESSION['uname']; 
 
// Insert visitor activity log into database 

$sql = "INSERT INTO `visitor_activity_logs` (`user_ip_address`, `emp_code`, `uname`, `page_url`, `created_on`) VALUES ('{$user_ip_address}', '{$emp_code}','{$uname}','{$user_current_url}' ,NOW())"; 

$insert = mysqli_query($con,$sql);

if($insert){
    echo "<script>console.log('yes')</script>";
}else{
    echo "<script>console.log('No')</script>";
}
?>
