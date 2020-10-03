<html>
<head>
  <title>Payemnts</title>
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

          <a class="btn btn-outline-warning ml-2" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
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
                <a class="nav-link btn btn-info mb-2 mt-2" href="#"><i class="fa fa-home" aria-hidden="true"></i>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-info mb-2" href="salary.php">
                  Salary
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link btn btn-info mb-2" href="workingtime.php">
                  Working Time
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-info mb-2" href="payments.php">
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
          <table class="table table-hover table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">p_id</th>
                <th scope="col">u_id</th>
                <th scope="col">p_incomeTax</th>
                <th scope="col">p_hra</th>
                <th scope="col">p_ma</th>
                <th scope="col">p_others</th>
              </tr>
            </thead>
            <tbody>
              <?php
                  require_once('index_model.php');
                    $indObj = new IndexModel();
                    $rs = $indObj->getpayemntsinfo($_SESSION["u_id"]);
                    while($d= mysqli_fetch_assoc($rs))
                    {
                      echo $str="<tr><td>".$d["p_id"]."</td><td>".$d["u_id"]."</td><td>".$d["p_incomeTax"]."</td><td>".$d["p_hra"]."</td><td>".$d["p_ma"]."</td><td>".$d["p_others"]."</td></tr>";
                    }	
                  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>