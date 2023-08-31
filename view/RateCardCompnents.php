<?php
if (isset($_GET['rateCardId'])) {
    require "../controller/Currency_Format.php";

    $id = $_GET['rateCardId'];
    $rateCard = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_rate_cards`"));
    require "../view/content-header.php";
    contentHeader("Rate Cards / {$rateCard['rate_card_name']}");
?>

    <div class="row except  mt-3 mx-3">
        <div class="input-group col-4 bg-transparent">
            <input type="text" name="searchBox" id="searchBox" class="form-control" aria-describedby="">
            <span class="input-group-text p-0 form-control col-sm-1 bg-light" id="searchBox">
                <i class="fa fa-search Center"></i>
            </span>
        </div>
        <div class="form-group ml-auto">
            <button type="button" class="btn btn-danger" id="deleteProds"> <i class="fa fa-trash"></i> Delete Items</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Add Items</button>
        </div>
        <div class="modal fade bd-example-modal-xl except" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-heading text-center border-bottom">
                    <h4>Product List</h4>
                </div>
                <div class="modal-content py-2 border-0">
                    <div class="input-group p-2 bg-transparent">
                        <input type="text" name="searchBox" id="searchBox" class="form-control" aria-describedby="">
                        <span class="input-group-text p-0 form-control col-sm-1 bg-light" id="searchBox">
                            <i class="fa fa-search Center"></i>
                        </span>
                    </div>
                    <div class="except table-card mx-2">
                        <div class="except table-responsive">
                            <table class="table mb-0 rounded-2">
                                <thead class="small text-uppercase bg-body text-muted">
                                    <tr class="border-bottom">
                                        <th><input type="checkbox" name="" id="SelectAll" class='from-control' oninput="$('.prodChecks').each(function(){($(this).click())})"></th>
                                        <th class="col-8 text-center">Product Name</th>
                                        <th class="text-center">Product Prices</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $productPricesQuery = mysqli_query($con, "SELECT * FROM `price_list`");
                                    while ($product = mysqli_fetch_assoc($productPricesQuery)) {
                                        $productRateQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `rate_card_prices` WHERE `rate_card_id` = '{$id}' AND `prod_id` = '{$product['id']}'"));
                                        // echo $productRateQuery['id'];
                                    ?>
                                        <tr class="border-bottom" onclick="//$('#<?= $product['id'] ?>').click()">
                                            <td>
                                                <input type="checkbox" name="" id="<?= $product['id'] ?>" class='from-control prodChecks <?= (!empty($productRateQuery['id'])) ? "Present" : "" ?>' <?= (!empty($productRateQuery['id'])) ? "Checked" : ''; ?>>
                                            </td>
                                            <td class="col-4 text-center">
                                                <?= $product['product'] ?>
                                            </td>
                                            <td class="col-4 text-center">
                                                <?= INR($product['price']) ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-center prodDIv" >
                                            <button class="btn btn-primary except" id="addProds"> Add Products</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                                    <th><input type="checkbox" name="" id="" class="selectActionProds" oninput="$('.selectProds').each(function(){$(this).click()})"></th>
                                    <th>#</th>
                                    <th class="text-start">Product</th>
                                    <?=($_GET['rateCardId'] != "1") ? '<th class="text-center">General Price</th>' : '' ?>
                                    <th class="text-center">Configured Price</th>
                                    <th class="text-center">Is Active</th>
                                    <!-- <th class="text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rateCardQuery = mysqli_query($con, "SELECT * FROM `rate_card_prices` WHERE `rate_card_id` = '{$id}'");
                                $i = 1;
                                while ($prods = mysqli_fetch_assoc($rateCardQuery)) {
                                    $generalPrice = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `rate_card_prices` WHERE `rate_card_id` = 1 AND `prod_id` = '{$prods['prod_id']}' "));
                                ?>
                                    <tr class="border-bottom">
                                        <td><input type="checkbox" name="" id="prods_<?= $prods['id'] ?>" class="selectProds"></td>
                                        <td class="">
                                            <?= $i ?>
                                        </td>
                                        <td class="text-start">
                                            <?= GetVal($prods['prod_id'])['product'] ?>
                                        </td>
                                        <?php  
                                        if ($_GET['rateCardId'] != "1") {?> <td class='text-center'><?=INR($generalPrice['price'])?> </td> <?php }?>
                                        <td class="text-center Price" contenteditable="true" id="price_<?= $prods['id'] ?>">
                                            <?= (!empty($prods['price'])) ? INR($prods['price']) : INR(0) ?>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="prodStatus ToogleSwitch" id="status_<?= $prods['id'] ?>" <?= ($prods['is_active'] == "True") ? "Checked" : ''; ?>>
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
        let Loader = '<div class="spinner-grow text-light mx-1  except" role="status"><span class="sr-only except"></span></div>';
        $('#addProds').click(function() {
            $(this).attr('disabled','true'); 
            $(this).html(Loader.repeat(4));
            let prods = {
                add : {},
                rem : {}
            }
            let i = 1;
            $(".prodChecks").each(function() {
                if ($(this).prop("checked")) {
                    if ($(this).hasClass('Present')) {

                    } else {
                        prods.add[i] = $(this).prop('id')
                    }
                } else if ($(this).hasClass('Present')) {
                    prods.rem[i] = $(this).prop('id')
                }
                i++;
            })
            if (Object.keys(prods.rem) != '') {
                AJAX({
                    action: "RemoveProduct",
                    prods: prods.rem,
                    rateCardId: <?= $id ?>
                })
                // console.log(prods.rem);
            }
            if (Object.keys(prods.add) != '') {
                AJAX({
                    action: "AddProducts",
                    prods: prods.add,
                    rateCardId: <?= $id ?>
                })
                // console.log(prods.add);
            }
        });
        $('.prodStatus').each(function() {
            
            $(this).on('input', function() {
                let id = $(this).prop('id').replace("status_", '');
                AJAX({
                    action: 'UpdateProduct',
                    id: id,
                    status: $(this).prop('checked')
                })
            })
        })

        $("#deleteProds").click(function() {
            $(this).attr('disabled','true'); 
            $(this).html(Loader.repeat(4));
            let prods = {}
            let i = 1
            $(".selectProds").each(function() {
                if ($(this).prop("checked")) {
                    prods[i] = $(this).prop('id').replace('prods_', '');
                }
                i++;
            });
            AJAX({
                action: 'DeleteProduct',
                prods: prods,
            });
        })

        $(".Price").keypress(function(e) {
            var key = e.keyCode || e.charCode; // ie||others
            if (key == 13) { // if enter key is pressed            
                $(this).blur();
            }
            $(this).on('blur', function() {
                let id = $(this).prop('id').replace("price_", '');
                AJAX({
                    action: 'UpdateProduct',
                    id: id,
                    price: parseInt($(this).html().replace("₹ ", ''))
                })
            })
        })
    </script>



<?php
}

?>