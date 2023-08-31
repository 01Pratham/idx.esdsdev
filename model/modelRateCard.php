<?php
require "database.php";
session_start();
$date = new DateTime();
$date->setTimezone(new DateTimeZone("Asia/Kolkata"));
$time = $date->format('Y-m-d H:i:sa');
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == "CreateRateCard") {
        $name = $_POST["rateCardName"];
        $empId = $_SESSION['emp_code'];


        $query = mysqli_query($con, "INSERT INTO `tbl_rate_cards`(`rate_card_name`, `created_by`, `created_date`, `is_active`) VALUES('{$name}', '{$empId}' , '{$time}' , 'True') ");
        if ($query) {
            echo "Rate Card Created Successfully";
        } else {
            echo "Error while creating Rate Card";
        }
    }
    if ($action == "rateCardStatus") {
        $id = $_POST['id'];
        $status = $_POST['status'];
        // print_r($_POST);
        $query = mysqli_query($con, "UPDATE `tbl_rate_cards` SET `is_active` = '{$status}' WHERE `id` ='{$id}' ");

        if ($query) {
            echo "Rate Card Updated Successfully";
        } else {
            echo "Error while Updating Rate Card";
        }
    }
    if ($action == "AddProducts") {
        $rateCardId = $_POST['rateCardId'];
        // $productId = $_POST['prod_id'];
        $Products = $_POST['prods'];
        foreach ($Products as $Key => $Val) {
            $query = mysqli_query($con, "INSERT INTO `rate_card_prices`(`rate_card_id`, `prod_id`, `date_created`, `is_active`) VALUES ('{$rateCardId}' , '{$Val}' , '{$time}', 'True')");
            if ($query) {
                $resp[] = "Product added Successfully";
            } else {
                $resp[] =  "Error while adding Product";
            }
        }
        // print_r($_POST);
        // print_r(array_unique($resp));
    }
    if ($action == "RemoveProduct") {
        $rateCardId = $_POST['rateCardId'];
        $Products = $_POST['prods'];
        foreach ($Products as $Key => $Val) {
            $query = mysqli_query($con, "DELETE FROM `rate_card_prices` WHERE `rate_card_id` = '{$rateCardId}' AND `prod_id` = '{$Val}'");
            if ($query) {
                echo "Product Removed Successfully";
            } else {
                echo "Error while Removing Product";
            }
        }
        // print_r($_POST);
    }
    if ($action == "UpdateProduct") {
        if (isset($_POST['status'])) {
            $query = mysqli_query($con, "UPDATE `rate_card_prices` SET `is_active` = '{$_POST['status']}' WHERE `id` = '{$_POST['id']}'");
        } elseif (isset($_POST['price'])) {
            $query = mysqli_query($con, "UPDATE `rate_card_prices` SET `price` = '{$_POST['price']}' WHERE `id` = '{$_POST['id']}'");
        }
    }

    if ($action == "DeleteProduct") {
        $Products = $_POST['prods'];
        foreach ($Products as $Key => $Val) {
            $query = mysqli_query($con, "DELETE FROM `rate_card_prices` WHERE `id` = '{$Val}'");
            if ($query) {
                $resp[] = "Product added Successfully";
            } else {
                $resp[] =  "Error while adding Product";
            }
        }
        print_r(array_unique($resp));
    }
}
