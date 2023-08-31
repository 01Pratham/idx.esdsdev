<div class="contain-btn btn-link border-bottom">
    <button class="btn btn-link col-md-11 text-left" data-toggle="collapse" type="button" role="button" aria-expanded="true" aria-controls="managed_collapse">
        <i class="fa fa-tasks mr-2"></i>Managed Services :
    </button>
</div>
<div class="collapse py-1 ml-3 show" id="managed_collapse">
    <div class="row">
        <div class="form-group col-md-4 row my-3">
            <select id="osmgmt-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">OS Management</option>
            </select>
            <input type="checkbox" <?= ($Editable['osmgmt'][$name] == "on") ? "Checked" : "" ?> name="osmgmt[<?= $name ?>]" id="osmgmt_<?= $id ?>" class="check">
            <!-- <input type="number" min = 0  class="hide form-control"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="dbmgmt-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">DB Management</option>
            </select>
            <input type="checkbox" <?= ($Editable['dbmgmt'][$name] == "on") ? "Checked" : "" ?> name="dbmgmt[<?= $name ?>]" id="dbmgmt_<?= $id ?>" class="check">
            <!-- <input type="number" min = 0  class="hide form-control"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="strgmgmt-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Storage Management</option>
            </select>
            <input type="checkbox" <?= ($Editable['strgmgmt'][$name] == "on") ? "Checked" : "" ?> name="strgmgmt[<?= $name ?>]" id="strgmgmt_<?= $id ?>" class="check">
            <!-- <input type="number" min = 0  class="hide form-control"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="backupmgmt-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Backup Management</option>
            </select>
            <input type="checkbox" <?= ($Editable['backmgmt'][$name] == "on") ? "Checked" : "" ?> name="backmgmt[<?= $name ?>]" id="backmgmt_<?= $id ?>" class="check">
            <!-- <input type="number" min = 0  class="hide form-control"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="lbmgmt-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Load Balancer Management</option>
            </select>
            <input type="checkbox" <?= ($Editable['lb_mgmt'][$name] == "on") ? "Checked" : "" ?> name="lb_mgmt[<?= $name ?>]" id="lb_mgmt_<?= $id ?>" class="check">
            <!-- <input type="number" min = 0  class="hide form-control"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="fwmgmt-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Firewall Management</option>
            </select>
            <input type="checkbox" <?= ($Editable['fv_mgmt'][$name] == "on") ? "Checked" : "" ?> name="fv_mgmt[<?= $name ?>]" id="fv_mgmt_<?= $id ?>" class="check">
            <!-- <input type="number" min = 0  class="hide form-control"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="wafmgmt-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">WAF Management</option>
            </select>
            <input type="checkbox" <?= ($Editable['wafmgmt'][$name] == "on") ? "Checked" : "" ?> name="wafmgmt[<?= $name ?>]" id="wafmgmt_<?= $id ?>" class="check">
            <!-- <input type="number" min = 0  class="hide form-control"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select name="emagic_type[<?= $name ?>]" id="emagic_type_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option class="editable" value="<?= $Editable['emagic_type'][$name] ?>" hidden><?= $Editable['emagic_type'][$name] ?> Monitoring Tool</option>
                <option value="Basic">Basic Monitoring Tool</option>
                <option value="Advanced">Advanced Monitoring Tool</option>
            </select>
            <input type="checkbox" name="emagic[<?= $name ?>]" id="emagic_<?= $id ?>" class="check" checked>
            <!-- <input type="number" min = 0  class="hide form-control"> -->
        </div>
    </div>
</div>