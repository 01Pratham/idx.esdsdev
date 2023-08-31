<?php
if (isset($_POST['name'])) {
    session_start();
    $cloneId = $_POST['cloneId'];
    require '../view/DC_DR.php';
    require '../model/database.php';
    require '../model/editable.php';
    $id = $_POST['id'];
    $name = $_POST['name'];

    DC_DR($name, $id, 'ajax', $cloneId);
    echo "
        <script>
            get_default();
            remove_arrow();

            $('#rem-estmt_{$id} ').on('click',function() {
                $('#est_div_{$id}').remove();
            })
            changeOnInput('#vmHead .OnInput', '#vmname_{$id}')
            changeOnInput('#estmtHead .OnInput', '#estmtname_{$id}', 'Your Estimate')
            
            window.addEventListener('beforeunload',
            function (e) {
                let conf = confirm('Are You sure want to unsave this Estimate ? ');
                if(conf){
                }else{
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        </script>
    ";

    if (!empty($_POST['cloneId'])) {

?>
        <script>
            name = <?= $name ?>;
            state = "";
            $(document).ready(function() {
                $('#est_div_<?= $id ?>').find("select,input").each(function() {
                    if ($(this).prop('type') === "button") {

                    } else if ($(this).prop('type') === "checkbox") {
                        let newId = $(this).prop('id')
                        let oldId = newId.replace(/<?= $id ?>/g, <?= $cloneId ?>);
                            if(oldId.match(/emagic/g)){

                            }else if ($("#" + oldId).prop('checked') ) {
                                $("#" + newId).click();
                            }
                    } else if ($(this).prop("name").match(/\[\]/) == '[]') {
                        let countOfVm = $("#count_of_vm_<?= $cloneId ?>").val();
                        // console.log("yes")
                        if (state != "done") {
                            for (let i = 1; i < countOfVm; i++) {
                                add_vm(i, name, <?= $id  ?>, <?= $cloneId ?> + "" + (i + 1));
                            }
                            state = "done";
                        }
                    } else
                    if ($(this).prop("type") == "hidden") {
                        // console.log($(this).val());
                    } else {
                        let newId = $(this).prop('id');
                        let oldId = newId.replace(/<?= $id ?>/g, <?= $cloneId ?>);
                        if ($("#" + newId).prop("type") == "hidden") {
                            console.log("yes");
                        } else
                        if ($("#" + oldId).val() != "") {
                            $("#" + newId).val($("#" + oldId).val());
                        }
                    }
                })
            })
        </script>




<?php }
}
// require '../view/includes/footer.php';