<div class="contain-btn btn-link border-bottom DR_<?= $name ?> d-none">
    <button class="btn btn-link col-md-11 text-left" data-toggle="collapse" type="button" role="button"
        aria-expanded="true" aria-controls="dr_collapse<?= $id ?>">
        <i class="fa fa-server mr-2"></i>Disaster Recovery Services :
    </button>
</div>
<div class="collapse py-1 ml-3 show DR_<?= $name ?> d-none" id="dr_collapse_<?= $id ?>">
    <div class="row">
        <div class="form-group col-md-4 row my-3">
            <select id="drm-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">DRM tool</option>
            </select>
            <input type="checkbox" name="drm[<?= $name ?>]" id="drm_<?= $id ?>"
                class="check <?= ($Editable['drm'][$name] == "on") ? "Checked" : "" ?>">
            <!-- <input type="number" min = 0  id="drmqty_<?= $id ?>" name="drmqty[<?= $name ?>]" class="hide form-control"> -->
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="dr_drill-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">DR Drill</option>
            </select>
            <input type="checkbox" name="dr_drill[<?= $name ?>]" id="dr_drill_<?= $id ?>"
                class="check <?= ($Editable['dr_drill'][$name] == "on") ? "Checked" : "" ?>">
            <input type="number" min=0 id="drillqty_<?= $id ?>" name="drillqty[<?= $name ?>]" class="hide form-control"
                value="<?= $Editable['drillqty'][$name] ?>" style="width: 75%" placeholder="Frequency">
        </div>
        <div class="form-group col-md-4 row my-3">
            <select name="rep_link_type[<?= $name ?>]" id="rep_link_type-select_<?= $id ?>" class="border-0 "
                style="width: 70%;">
                <option class="editable" value="<?= $Editable['rep_link_type'][$name] ?>" hidden><?= $Editable['rep_link_type'][$name] ?></option>
                <option value="">Replication Link</option>
                <?php create_opt('link') ?>
            </select>
            <input type="checkbox" name="rep_link[<?= $name ?>]" id="rep_link_<?= $id ?>"
                class="check <?= ($Editable['rep_link'][$name] == "on") ? "Checked" : "" ?>">
            <!-- <input type="number" min=0 id="rep_link_qty_<?= $id ?>" name="rep_link_qty[<?= $name ?>]" class="hide form-control" value="<?= $Editable['rep_link_type'][$name] ?>" style="width: 75%" placeholder="Mbps"> -->
            <div class="input-group hide" style="width: 75%">
                <input type="number" min=0 id="rep_link_qty_<?= $id ?>" name="rep_link_qty[<?= $name ?>]"
                    class="form-control  my-1" value="<?= $Editable['rep_link_type'][$name] ?>"
                    aria-describedby="inputGroupPrepend">
                <span class="input-group-text py-0 form-control my-1 bg-light col-3"
                    id="ReplUnit_<?= $id ?>">Mbps</span>
            </div>
        </div>
        <div class="form-group col-md-4 row my-3">
            <select id="repmgmt-select_<?= $id ?>" class="border-0 " style="width: 70%;">
                <option value="">Replication Link Management</option>
            </select>
            <input type="checkbox" name="rep_link_mgmt[<?= $name ?>]" id="rep_link_mgmt_<?= $id ?>"
                class="check <?= ($Editable['rep_link_mgmt'][$name] == "on") ? "Checked" : "" ?>">
            <!-- <input type="number" min = 0  id="drmqty_<?= $id ?>" name="drmqty[<?= $name ?>]" class="hide form-control"> -->
        </div>
    </div>
</div>