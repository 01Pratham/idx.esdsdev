<?php
$Sku_Data = array();
require_once "../controller/calculations.php";

foreach ($estmtname as $j => $_Key) {
    $no = 0;
    $Infrastructure = array();
    $antiVirus = false;
?>
    <table class='final-tbl table except' id="final-tbl<?= $j ?>">
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr>
            <th class='Head colspan except noExl' colspan='7' style='font-size: 30px;'>
                <?= $estmtname[$j] ?>
            </th>
        </tr>
        <?php
        if (!empty($series[$j][0])) {
            $no + 1;
            $a = 'A.' . $no . ' +';

            tblHead('eNlight Cloud Hosting');

            $vm_total = array();
            $vcore_data = array();
            foreach ($vmqty[$j] as $i => $val) {
                $cost_rows = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_pack` WHERE `sr_no` = '{$instance[$j][$i]}' AND `region` =  '{$region[$j][$i]}' "));
                $compute[$j][$i] = "vCores {$cpu[$j][$i]} | RAM  {$ram[$j][$i]} GB | Disk - 1000 IOPS -  {$disk[$j][$i]} GB";
                $price = ($instance[$j][$i] == 'Flexi') ?
                    (($product_prices['cpu'] * intval($cpu[$j][$i])) +
                        ($product_prices['ram'] * intval($ram[$j][$i])) +
                        ($product_prices['iops_1'] * intval($disk[$j][$i])))
                    : $cost_rows['price'];

                $vCore[$j][$i] = $cpu[$j][$i];
                $vRam[$j][$i] = $ram[$j][$i];
                $vDisk[$j][$i] = $disk[$j][$i];

                array_push($vcore_data, $vCore[$j][$i]);
                if (!empty($av_type[$j][$i])) {
                    $av = true;
                } else {
                }

                $Service = !empty($vmname[$j][$i]) ? ($vmname[$j][$i]) : ('Virtual Machine') . ' - ' . $region[$j][$i] . ' - ' . $sector[$j][$i] . ' ' . $state[$j][$i];

                $ProdName = $instance[$j][$i] . ' : ' . $compute[$j][$i] . ' | OS : ' . $os[$j][$i] . ' | DB : ' . $db[$j][$i];

                tblRow($Service, $ProdName, $vmqty[$j][$i], $price);

                $Infrastructure['VM' . $i] = GroupPrice()['VM' . $i];
                $Infrastructure['VM' . $i][$vmname[$j][$i]] = intval($vmqty[$j][$i]) * $price;
            }
        }

        if (!empty($series[$j][0]) || !empty($agenttype[$j]) || isset($drm_tool[$j])) {
            $b = 'A.' . $no = $no + 1;
            $b .= ' +';
            tblHead("Software Licenses");

            $os_data = (!empty($os[$j])) ? array_values(array_unique($os[$j])) : null;
            $db_data = (!empty($db[$j])) ? array_values(array_unique($db[$j])) : null;
            foreach ($vmqty[$j] as $i => $val) {

                if ($os_data[$i] == 'Windows Standard Edition') {
                    tblRow("Operating System", $os_data[$i], get_OS($os_data[$i], 2), $product_prices['win_se'], "Lic.");
                }

                if ($os_data[$i] == 'Windows Datacenter Edition') {
                    tblRow("Operating System", $os_data[$i], get_OS($os_data[$i], 2), $product_prices['win_dc'], "Lic.");
                }

                if ($os_data[$i] == 'Linux : RHEL') {
                    tblRow("Operating System", $os_data[$i], get_OS($os_data[$i]), $product_prices['rhel'], "Lic.");
                }

                if ($os_data[$i] == 'Linux : UBUNTU') {
                    tblRow("Operating System", $os_data[$i], get_OS($os_data[$i]), 0, "Lic.");
                }

                if ($os_data[$i] == 'Linux : CENTOS') {
                    tblRow("Operating System", $os_data[$i], get_OS($os_data[$i]), 0, "Lic.");
                }

                if ($os_data[$i] == 'Linux : SUSE') {
                    tblRow("Operating System", $os_data[$i], get_OS($os_data[$i]), $product_prices['suse'], "Lic.");
                }
                
            }

            foreach ($vmqty[$j] as $i => $val) {
                if ($db_data[$i] == 'MS SQL Standard') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i], 2), $product_prices['ms_std'], " Lic.");
                }
                if ($db_data[$i] == 'MS SQL Enterprise') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i], 2), $product_prices['ms_ent'], " Lic.");
                }
                if ($db_data[$i] == 'MS SQL WEB') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i], 2), $product_prices['ms_web'], " Lic.");
                }
                if ($db_data[$i] == 'MY SQL Community') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i]), $product_prices['my_com'], " Lic.");
                }
                if ($db_data[$i] == 'MY SQL Standard') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i], 4), $product_prices['my_std'], " Lic.");
                }
                if ($db_data[$i] == 'MY SQL Enterprise') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i], 4), $product_prices['my_ent'], " Lic.");
                }
                if ($db_data[$i] == 'Postgre SQL Enterprise') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i], 1), $product_prices['post_ent'], " Lic.");
                }
                if ($db_data[$i] == 'Postgre SQL Community') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i]), $product_prices['post_com'], " Lic.");
                }
                if ($db_data[$i] == 'Oracle SQL Standard') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i], 8), $product_prices['orc_std'], " Lic.");
                }
                if ($db_data[$i] == 'Oracle SQL Enterprise') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i], 1), $product_prices['orc_ent'], " Lic.");
                }
                if ($db_data[$i] == 'Mongo DB Community') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i]), $product_prices['mong_com'], " Lic.");
                }
                if ($db_data[$i] == 'Maria DB Community') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i]), $product_prices['mar_com'], " Lic.");
                }
                if ($db_data[$i] == 'Other') {
                    tblRow("Database", $db_data[$i], get_DB($db_data[$i]), $product_prices['mar_com'], " Lic.");
                }
            }
            $Sku_Data[$estmtname[$j]] = SkuList();

            if (!empty($agenttype[$j])) {
                if ($agenttype[$j] == 'All VM') {
                    $agentqty[$j] = $vmqty[$j];
                } elseif ($agenttype[$j] == 'DB VM') {
                    foreach ($vmqty[$j] as $i => $val) {
                        if ($db[$i] != 'NA') {
                            $agentqty[$j][$i] = $vmqty[$j][$i];
                        }
                    }
                } elseif ($agenttype[$j] == 'Customized') {
                    $agentqty[$j][$i] = $_POST['ageqty'][$j];
                }

                tblRow("Software", 'Backup Agent', array_sum($agentqty[$j]), $product_prices['backup_age']);

                $Infrastructure['Software']['agent'] = array_sum($agentqty[$j]) * $product_prices['backup_age'];
                $Sku_Data[$estmtname[$j]]['Software'][$product_sku['backup_age']] = array_sum($agentqty[$j]);
            }
            if (isset($drm_tool[$j])) {
                $drm_tool_qty = (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0;
                tblRow("Software", 'DRM Tool', $drm_tool_qty, $product_prices['drm_tool']);
                $Infrastructure['Software']['drmtool'] = $drm_tool_qty * $product_prices['drm_tool'];
                $Sku_Data[$estmtname[$j]]['Software'][$product_sku['drm_tool']] = $drm_tool_qty;
            }
        }
        if (isset($iops1[$j]) || isset($iops3[$j]) || isset($iops5[$j]) || isset($iops8[$j]) || isset($iops10[$j]) || !empty($backupstrg[$j]) || isset($tape_lib[$j]) || isset($tape_cart[$j]) || isset($fire_cab[$j])) {
            $c = 'A.' . $no = $no + 1;
            $c .= ' +';
            tblHead("Storage and Backup Services");

            if (isset($iops03[$j])) {
                tblRow("Additional Storage", strg_iops($strgunit03[$j], 300), $iops03qty[$j], get_strg($strgunit03[$j], $product_prices['iops_03']), $strgunit03[$j]);
                $Infrastructure['Storage Solution']['03iops'] = get_strg($strgunit03[$j], $product_prices['iops_03'], $iops03qty[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['iops_03']] = ($strgunit03[$j] == 'TB') ? intval($iops03qty[$j]) * 1024 : intval($iops03qty[$j]);
            }
            if (isset($iops1[$j])) {
                tblRow("Additional Storage", strg_iops($strgunit1[$j], 1000), $iops1qty[$j], get_strg($strgunit1[$j], $product_prices['iops_1']), $strgunit1[$j]);
                $Infrastructure['Storage Solution']['1iops'] = get_strg($strgunit1[$j], $product_prices['iops_1'], $iops1qty[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['iops_1']] = ($strgunit1[$j] == 'TB') ? intval($iops1qty[$j]) * 1024 : intval($iops1qty[$j]);
            }

            if (isset($iops3[$j])) {
                tblRow("Additional Storage", strg_iops($strgunit3[$j], 3000), $iops3qty[$j], get_strg($strgunit3[$j], $product_prices['iops_3']), $strgunit3[$j]);
                $Infrastructure['Storage Solution']['3iops'] = get_strg($strgunit3[$j], $product_prices['iops_3'], $iops3qty[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['iops_3']] = ($strgunit3[$j] == 'TB') ? intval($iops3qty[$j]) * 1024 : intval($iops3qty[$j]);
            }

            if (isset($iops5[$j])) {
                tblRow("Additional Storage", strg_iops($strgunit5[$j], 5000), $iops5qty[$j], get_strg($strgunit5[$j], $product_prices['iops_5']), $strgunit5[$j]);
                $Infrastructure['Storage Solution']['5iops'] = get_strg($strgunit5[$j], $product_prices['iops_5'], $iops5qty[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['iops_5']] = ($strgunit5[$j] == 'TB') ? intval($iops5qty[$j]) * 1024 : intval($iops5qty[$j]);
            }

            if (isset($iops8[$j])) {
                tblRow("Additional Storage", strg_iops($strgunit8[$j], 8000), $iops8qty[$j], get_strg($strgunit8[$j], $product_prices['iops_8']), $strgunit8[$j]);
                $Infrastructure['Storage Solution']['8iops'] = get_strg($strgunit8[$j], $product_prices['iops_8'], $iops8qty[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['iops_8']] = ($strgunit8[$j] == 'TB') ? intval($iops8qty[$j]) * 1024 : intval($iops8qty[$j]);
            }
            if (isset($iops10[$j])) {
                tblRow("Additional Storage", strg_iops($strgunit10[$j], 10000), $iops10qty[$j], get_strg($strgunit10[$j], $product_prices['iops_10']), $strgunit10[$j]);
                $Infrastructure['Storage Solution']['10iops'] = get_strg($strgunit10[$j], $product_prices['iops_10'], $iops10qty[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['iops_10']] = ($strgunit10[$j] == 'TB') ? intval($iops10qty[$j]) * 1024 : intval($iops10qty[$j]);
            }

            if (!empty($backupstrg[$j])) {
                tblRow("Backup Storage", 'Backup Space', $backupstrg[$j], get_strg($backupunit[$j], $product_prices['backup_gb']), $backupunit[$j]);
                $Infrastructure['Storage Solution']['backup_gb'] = get_strg($backupunit[$j], $product_prices['backup_gb'], $backupstrg[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['backup_gb']] = ($backupunit[$j] == 'TB') ? intval($backupstrg[$j]) * 1024 : intval($backupstrg[$j]);
            }
            if (!empty($arc_strg[$j])) {
                tblRow("Archival Storage", 'Archival Space', $arc_strg[$j], get_strg($archival_unit[$j], $product_prices['arc_strg_gb']), $archival_unit[$j]);
                $Infrastructure['Storage Solution']['arc_strg_gb'] = get_strg($archival_unit[$j], $product_prices['arc_strg_gb'], $arc_strg[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['arc_strg_gb']] = ($archival_unit[$j] == 'TB') ? intval($arc_strg[$j]) * 1024 : intval($arc_strg[$j]);
            }
            if (isset($tape_lib[$j])) {
                tblRow('Offline Backup', 'Offline Backup Solution Tape Library', $tlqty[$j], $product_prices['tl']);
                $Infrastructure['Storage Solution']['tape'] = intval($tlqty[$j]) * $product_prices['tl'];
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['tl']] = $tlqty[$j];
            }

            if (isset($tape_cart[$j])) {
                tblRow('Offline Backup', 'Offline Backup Solution Tape Cartridge', $tcqty[$j], $product_prices['tc']);
                $Infrastructure['Storage Solution']['cart'] = intval($tcqty[$j]) * $product_prices['tc'];
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['tc']] = $tcqty[$j];
            }

            if (isset($fire_cab[$j])) {
                tblRow('Offline Backup', 'Offline Backup Solution Fireproof cabinate', $fcqty[$j], $product_prices['fc']);
                $Infrastructure['Storage Solution']['cart'] = intval($fcqty[$j]) * $product_prices['fc'];
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['fc']] = $fcqty[$j];
            }
        }
        if (isset($rack[$j]) || isset($rated[$j]) || isset($metered[$j]) || isset($cage[$j]) || isset($bio[$j]) || isset($pdu[$j]) || isset($cctv[$j])) {
            $c = 'A.' . $no = $no + 1;
            $c .= ' +';
            tblHead("Colocation Services");
            if (isset($rack[$j])) {
                tblRow('Services', 'Rack Space', $rackqty[$j], $product_prices['rack_space'], "U");
                $Infrastructure['Colocation']['rack_space'] = ($rackqty[$j] * $product_prices['rack_space']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['rack_space']] = ($rackqty[$j]);
            }
            if (isset($metered[$j])) {
                tblRow('Services', 'Metered Power', $meteredqty[$j], $product_prices['metered_power'], "Power Unit");
                $Infrastructure['Colocation']['metered_power'] = ($meteredqty[$j] * $product_prices['metered_power']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['metered_power']] = ($meteredqty[$j]);
            }
            if (isset($rated[$j])) {
                tblRow('Services', 'Rated Power', $ratedqty[$j], $product_prices['rated_power'], "Power Unit");
                $Infrastructure['Colocation']['rated_power'] = ($ratedqty[$j] * $product_prices['rated_power']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['rated_power']] = ($ratedqty[$j]);
            }

            if (isset($cage[$j])) {
                tblRow('Services', 'Cage For RACK', $cageqty[$j], $product_prices['cage']);
                $Infrastructure['Colocation']['cage'] = ($cageqty[$j] * $product_prices['cage']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['cage']] = ($cageqty[$j]);
            }
            if (isset($bio[$j])) {
                tblRow('Services', 'Bio-matrix for Cage', $bioqty[$j], $product_prices['bio']);
                $Infrastructure['Colocation']['bio'] = ($bioqty[$j] * $product_prices['bio']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['bio']] = ($bioqty[$j]);
            }
            if (isset($pdu[$j])) {
                tblRow('Services', 'PDU Meter', $pduqty[$j], $product_prices['pdu']);
                $Infrastructure['Colocation']['pdu'] = ($pduqty[$j] * $product_prices['pdu']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['pdu']] = ($pduqty[$j]);
            }

            if (isset($cctv[$j])) {
                tblRow('Services', 'CCTV Camera fo Rack', $cctvqty[$j], $product_prices['cctv']);
                $Infrastructure['Colocation']['cctv'] = ($cctvqty[$j] * $product_prices['cctv']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['cctv']] = ($cctvqty[$j]);
            }
        }
        if ($ip_private[$j] != NULL) {
            $private_data[$j] = array_unique($ip_private[$j]);
        }
        if ($ip_public[$j] != NULL) {
            $public_data[$j] = array_unique($ip_public[$j]);
        }

        if (isset($ip_public[$j]) || isset($ip_private[$j]) || !empty($bandwidth[$j]) || !empty($ccptqty[$j]) || !empty($vpn[$j]) || !empty($lb[$j]) || !empty($rep_link_type[$j])) {
            $d = 'A.' . $no = $no + 1;
            $d .= ' +';
            tblHead("Network and Connectivity Services");
            foreach ($vmqty[$j] as $i => $val) {
                if (isset($public_data[$j][$i])) {
                    tblRow('Services', 'Public IP Address : ' . $publicip_vers[$j][$i], array_sum($publicip_qty[$j]), $product_prices['ip']);
                    $Infrastructure['Network Solution']['ip'] = array_sum($publicip_qty[$j]) * $product_prices['ip'];
                    $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ip']] = array_sum($publicip_qty[$j]);
                }

                if (isset($private_data[$j][$i])) {
                    tblRow('Services', 'Private IP Address : ' . $privateip_vers[$j][$i], array_sum($privateip_qty[$j]), 0);
                    $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['private_ip']] = array_sum($privateip_qty[$j]);
                }
            }
            if (!empty($bandwidth[$j])) {
                $bandInt = ($bandwidthType[$j] == 'Speed Based Internet Bandwidth') ? 'speed_band' : 'volume_band';
                $bandUnit = ($bandwidthType[$j] == 'Speed Based Internet Bandwidth') ? ' Mbps' : ' GB';
                tblRow('Services', $bandwidthType[$j], $bandwidth[$j], $product_prices[$bandInt], $bandUnit);
                $Infrastructure['Network Solution']['bandwidth'] = intval($product_prices[$bandInt]) * intval($bandwidth[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku[$bandInt]] = $bandwidth[$j];
            }
            if (!empty($ccptqty[$j])) {
                tblRow('Services', "Cross Connect and Port Termination", $ccptqty[$j], $product_prices['ccpt']);
                $Infrastructure['Network Solution']['ccpt'] = intval($product_prices['ccpt']) * intval($ccptqty[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ccpt']] = $ccptqty[$j];
            }

            if (isset($rep_link[$j])) {
                tblRow('Services', $rep_link_type[$j] . ' Replication Link', $rep_link_qty[$j], get_Price($rep_link_type[$j]), "Mbps");
                $Infrastructure['Network Solution']['rep_link'] = intval($rep_link_qty[$j]) * get_Price($rep_link_type[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution']['CNPP000000000000'] = $rep_link_qty[$j];
            }

            if (!empty($ipsec[$j])) {
                tblRow('Services', 'Virtual Private Network (VPN) : IPSEC', $ipsecqty[$j], $product_prices['ipsec']);
                $Infrastructure['Network Solution']['ipsec'] = intval($ipsecqty[$j]) * $product_prices['ipsec'];
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ipsec']] = $ipsecqty[$j];
            }

            if (!empty($sslvpn[$j])) {
                tblRow('Services', 'Virtual Private Network (VPN) : SSL', $sslvpnqty[$j], $product_prices['ssl_vpn']);
                $Infrastructure['Network Solution']['sslvpn'] = intval($sslvpnqty[$j]) * $product_prices['ssl_vpn'];
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ssl_vpn']] = $sslvpnqty[$j];
            }

            if (!empty($lb[$j])) {
                tblRow('Services', 'Load Balancer', $lbqty[$j], get_Price($lb[$j]));
                $Infrastructure['Network Solution']['lb'] = get_Price($lb[$j]) * intval($lbqty[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution']['INLBPLCI00000000'] = $lbqty[$j];
            }
        }
        if (
            !empty($av) ||
            isset($ext_firewall[$j]) ||
            isset($int_fv[$j]) ||
            isset($ddos[$j]) ||
            isset($waf[$j]) ||
            isset($tfa[$j]) ||
            isset($sslcert[$j]) ||
            isset($siem[$j]) ||
            isset($pim[$j]) ||
            isset($vtm[$j]) ||
            isset($vapt[$j]) ||
            isset($hsm[$j]) ||
            isset($iam[$j]) ||
            isset($dlp[$j]) ||
            isset($edr[$j]) ||
            isset($dam[$j]) ||
            isset($sor[$j])
        ) {
            if (!empty($vmqty[$j])) {
                $av_count = array();
                foreach ($vmqty[$j] as $i => $val) {
                    if (!empty($av_type[$j][$i])) {
                        // $av_type[ $j ][ $key ] = $val;
                        $newAV = $av_type[$j][$i];
                        // echo $vmqty[ $j ][ $i ];
                        array_push($av_count, $vmqty[$j][$i]);
                    } else {
                        unset($av_type[$j][$i]);
                    }
                }
            }
            $e = 'A.' . $no = $no + 1;
            tblHead('Security Solution');

            if (!empty($newAV)) {
                $avPrice = (preg_match('/HIPS/', $newAV)) ? 1200 : 300;
                tblRow('Services', $newAV, array_sum($av_count), $avPrice);
                $Infrastructure['Security Solution']['av'] = (preg_match('/HIPS/', $newAV)) ? (array_sum($av_count) * 1200) : (array_sum($av_count) * 300);
                $Sku_Data[$estmtname[$j]]['Security Solution']['ESAVAHMA00000000'] = array_sum($av_count);
            }
            if (isset($ext_firewall[$j])) {
                $throughput = preg_split('/:/', $efv_throughput[$j]);
                $efvName = ((isset($utm[$j])) ? ('vUTM ') : ('')) . "External Firewall - {$throughput[1]} Throughput";

                tblRow('Services', $efvName, $extfvqty[$j], get_Price($efv_throughput[$j]));

                $Infrastructure['Security Solution']['efw'] = intval($extfvqty[$j]) * get_Price($efv_throughput[$j]);
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($efv_throughput[$j], 'sku_code')] = $extfvqty[$j];
            }
            if (isset($int_fv[$j])) {
                $throughput = preg_split('/:/', $ifv_throughput[$j]);
                $ifvName = "Internal Firewall - {$throughput[1]} Throughput";

                tblRow('Services', $ifvName, $intfvqty[$j], get_Price($ifv_throughput[$j]));
                $Infrastructure['Security Solution']['ifw'] = intval($intfvqty[$j]) * get_Price($ifv_throughput[$j]);
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($ifv_throughput[$j], 'sku_code')] = $intfvqty[$j];
            }
            if (isset($ddos[$j])) {
                $ddosName = "DDoS Mitigation up to 1 Gbps Mitigation";
                tblRow('Services', $ddosName, 1, get_Price($ddos_throughput[$j]));

                $Infrastructure['Security Solution']['ddos'] = intval(1) * get_Price($ddos_throughput[$j]);
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($ddos_throughput[$j], 'sku_code')] = 1;
            }
            if (isset($waf[$j])) {
                tblRow('Services', $waf_name[$j], $wafqty[$j], get_Price($waf_name[$j]));
                $Infrastructure['Security Solution']['waf'] = intval($wafqty[$j]) * get_Price($waf_name[$j]);
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($waf_name[$j], 'sku_code')] = $wafqty[$j];
            }
            if (isset($tfa[$j])) {
                tblRow('Services', "Two Factor Authentication", $tfaqty[$j], $product_prices['tfa']);
                $Infrastructure['Security Solution']['tfa'] = intval($tfaqty[$j]) * $product_prices['tfa'];
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku['tfa']] = $tfaqty[$j][1];
            }
            if (isset($sslcert[$j])) {
                tblRow('Services', 'SSL Certificate : ' . $ssl[$j], $sslqty[$j], get_Price($ssl[$j]));
                $Infrastructure['Security Solution']['ssl'] = get_Price($ssl[$j]) * intval($sslqty[$j]);
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($ssl[$j], 'sku_code')] = $sslqty[$j];
            }
            if (isset($siem[$j])) {
                $siemqty =
                    array(
                        (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0,
                        intval($intfvqty[$j]) + intval($extfvqty[$j]),
                        intval($wafqty[$j]),
                        intval($lbqty[$j]),
                        ($hsm[$j] && $hsmtype[$j] == 'Dedicated HSM') ? intval($hsmqty[$j]) : (0)
                    );
                $info = "<i class='fa fa-info-circle  float-right' title='
VM Quantity -  $siemqty[0]  
Internal & External Firewall -  $siemqty[1]  
Web App Firewall -  $siemqty[2]  
Load Balancer -  $siemqty[3]  
HSM -  $siemqty[4]'  ></i>";
                tblRow("Services", "SIEM " . $info, array_sum($siemqty), get_Price($siem_name[$j]));
                $Infrastructure['Security Solution']['siem'] = array_sum($siemqty) * get_Price($siem_name[$j]);
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($siem_name[$j], 'sku_code')] = array_sum($siemqty);
            }
            if (isset($pim[$j])) {
                tblRow("Services", "PIM ", $pimqty[$j], $product_prices['pim']);
                $Infrastructure['Security Solution']['pim'] = intval($pimqty[$j]) * $product_prices['pim'];
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku['pim']] = $pimqty[$j];
            }
            if (isset($vtm[$j])) {
                tblRow("Services", "VTM Scan ( {$vtmqty[$j]} )", 1, get_Price($vtmqty[$j]));
                $Infrastructure['Security Solution']['vtm'] = get_Price($vtmqty[$j]);
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($vtmqty[$j], 'sku_code')] = 1;
            }
            if (isset($vapt[$j])) {
                $Devices =
                    array(
                        (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0,
                        intval($intfvqty[$j]) + intval($extfvqty[$j]),
                        intval($wafqty[$j]),
                        intval($lbqty[$j]),
                        (isset($hsm[$j]) && $hsmtype[$j] == 'Dedicated HSM') ? intval($hsmqty[$j]) : 0
                    );

                $info = "<i class='fa fa-info-circle  float-right' title='
VM Quantity -  $Devices[0]  
Internal & External Firewall -  $Devices[1]  
Web App Firewall -  $Devices[2]  
Load Balancer -  $Devices[3]  
HSM -  $Devices[4]'  ></i>";

                $vaptName = $vapt_type[$j] . ' ' . $vapt_frequency[$j] . ' ' . $vaptqty[$j];
                tblRow("Services", $vaptName . $info, array_sum($Devices), get_Price($vapt_type[$j]));
                $Infrastructure['Security Solution']['vapt'] = array_sum($Devices) * get_Price($vapt_type[$j]);
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($vapt_type[$j], 'sku_code')] = array_sum($Devices);
            }
            if (isset($hsm[$j])) {
                tblRow("Services", $hsmtype, $hsmqty[$j], get_Price($hsmtype[$j]));

                $Infrastructure['Security Solution']['hsm'] = intval($hsmqty[$j]) * $product_prices['hsm'];
                $Sku_Data[$estmtname[$j]]['Security Solution'][get_Price($hsmtype[$j], 'sku_code')] = $hsmqty[$j];
            }
            if (isset($iam[$j])) {
                tblRow("Services", "IAM", $iamqty[$j], $product_prices['iam']);
                $Infrastructure['Security Solution']['iam'] = intval($iamqty[$j]) * $product_prices['iam'];
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku['iam']] = $iamqty[$j];
            }
            if (isset($dlp[$j])) {
                tblRow("Services", "DLP", $dlpqty[$j], $product_prices['dlp']);
                $Infrastructure['Security Solution']['dlp'] = intval($dlpqty[$j]) * $product_prices['dlp'];
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku['dlp']] = $dlpqty[$j];
            }
            if (isset($edr[$j])) {
                tblRow("Services", "EDR", $edrqty[$j], $product_prices['edr']);
                $Infrastructure['Security Solution']['edr'] = intval($edrqty[$j]) * $product_prices['edr'];
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku['edr']] = $edrqty[$j];
            }
            if (isset($dam[$j])) {
                tblRow("Services", "DAM", $damqty[$j], $product_prices['dam']);
                $Infrastructure['Security Solution']['dam'] = intval($damqty[$j]) * $product_prices['dam'];
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku['dam']] = $damqty[$j];
            }
            if (isset($sor[$j])) {
                tblRow("Services", "SOR", $sorqty[$j], $product_prices['sor']);
                $Infrastructure['Security Solution']['sor'] = intval($sorqty[$j]) * $product_prices['sor'];
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku['sor']] = $sorqty[$j];
            }
        }
        $f = 'A.' . $no = $no + 1;
        tblHead("Managed Services");

        if (isset($rep_link_mgmt[$j])) {
            $replication_mgmt = (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0;
        } else {
            $replication_mgmt = 0;
        }
        if (isset($osmgmt[$j]) && !empty($os[$j])) {
            foreach ($os as $i => $val) {
                if (preg_match('/Windows/', $os[$j][$i])) {
                    $os_mgmt_name[] = 'Windows';
                    $os_mgmt_qty['Windows'][] = $vmqty[$j][$i];
                    $mgmtINT['Windows'] = 'win_os_mg';
                    // echo $vmqty[ $j ][ $i ];
                }
                if (preg_match('/RHEL/', $os[$j][$i])) {
                    $os_mgmt_name[] = 'RHEL';
                    $os_mgmt_qty['RHEL'][] = $vmqty[$j][$i];
                    $mgmtINT['RHEL'] = 'rhel_os_mg';
                }
                if (preg_match('/SUSE/', $os[$j][$i])) {
                    $os_mgmt_name[] = 'SUSE';
                    $os_mgmt_qty['SUSE'][] = $vmqty[$j][$i];
                    $mgmtINT['SUSE'] = 'suse_os_mg';
                }
                if (preg_match('/UBUNTU/', $os[$j][$i])) {
                    $os_mgmt_name[] = 'UBUNTU';
                    $os_mgmt_qty['UBUNTU'][] = $vmqty[$j][$i];
                    $mgmtINT['UBUNTU'] = 'ubuntu_os_mg';
                }
                if (preg_match('/CENTOS/', $os[$j][$i])) {
                    $os_mgmt_name[] = 'CENTOS';
                    $os_mgmt_qty['CENTOS'][] = $vmqty[$j][$i];
                    $mgmtINT['CENTOS'] = 'centos_os_mg';
                }
            }
            $os_mgmt_data = (!empty($os_mgmt_name)) ? array_values(array_unique($os_mgmt_name)) : null;
        }

        if (isset($dbmgmt[$j]) && !empty($db[$j])) {
            foreach ($db[$j] as $i => $val) {
                if (preg_match('/MS SQL/', $db[$j][$i])) {
                    $db_mgmt_name[] = 'MS SQL';
                    $db_mgmt_qty['MS SQL'][] = floor(($vmqty[$j][$i] * $vDisk[$j][$i]) / 100);
                    $mgmtINT['MS SQL'] = 'ms_db_mg';
                }
                if (preg_match('/MY SQL/', $db[$j][$i])) {
                    $db_mgmt_name[] = 'MY SQL';
                    $db_mgmt_qty['MY SQL'][] = floor(($vmqty[$j][$i] * $vDisk[$j][$i]) / 100);
                    $mgmtINT['MY SQL'] = 'my_db_mg';
                }
                if (preg_match('/Postgre/', $db[$j][$i])) {
                    $db_mgmt_name[] = 'Postgre';
                    $db_mgmt_qty['Postgre'][] = floor(($vmqty[$j][$i] * $vDisk[$j][$i]) / 100);
                    $mgmtINT['Postgre'] = 'pg_db_mg';
                }
                if (preg_match('/Oracle/', $db[$j][$i])) {
                    $db_mgmt_name['Oracle'] = 'Oracle';
                    $db_mgmt_qty['Oracle'][] = floor(($vmqty[$j][$i] * $vDisk[$j][$i]) / 100);
                    $mgmtINT['Oracle'] = 'orc_db_mg';
                }
                if (preg_match('/Mongo/', $db[$j][$i])) {
                    $db_mgmt_name['Mongo'] = 'Mongo';
                    $db_mgmt_qty['Mongo'][] = floor(($vmqty[$j][$i] * $vDisk[$j][$i]) / 100);
                    $mgmtINT['Mongo'] = 'mong_db_mg';
                }
                if (preg_match('/Maria/', $db[$j][$i])) {
                    $db_mgmt_name['Maria'] = 'Maria';
                    $db_mgmt_qty['Maria'][] = floor(($vmqty[$j][$i] * $vDisk[$j][$i]) / 100);
                    $mgmtINT['Maria'] = 'mar_db_mg';
                }
            }
            $db_mgmt_data = (!empty($db_mgmt_name)) ? array_values(array_unique($db_mgmt_name)) : null;
        }
        if (isset($strgmgmt[$j])) {
            $strgmgmtqty = array(
                ($strgunit03[$j] == 'TB') ? intval($iops03qty[$j]) * 1024 : intval($iops03qty[$j]),
                ($strgunit1[$j] == 'TB') ? intval($iops1qty[$j]) * 1024 : intval($iops1qty[$j]),
                ($strgunit3[$j] == 'TB') ? intval($iops3qty[$j]) * 1024 : intval($iops3qty[$j]),
                ($strgunit5[$j] == 'TB') ? intval($iops5qty[$j]) * 1024 : intval($iops5qty[$j]),
                ($strgunit8[$j] == 'TB') ? intval($iops8qty[$j]) * 1024 : intval($iops8qty[$j]),
                ($strgunit10[$j] == 'TB') ? intval($iops10qty[$j]) * 1024 : intval($iops10qty[$j])
            );
        } else {
            $strgmgmtqty = array();
        }

        if (isset($backup_mgmt[$j]) && !empty($backupstrg[$j])) {
            $backmgmtqty = (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0;
        } else
            $backmgmtqty = 0;

        if (isset($lbmgmt[$j]) && !empty($lbqty[$j])) {
            $lbmgmtqty = $lbqty[$j];
        } else
            $lbmgmtqty = 0;

        if (isset($fvmgmt[$j])) {
            if (!empty($intfvqty[$j])) {
                $fvmgmtqty = intval($intfvqty[$j]) + intval($extfvqty[$j]);
            } else {
                $fvmgmtqty = intval($extfvqty[$j]);
            }
        } else
            $fvmgmtqty = 0;

        if (isset($wafmgmt[$j]) && !empty($wafqty[$j])) {
            $wafmgmtqty = $wafqty[$j];
        } else
            $wafmgmtqty = 0;

        if (!empty($bandwidth[$j])) {
            $bandwidth_monitoring = 1;
        } else
            $bandwidth_monitoring = 0;

        if (isset($_POST['emagic'][$j])) {
            $emagicqty = array(intval($lbmgmtqty), intval($fvmgmtqty), intval($wafmgmtqty), (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0, intval($ccptqty[$j]), $bandwidth_monitoring);
        }
        $managed_services = array(
            'st_mg' => floor(array_sum($strgmgmtqty) / 1024) * $product_prices['st_mg'],
            'back_mg' => intval($backmgmtqty) * intval($product_prices['back_mg']),
            'rep_mgmt' => $replication_mgmt * $product_prices['rep_mgmt'],
            'dr_drill' => intval($drill_qty[$j]) * $product_prices['dr_drill'],
            'lb_mgmt' => intval($lbmgmtqty) * intval($product_prices['lb_mg']),
            'fw_mgmt' => (isset($utm[$j])) ? $product_prices['utm_fv_mg'] * intval($fvmgmtqty) : $product_prices['fv_mg'] * intval($fvmgmtqty),
            'waf_mgmt' => intval($wafmgmtqty) * intval($product_prices['waf_mg']),
            'emagic' => (isset($_POST['emagic'][$j])) ? array_sum($emagicqty) * intval($product_prices['emagic']) : 0
        );
        if (isset($osmgmt[$j]) && !empty($os_mgmt_name)) {
            for (
                $i = 0;
                $i < count($os_mgmt_data);
                $i++
            ) {
                $managed_services[$mgmtINT[$os_mgmt_data[$i]]] = array_sum($os_mgmt_qty[$os_mgmt_data[$i]]) * intval($product_prices[$mgmtINT[$os_mgmt_data[$i]]]);
            }
        }
        if (isset($dbmgmt[$j]) && !empty($db_mgmt_name)) {
            for (
                $i = 0;
                $i < count($db_mgmt_data);
                $i++
            ) {
                $managed_services[$mgmtINT[$db_mgmt_data[$i]]] = array_sum($db_mgmt_qty[$db_mgmt_data[$i]]) * intval($product_prices[$mgmtINT[$db_mgmt_data[$i]]]);
            }
        }

        $newInfra = array();
        foreach ($Infrastructure as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $p) {
                    array_push($newInfra, $p);
                }
            } else {
                array_push($newInfra, $val);
            }
        }

        $total[$j] = array(array_sum($newInfra), array_sum($managed_services));

        $period = $_POST['period'];
        if (empty($period[$j])) {
            $period[$j] = 1;
        }

        $push_total[$j]['infra'] = $newInfra;
        $push_total[$j]['service'] = $managed_services;

        tblRow('Services', 'One Time Infrastructure Setup', '', '', "", (array_sum($total[$j]) * 12) * 0.05);


        if (isset($osmgmt[$j]) && !empty($os_mgmt_name)) {
            for ($i = 0; $i < count($os_mgmt_data); $i++) {
                tblRow("Services", $os_mgmt_data[$i] . ' OS Managed Services', array_sum($os_mgmt_qty[$os_mgmt_data[$i]]), $product_prices[$mgmtINT[$os_mgmt_data[$i]]]);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku[$mgmtINT[$os_mgmt_data[$i]]]] = array_sum($os_mgmt_qty[$os_mgmt_data[$i]]);
            }
        }
        if (isset($dbmgmt[$j]) && !empty($db_mgmt_data)) {
            for ($i = 0; $i < count($db_mgmt_data); $i++) {
                $name = $db_mgmt_data[$i] . ' Database Managed Services (Up to 100 GB)';
                tblRow("Service", $name, array_sum($db_mgmt_qty[$db_mgmt_data[$i]]), $product_prices[$mgmtINT[$db_mgmt_data[$i]]]);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku[$mgmtINT[$db_mgmt_data[$i]]]] = array_sum($db_mgmt_qty[$db_mgmt_data[$i]]);
                $managed_services[$mgmtINT[$db_mgmt_data[$i]]] = array_sum($db_mgmt_qty[$db_mgmt_data[$i]]) * intval($product_prices[$mgmtINT[$db_mgmt_data[$i]]]);
            }
        }
        if (isset($strgmgmt[$j])) {
            tblRow("Service", "Storage Management Per TB'", floor(array_sum($strgmgmtqty) / 1024), $product_prices['st_mg']);
            $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['st_mg']] = floor(array_sum($strgmgmtqty) / 1024);
        }
        if (isset($backup_mgmt[$j])) {
            tblRow("Service", 'Backup Management - per Instance', $backmgmtqty, $product_prices['back_mg']);
            $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['back_mg']] = $backmgmtqty;
        }
        if (isset($rep_link_mgmt[$j])) {
            tblRow("Service", 'Replication Service Management', $replication_mgmt, $product_prices['rep_mgmt']);
            $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['rep_mgmt']] = $replication_mgmt;
        }

        if (isset($dr_drill[$j])) {
            tblRow("Service", 'DR Drill Per Year', $drill_qty, $product_prices['dr_drill']);
            $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['dr_drill']] = $drill_qty[$j];
        }

        if (isset($lbmgmt[$j])) {
            tblRow("Service", 'Load Balancer Management', $lbmgmtqty, $product_prices['lb_mg']);
            $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['lb_mg']] = $lbmgmtqty;
        }
        if (isset($fvmgmt[$j])) {
            $name = ((isset($utm[$j])) ? 'vUTM ' : '') . "FireWall Management";
            $price = (isset($utm[$j])) ? ($product_prices['utm_fv_mg']) : ($product_prices['fv_mg']);
            tblRow("Service", $name, $fvmgmtqty, $price);
            $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['fv_mg']] = $fvmgmtqty;
        }
        if (isset($wafmgmt[$j])) {
            tblRow("Service", "Web Application Firewall Management", $wafmgmtqty, $product_prices['waf_mg']);
            $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['waf_mg']] = $wafmgmtqty;
        }

        if (isset($_POST['emagic'][$j])) {
            $info = "<i class='fa fa-info-circle  float-right' title='
Load Balancer - $emagicqty[0]
Internal & External Firewall - $emagicqty[1]
Web App Firewall - $emagicqty[2]
VM Quantity - $emagicqty[3]
Cross Connect & Port Termination - $emagicqty[4] 
Bandwidth Monitoring - $emagicqty[5] '></i>";
$name = 'eMagic Monitoring ' . $emagic_type[$j];
            tblRow("Services", $name , array_sum($emagicqty), $product_prices['emagic']);
            $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['emagic']] = array_sum($emagicqty);
        }
        ?>
        <tr>
            <th class='except unshareable' style='background: rgba(212,212,212,1); '> Sr No . </th>
            <th class=' final colspan except unshareable' colspan='4' style='background: rgba(212,212,212,1); '> Description </th>
            <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>MRC</th>
        </tr>
        <?php
        $m = 0;
        if (!empty($Infrastructure)) {
        ?>
            <tr>
                <td class='unshareable'>
                    <?= $m + 1 ?>
                </td>
                <td class='colspan  final unshareable' colspan='4'> Infrastructure [ <?= $a . ' ' ?>
                    <?= $b . ' ' ?>
                    <?= $c . ' ' ?>
                    <?= $d . ' ' ?>
                    <?= $e . ' ' ?> ]</td>
                <td class='colspan unshareable ' colspan='2'><?php INR(array_sum($newInfra));
                                                                ?></td>
            </tr>
        <?php }
        ?>
        <tr>
            <td class='unshareable'>
                <?= $m = $m + 1 ?>
            </td>
            <td class='colspan final unshareable' colspan='4'> Managed Services [ <?= $f ?> ] </td>
            <td class='colspan unshareable' colspan='2'><?php INR(array_sum($managed_services));
                                                        ?></td>
        </tr>

        <tr>
            <td class='unshareable'>
                <?= $m = $m + 1 ?>
            </td>
            <td class='colspan final unshareable' colspan='4'> One Time Cost </td>
            <td class='colspan unshareable' colspan='2'>
                <?= INR((array_sum($total[$j]) * 12) * 0.05); ?>
            </td>
        </tr>
        <tr>
            <th class=' final unshareable' style='background-color: rgb(255, 207, 203);'> </th>
            <th class=' final colspan except unshareable' colspan='4' style='background-color: rgb(255, 207, 203);'> Total [ Monthly ]</th>
            <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='total_monthly'><?php INR(array_sum($total[$j]));
                                                                                                                                    array_push($MothlyTotal, array_sum($total[$j]));
                                                                                                                                    ?></th>
        </tr>
        <tr>
            <th class=' final unshareable' style='background-color: rgb(255, 226, 182);'> </th>
            <th class=' final colspan except unshareable' colspan='4' style='background-color: rgb(255, 226, 182);'> Total [ For <?= $period[$j] ?> Months ]</th>
            <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);'><?php INR(array_sum($total[$j]) * intval($period[$j]));
                                                                                                                array_push($ProjectTotal, array_sum($total[$j]) * intval($period[$j]));
                                                                                                                ?></th>
        </tr>
    </table>
<?php
    $I_M[$j] = $Infrastructure;
    $I_M[$j]['Managed Services'] = $managed_services;
}


function tblRow($Service, $Product, $Quantity, $Price, $Unit = "NO", $OTC = '')
{
    global $j;
    // echo gettype($OTC);
?>
    <tr>
        <td><?php echo $Service; ?></td>
        <td class='final'><?php echo $Product; ?></td>
        <td class='qty'><?php echo $Quantity . " " . $Unit; ?></td>
        <td class='cost unshareable'><?php INR(intval($Price)); ?></td>
        <td class='discount unshareable' id='disc'></td>
        <td class="mrc_<?= $j ?> unshareable"><?php INR(intval($Quantity) * intval($Price)); ?></td>
        <td class='unshareable' id='otc'><?php (!empty($OTC))? INR($OTC) : '' ?></td>
    </tr>
<?php
}

function tblHead($Service)
{
    global $no;
?>
    <tr>
        <th class='Head except' id='sr'><?php echo 'A.' . $no; ?></th>
        <th class='Head except' id='comp'><?= $Service ?></th>
        <th class='Head except' id='unit'>Unit</th>
        <th class='Head unshareable except' id='cost'>Cost/Unit</th>
        <th class='Head unshareable except' id='disc-head'>Discount %</th>
        <th class='Head unshareable except' id='mrc'>Monthly Cost</th>
        <th class='Head unshareable except' id='otc'>OTC</th>
    </tr>
<?php
}


?>