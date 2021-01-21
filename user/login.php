<?php
include("include/header.php");
if(isset($_SESSION['user'])) {
    header("Location: http://localhost:63342/UTSPBO2FINALE/user/index.php");
}
if(isset($_POST['submit'])) {
    $user->auth($_POST['email'], $_POST['pass']);
}
?>

    <div class="container-fluid" style="margin-top: 25px;">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <div class="card center">
                    <div class="card-header text-sm-center">
                        Login Here
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
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter Password">
                            </fieldset>
                            <input class="btn btn-primary float-sm-right" type="submit" value="Login" name="submit">
                        </form>

                    </div>
                </div>
            </div>
        </div>

<?php include("include/footer.php"); ?>