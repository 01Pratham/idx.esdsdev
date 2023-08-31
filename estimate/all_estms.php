<?php
function allEstimates($code, $userCode = '')
{   

    include '../view/content-header.php';
    if($userCode != ''){
        $user = employee($userCode);
        contentHeader("All Estimates / {$user['first_name']} {$user['last_name']}");
    }else{
        contentHeader("All Estimates");
    }
    require_once '../controller/Currency_Format.php';
    global $con;
?>
    <div class="except content" style="min-height: 277px;">
        <div class="except container-fluid">
            <div class="except">
                <div class="except row">
                    <div class="except col-12 mb-3 mb-lg-5">
                        <div class="except table-card">
                            <div class="except table-responsive">
                                <table class="table mb-0">
                                    <thead class="small text-uppercase bg-body text-muted">
                                        <tr>
                                            <th>POT ID</th>
                                            <th>Project Name</th>
                                            <th>Version</th>
                                            <th>Owner</th>
                                            <th>Last Updated By</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                            <th>Contract Period</th>
                                            <th>Total Upfront Cost</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get_estems_query = mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `emp_code` = '{$code}'");
                                        while ($data = mysqli_fetch_assoc($get_estems_query)) { 
                                            $emp1 = employee($data['owner']);
                                            $emp2 = employee($data['last_changed_by']);
                                            ?>
                                            <tr class="align-middle">
                                                <td>
                                                    <div class="except d-flex align-items-center">
                                                        <div>
                                                            <div class="except h6 mb-0 lh-1"><?= $data['pot_id'] ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $data['project_name'] ?></td>
                                                <td contenteditable="true" class="version" id = "version_<?= $data['id'] ?>"><?= $data['version'] ?></td>
                                                <td><?= $emp1['first_name'] ?></td>
                                                <td><?= $emp2['first_name'] ?></td>
                                                <td><?= $data['date_created'] ?></td>
                                                <td><?= $data['date_updated'] ?></td>
                                                <td><?= $data['contract_period'] ?></td>
                                                <td><?= INR($data['total_upfront']) ?></td>
                                                <td class="text-end">
                                                    <div class="except drodown">
                                                        <a data-bs-toggle="dropdown" href="#" class="btn p-1" aria-expanded="false">
                                                            <span class="fa fa-bars" aria-hidden="true"></span>
                                                        </a>
                                                        <div class="except dropdown-menu dropdown-menu-end text-light" style="min-width: 8rem; z-index:1 ">
                                                            <a href="?edit_id=<?= $data['id'] ?>" class="dropdown-item"><i>Edit</i><i class="fa fa-edit float-right pt-1"></i></a>
                                                            <a href="?clone_id=<?= $data['id'] ?>" class="dropdown-item"><i>Clone</i><i class="fa fa-clone float-right pt-1"></i></a>
                                                            <a href="?share_id=<?= $data['id'] ?>" class="dropdown-item"><i>Share</i><i class="fa fa-share-alt float-right pt-1"></i></a>
                                                            <a href="?all&delete_id=<?= $data['id'] ?>" class="dropdown-item"><i>Delete</i><i class="fa fa-trash float-right pt-1"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
         $(".version").keypress(function(e) {
                // console.log(e.keyCode);
                var key = e.keyCode || e.charCode; // ie||others
                if (key == 13) { // if enter key is pressed            
                    $(this).blur();
                    $(this).html();
                }
                $(this).on('blur',function(){
                    var value = parseInt($(this).html());
                    console.log(value);
                    var id = $(this).prop("id").replace("version_",'');
                    if(value != ''){
                        $.ajax({
                            url: "all_estms.php",
                            dataType : "TEXT",
                            type : 'POST',
                            data:{
                                action : "updateVersion",
                                id : id,
                                val : value
                            },
                            success: function (response) {
                                alert(response);
                            }
                        })
                    }
                })
    })
    </script>

<?php } 

function updateVersion(){
    require "../model/database.php";
    $id = $_POST['id'];
    $val = intval($_POST['val']);
    // global $con;
    $query = mysqli_query($con,"UPDATE `tbl_saved_estimates` SET `version` = {$val} WHERE `id` = {$id}");
    if($query){
        echo "Version Updated Successfully" ;
        // print_r($_POST); 
    }else{
        echo "Error while Updating Version";
    }
}
if($_POST['action'] == "updateVersion"){
    updateVersion();
}
?>
