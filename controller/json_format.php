<?php

function json_template($arr,    $total)
{
    require '../controller/constants.php';
    $template = array(
        "opportunity_id" => ($_POST['pot_id'][0] == 0 )? $_POST['pot_id'] : '0' . $_POST['pot_id'],
        "quotation_id" => '',
        "price_list" => $_POST['price_list'],
        "user_id" => $_SESSION['crmId'],
        "phase_name" => array()
    );
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Kolkata"));
    $date = $date->format('Y-m-d');

    $newInfra = array();
    $j = 1;
    foreach ($total as $key => $val) {
        if(is_array($val)){
            foreach ($val as $k => $v){
              
                if (is_array($v)) {
                    foreach ($v as $p) {
                        $newInfra[$j][] = $p;
                    }
                } else {
                    $newInfra[$j][]= $val;
                }
            }
        }
        $j++;
        
    }


    $p = 1;
    $pCount = 0;
    foreach ($arr as $key => $val) {
        $Pname[] = $key;
        if (is_array($val)) {
            $template['phase_name'][$pCount]["phase"] = $Pname[$pCount];
            $template['phase_name'][$pCount]["phase_start_date"] = $date;
            $template['phase_name'][$pCount]["phase_tenure_month"] = $period[$p];
            $template['phase_name'][$pCount]["phase_total_recurring"] = (array_sum($newInfra[$p]));
            $template['phase_name'][$pCount]["phase_total_otp"] = ((array_sum($newInfra[$p]) *12)* 0.05);

            $g = 1;
            $gCount = 0;
            foreach ($val as $k => $v) {
                $gName[$Pname[$pCount]][] = $k;
                // print_r($gName);
                if (is_array($v)) {
                     
                    $template['phase_name'][$pCount]["group_name"][$gCount]['quotation_group_name'] = (preg_match("/VM/",$gName[$Pname[$pCount]][$gCount])) ? $arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Group_Name'] : $gName[$Pname[$pCount]][$gCount];
                    $template['phase_name'][$pCount]["group_name"][$gCount]['group_otp_price'] = (((array_sum($total[$p][$gName[$Pname[$pCount]][$gCount]]))*12)*0.05);
                    $template['phase_name'][$pCount]["group_name"][$gCount]['group_recurring_price'] = (array_sum($total[$p][$gName[$Pname[$pCount]][$gCount]]));
                    $template['phase_name'][$pCount]["group_name"][$gCount]['group_quantity'] = ($arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Quantity'])?$arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Quantity'] :1 ;

                    $i = 1;
                    $iCount = 0;
                    foreach ($v as $_k => $_v){
                        $iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][]=$_k;
                        if(!empty($iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount])){
                            if($iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount] == "NULL" || $iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount] == "Quantity" || $iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount] == "Group_Name"){
                                // continue;
                            }else{
                                $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_sku'] = $iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount];
                                if(empty($_v)){
                                    // continue;
                                }else{
                                    $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_quantity'] = intval($_v);
                                }
                            }
                        }else{
                            continue;
                        }

                        $iCount+=1;
                        $i+=1;
                    }
                    
                    
                }

                $gCount = $gCount+1;
                $g = $g + 1;
            }

            $pCount += 1;
            $p = $p + 1;
        }
    }

    return $template;
}
