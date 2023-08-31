<?php
error_reporting( E_ERROR | E_PARSE );

$HostName = 'localhost';
$UserName = 'idxesdsd_cal';
$Password = 'v2BFvmbge2P+#C';
// $Password = '';
$DataBase = 'idxesdsd_cal_v2';

$con = mysqli_connect( $HostName, $UserName, $Password, $DataBase )  or die( 'Database Error : Connection Lost' );

mysqli_set_charset($con,'utf8');

$reg = mysqli_query( $con, 'Select Distinct region from tbl_pack' );
$ser = mysqli_query( $con, 'Select Distinct pack_series from tbl_pack' );

$pack_query = 'Select Distinct pack from tbl_pack';
$pack = mysqli_query( $con, $pack_query );
$product_prices = array();
$tbl = array();

if(isset($_POST['buffer'])){
    echo $_POST['buffer'];
}

$exe_query = mysqli_query( $con, 'SELECT * FROM `price_list`' );

while ( $price_tbl = mysqli_fetch_assoc( $exe_query ) ) {
    // $price_query = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `rate_card_prices` WHERE `rate_card_id` = '{$_POST['price_list']}' AND `prod_id` = '{$price_tbl['id']}'" ));
    $product_prices[ $price_tbl[ 'prod_int' ] ] = intval($price_tbl[ 'price' ]);
    $prod_cat[ $price_tbl[ 'prod_int' ] ] = $price_tbl[ 'sec_category' ];
    $product_sku[ $price_tbl[ 'prod_int' ] ] = $price_tbl[ 'sku_code' ];
    $products[ $price_tbl[ 'prod_int' ] ] = $price_tbl[ 'product' ];
    array_push( $tbl, $price_tbl );
}
// print_r( $prod_cat );

if ( !function_exists( 'employee' ) ) {
    function employee( $code ) {
        global $con;
        $get_emp = mysqli_fetch_assoc( mysqli_query( $con, "SELECT * FROM `login_master` WHERE `employee_code` = '{$code}'" ) );
        return $get_emp;
    }

    function UserRole( $role_id ) {
        global $con;
        $get_role = mysqli_fetch_assoc( mysqli_query( $con, "SELECT * FROM `role_master` WHERE `id` = '{$role_id}'" ) );
        return $get_role[ 'role_name' ];
    }
}

if(!function_exists('create_opt')){
    function create_opt($category)
    {
        global $con;
        $query = mysqli_query($con, "SELECT * FROM `price_list` WHERE sec_category = '{$category}'");
        while ($product = mysqli_fetch_assoc($query)) {
            // echo $product['product'];
            echo "<option value = '{$product['product']}'>{$product['product']}</option>";
        }
    }
}
if(!function_exists('GetVal')){
    function GetVal($id){
        global $con;
        $quer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `price_list` WHERE `id` = '{$id}'"));
        return $quer;
    }
}




