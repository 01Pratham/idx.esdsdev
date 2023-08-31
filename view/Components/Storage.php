<div class="contain-btn btn-link border-bottom">
    <button class="btn btn-link col-md-11 text-left" data-toggle="collapse" type="button" id="strHead_<?= $id ?>" role="button" aria-expanded="true" aria-controls="str_collapse_<?= $id ?>">
        <i class="fa fa-hdd mr-2"></i>Storage Solutions :
    </button>
</div>
<div class="collapse show py-1 " id="str_collapse_<?= $id ?>">
    <div class="mx-3">
        <h6><small>Additional Storage : </small></h6>
    </div>
    <div class='row'>
        <div class="form-switch form-group form-check col-md-2">
            <label style='cursor:pointer' class='h6'> <span class="lblIops" id="0.3">300</span>IOPS/</label>
            <select name='03strgunit[<?= $name ?>]' id='03strgunit_<?= $id ?>' class='strg-select'>
                <option class="editable" value="<?= $Editable['03strgunit'][$name] ?>" hidden><?= $Editable['03strgunit'][$name] ?></option>
                <option value='TB'>TB</option>
                <option value='GB'> GB </option>
            </select>
            <input type='checkbox' class='<?= ($Editable['03iops'][$name] == "on") ? "Checked" : "" ?> iops-check check' id="03iops_check_<?= $id ?>" name="03iops[<?= $name ?>]">
            <input type='Number' step="0.1" min=0 name='03iopsqty[<?= $name ?>]' id='03iopsqty_<?= $id ?>' class="strg hide form-control" min=0 placeholder="Quantity" value="<?= $Editable['03iopsqty'][$name] ?>">
        </div>
        <div class="form-switch form-group form-check col-md-2">
            <label style='cursor:pointer' class='h6'> <span class="lblIops" id="1">1000</span>IOPS/</label>
            <select name='1strgunit[<?= $name ?>]' id='1strgunit_<?= $id ?>' class='strg-select'>
                <option class="editable" value="<?= $Editable['1strgunit'][$name] ?>" hidden><?= $Editable['1strgunit'][$name] ?></option>
                <option value='TB'>TB</option>
                <option value='GB'> GB </option>
            </select>
            <input type='checkbox' class='<?= ($Editable['1iops'][$name] == "on") ? "Checked" : "" ?> iops-check check' id="1iops_check_<?= $id ?>" name="1iops[<?= $name ?>]">
            <input type='Number' step="0.1" min=0 name='1iopsqty[<?= $name ?>]' id='1iopsqty_<?= $id ?>' class="strg hide form-control" min=0 placeholder="Quantity" value="<?= $Editable['1iopsqty'][$name] ?>">
        </div>
        <div class="form-switch form-group form-check col-md-2">
            <label style='cursor:pointer' class='h6'> <span class="lblIops" id="3">3000</span>IOPS/</label>
            <select name='3strgunit[<?= $name ?>]' id='3strgunit_<?= $id ?>' class='strg-select'>
                <option class="editable" value="<?= $Editable['3strgunit'][$name] ?>" hidden><?= $Editable['3strgunit'][$name] ?></option>
                <option value='TB'>TB</option>
                <option value='GB'> GB </option>
            </select>
            <input type='checkbox' class='<?= ($Editable['3iops'][$name] == "on") ? "Checked" : "" ?> iops-check check' id="3iops_check_<?= $id ?>" name="3iops[<?= $name ?>]">
            <input type='Number' step="0.1" min=0 name='3iopsqty[<?= $name ?>]' id='3iopsqty_<?= $id ?>' class="strg hide form-control" min=0 placeholder="Quantity" value="<?= $Editable['3iopsqty'][$name] ?>">
        </div>
        <div class="form-switch form-group form-check col-md-2">
            <label style='cursor:pointer' class='h6'> <span class="lblIops" id="5">5000</span>IOPS/</label>
            <select name='5strgunit[<?= $name ?>]' id='5strgunit_<?= $id ?>' class='strg-select'>
                <option class="editable" value="<?= $Editable['5strgunit'][$name] ?>" hidden><?= $Editable['5strgunit'][$name] ?></option>
                <option value='TB'>TB</option>
                <option value='GB'> GB </option>
            </select>
            <input type='checkbox' class='<?= ($Editable['5iops'][$name] == "on") ? "Checked" : "" ?> iops-check check' id="5iops_check_<?= $id ?>" name="5iops[<?= $name ?>]">
            <input type='Number' step="0.1" min=0 name='5iopsqty[<?= $name ?>]' id='5iopsqty_<?= $id ?>' class="strg hide form-control" min=0 placeholder="Quantity" value="<?= $Editable['5iopsqty'][$name] ?>">
        </div>
        <div class="form-switch form-group form-check col-md-2">
            <label style='cursor:pointer' class='h6'> <span class="lblIops" id="8">8000</span>IOPS/ </label>
            <select name='8strgunit[<?= $name ?>]' id='8strgunit_<?= $id ?>' class='strg-select'>
                <option class="editable" value="<?= $Editable['8strgunit'][$name] ?>" hidden><?= $Editable['8strgunit'][$name] ?></option>
                <option value='TB'>TB</option>
                <option value='GB'> GB </option>
            </select>
            <input type='checkbox' class='<?= ($Editable['8iops'][$name] == "on") ? "Checked" : "" ?> iops-check check' id="8iops_check_<?= $id ?>" name="8iops[<?= $name ?>]">
            <input type='Number' step="0.1" min=0 name='8iopsqty[<?= $name ?>]' id='8iopsqty_<?= $id ?>' class="strg hide form-control" min=0 placeholder="Quantity" value="<?= $Editable['8iopsqty'][$name] ?>">
        </div>
        <div class="form-switch form-group form-check col-md-2">
            <label style='cursor:pointer' class='h6'> <span class="lblIops" id="10">10000</span>IOPS/</label>
            <select name='10strgunit[<?= $name ?>]' id='10strgunit_<?= $id ?>' class='strg-select'>
                <option class="editable" value="<?= $Editable['10strgunit'][$name] ?>" hidden><?= $Editable['10strgunit'][$name] ?></option>
                <option value='TB'>TB</option>
                <option value='GB'> GB </option>
            </select>
            <input type='checkbox' class='<?= ($Editable['10iops'][$name] == "on") ? "Checked" : "" ?> iops-check check' id="10iops_check_<?= $id ?>" name="10iops[<?= $name ?>]">
            <input type='Number' step="0.1" min=0 name='10iopsqty[<?= $name ?>]' id='10iopsqty_<?= $id ?>' class="strg hide form-control" min=0 placeholder="Quantity" value="<?= $Editable['10iopsqty'][$name] ?>">
        </div>
    </div>
</div>