<?php
// error_reporting(E_ERROR | E_PARSE);    
// echo 'hi';

// if (isset($_POST['proceed'])) {

    // $form1 = $_POST['form1'];
    $estmtname = $_POST['estmtname'];
    $i = 1;
    $t=false;
    foreach ($estmtname as $K => $V){
        foreach ($estmtname as $k => $v){
            if($V == $v && $K != $k){
                $estmtname[$k] = $v." - ".$i;
                $t = true;
            }
        }    
        if($t){
            $i++;
        }
    }
    $instance = $_POST['instance'];

    $cpu = $_POST['vcpu'];
    $ram = $_POST['ram'];
    $disk = $_POST['inst_disk'];

    $vmname = $_POST['vmname'];
    $back_soft = $_POST['backup_soft'];

    $vmqty = $_POST['vmqty'];
    $region =  $_POST['region'];
    $sector = $_POST['sector'];
    $os = $_POST['os'];
    $db = $_POST['database'];
    $series = $_POST['series'];
    $ip_public = $_POST['ip_public'];
    $publicip_vers = $_POST["publicipversion"];
    $ip_private = $_POST['ipprivate'];
    $privateip_vers = $_POST["privateipversion"];
    $state = $_POST["state"];
    $av_type = $_POST["virus_type"];
    
    $iops03 = $_POST['03iops'];
    $iops1 = $_POST['1iops'];
    $iops3 = $_POST['3iops'];
    $iops5 = $_POST['5iops'];
    $iops8 = $_POST['8iops'];
    $iops10 = $_POST['10iops'];

    $strgunit03 = $_POST['03strgunit'];
    $strgunit1 = $_POST['1strgunit'];
    $strgunit3 = $_POST['3strgunit'];
    $strgunit5 = $_POST['5strgunit'];
    $strgunit8 = $_POST['8strgunit'];
    $strgunit10 = $_POST['10strgunit'];

    $agenttype = $_POST['age_qty_type'];
    $backupstrg = $_POST['backup_strg'];
    $backupunit = $_POST['backup_unit'];
    $tape_lib = $_POST['tape_lib'];

    $tape_cart = $_POST['tape_cart'];

    $fire_cab = $_POST['fire_cab'];

    $bandwidth = $_POST['bandwidth'];
    $bandwidthType = $_POST['bandwidthType'];

    // $vpn = $_POST['vpn'];
    $ipsec = $_POST['ipsec'];
    $ipsecqty = $_POST['ipsecqty'];
    $sslvpn = $_POST['sslvpn'];
    $sslvpnqty = $_POST['sslvpnqty'];

    $lb = $_POST['load_balancer'];

    $ccptqty = $_POST['ccptqty'];
    
    $utm = $_POST['utm'];
    
    $ext_firewall = $_POST['extfirewall'];
    $efv_throughput = $_POST['efv_throughput'];

    $int_fv = $_POST['intfirewall'];
    $ifv_throughput = $_POST['ifv_throughput'];

    $ddos = $_POST['ddos'];
    $ddos_throughput = $_POST['ddos_throughput'];

    $waf = $_POST['waf'];
    $waf_name = $_POST['waf_type'];

    $tfa = $_POST['tfa'];
    $arc_strg = $_POST["arc_strg"];
    $archival_unit = $_POST["archival_unit"];

    $ssl = $_POST['ssl'];
    $sslcert = $_POST['ssl-check'];

    $hsmtype = $_POST['hsm_type'];

    $siem = $_POST['siem'];
    $siem_name = $_POST['siem_name'];

    $pim = $_POST['pim'];

    $vtm = $_POST['vtm'];

    $vapt = $_POST['vapt'];
    $vapt_type = $_POST['vapt_type'];
    $vapt_frequency = $_POST['vapt_frequency'];

    $dlp = $_POST['dlp'];
    $dlpqty = $_POST['dlpqty'];

    $edr = $_POST['edr'];
    $edrqty = $_POST['edrqty'];

    $dam = $_POST['dam'];
    $damqty = $_POST['damqty'];

    $sor = $_POST['sor'];
    $sorqty = $_POST['sorqty'];

    $hsm = $_POST['hsm'];

    $iam = $_POST['iam'];


    $osmgmt = $_POST['osmgmt'];
    $backup_mgmt = $_POST['backmgmt'];
    $dbmgmt = $_POST['dbmgmt'];
    $strgmgmt = $_POST['strgmgmt'];
    $lbmgmt = $_POST['lb_mgmt'];
    $fvmgmt = $_POST['fv_mgmt'];
    $wafmgmt = $_POST['wafmgmt'];


    $drm_tool = $_POST['drm_tool'];
    $dr_drill = $_POST['dr_drill'];
    $drill_qty = $_POST['drillqty'];
    $rep_link = $_POST['rep_link'];
    $rep_link_type = $_POST['rep_link_type'];
    $rep_link_qty = $_POST['rep_link_qty'];
    $rep_link_mgmt = $_POST['rep_link_mgmt'];


    $publicip_qty = $_POST["public_ipqty"];
    $privateip_qty = $_POST["private_ipqty"];
    $iops03qty = $_POST['03iopsqty'];
    $iops1qty = $_POST['1iopsqty'];
    $iops3qty = $_POST['3iopsqty'];
    $iops5qty = $_POST['5iopsqty'];
    $iops8qty = $_POST['8iopsqty'];

    $iops10qty = $_POST['10iopsqty'];

    $tlqty = $_POST['tlqty'];

    $tcqty = $_POST['tcqty'];
    $fcqty = $_POST['fcqty'];

    $vpnqty = $_POST['vpnqty'];

    $lbqty = $_POST['lbqty'];
    $extfvqty = $_POST['extfvqty'];
    $intfvqty = $_POST['intfvqty'];
    $ddosqty = $_POST['ddosqty'];
    $wafqty = $_POST['wafqty'];
    $tfaqty = $_POST['tfaqty'];
    $sslqty = $_POST['sslqty'];
    $pimqty = $_POST['pimqty'];
    $vtmqty = $_POST['vtmqty'];
    $vaptqty = $_POST['vaptqty'];
    $hsmqty = $_POST['hsmqty'];
    $iamqty = $_POST['iamqty'];
    $period = $_POST['period'];

    $emagic_type = $_POST['emagic_type'];

    $rack = $_POST['rack'];    $rackqty = $_POST['rackqty'];
    $rated = $_POST['rated'];    $ratedqty = $_POST['ratedqty'];
    $metered = $_POST['metered'];    $meteredqty = $_POST['meteredqty'];
    $cage = $_POST['cage'];    $cageqty = $_POST['cageqty'];
    $bio = $_POST['bio'];    $bioqty = $_POST['bioqty'];
    $pdu = $_POST['pdu'];    $pduqty = $_POST['pduqty'];
    $cctv = $_POST['cctv'];    $cctvqty = $_POST['cctvqty'];

// }
