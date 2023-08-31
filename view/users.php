<?php

function Users($id, $master = '')
{
    global $con;
    if ($id == "*") {
        $user_query = mysqli_query($con, "SELECT * FROM `login_master`");
    } else {
        $user_query = mysqli_query($con, "SELECT * FROM `login_master` WHERE `manager_code` = '{$id}'");
    }
    if ($id != "*") {
?>


        <?php
    }
    while ($users = mysqli_fetch_assoc($user_query)) {
        if (!empty($users['id'])) {
            $iUsers[] = $users['employee_code'];
            if ($_SESSION['emp_code'] == $users['employee_code']) {
                continue;
            }
            $quer = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM `login_master` WHERE `manager_code` = '{$users['employee_code']}'"));
        ?>

            <tr class=" align-middle subUsers">
                <td class="col-4">
                    <div class="except d-flex align-items-center">
                        <!-- <span class="fa fa-angle-down "></span>     -->
                        <img src="../include/dist/img/avatar.png" class="avatar sm rounded-pill me-3 flex-shrink-0" alt="Customer">
                        <div>
                            <div class="except h6 mb-0 lh-1 mx-2">
                                <?= $users['first_name'] . " " . $users['last_name'] ?>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="col-2 text-center">
                    <?= $users['employee_code'] ?>
                </td>
                <td class="col-4 text-center"> <span class="d-inline-block align-middle">
                        <?= $users['designation'] ?>
                    </span></td>
                <td class="text-center">
                    <div class="except drodown">
                        <a data-bs-toggle="dropdown" href="#" class="btn p-1" aria-expanded="false" onclick="preventdefault()">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                        <div class="except dropdown-menu dropdown-menu-end text-light" style="min-width: 8rem; z-index:1 ">
                            <?php
                            if ($id == "*") {
                                echo "<a href='index.php?share_id={$_GET['share_id']}&emp_id={$users['employee_code']}' class='dropdown-item'>Share</a>";
                            } else {
                                echo "<a href='index.php?all={$users['employee_code']}' class='dropdown-item'>View Estimates</a>";
                            }
                            ?>
                        </div>
                    </div>

                </td>
            </tr>

        <?php
            // print_r(empty($quer));
            if (!empty($quer)) {
                Users($users['employee_code'], $id);
            }
        } else {
            $iData = 0;
        }
        ?>

    <?php
    }
}


function allUsers($type = "")
{
    require '../view/content-header.php';
    contentHeader('Team Details');
    require '../model/database.php';
    ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="except  mt-3 mx-3">
        <div class="except row">
            <div class="except col-12 mb-3 mb-lg-5">
                <div class="except table-card">
                    <div class="except table-responsive">
                        <table class="table mb-0 rounded-2">
                            <thead class="small text-uppercase bg-body text-muted">
                                <tr class="border-bottom">
                                    <th class="col-4">Name</th>
                                    <th class="col-2 text-center">Employee Code</th>
                                    <th class="col-4 text-center">Designation</th>
                                    <th class="text-end col-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_query = mysqli_query($con, "SELECT * FROM `login_master` WHERE `manager_code` = '{$_SESSION['emp_code']}'");
                                if (empty(mysqli_fetch_assoc($user_query)['id']) && $type != "share") {
                                    echo "
                                    <tr>
                                        <td colspan = '2' class = 'text-center'> There is No User in your TEAM. </td>
                                    </tr>
                                    <style>
                                        body{
                                            overflow-y: hidden;
                                        }
                                    </style>
                                ";
                                } else {
                                    if ($type == "share") {
                                        Users("*");
                                    } else {
                                        Users($_SESSION['emp_code'], $_SESSION['emp_code']);
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
}
?>