<?php
include("include/header.php");
if(isset($_SESSION['user'])) {
    header("Location: http://localhost:63342/UTSPBO2FINALE/user/index.php");
}
if(isset($_POST['submit'])) {
    $user->register($_POST);
}
?>

    <div class="container-fluid" style="margin-top: 25px;">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <div class="card center">
                    <div class="card-header text-sm-center">
                        Register Here
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
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                       value="<?php echo @$_POST['name'] ?>" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email"
                                       value="<?php echo @$_POST['email'] ?>" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter Password">
                            </fieldset>
                            <input class="btn btn-primary float-sm-right" type="submit" value="Register" name="submit">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("include/footer.php"); ?>