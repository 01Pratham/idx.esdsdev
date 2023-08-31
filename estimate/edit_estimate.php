<?php
if (isset($_GET['type'])) {
  include '../view/content-header.php';
  contentHeader('Estimate');
  // print_r($Editable);
  ?>
  <div class="content Main">
    <div class="container mt-2 Main">
      <form action="final_quotation.php" class="form1" id="form1" method="post">

        <div hidden>
          <?php if (isset($_GET['pot_id'])) { ?>
            <input type="hidden" name="quot_type" value="<?= $_GET['type'] ?>">
            <input type="hidden" name="price_list" value="<?= $_GET['list'] ?>">
            <input type="hidden" name="pot_id" value="<?= $_GET['pot_id'] ?>">
            <input type="hidden" name="project_name" value="<?= $_GET['project_name'] ?>">
            <?php
            $p = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `id` = '{$_SESSION['edit_id']}' "));
            if ($p['pot_id'] != $_POST['pot_id']) {
              echo "<input type = 'hidden' name = 'old_pot' value = '{$p['pot_id']}' >";
            }
          } else { ?>

            <input type="hidden" name="quot_type" value="<?= $Editable['quot_type'] ?>">
            <input type="hidden" name="price_list" value="<?= $Editable['price_list'] ?>">
            <input type="hidden" name="pot_id" value="<?= $Editable['pot_id'] ?>">
            <input type="hidden" name="project_name" value="<?= $Editable['project_name'] ?>">
          <?php } ?>
          <input type="hidden" name="version" value=" <?php echo $data_query['version'] ?> ">
        </div>

        <div class="mytabs my-2" id="myTab">
          <input type="hidden" name="count_of_est" id="count_of_est" value=1>

          <?php
          require '../view/DC_DR.php';
          require '../view/Colocation.php';

          $getTypeQuot = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_quot_type` WHERE `id` = '{$_GET['type']}'"));
          $getTypeQuot['template_name'](1, 1);
          ?>
        </div>
        <div class="light py-2 rounded d-flex justify-content-center my-4">
          <button class="Next-Btn" name="proceed" formtarget="_blank">Proceed <i
              class="px-2 py-2  fa fa-angle-double-right"></i></button>
        </div>
      </form>
      <div class="except fab-container d-flex align-items-end flex-column">
        <div class="except fab shadow fab-content">
          <i class="except icons fa fa-ellipsis-v text-white" title="Actions"></i>
        </div>
        <?php
        $potQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `pot_id` = '{$_GET['pot_id']}' AND `emp_code` = '{$_SESSION['emp_code']}'"));
        // print_r($potQuery);
        if (!isset($_GET['edit_id']) && empty($potQuery['id'])) { ?>
          <div class="except sub-button shadow  btn btn-outline-success action" id="save">
            <i class="except icons fa fa-save"></i>
          </div>
        <?php } else { ?>
          <div class="except sub-button shadow btn btn-outline-info action" title="Update" id="update">
            <i class="except icons fa fa-files-o" title="Update"></i>
          </div>
        <?php } ?>
      </div>

    </div>
  </div>

  <script>
    $(document).ready(function () {
      get_default();
      remove_arrow();
    })

    $(".action").click(function () {
      let act = $(this).prop('id');
      $.ajax({
        url: "../controller/test.php",
        method: "post",
        dataType: "TEXT",
        data: $("#form1").serialize(),
        success: function (res) {
          $.ajax({
            url: '../model/remove_estmt.php',
            dataType: "TEXT",
            method: "post",
            data: {
              action: act,
              'emp_id': <?= $_SESSION['emp_code'] ?>,
              data: res,
              'pot_id': '<?= $_GET['pot_id'] ?>',
              'project_name': '<?= $_GET['project_name'] ?>',
              'period': $('#period_1').val(),
            },
            success: function (response) {
              alert(response)
              if (act == "save") {
                window.location.href = "index.php?all";
              }else{
                alert("Quotation updated Successfully ")
              }
            }
          })
        }
      })
    })
  </script>

<?php
}

?>