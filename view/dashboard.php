<div class="content-wrapper bg-transparent except" id="dashboard" style="margin-top: 2.5%;">
    <?php
    require '../view/content-header.php';
    contentHeader('Dashboard');
    ?>

    <section class="except content">
        <div class="except container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="except row">
                <div class="except col-lg-3 col-6">
                    <!-- small box -->
                    <div class="except small-box bg-info" onclick="location.href = 'index.php'">
                        <div class="except inner">
                            <h3 class="text-info">.</h3>

                            <p class="except">Dashboard</p>
                        </div>
                        <div class="except icon">
                            <i class="fa fa-tachometer-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="except col-lg-3 col-6">
                    <!-- small box -->
                    <div class="except small-box bg-success" onclick="location.href = 'index.php?all'">
                        <div class="except inner">
                            <?php
                            $get_estems_query = mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `emp_code` = '{$_SESSION['emp_code']}'");
                            while ($data = mysqli_fetch_assoc($get_estems_query)) {
                                $iData[] = $data['id'];
                            }

                            ?>
                            <h3><?= (gettype($iData) == "array") ? count($iData) : 0; ?></h3>

                            <p class="except">Saved Quotation</p>
                        </div>
                        <div class="except icon">
                            <i class="fa fa-folder-open "></i>
                        </div>
                        <a href="index.php?all" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="except col-lg-3 col-6">
                    <!-- small box -->
                    <div class="except small-box bg-secondary" onclick="location.href = 'index.php?create_new'">
                        <div class="except inner">
                            <h3 class="text-secondary">.</h3>
                            <p class="except">Create New</p>
                        </div>
                        <div class="except icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <a href="index.php?create_new" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="except col-lg-3 col-6">
                    <!-- small box -->
                    <div class="except small-box bg-danger" onclick="location.href = 'index.php?users'">
                        <div class="except inner">
                            <h3 class = "text-danger">.</h3>
                            <p class="except">Users </p>
                        </div>
                        <div class="except icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="index.php?users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<style>
    body{
        overflow-y: hidden;
    }
</style>
</div>