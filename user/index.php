<?php
include("include/header.php");
if(!isset($_SESSION['user'])) {
    header("Location: http://localhost:63342/UTSPBO2FINALE/user/login.php");
}
?>

<div class="container-fluid" style="margin-top: 25px;">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <div class="card center">
                <div class="card-header text-sm-center">
                    Dashboard
                </div>
                <div class="card-block">
                    <h2> Halo <?php echo $_SESSION['user']->nama ?> </h2>
                    <a href="../index.php"><button>Lanjut ke mesin kasir</button></a>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>

