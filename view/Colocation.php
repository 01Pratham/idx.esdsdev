<?php
function Colocation($name, $id)
{
    global $Editable;
?>
    <section class="est_div align-center Main mt-2" id="est_div_<?= $id ?>">
        <div class="contain-btn btn-link shadow-sm light " id="contain-btn_<?= $id ?>">
            <input class="add-estmt btn btn-link except text-primary" type="button" role="button" title="Add Estimate" id="add-estmt" style="z-index: 1;" value="&plus;">
            <script>
                $('#add-estmt').click(function() {
                    add_estmt("ajax");
                })
            </script>
            <input 
                type="checkbox" 
                id="checkHead_<?= $id ?>" 
                class="head-btn d-none"
                oninput="
                    if($(this).prop('checked')){
                        $('#estmt_collapse_<?= $id ?>').removeClass('hide')
                        $('#estmt_collapse_<?= $id ?>').addClass('show')
                    }else{
                        $('#estmt_collapse_<?= $id ?>').removeClass('show')
                        $('#estmt_collapse_<?= $id ?>').addClass('hide')
                    }
                "    
            >
            <label class="text-left text-primary pt-3" for="checkHead_<?= $id ?>" id="estmtHead_<?= $id ?>" style="z-index: 1;">
                <h6 class="OnInput">Your Estimate</h6>
            </label>
            <span class="float-right">
                <select name="EstType[<?= $name ?>]" id="EstType_<?= $id ?>" class="border-0 text-primary pt-3">
                    <option value="Colocation">Colocation</option>
                </select>
            </span>
            <script>
                $('#coptI_<?= $id ?>').click(() => {
                    $('#coptI_<?= $id ?> input').click()
                })
            </script>
        </div>
        <div class="show my-1 except" id="estmt_collapse_<?= $id ?>">
            <div class="tab card card-body">
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <input type="text" class="form-control EstmtName" id="estmtname_<?= $id ?>" placeholder="Your Estimate" name="estmtname[<?= $name ?>]" required value="<?= $Editable["estmtname"][$name] ?>">
                    </div>
                    <div class="form-group col-md-3 ">
                        <input type="number" min=0 class="form-control small" id="period_<?= $id ?>" placeholder="Contract Period [MONTHS]" min=1 name="period[<?= $name ?>]" required value="<?= $Editable['period'][$name] ?>">
                    </div>
                </div>
                <?php
                require 'Components/colocation.php';
                require 'Components/Network.php';
                require 'Components/Security.php';
                require 'Components/ManagedServices.php';
                ?>
            </div>
        </div>

    </section>

    <script>

        $('.vpn').addClass('d-none');

    </script>


<?php
}
?>