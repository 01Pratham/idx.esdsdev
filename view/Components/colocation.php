<div class="contain-btn btn-link border-bottom">
    <button class="btn btn-link col-md-11 text-left" data-toggle="collapse" type="button" role="button" aria-expanded="true" aria-controls="dr_collapse<?= $id ?>">
        <i class="fa fa-ethernet mr-2"></i>Colocation :
    </button>
</div>
<div class="collapse py-1 ml-3 show" id="dr_collapse_<?= $id ?>">
    <div class="row">
        <div class="form-group col-md-4 row my-3">
            <select id="rack-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Rack Space</option>
            </select>
            <input type="checkbox" name="rack[<?= $name ?>]" id="rack_<?= $id ?>" class="check" <?= ($Editable['rack'][$name] == "on") ? "Checked" : "" ?>>
            <input type="number" style="width: 75%;" min=0 id="rackqty_<?= $id ?>" name="rackqty[<?= $name ?>]" class="hide form-control" value="<?= $Editable['rackqty'][$name] ?>" placeholder="Number of U">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="rated-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Rated Power</option>
            </select>
            <input type="checkbox" name="rated[<?= $name ?>]" id="rated_<?= $id ?>" class="check" <?= ($Editable['rated'][$name] == "on") ? "Checked" : "" ?>>
            <input type="number" style="width: 75%;" min=0 id="ratedqty_<?= $id ?>" name="ratedqty[<?= $name ?>]" class="hide form-control" value="<?= $Editable['ratedqty'][$name] ?>" placeholder="Number of KVA">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="metered-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Metered Power</option>
            </select>
            <input type="checkbox" name="metered[<?= $name ?>]" id="metered_<?= $id ?>" class="check" <?= ($Editable['metered'][$name] == "on") ? "Checked" : "" ?>>
            <input type="number" style="width: 75%;" min=0 id="meteredqty_<?= $id ?>" name="meteredqty[<?= $name ?>]" class="hide form-control" value="<?= $Editable['meteredqty'][$name] ?>" placeholder="Power Unit">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="cage-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Cage for Rack</option>
            </select>
            <input type="checkbox" name="cage[<?= $name ?>]" id="cage_<?= $id ?>" class="check" <?= ($Editable['cage'][$name] == "on") ? "Checked" : "" ?>>
            <input type="number" style="width: 75%;" min=0 id="cageqty_<?= $id ?>" name="cageqty[<?= $name ?>]" class="hide form-control" value="<?= $Editable['cageqty'][$name] ?>" placeholder="Quantity">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="bio-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Bio-matrix for Cage</option>
            </select>
            <input type="checkbox" name="bio[<?= $name ?>]" id="bio_<?= $id ?>" class="check" <?= ($Editable['bio'][$name] == "on") ? "Checked" : "" ?>>
            <input type="number" style="width: 75%;" min=0 id="bioqty_<?= $id ?>" name="bioqty[<?= $name ?>]" class="hide form-control" value="<?= $Editable['bioqty'][$name] ?>" placeholder="Quantity">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="pdu-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">PDU Meter</option>
            </select>
            <input type="checkbox" name="pdu[<?= $name ?>]" id="pdu_<?= $id ?>" class="check" <?= ($Editable['pdu'][$name] == "on") ? "Checked" : "" ?>>
            <input type="number" style="width: 75%;" min=0 id="pduqty_<?= $id ?>" name="pduqty[<?= $name ?>]" class="hide form-control" value="<?= $Editable['pduqty'][$name] ?>" placeholder="Quantity">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="cctv-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">CCTV Camera for Rack</option>
            </select>
            <input type="checkbox" name="cctv[<?= $name ?>]" id="cctv_<?= $id ?>" class="check" <?= ($Editable['cctv'][$name] == "on") ? "Checked" : "" ?>>
            <input type="number" style="width: 75%;" min=0 id="cctvqty_<?= $id ?>" name="cctvqty[<?= $name ?>]" class="hide form-control" value="<?= $Editable['cctvqty'][$name] ?>" placeholder="Quantity">
        </div>
    </div>
</div>