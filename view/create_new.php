<?php
function CreateNew()
{

    echo '<section class="Create">';
    require_once '../model/editable.php';
    global $con, $Editable;

    require '../view/content-header.php';
    contentHeader('Create Estimate');

    ?>

    <div class="except container mt-2">
        <div class="Errors except"></div>
        <section id="create_Main" class="light rounded">
            <form class="row px-3 p-3 g-2 py-4">
                <div class="except px-2 col-md-6">
                    <label for="inputEmail4" class="form-label">
                        <i class="fa fa-info-circle px-2  " title="Enter 4 Chracters only."></i>
                        POT ID :
                    </label>
                    <input type="number" class="form-control" id="pot_id" value="<?= $Editable['pot_id'] ?>" min="1000"
                        max='9999' name="pot_id" placeholder="Enter POT ID Here"
                        style="border: none; border-bottom: 1px solid ; border-radius:0;">
                </div>
                <div class="except px-2 col-md-6 ">
                    <label for="inputEmail4" class="form-label">Project Name : </label>
                    <input type="Text" class="form-control" id="project_name" value="<?= $Editable['project_name'] ?>"
                        min="1000" max='9999' name="project_name" placeholder="Enter Project Name Here"
                        style="border: none; border-bottom: 1px solid ; border-radius:0;">
                </div>
                <div class="except px-2 col-md-6  py-4">
                    <label for="pice_list" class="form-label">Price List</label>
                    <select class="form-control" name="price_list" id="pice_list"
                        style="border: none; border-bottom: 1px solid ; border-radius:0;">
                        <?php
                        $list = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `pricing_list_master` WHERE `pricing_list_id` ='{$Editable['price_list']}' "));
                        echo "<option value='{$list["pricing_list_id"]}' class='editable' hidden>{$list["pricing_list_name"]}</option>'";

                        $p_query = mysqli_query($con, "SELECT * FROM `pricing_list_master`");
                        while ($pricing_list = mysqli_fetch_array($p_query)) {
                            ?>
                            <option value="<?= $pricing_list["pricing_list_id"] ?>"><?= $pricing_list["pricing_list_name"] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="except px-2 col-md-6 py-4">
                    <label for="type_est" class="form-label">Quotation Type</label>
                    <select class="form-control" name="quot_type" id="type_est"
                        style="border: none; border-bottom: 1px solid ; border-radius:0;">
                        <?php
                        if(!empty($Editable['quot_type'])){
                            $quer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_quot_type` WHERE `id` = '{$Editable['quot_type']}' "));
                            echo "<option value='{$quer['id']}' class='editable' hidden>{$quer['template_name']}</option>";
                        }
                        $quotQuery = mysqli_query($con, "SELECT * FROM `tbl_quot_type` WHERE `is_active` = 'True'");
                        while ($type = mysqli_fetch_assoc($quotQuery)) {
                            ?>
                            <option value="<?= $type['id'] ?>"><?= $type['template_name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="except px-2 col-12 d-flex justify-content-center">
                    <a href="#" role='button' id="Next-Btn" class="Next-Btn" name="Next-Btn">Next</a>
                </div>
            </form>
        </section>
    </div>

    <script>
        $("#Next-Btn").on("click", function () {
            if ($('#pot_id').val() == '' || $('#project_name').val() == '') {
                $('.Errors').html('<div class="except alert alert-danger alert-dismissible fade show" role="alert"><strong>Error !</strong> Please Fill all the required Fields. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class = "except" aria-hidden="true">&times;</span></button></div>')
            } else if ($('#pot_id').val().length < 4 || $('#pot_id').val().length >= 5) {
                $('.Errors').html('<div class="except alert alert-warning alert-dismissible fade show" role="alert"><strong>Warning !</strong> Please Enter valid POT Id.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class = "except" aria-hidden="true">&times;</span></button></div>')
            } else {
                if ($('#type_est').val() == "phase" || $('#type_est').val() == "phase_dr") {
                    $(this).attr("href", '?<?= (isset($_GET['edit_id'])) ? "edit_id={$_GET['edit_id']}&" : '' ?>next&pot_id=' + $('#pot_id').val() + '&project_name=' + $('#project_name').val() + '&list=' + $('#pice_list').val() + '&type=' + $('#type_est').val() + "&phase=" + $("#phases").val())
                } else {
                    $(this).attr("href", '?<?= (isset($_GET['edit_id'])) ? "edit_id={$_GET['edit_id']}&" : '' ?>next&pot_id=' + $('#pot_id').val() + '&project_name=' + $('#project_name').val() + '&list=' + $('#pice_list').val() + '&type=' + $('#type_est').val());
                }
            }
        })
    </script>

    </section>
    <?php

}
?>