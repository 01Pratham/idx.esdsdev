<?php
// require "../model/database.php";
session_start();
include '../model/editable.php';

$reg_name = $_POST['reg_name'];
$ser_name = $_POST['ser_name'];
$name = $_POST['name'];
$id = $_POST['id'];
$count = $_POST['count'];
$cloneId = $_POST['cloneId'];
// echo $cloneId;
if (!isset($_POST['action'])) {
    if ($ser_name != "Flexible Compute") {

        if ($ser_name == "All") {
            $pack_query = " Select * From tbl_pack Where region ='{$reg_name}' ";
        } else {
            $pack_query = " Select * From tbl_pack Where region ='{$reg_name}' And pack_series = '{$ser_name}' ";
        }
        $res2 = mysqli_query($con, $pack_query);
        
        $inst = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_pack` WHERE `sr_no` = '{$Editable['instance'][$name][$count]}'"));
?>
        <select name="instance[<?= $name ?>][]" id="instance_<?= $id ?>" class="form-control bg-transparent" onchange="instanceVals()" onload="instanceVals()">
            <option class="editable" value="<?= $Editable['instance'][$name][$count] ?>" hidden><?= $inst['pack'] ?></option>
            <option value="" hidden>Select Instance</option>
            <?php
            while ($rows = mysqli_fetch_array($res2)) { ?>
                <option value='<?= $rows['sr_no']; ?>'> <?= $rows['pack']; ?> </option>
            <?php  } ?>
        </select>

        <div id="inst_vals_<?= $id ?>">
            <?php 
            if(!empty($Editable['instance'][$name][$count])){
             ?>
                 <input type="hidden" name="vcpu[<?= $name ?>][]" value="<?= $Editable['vcpu'][$name][$count] ?>">
                <input type="hidden" name="ram[<?= $name ?>][]" value="<?= $Editable['ram'][$name][$count] ?>">
                <input type="hidden" name="inst_disk[<?= $name ?>][]" value="<?= $Editable['inst_disk'][$name][$count] ?>">
             
             <?php   
            }
            ?>
            
        </div>

        <script>
            if ($('#instance_<?= $id ?> .editable').val() == '') {
                $('#instance_<?= $id ?> .editable').remove()
            }
            
            function instanceVals() {
                $.ajax({
                    url: "../view/instance_ajax.php",
                    type: 'POST',
                    dataType: "TEXT",
                    data: {
                        region: $('#region_<?= $id ?>').val(),
                        instance: $('#instance_<?= $id ?>').val(),
                        action: "inst",
                        name: <?= $name ?>
                    },
                    success: function(response) {
                        $("#inst_vals_<?= $id ?>").html(response);
                    }
                })
            }

            <?php
            if (!empty($cloneId)) {
            ?>
                var newId = '#instance_<?= $id ?>';
                var oldId = '#instance_<?= $cloneId ?>'
                $(newId).val($(oldId).val())
            <?php
            }
            ?>
        </script>
    <?php
    } else { ?>
        <div class="row ml-2 flexComp">
            <div class="col-md-4 border p-0 rounded ">
                <label for="vcpu_<?= $id ?>" class="small d-inline-block pl-1">vCPU : </label>
                <input type="number" min=0 name="vcpu[<?= $name ?>][]" value='<?= !empty($Editable['vcpu'][$name][$count]) ? $Editable['vcpu'][$name][$count] : 1 ?>' id="vcpu_<?= $id ?>" placeholder='QTY..' class="form-control d-inline-block col-8 border-0 bg-transparent" oninput="($(this).val()%2 != 0)?$(this).parent().addClass('border-danger'):$(this).parent().removeClass('border-danger')">
            </div>
            <div class="col-md-3 border p-0 rounded ml-1">
                <label for="ram_<?= $id ?>" class="small d-inline-block pl-1">RAM : </label>
                <input type="number" min=0 name="ram[<?= $name ?>][]" value='<?= !empty($Editable['ram'][$name][$count]) ? $Editable['ram'][$name][$count] : 2 ?>' id="ram_<?= $id ?>" placeholder='QTY..' class="form-control d-inline-block col-7 border-0 bg-transparent">
            </div>
            <div class="col-md-4 border p-0 rounded ml-1">
                <label for="inst_disk_<?= $id ?>" class="small d-inline-block pl-1">Disk [ GB ] : </label>
                <input type="number" min=0 name="inst_disk[<?= $name ?>][]" value='<?= !empty($Editable['inst_disk'][$name][$count]) ? $Editable['inst_disk'][$name][$count] : 100 ?>' id="inst_disk_<?= $id ?>" placeholder='QTY..' class="form-control d-inline-block col-5 border-0 bg-transparent">
            </div>
            <input type="hidden" name="instance[<?=$name?>][]" value="Flexi">
        </div>
        <script>
            <?php
            if (!empty($cloneId)) {
            ?>
                $(".flexComp").find("input[type = number]").each(function() {
                    let newId = $(this).prop("id");
                    let oldId = newId.replace(<?=$id?>, <?=$cloneId?>);
                    $(this).val($("#"+oldId).val());
                })
            <?php
            }
            ?>
        </script>
    <?php  }
}
function inst_val()
{
    global $con;
    $name = $_POST['name'];
    $reg = $_POST['region'];
    $inst = $_POST['instance'];
    $sr_no = trim(substr($inst, 0, 4));
    if (preg_match('/:/', $sr_no)) {
        $sr_no = preg_replace('/:/', '', $sr_no);
    }
    $vals = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_pack` WHERE `region`= '{$reg}' AND `sr_no` = '{$sr_no}'"))
    ?>

    <input type="hidden" name="vcpu[<?= $name ?>][]" value="<?= $vals['vCores'] ?>">
    <input type="hidden" name="ram[<?= $name ?>][]" value="<?= $vals['ram'] ?>">
    <input type="hidden" name="inst_disk[<?= $name ?>][]" value="<?= $vals['disk'] ?>">

<?php

}

if ($_POST['action'] == 'inst') {
    inst_val();
}

?>