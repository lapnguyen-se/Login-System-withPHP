<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Welcome, <?php echo $username; ?></h3>
    </div>

    <ul class="components">
        <p>You are now logged in
            under <?php if ($_SESSION['is_admin'] == true) echo "<b><i>administrator</i></b>"; else echo "<b><i>normal</i></b>"; ?>
            privilege <br>
            <a href="logout.php">
                <button class="btn btn btn-danger btn-sm button-no-radius" name="logout"/>
                <i class="fas fa-sign-out-alt"></i> Log Out</button>
            </a>
        </p>
        <li>
            <a href="index.php" class="no-text-decoration"><i class="fas fa-home no"></i> Home</a>
        </li>
        <?php
        if ($_SESSION['is_admin'] == true) {
            echo "<li><a href='add-student.php' class='no-text-decoration'><i class='fas fa-plus-square'></i> Add new student</a></li>";
        }
        ?>

        <li>
            <a href="sensor.php" class="no-text-decoration"><i class="far fa-chart-bar"></i> View environment data</a>
        </li>
    </ul>

    <div id="search-area">
        <div class="container">
            <h5><b><i class="fas fa-search back"></i> Search Student</b></h5>
            <form action="index.php" method="post">
                <div class="form-group row">
                    <div class="col-sm-2">First name:</div>
                    <div class="col-sm-10">
                        <input type="text" class="button-no-radius" name="firstName">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Last name:</div>
                    <div class="col-sm-10">
                        <input type="text" class="button-no-radius" name="lastName">
                    </div>
                </div>
                <button class="btn btn-dark btn-lg button-no-radius float-right" name="search"/>
                Search</button>
            </form>
        </div>
</nav>