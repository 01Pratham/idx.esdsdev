<?php
if (isset($_POST['name'])) {
    session_start();
    require '../model/database.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $count = $_POST['count'];
    require '../view/Components/VirtualMachine.php';
    vmContent($name, $id, $count, 'ajax' , $_POST['cloneId'] );
    echo "
        <script>
            get_default();
            $('#region_{$id}').val('{$_POST['reg_val']}');
            $('#sector_{$id}').val('{$_POST['sect_val']}');

            $('#rem-vm_{$id} ').on('click',function() {
                $('#vmHead_{$id},#vm_collapse_{$id}').remove();
            })
        </script>
    ";
// require '../view/includes/footer.php';

?>

<script>
    <?php 
    if (!empty($_POST['cloneId'])) {
                $cloneId = $_POST['cloneId'];
            ?>
                $('#vm_collapse_<?= $id ?>').find("select,input").each(function() {
                    if ($(this).prop('type') === "button") {

                    } else if ($(this).prop('type') === "checkbox") {
                        let newId = $(this).prop('id')
                        let oldId = newId.replace(/<?= $id ?>/g, <?= $cloneId ?>);
                        if ($("#" + oldId).prop('checked')) {
                            $("#" + newId).attr("checked", $("#" + oldId).prop('checked'));
                        }
                    } else if ($(this).prop("type") == "hidden") {
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

</script>
<?php }
}
?>