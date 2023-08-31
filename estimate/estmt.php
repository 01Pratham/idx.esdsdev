<div class="except content-wrapper Main bg-transparent" >
    <?php
//  print_r($_SERVER);

    if (empty($_SERVER['QUERY_STRING'])) {
        unset($_SESSION['post_data']);
        unset($_SESSION['edit_id']);
    }
    // elseif (isset($_GET['priceBook'])) {
    //     unset($_SESSION['post_data']);
    //     require '../view/priceBook.php';
    //     priceBook();
    //     echo "
    //     <script>
    //         $('.nav-link').removeClass('active')
    //         $('#priceBook').addClass('active')
    //     </script>";
    // } elseif (isset($_GET['data_id'])) {
    //     unset($_SESSION['post_data']);
    //     require '../view/TableEditAdmin.php';
    //     EditTableEstmt();
    //     echo "
    //     <script>
    //         $('.nav-link').removeClass('active')
    //         $('#priceBook').addClass('active')
    //     </script>";
    // } 
    elseif (isset($_GET['all'])) {
        unset($_SESSION['post_data']);
        echo "
        <script>
            $('#dashboard').remove()
            $('.nav-link').removeClass('active')
            $('#allEstms').addClass('active')
        </script>
        ";
        require 'all_estms.php';
        if (!empty($_GET['all'])) {
            allEstimates($_GET['all'], $_GET['all']);
        } else {
            allEstimates($_SESSION['emp_code']);
        }

        if (isset($_GET['delete_id'])) {
            echo "
            <script> 
            
                let action = confirm('Are you Sure wanted to delete this ? ');
                if (action) {
                    $.ajax({
                        type: 'POST',
                        url: '../model/remove_estmt.php',
                        data: {
                            'action': 'Delete',
                            'post_data': {$_GET['delete_id']}
                        },
                        dataType: 'TEXT',
                        success: function(response) {
                            alert('Deleted the Estimate');
                            window.location.href = 'index.php?all';
                        }
                    });
                } else {
                    window.location.href = 'index.php?all';
                }
            </script>";
        }
    } elseif (isset($_GET['create_new'])) {
        unset($_SESSION['post_data']);
        unset($_SESSION['edit_id']);
        echo "<script>
                $('#dashboard').remove()
                $('.nav-link').removeClass('active')
                $('#create').addClass('active');
            </script>";
        require('../view/create_new.php');
        CreateNew();
    } elseif (isset($_SESSION['post_data'])) {
        // require('../view/create_new.php');
        require('edit_estimate.php');
        echo "<script>$('#dashboard').remove()</script>";
        exit();
    } elseif (isset($_GET['edit_id'])) {
        unset($_SESSION['post_data']);
        $_SESSION['edit_id'] = $_GET['edit_id'];
        require "../model/editable.php";
        echo "
        <script>
            $('#dashboard').remove()
            $('.nav-link').removeClass('active')
            $('#create').addClass('active')
        </script>";


        require('../view/create_new.php');
        CreateNew();
        require('edit_estimate.php');
        if ($Editable['count_of_est'] > 1) {
            echo "<script>add_estmt()</script>";
        }
        if (isset($_GET['edit_id']) && isset($_GET['next'])) {
            echo "<script> 
                $('.Create').remove(); 
                $('#dashboard').remove()
                $('.nav-link').removeClass('active');
                $('#create').addClass('active')
            </script>";
            // require('edit_estimate.php');
        }
    } elseif (!isset($_GET['edit_id']) && isset($_GET['next'])) {

        echo "<script>
                    $('#dashboard').remove()
                    $('#create_Main').remove();
                    $('.nav-link').removeClass('active')
                    $('#create').addClass('active')
                </script>";
        require('edit_estimate.php');
    } elseif (isset($_GET['clone_id'])) {
        $qoutaion = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `emp_code`='{$_SESSION['emp_code']}' AND `id` = '{$_GET['clone_id']}' "));
        $version = intval($qoutaion['version']) + 1;

        mysqli_query(
            $con,
            "INSERT INTO `tbl_saved_estimates`(
            `emp_code`, 
            `pot_id`, 
            `project_name`, 
            `version`,
            `owner`,
            `last_changed_by`,
            `date_created`, 
            `date_updated`, 
            `contract_period`, 
            `total_upfront`, 
            `data`) VALUES (
            '{$_SESSION['emp_code']}',
            '{$qoutaion['pot_id']}',
            '{$qoutaion['project_name']}',
            '{$version}',
            '{$qoutaion['owner']}',
            '{$qoutaion['last_changed_by']}',
            '{$qoutaion['date_created']}',
            '{$qoutaion['date_updated']}',
            '{$qoutaion['contract_period']}',
            '{$qoutaion['total_upfront']}',
            '{$qoutaion['data']}')"
        );

        echo "<script> alert('Estimate Cloned Successfully'); window.location.href = 'index.php?all'</script>";
    } elseif (isset($_GET['share_id'])) {
        require '../view/users.php';
        allUsers('share');
        if (isset($_GET['emp_id'])) {
            $qoutaion = mysqli_fetch_array(mysqli_query(
                $con,
                "SELECT * FROM `tbl_saved_estimates` WHERE  
            `id` = '{$_GET['share_id']}' "
            ));

            $emp = employee($_GET['emp_id']);
            $share_quer = mysqli_query(
                $con,
                "INSERT INTO `tbl_saved_estimates`(
            `emp_code`, 
            `pot_id`, 
            `project_name`, 
            `version`,
            `owner`,
            `last_changed_by`,
            `date_created`, 
            `date_updated`, 
            `contract_period`, 
            `total_upfront`, 
            `data`) VALUES (
            '{$_GET['emp_id']}',
            '{$qoutaion['pot_id']}',
            '{$qoutaion['project_name']}',
            '{$qoutaion['version']}',
            '{$qoutaion['owner']}',
            '{$qoutaion['last_changed_by']}',
            '{$qoutaion['date_created']}',
            '{$qoutaion['date_updated']}',
            '{$qoutaion['contract_period']}',
            '{$qoutaion['total_upfront']}',
            '{$qoutaion['data']}')"
            );

            if ($share_quer) {
                echo  "<script> alert('Estimate Shared to " . $emp['first_name'] . " " .  $emp['last_name'] . " Successfully'); window.location.href = 'index.php?all'</script>";
            } else {
                echo "<script>alert('Error While Sharing Data')</script>";
            }
        }
    } else if (isset($_GET['users'])) {
        require '../view/users.php';
        allUsers();
        echo "<script>
        $('.nav-link').removeClass('active')
        $('#teamUsers').addClass('active')
        </script>";
    } else {
        echo "<h1>404 Page Not Found</h1>";
    }

    // print_r($_SERVER);

    ?>

</div>
<script>
    $(".edit").click(function() {

        $("#form").remove();
        if (typeof($("#edit_form").val()) == 'undefined' || $("#edit_form").val() == null) {
            data_id = $(this).attr("name")
            $.ajax({
                type: "POST",
                url: "edit_estimate.php",
                data: {
                    post_data: data_id
                },
                dataType: "TEXT",
                success: function(response) {
                    $('.editable').append(response);
                }
            });
        } else {    
            alert("The Data has already been Showed")
        }
    })
</script>

<script src="../javascript/main.js"></script>