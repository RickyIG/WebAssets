<?php
include("include/header.php");
if(isset($_SESSION['user'])) {
    header("Location: http://localhost:63342/UTSPBO2FINALE/user/register.php");
}
if( isset($_GET['active']) || isset($_POST['submit']) ) {
    $tk = isset($_POST['submit']) ? $_POST['active'] : $_GET['active'];
    $id = isset($_POST['submit']) ? $_POST['id'] : $_GET['id'];

    $user->activate($id, $tk);
}
?>

    <div class="container-fluid" style="margin-top: 25px;">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <div class="card center">
                    <div class="card-header text-sm-center">
                        Activate your Account
                    </div>
                    <div class="card-block">
                        <?php
                        if ( isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $_SESSION['error'];
                            echo '</div>';
                            unset($_SESSION['error']);
                        }
                        ?>
                        <form method="post">
                            <fieldset class="form-group">
                                <label for="active">Activation Code</label>
                                <input type="text" class="form-control" id="active" name="active" placeholder="Enter Your Activation Code">
                            </fieldset>
                            <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                            <input class="btn btn-primary float-sm-right" type="submit" value="Activate" name="submit">
                        </form>

                    </div>

                    <div class="card-footer text-muted text-sm-center">
                        We have sent you an email, kindly activate your account<br>
                        You can copy and paste the code in above field or just use the Link to activate.
                    </div>

                </div>


            </div>
        </div>

<?php include("include/footer.php"); ?>