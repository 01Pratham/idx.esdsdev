<div class="contain-btn btn-link border-bottom">
    <button class="btn btn-link col-md-11 text-left" data-toggle="collapse" type="button" role="button" aria-expanded="true" aria-controls="back_collapse_<?= $id ?>">
        <i class="fa fa-database mr-2"></i>Backup Solutions :
    </button>
</div>
<div class="collapse show py-1 ml-3" id="back_collapse_<?= $id ?>">
    <div class="row">
        <div class="form-group col-md-3">
            <h6><small>Backup Storage :</small></h6>
            <div class="form-group row">
                <div class=" col-sm-8 " style="padding-right: 0px;">
                    <input type="number" step="0.1" min=0 class="form-control small border-right-0 rounded-0" id="backup_strg_<?= $id ?>" placeholder="Quantity" value="<?= $Editable['backup_strg'][$name] ?>" name="backup_strg[<?= $name ?>]">
                </div>
                <div class="form-group col-sm-4" style="padding-left: 0px;">
                    <select name='backup_unit[<?= $name ?>]' id='backupunit_<?= $id ?>' class='rounded-0 border-left-0 form-control'>
                        <option class="editable" value="<?= $Editable['backupunit'][$name] ?>" hidden><?= $Editable['backupunit'][$name] ?></option>
                        <option value='TB'>TB</option>
                        <option value='GB'> GB </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-md-3">
            <h6><small> Backup Agent :</small></h6>
            <div class="row px-2">
                <select name="age_qty_type[<?= $name ?>]" id="age-type_<?= $id ?>" class="form-control">
                    <option class="editable" value="<?= $Editable['age_qty_type'][$name] ?>" hidden><?= $Editable['age_qty_type'][$name] ?></option>
                    <option value="">Select Agent</option>
                    <option value="All VM">All VM</option>
                    <option value="DB VM">DB VM</option>
                    <option value="Customized">Customized</option>
                </select>
                <input type='number' min=0 name='ageqty[<?= $name ?>]' value="<?= $Editable['ageqty'][$name] ?>" placeholder='Quantity' id='ageqty_<?= $id ?>' min="0" class="agent-qty form-control col-md-6" style="display : none">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <h6><small>Archival Storage :</small></h6>
            <div class="form-group row">
                <div class=" col-sm-8 pr-0">
                    <input type="number" step="0.1" min=0 class="form-control small border-right-0 rounded-0" id="arc_qty_<?= $id ?>" placeholder="Quantity" value="<?= $Editable['arc_strg'][$name] ?>" name="arc_strg[<?= $name ?>]">
                </div>
                <div class="form-group col-sm-4 pl-0">
                    <select name='archival_unit[<?= $name ?>]' id='arc_strgunit_<?= $id ?>' class='rounded-0 border-left-0 form-control'>
                        <option class="editable" value="<?= $Editable['archival_unit'][$name] ?>" hidden><?= $Editable['archival_unit'][$name] ?></option>
                        <option value='TB'>TB</option>
                        <option value='GB'> GB </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-md-8">
            <h6><small>Offline Backup :</small></h6>
            <div class="row">
                <div class="form-switch form-group form-check col-md-4">
                    <label class="form-check-label h6" for="tape_lib"> Tape Library : </label>
                    <input class="form-check-input check-off check ml-1 <?= ($Editable['tape_lib'][$name] == "on") ? "Checked" : "" ?>" role="switch" type="checkbox" id="tape_lib_<?= $id ?>" name="tape_lib[<?= $name ?>]">
                    <input type="number" min=0 name="tlqty[<?= $name ?>]" class="hide form-control" placeholder="Quantity" value="<?= $Editable['tlqty'][$name] ?>" id="tlqty_<?= $id ?>">
                </div>
                <div class="form-switch form-group form-check col-md-4">
                    <label class="form-check-label h6" for="tape_cart">Tape Cartridge : </label>
                    <input class="form-check-input check-off check ml-1 <?= ($Editable['tape_cart'][$name] == "on") ? "Checked" : "" ?>" role="switch" type="checkbox" id="tape_cart_<?= $id ?>" name="tape_cart[<?= $name ?>]">
                    <input type="number" min=0 name="tcqty[<?= $name ?>]" class="hide form-control" placeholder="Quantity" value="<?= $Editable['tcqty'][$name] ?>" id="tcqty_<?= $id ?>">
                </div>
                <div class="form-switch form-group form-check col-md-4">
                    <label class="form-check-label h6" for="fire_cab">Fireproof Cabinate : </label>
                    <input class="form-check-input check-off check ml-1 <?= ($Editable['fire_cab'][$name] == "on") ? "Checked" : "" ?>" role="switch" type="checkbox" id="fire_cab" name="fire_cab[<?= $name ?>]">
                    <input type="number" min=0 name="fcqty[<?= $name ?>]" class="hide form-control" placeholder="Quantity" value="<?= $Editable['fcqty'][$name] ?>" id="fcqty_<?= $id ?>">
                </div>
            </div>
        </div>
    </div>
</div>