<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php">EnakBenerCafe Cashier Panel</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php
                if(!isset($_SESSION['user'])) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-right" style="float: right">
                <a class="nav-link" href="register.php">Register</a>
            </li>
            <?php
                } else {
            ?>
            <li class="nav-item float-sm-right">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>