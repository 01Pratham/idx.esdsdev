<?php

function get_OS($sw_name, $core_devide = 1, $price = 1, $Data = 'Price')
{
  global $os, $vcore_data, $value, $vmqty, $final_qty, $j;
  $final_qty = array();
  $core_data = array();
  $vmqty_data = array();
  foreach ($vmqty[$j] as $i => $value) {
    if ($os[$j][$i] == $sw_name) {
      $vmqty_data[$i] = $vmqty[$j][$i];
      if (empty($vmqty_data[$i])) {
        array_pop($vmqty_data);
      }
      if (preg_match("/Windows/", $sw_name)) {
        $core_data[$i] = $vcore_data[$i];
        if (empty($core_data[$i])) {
          array_pop($core_data);
        }
        $final_qty[$i] = ($core_data[$i] * $vmqty_data[$i]) / $core_devide;
      }
      else {
        $final_qty[$i] = $vmqty_data[$i];
        // echo ($vmqty_data[$i])."\n";
      }
    } 
  }
  if ($Data == "SKU") {
    $value = $final_qty;
  } else {
    $value = intval(array_sum($final_qty)) * intval($price);
  }
  // print_r(array_keys($final_qty));
  return $value;
  // print_r($vcore_data);
}


function get_DB($sw_name, $core_devide = 1, $price = 1, $Data = 'price')
{
  global $db, $vcore_data, $vmname, $vmqty, $value, $final_qty, $state, $j;
  $final_qty = array();
  $core_data = array();
  $vmqty_data = array();
  foreach ($vmqty[$j] as $i => $value) {
    if($db[$j][$i] == $sw_name){
      $core_data[$i] = $vcore_data[$i];
      $vmqty_data[$i] = $vmqty[$j][$i];
      if (preg_match('/MS SQL/', $sw_name)) {
        $state_data[$i] = $state[$j][$i];
        if ($state_data[$i] == "Passive") {
          $core_data[$i] = 0;
        } elseif ($state_data[$i] == "Active-Passive") {
          $vmqty_data[$i] = $vmqty[$j][$i] / 2;
        }
        $final_qty[$i] = (intval($core_data[$i]) * intval($vmqty_data[$i])) / $core_devide;
      }
      else if (preg_match("/Community/", $sw_name)) {
        $final_qty[$i] = intval($vmqty_data[$i]);
      } else {
        $final_qty[$i] = ($core_data[$i] * $vmqty_data[$i]) / $core_devide;
      }
    }
  }
  if ($Data == "SKU") {
    $value = $final_qty;
  } else {
    $value = intval(array_sum($final_qty)) * intval($price);
  }
  return $value;
}

function get_Price($prod, $act = "price")
{

  global $con, $_POST;
  $query = mysqli_query($con, "SELECT * FROM `price_list` WHERE `product` = '{$prod}'");
  $val = mysqli_fetch_assoc($query);
  if ($act == "price") {
    $price = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `rate_card_prices` WHERE `rate_card_id` = '{$_POST['price_list']}' AND `prod_id` = '{$val['id']}' "));
    return $price['price'];
  } else {
    return $val[$act];
  }
  //   print_r($val);
}
// echo get_Price("Load Balancer : CITRIX");

function get_strg($unit, $price = 1, $qty = 1)
{
  if ($unit == "TB") {
    return (intval($qty) * 1024) * $price;
  } else {
    return $price * intval($qty);
  }
}

function strg_iops($unit, $iops)
{
  if ($unit == 'GB') {
    return "Storage Space with " . ($iops / 1000) . " IOPS";
  } else {
    return "Storage Space with " . ($iops) . " IOPS";
  }
}


function ManagedServices($service, $service_qty)
{
  if (isset($service)) {
    if (!empty($service_qty)) {

    }
  }
}

$db_cal = array(
  'MS SQL Enterprise' => 2,
  'MS SQL WEB' => 2,
  'MS SQL Standerd' => 2,
  'MY SQL Community' => NULL,
  'MY SQL Standard' => 4,
  'MY SQL Enterprise' => 4,
  'Postgre SQL Enterprise' => 1,
  'Postgre SQL Community' => NULL,
  'Oracle SQL Standerd' => 8,
  'Oracle SQL Enterprise' => 8,
  'Mongo DB Community' => NULL,
  'Maria DB Community' => NULL
);


if (!function_exists('SkuList')) {
  function SkuList()
  {
    include 'constants.php';
    require '../model/database.php';
    global $vmname, $j, $product_sku, $db_cal, $vCore, $vRam, $vDisk, $vmqty;

    $Sku_Data = array();
    foreach ($vmname[$j] as $i => $nameVal) {
      $Sku_Data["VM" . $i]['Group_Name'] = $vmname[$j][$i];
      if ($series[$j][$i] == "Flexible Compute") {
        $Sku_Data["VM" . $i][$product_sku['cpu']] = $cpu[$j][$i];
        $Sku_Data["VM" . $i][$product_sku['ram']] = $ram[$j][$i];
        $Sku_Data["VM" . $i][$product_sku['iops_1']] = $disk[$j][$i];
      } else {
        $Sku_Data["VM" . $i][$product_sku['cpu']] = $vCore[$j][$i];
        $Sku_Data["VM" . $i][$product_sku['ram']] = $vRam[$j][$i];
        $Sku_Data["VM" . $i][$product_sku['iops_1']] = $vDisk[$j][$i];
      }
      foreach ($prod_cat as $int => $cat) {
        foreach ($products as $new_int => $product) {
          if ($new_int == $int) {
            if ($cat == "os") {
              if ($os[$j][$i] == $product) {
                $Sku_Data["VM" . $i][$product_sku[$int]] = get_OS($os[$j][$i], 2, '', 'SKU')[$i];
              }
            }
            if ($cat == 'db') {
              if ($db[$j][$i] == $product) {
                $Sku_Data["VM" . $i][$product_sku[$int]] = get_DB($db[$j][$i], $db_cal[$db[$j][$i]], '', 'SKU')[$i];
              }
            }
          }
        }
      }
      $Sku_Data["VM" . $i]['Quantity'] = $vmqty[$j][$i];
    }
    return $Sku_Data;
  }
}

if (!function_exists('GroupPrice')) {
  function GroupPrice()
  {
    include 'constants.php';
    require '../model/database.php';
    global $vmname, $j, $i, $db_cal, $vCore, $vRam, $vDisk, $vmqty;

    $PriceData = array();

    $Infrastructure['VM' . $i][$vmname[$j][$i]] = intval($vmqty[$j][$i]) * $price;
    foreach ($prod_cat as $int => $cat) {
      foreach ($products as $new_int => $product) {
        if ($new_int == $int) {
          if ($cat == "os") {
            if ($os[$j][$i] == $product) {
              $PriceData["VM" . $i][$product] = get_OS($os[$j][$i], 2, $product_prices[$int], "SKU")[$i] * $product_prices[$int];
            }
          }
          if ($cat == 'db') {
            if ($db[$j][$i] == $product) {
              $PriceData["VM" . $i][$product] = get_DB($db[$j][$i], $db_cal[$db[$j][$i]], $product_prices[$int], "SKU")[$i] * $product_prices[$int];
            }
          }
        }

      }
      // $PriceData[$vmname[$j][$i]]['Quantity']= $vmqty[$j][$i];
    }
    return $PriceData;
  }
}

?>