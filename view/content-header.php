<?php 
if(!function_exists("contentHeader")){
function contentHeader($Path){
    ?>
<div class="except content-header bg-transparent">
    <div class="except container-fluid bg-transparent">
        <div class="except row mb-2 bg-transparent">
            <div class="except col-sm-6 v">
                <!-- <h1 class="m-0"><?=$Path?></h1> -->
            </div><!-- /.col -->
            <div class="except col-sm-6 bg-transparent">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active"><?=$Path?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<?php 
    }
}
?>