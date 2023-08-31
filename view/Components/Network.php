<div class="contain-btn btn-link border-bottom">
    <button class="btn btn-link col-md-11 text-left" data-toggle="collapse" type="button" role="button" aria-expanded="true" aria-controls="network_collapse_<?= $id ?>">
        <i class="fa fa-network-wired mr-2"></i>Network Services :
    </button>
</div>
<div class="collapse py-1 ml-3 show" id="network_collapse_<?= $id ?>">
    <div class="row">
        <div class="form-group col-md-3">
            <select name="bandwidthType[<?= $name ?>]" id="bandwidthType_<?= $id ?>" class="border-0 small" style="width: 100%;">
                <option class="editable" value="<?= $Editable['bandwidthtype'][$name] ?>" hidden><?= $Editable['bandwidthtype'][$name] ?></option>
                <option value="Speed Based Internet Bandwidth">Speed Based Internet Bandwidth</option>
                <option value="Volume Based Internet Bandwidth">Volume Based Internet Bandwidth</option>
            </select>
            <!-- <input type="number" min=0 name="bandwidth[<?= $name ?>]" id="bandwidth_<?= $id ?>" class="form-control my-1" placeholder="Mbps" value="<?= $Editable['bandwidth'][$name] ?>"> -->
            <div class="input-group">
                <input type="number" min=0 name="bandwidth[<?= $name ?>]" id="bandwidth_<?= $id ?>" class="form-control my-1" placeholder="" value="<?= $Editable['bandwidth'][$name] ?>" aria-describedby="inputGroupPrepend">
                <span class="input-group-text py-0 form-control my-1 col-3 bg-light" id="BandwidthUnit_<?= $id ?>">Mbps</span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <select name="load_balancer[<?= $name ?>]" id="lb_<?= $id ?>" class="border-0 small" style="width: 100%;">
                <option class="editable" value="<?= $Editable['load_balancer'][$name] ?>" hidden><?= $Editable['load_balancer'][$name] ?></option>
                <option value="">Load Balancer</option>
                <?php create_opt('lb') ?>
            </select>
            <input type="number" min=0 name="lbqty[<?= $name ?>]" id="lbqty_<?= $id ?>" class="form-control my-1" placeholder="Quantity" value="<?= $Editable['lbqty'][$name] ?>">
        </div>
        <div class="form-group col-md-3">
            <h6><small>Cross Connect and Port Termination</small></h6>
            <input type="number" min=0 name="ccptqty[<?= $name ?>]" id="ccptqty_<?= $id ?>" class="form-control" placeholder="Quantity" value="<?= $Editable['ccptqty'][$name] ?>">
        </div>
        <div class="form-group col-md-3 vpn">
            <h6><small>VPN :</small></h6>
            <div class="row">
                <div class="form-switch form-group form-check col-md-6">
                    <label class="form-check-label h6" for="ssl_vpn"> SSL VPN : </label>
                    <input class="form-check-input check ml-1 <?= ($Editable['sslvpn'][$name] == "on") ? "Checked" : "" ?>" role="switch" type="checkbox" id="ssl_vpn_<?= $id ?>" name="sslvpn[<?= $name ?>]">
                    <input type="number" min=0 name="sslvpnqty[<?= $name ?>]" class="hide form-control" placeholder="Quantity" value="<?= $Editable['sslvpnqty'][$name] ?>" id="sslvpnqty_<?= $id ?>">
                </div>
                <div class="form-switch form-group form-check col-md-6">
                    <label class="form-check-label h6" for="ipsec_vpn">IPSEC VPN : </label>
                    <input class="form-check-input check ml-1 <?= ($Editable['ipsec'][$name] == "on") ? "Checked" : "" ?>" role="switch" type="checkbox" id="ipsec_vpn_<?= $id ?>" name="ipsec[<?= $name ?>]">
                    <input type="number" min=0 name="ipsecqty[<?= $name ?>]" class="hide form-control" placeholder="Quantity" value="<?= $Editable['ipsecqty'][$name] ?>" id="ipsecvpnqty_<?= $id ?>">
                </div>
            </div>
        </div>
        <div class="form-group col-md-3 replink">
            <h6><small>Replication Link</small></h6>
            <!-- <input type="number" min=0 name="rep_link[<?= $name ?>]" id="rep_link_<?= $id ?>" class="form-control" placeholder="Quantity" value="<?= $Editable['rep_link'][$name] ?>"> -->
            <div class="input-group">
                <input type="number" min=0 name="rep_link_qty[<?= $name ?>]" id="rep_link_qty_<?= $id ?>" class="form-control my-1" placeholder="" value="<?= $Editable['rep_link'][$name] ?>" aria-describedby="inputGroupPrepend">
                <span class="input-group-text py-0 form-control my-1 col-3 bg-light" id="rep_linkUnit_<?= $id ?>">Mbps</span>
            </div>
        </div>
    </div>
</div>