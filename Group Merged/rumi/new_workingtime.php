<html>

<head>
    <title>New Working Time</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <!-- first row -->
            <div class="col-12 mb-2 bg-light">
                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
                    <a class="btn btn-outline-warning ml-2" href="logout.php"><i class="fa fa-sign-out"
                            aria-hidden="true"></i>
                        Logout
                    </a>
                </nav>
            </div>

            <!-- 2nd row -->
            <!-- col 1 -->
            <div class="col-2 bg-light border">
                <nav class=" d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link btn btn-info mb-2 mt-2" href="#">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-info mb-2" href="admin_workingtime.php">
                                    Working TIme
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-info mb-2" href="admin_payment.php">
                                    Payments
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <!-- col 2 -->
            <div class="col-10 bg-transparent">
                <div class="container-fluid">

                    <form method="POST" action="insertworkingtime.php" name="datavalid"
                        onsubmit="return validateForm()">
                        <div class="form-group row">
                            <label for="t_id" class="col-sm-2 col-form-label">t_id</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="t_id" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="u_id" class="col-sm-2 col-form-label">u_id</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="u_id" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_hour" class="col-sm-2 col-form-label">t_hour</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="t_hour" value="" required>
                                <small id="t_hourhelp" class="form-text text-muted">Enter Float Number
                                    Only.</small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"> Save</button>

                    </form>
                    <script>
                    function validateForm() {
                        var thour = document.forms["datavalid"]["t_hour"].value;
                        if (!isFinite(pit)) {
                            alert("hour must be float");
                            return false;
                        }
                    }
                    </script>
                </div>
            </div>
        </div>
    </div>
</body>

</html>