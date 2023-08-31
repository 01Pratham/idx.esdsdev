<?php 
require "../view/content-header.php";
contentHeader("Rate Cards");
?>
<div class="row except  mt-3 mx-3">
    <div class="input-group col-4 bg-transparent">
        <input type="text" name="searchBox" id="searchBox" class="form-control" aria-describedby="">
        <span class="input-group-text p-0 form-control col-sm-1 bg-light" id="searchBox">
            <i class="fa fa-search Center"></i>
        </span>
    </div>
    <div class="form-group ml-auto">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-m">Create Rate
            Card</button>
    </div>
    <div class="modal fade bd-example-modal-m except" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-m">
            <div class="modal-heading text-center border-bottom">
                <h4>Create Rate Card</h4>
            </div>
            <div class="modal-content py-2 border-0">
                <form>
                    <div class="form-group mx-2">
                        <h6><small><span class="text-danger"> * </span>Rate Card Name : </small></h6>
                        <input type="text" class="form-control" id="rateCardName" required>
                    </div>
                    <div class="form-group mx-2">
                        <input type="button" value="Submit" id="rateCardSubmit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="except  mt-3 mx-3">
    <div class="except row">
        <div class="except col-12 mb-3 mb-lg-5">
            <div class="except table-card">
                <div class="except table-responsive">
                    <table class="table mb-0 rounded-2">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr class="border-bottom">
                                <th class="col-1">#</th>
                                <th class="col-2 text-center">Rate Card Name</th>
                                <th class="col-1 text-center">Created By</th>
                                <th class="col-2 text-center">Created Date</th>
                                <th class="col-2 text-center">Is Active</th>
                                <th class="col-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rateCareQuery = mysqli_query($con, "SELECT * FROM `tbl_rate_cards`");
                            $i = 1;
                            while ($rateCard = mysqli_fetch_assoc($rateCareQuery)) {
                                ?>
                                <tr class="border-bottom">
                                    <td class="col-1">
                                        <?= $i ?>
                                    </td>
                                    <td class="col-4 text-center">
                                        <?= $rateCard['rate_card_name'] ?>
                                    </td>
                                    <td class="col-2 text-center">
                                        <?= $rateCard['created_by'] ?>
                                    </td>
                                    <td class="col-3 text-center">
                                        <?= $rateCard['created_date'] ?>
                                    </td>
                                    <td class="col-2 text-center"><input type="checkbox" class="rateCardStatus ToogleSwitch"
                                            id="<?= $rateCard['id'] ?>" <?= ($rateCard['is_active'] == "True") ? "Checked" : ''; ?>>
                                    </td>
                                    <td class="drodown text-center">
                                        <a data-bs-toggle="dropdown" href="#" class="btn p-1" aria-expanded="false">
                                            <span class="fa fa-bars" aria-hidden="true"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end text-light"
                                            style="min-width: 8rem; z-index:1 ">
                                            <a href="?rateCardId=<?= $rateCard['id'] ?>" class="dropdown-item"><i>Edit</i><i
                                                    class="fa fa-edit float-right pt-1"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $i++;
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

<script>
    $('#rateCardSubmit').click(function () {
        $.ajax({
            url: "../model/modelRateCard.php",
            type: "POST",
            dataType: "TEXT",
            data: {
                action: 'CreateRateCard',
                rateCardName: $('#rateCardName').val(),
            },
            success: function (response) {
                alert(response);
                window.location.href = "index.php?rateCard";
            }
        })
    });

    $('.rateCardStatus').on('input', function () {
        let id = $(this).prop('id');
        $.ajax({
            url: "../model/modelRateCard.php",
            type: "POST",
            dataType: "TEXT",
            data: {
                action: 'rateCardStatus',
                id: id,
                status: $(this).prop('checked')
            },
            success: function (response) {
                alert(response);
                // window.location.href="index.php?rateCard";
            }
        })
    })
</script>