<div class="contain-btn btn-link border-bottom">
    <button class="btn btn-link col-md-11 text-left" data-toggle="collapse" type="button" role="button" aria-expanded="true" aria-controls="security_collapse_<?= $id ?>">
        <i class="fa fa-shield-alt mr-2"></i>Security Services :
    </button>
</div>
<div class="collapse py-1 ml-3 show" id="security_collapse_<?= $id ?>">
    <div class="row">
        <div class="form-group col-md-4 row my-3">
            <select name="efv_throughput[<?= $name ?>]" id="efv_throughput_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option class="editable" value="<?= $Editable['efv_throughput'][$name] ?>" hidden><?= $Editable['efv_throughput'][$name] ?></option>
                <option value="" hidden>Select External Firewall</option>
                <?php create_opt('efw') ?>
            </select>
            <input type="checkbox" name="extfirewall[<?= $name ?>]" id="extFirewall_<?= $id ?>" class="check sec-check <?= ($Editable['extfirewall'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['extfvqty'][$name] ?>" id="extfv_<?= $id ?>" name="extfvqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select name="ifv_throughput[<?= $name ?>]" id="ifv_thorughput_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option class="editable" value="<?= $Editable['ifv_throughput'][$name] ?>" hidden><?= $Editable['ifv_throughput'][$name] ?></option>
                <option value="">Select Internal Firewall</option>
                <?php create_opt('ifw') ?>
            </select>
            <input type="checkbox" name="intfirewall[<?= $name ?>]" id="intfirewall_<?= $id ?>" class="<?= ($Editable['intfirewall'][$name] == "on") ? "Checked" : "" ?> check sec-check">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['intfvqty'][$name] ?>" id="intfv_<?= $id ?>" name="intfvqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="select-utm_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">UTM</option>
            </select>
            <input type="checkbox" <?= ($Editable['utm'][$name] == "on") ? "Checked" : "" ?> name="utm[<?= $name ?>]" id="utm_<?= $id ?>" class="check sec-check">
            <!--<input type="number" placeholder="Quantity" value="<?= $Editable['utmqty'][$name] ?>" id="utmqty_<?= $id ?>" name="utmqty[<?= $name ?>]" class="hide form-control sec-qty">-->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select name="ddos_throughput[<?= $name ?>]" id="ddos_throughput_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option class="editable" value="<?= $Editable['ddos_throughput'][$name] ?>" hidden><?= $Editable['ddos_throughput'][$name] ?></option>
                <option value="">Select DDOS Mitigation</option>
                <?php create_opt('ddos') ?>
            </select>
            <input type="checkbox" name="ddos[<?= $name ?>]" id="ddos_<?= $id ?>" class="<?= ($Editable['ddos'][$name] == "on") ? "Checked" : "" ?> check sec-check">
            <!-- <input type="number" min = 0  placeholder="Quantity" value="<?= $Editable['ddosqty'][$name] ?>" id="ddosqty_<?= $id ?>" name="ddosqty[<?= $name ?>]" class="hide form-control sec-qty"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select name="waf_type[<?= $name ?>]" id="waf_type_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option class="editable" value="<?= $Editable['waf_type'][$name] ?>" hidden><?= $Editable['waf_type'][$name] ?></option>
                <option value="">Select Web App Firewall</option>
                <?php create_opt('waf') ?>
            </select>
            <input type="checkbox" name="waf[<?= $name ?>]" id="waf_<?= $id ?>" class="<?= ($Editable['waf'][$name] == "on") ? "Checked" : "" ?> check sec-check">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['wafqty'][$name] ?>" id="waf_<?= $id ?>" name="wafqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select name="ssl[<?= $name ?>]" id="ssl_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option class="editable" value="<?= $Editable['ssl'][$name] ?>" hidden><?= $Editable['ssl'][$name] ?></option>
                <option value="">Select SSL Certificate</option>
                <?php create_opt('ssl_cert') ?>
            </select>
            <input type="checkbox" name="ssl-check[<?= $name ?>]" id="ssl-check_<?= $id ?>" class="check sec-check <?= ($Editable['ssl-check'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['sslqty'][$name] ?>" id="sslqty_<?= $id ?>" name="sslqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select name="siem_name[<?= $name ?>]" id="siem_name_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option class="editable" value="<?= $Editable['siem_name'][$name] ?>" hidden><?= $Editable['siem_name'][$name] ?></option>
                <option value="">Select SIEM</option>
                <?php create_opt('siem') ?>
            </select>
            <input type="checkbox" name="siem[<?= $name ?>]" id="siem_<?= $id ?>" class="check sec-check <?= ($Editable['siem'][$name] == "on") ? "Checked" : "" ?> ">
            <!-- <input type="number" min = 0  id="siemqty_<?= $id ?>" name="siemqty[<?= $name ?>]" class="hide form-control sec-qty"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="select-pim_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">PIM / PAM</option>
            </select>
            <input type="checkbox" name="pim[<?= $name ?>]" id="pim_<?= $id ?>" class="check sec-check <?= ($Editable['pim'][$name] == "on") ? "Checked" : "" ?> ">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['pimqty'][$name] ?>" id="pimqty_<?= $id ?>" name="pimqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="vtm-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">VTM Scan</option>
            </select>
            <input type="checkbox" name="vtm[<?= $name ?>]" id="vtm_<?= $id ?>" class="check sec-check <?= ($Editable['vtm'][$name] == "on") ? "Checked" : "" ?>">
            <select name="vtmqty[<?= $name ?>]" id="vtmqty_<?= $id ?>" class="hide small form-control sec-qty py-0" style="height: fit-content;">
                <option class="editable" value="<?= $Editable['vtmqty'][$name] ?>" hidden><?= $Editable['vtmqty'][$name] ?></option>
                <option value="" hidden>Select Scans per Month</option>
                <?php create_opt('vtm_scan') ?>
            </select>
            <!-- <input type="number" min = 0  id="vtmqty_<?= $id ?>" name="vtmqty[<?= $name ?>]" class="hide form-control sec-qty"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="vpt-select_<?= $id ?>" name="vapt_type[<?= $name ?>]" class="border-0 " style="width: 70%;">
                <option class="editable" value="<?= $Editable['vapt_type'][$name] ?>" hidden><?= $Editable['vapt_type'][$name] ?></option>
                <option value="">Select VAPT Audit</option>
                <?php create_opt('vapt') ?>
            </select>
            <input type="checkbox" name="vapt[<?= $name ?>]" id="vapt_<?= $id ?>" class="check sec-check <?= ($Editable['vapt'][$name] == "on") ? "Checked" : "" ?>">
            <div class="hide sec-qty">
                <input type="number" min=0 id="vaptqty_<?= $id ?>" name="vaptqty[<?= $name ?>]" placeholder="Frequency" class="form-control col-md-6 d-inline-block" value="<?= $Editable['vaptqty'][$name] ?>">
                <select name="vapt_frequency[<?= $name ?>]" id="vapt_frequency_<?= $id ?>" class="form-control col-md-6 d-inline-block py-0">
                    <option class="editable" value="<?= $Editable['vapt_frequency'][$name] ?>" hidden><?= $Editable['vapt_frequency'][$name] ?></option>
                    <option value="Quarterly">/ Quarterly</option>
                    <option value="Half Yearly">/ Half Yearly</option>
                    <option value="Yearly">/ Yearly</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-4 row my-3">
            <select name="hsm_type[<?= $name ?>]" id="hsm_type_<?= $id ?>" class="border-0 hsm" style="width: 70%;">
                <option class="editable" value="<?= $Editable['hsm_type'][$name] ?>" hidden><?= $Editable['hsm_type'][$name] ?></option>
                <option value="">Select HSM</option>
                <?php create_opt('hsm') ?>
            </select>
            <input type="checkbox" name="hsm[<?= $name ?>]" id="hsm_<?= $id ?>" class="check sec-check  <?= ($Editable['hsm'][$name] == "on") ? "Checked" : "" ?>">
            <!-- <input type="number" min=0 placeholder="" id="hsmqty_<?= $id ?>" name="hsmqty[<?= $name ?>]" class="hide form-control sec-qty" value="<?= $Editable['hsmqty'][$name] ?>"> -->
            <div class="input-group hide sec-qty">
                <input type="number" min=0 placeholder="" id="hsmqty_<?= $id ?>" name="hsmqty[<?= $name ?>]" class=" form-control " value="<?= $Editable['hsmqty'][$name] ?>" aria-describedby="inputGroupPrepend">
                <span class="input-group-text py-0 form-control bg-light col-4" id="HSMUnit_<?= $id ?>"></span>
            </div>
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="tfa_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Two Factor Authentication</option>
            </select>
            <input type="checkbox" name="tfa[<?= $name ?>]" id="tfa_<?= $id ?>" class="check sec-check <?= ($Editable['tfa'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['tfaqty'][$name] ?>" id="tfaqty_<?= $id ?>" name="tfaqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="iam-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">IAM</option>
            </select>
            <input type="checkbox" name="iam[<?= $name ?>]" id="iam_<?= $id ?>" class="check sec-check <?= ($Editable['iam'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['iamqty'][$name] ?>" id="iamqty_<?= $id ?>" name="iamqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="dlp-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">DLP</option>
            </select>
            <input type="checkbox" name="dlp[<?= $name ?>]" id="dlp_<?= $id ?>" class="check sec-check <?= ($Editable['dlp'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['dlpqty'][$name] ?>" id="dlpqty_<?= $id ?>" name="dlpqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="edr-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">EDR</option>
            </select>
            <input type="checkbox" name="edr[<?= $name ?>]" id="edr_<?= $id ?>" class="check sec-check <?= ($Editable['edr'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['edrqty'][$name] ?>" id="edrqty_<?= $id ?>" name="edrqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="dam-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">DAM</option>
            </select>
            <input type="checkbox" name="dam[<?= $name ?>]" id="dam_<?= $id ?>" class="check sec-check <?= ($Editable['dam'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['damqty'][$name] ?>" id="damqty_<?= $id ?>" name="damqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="sor-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">SOAR</option>
            </select>
            <input type="checkbox" name="sor[<?= $name ?>]" id="sor_<?= $id ?>" class="check sec-check <?= ($Editable['sor'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 placeholder="Quantity" value="<?= $Editable['sorqty'][$name] ?>" id="sorqty_<?= $id ?>" name="sorqty[<?= $name ?>]" class="hide form-control sec-qty">
        </div>
    </div>
</div>