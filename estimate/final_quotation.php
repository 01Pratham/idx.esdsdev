<?php
session_start();
if (!isset($_SESSION['emp_code'])) {
    require "../view/session_expired.php";
    exit();
}
$_SESSION['post_data'] = $_POST;
$ProjectTotal = array();
$MothlyTotal = array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require '../model/database.php';
    require '../controller/constants.php';
    require '../controller/json_format.php';
    require '../controller/Currency_Format.php';
    require '../view/includes/header.php';
    ?>
    <link rel="stylesheet" href="../css/submit.css">
</head>

<body class="sidebar-mini layout-fixed sidebar-collapse" data-new-gr-c-s-check-loaded="14.1111.0" data-gr-ext-installed style="height: auto; overflow-x: hidden;">
    <?php
    require "../view/includes/nav.php";
    ?>
    <div class="content-wrapper except bg-transparent">
        <?php
        require '../view/content-header.php';
        contentHeader('Quotation');
        ?>
        <div class="content Main except ">
            <div class="container-fluid except full" style="zoom : 65%">
                <div class="errors except container" style="max-width: 2020px; margin: auto; "> </div>
                    <?php
                    require '../view/Table.php';
                    require '../view/summary_table.php' 
                    ?>
                <div class="container except d-flex justify-content-center mt-3 py-3">
                    <button class="btn btn-outline-success btn-lg mx-1" id="export"><i class="fa fa-file-excel-o pr-2"></i> Export</button>
                    <button class="btn btn-outline-success btn-lg mx-1" id="exportShareable"><i class="fa fa-file-excel-o pr-2"></i> Export as Shareable</button>
                    <button class="btn btn-outline-success btn-lg mx-1" id="push" onclick="Push()"><i class="fab fa-telegram-plane pr-2" aria-hidden="true"></i>Push</button>
                    <?php
                    $query = mysqli_fetch_assoc(mysqli_query($con , "SELECT * FROM `tbl_saved_estimates` WHERE `pot_id` = '{$_POST['pot_id']}' AND emp_code = '{$_SESSION['emp_code']}'"));
                    if(!empty($query['id'])){
                    ?>
                        <button class="btn btn-outline-success btn-lg mx-1 save" id="update"><i class="fas fa-refresh pr-2"></i> Update</button>
                    <?php 
                    }
                    else{ ?>  
                        <button class="btn btn-outline-success btn-lg mx-1 save" id="save"><i class="fas fa-save pr-2"></i> Save</button>
                    <?php } ?>  
                </div>
                <?php
                    $temp =  json_encode(json_template($Sku_Data, $I_M), JSON_PRETTY_PRINT);
                    // echo "<pre>";print_r($Infrastructure);echo "</pre>";    
                ?>
            </div>
        </div>
    </div>


    <?php
    require '../view/includes/footer.php';
    ?>
    <script src="../javascript/jquery-3.6.4.js"></script>
    <script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


    <script>
        $('.nav-link').removeClass('active')
        $('#create').addClass('active');
        <?php
        if (UserRole($get_emp["user_role"]) == "User") { ?>
            $('#push').remove();
        <?php }
        ?>

        

        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "../model/database.php",
                dataType: "TEXT",
                data: {
                    type: "buffer",
                    buffer: <?= array_sum($MothlyTotal) * 0.05 ?>
                },
                success: function(response) {
                    // alert ("Contingency Buffer has been added into your quotation : " + response);
                }
            })
        });
        function Push() {
            $.ajax({
                type: 'POST',
                url: "../controller/push.php",
                dataType: "TEXT",
                data: {
                    action: 'push',
                    data: '<?= base64_encode($temp) ?>'
                },
                success: function(response) {
                    alert(response);
                }
            })
        }
        <?php
        if (UserRole($get_emp["user_role"]) == "Super Admin") { ?>
            $('.discount').attr('contentEditable', 'true')
            var mrc = $('#vm-mrc').html();
            $(".discount").keypress(function(e) {
                var key = e.keyCode || e.charCode;
                if (key == 13) {
                    $(this).blur();
                    $(this).html();
                }
                $(this).on('blur', function() {
                    if ($(this).html() > 10) {
                        $('.errors').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Maximum Discount limit is only 10%. <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="remAlert()"><span aria-hidden="true">&times;</span></button></div>')
                        var val = 0;
                        $(this).html(0)
                    } else {
                        var val = $(this).html();
                    }
                    var unit = $(this).parent().find('.qty').html();
                    var cost = $(this).parent().find('.cost').html();
                    var mrc = $(this).parent().find('.mrc');
                    cost = cost.replace(',', "");
                    cost = cost.replace('₹', "");
                    unit = unit.replace('  NO', "")
                    $.ajax({
                        type: 'POST',
                        url: "../controller/discounting.php",
                        dataType: 'Text',
                        data: {
                            type: "Discount",
                            percent: val,
                            qty: unit,
                            cost: cost
                        },
                        success: function(response) {
                            // console.log(response);
                            mrc.html(response);
                        }
                    })

                    $('#alert_btn').on('click', function() {
                        $(this).remove();
                    })
                })
            })
        <?php 
        }
        ?>
        let sheetNames = {
            <?php
            $i = 1;
            foreach ($estmtname as $key => $val) {
                echo "'sheet{$i}' : '{$val}' ,";
                $i++;
            }
            echo "sheet{$i} : 'Summary Sheet'";
            ?>}

        $(document).ready(function() {
            $("#export").click(function() {
                var tables = document.querySelectorAll('table');
                convertTablesToExcel(Array.from(tables), "unShareable", sheetNames, "<?= $_POST['project_name'] ?>");
            });
            $("#exportShareable").click(function() {
                var tables = document.querySelectorAll('table');
                convertTablesToExcel(Array.from(tables), "Shareable", sheetNames, "<?= $_POST['project_name'] ?>");
            });
        });

        function remAlert() {
            $('.alert').remove();
        }
        $('.save').click(function() {
            $.ajax({
                type: "POST",
                url: '../model/remove_estmt.php',
                data: {
                    'action': $(this).prop("id"),
                    'emp_id': <?= $_SESSION['emp_code'] ?>,
                    'data': '<?= json_encode($_POST) ?>',
                    'total': '<?= array_sum($ProjectTotal) ?>',
                    'pot_id': '<?= $_POST['pot_id'] ?>',
                    'project_name': '<?= $_POST['project_name'] ?>',
                    'period': <?= $period[1] ?>,
                },
                dataType: "TEXT",
                success: function(response) {
                    alert("Data Saved Successfully");
                }
            });
        })

        $(document).ready(function() {
            $('.full').find('.mng_qty').each(function() {
                var tr_val = $(this).html()
                if (tr_val == "0 NO") {
                    $(this).parent().find('td').each(function() {
                        $(this).addClass('bg-danger')
                    })
                }
            })
        })
        window.addEventListener('beforeunload',
            function(e) {
                let conf = confirm("Are You sure want to unsave this Estimate ? ");
                if (conf) {} else {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
    </script>
</body>

</html>