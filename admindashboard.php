<?php
session_start();
if (isset($_SESSION["sessionuser"])) {
  if (isset($_SESSION["sessionadmin"]) && $_SESSION["sessionadmin"] == 'false') {
    readfile('503error.html');
    exit();
  }
} else {
  readfile('503error.html');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="css/dashstyle.css" />
  <title>IJMESRT-Dashboard</title>
</head>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #252E67;">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Admin Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <form class="d-flex ms-auto my-3 my-lg-0">
          <div class="input-group">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href=index.html>Home</a></li>
              <li><a class="dropdown-item" href=logout.php>Log Out</a></li>

            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- top navigation bar -->
  <!-- offcanvas -->
  <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="sidebar" style="background-color: #252E67;">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3">
              CORE
            </div>
          </li>
          <li>
            <a href="#" class="nav-link px-3 active">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Reviewer Dashboard</span>
            </a>
          </li>
          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              Interface
            </div>
          </li>
          <li>
            <a href="addreviewer.html" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-plus"></i></span>
              <span>Add Reviewer</span>
            </a>
          </li>


          <li>
            <a href="removereviewer.html" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-x"></i></span>
              <span>Remove Reviewer</span>
            </a>
          </li>
          <!-- <li>
            <a href="" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-plus"></i></span>
              <span>Add Author</span>
            </a>
          </li> -->


          <!-- <li>
            <a href="" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-x"></i></span>
              <span>Delete Author</span>
            </a>
          </li> -->
          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              Addons
            </div>
          </li>
          <li>
            <a href="#" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-check-circle"></i></span>
              <span>New Reviewer Invitation</span>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </div>
  <!-- offcanvas -->
  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4>Dashboard</h4>
        </div>
      </div>
      <div class="row">
        <?php
        require('connection.php');
        $compl = "SELECT * FROM article WHERE status='completed'";
        $pend = "SELECT * FROM article WHERE status='pending'";
        $decl = "SELECT * FROM article WHERE status='declined'";
        $close = "SELECT * FROM article WHERE status='closed'";
        $result1 = mysqli_query($conn, $compl);
        $result2 = mysqli_query($conn, $pend);
        $result3 = mysqli_query($conn, $decl);
        $result4 = mysqli_query($conn, $close);
        if ($result1 && $result2 && $result3 && $result4) {
          $count1 = mysqli_num_rows($result1);
          $count2 = mysqli_num_rows($result2);
          $count3 = mysqli_num_rows($result3);
          $count4 = mysqli_num_rows($result4);
        }
        ?>
        <div class="col-md-3 mb-3">
          <div class="card  bg-success text-white h-100">
            <div class="card-body py-5">Completed Assignments = <?php echo $count1; ?> </div>

          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-warning text-dark h-100">
            <div class="card-body py-5">Pending Assignments = <?php echo $count2; ?></div>


          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-danger text-white h-100">
            <div class="card-body py-5">Declined Assignments = <?php echo $count3; ?></div>


          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">Closed Assignments = <?php echo $count4; ?></div>


          </div>
        </div>
      </div>

      <!--
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Area Chart Example
              </div>
              <div class="card-body">
                <canvas class="chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Area Chart Example
              </div>
              <div class="card-body">
                <canvas class="chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
      -->
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Data Table
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Affiliation</th>
                      <th>Phone</th>
                      <th>Abstract</th>
                      <th>File name</th>
                      <th>Requested Reviewer</th>
                      <th>Assign Reviewer</th>
                      <th>Current Status</th>
                      <th>Change Status</th>
                    </tr>
                  </thead>
                  <?php
                  require("connection.php");
                  $sql = 'SELECT * FROM article';
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                  ?>
                    <tbody>
                      <tr>
                        <form name="tableform" action="edit.php" onsubmit="return validation()" method="get">
                          <td>
                            <?php echo $row['username']; ?>
                          </td>
                          <td>
                            <?php echo $row['firstname']; ?>
                          </td>
                          <td>
                            <?php echo $row['lastname']; ?>
                          </td>
                          <td>
                            <input type="hidden" name="email" id="email" value="<?php echo $row['email']; ?>" />
                            <?php echo $row['email']; ?>
                          </td>
                          <td>
                            <?php echo $row['affl']; ?>
                          </td>
                          <td>
                            <?php echo $row['phno']; ?>
                          </td>
                          <td>
                            <?php echo $row['abstract']; ?>
                          </td>
                          <td>
                            <a href="uploads/<?php echo $row['filename']; ?>">
                              <?php echo $row['filename']; ?>
                            </a>
                          </td>
                          <td>
                          <input type="hidden" name="curreviewer" id="curreviewer" value="<?php echo $row['reviewer']; ?>" />
                            <?php echo $row['reviewer']; ?>
                          </td>
                          <td>
                          <select name="setreviewer" id="setreviewer">
                            <option value="<?php echo $row['reviewer'] ?>"><?php echo $row['reviewer'] ?></option>
                              <?php
                              $sql = "SELECT * FROM user WHERE admin='1'";
                              $reslt = mysqli_query($conn, $sql);
                              while ($rw = mysqli_fetch_array($reslt, MYSQLI_ASSOC)) {
                              ?>
                                <option value="<?php echo $rw['username']; ?>"><?php echo $rw['username']; }?></option>
                              
                            </select>
                          </td>
                          <td>
                            <input type="hidden" name="curstatus" id="curstatus" value="<?php echo $row['status']; ?>" />
                            <?php echo $row['status']; ?>
                          </td>
                          <td>
                            <select name="newstatus" id="newstatus">
                              <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                              <option value="completed">completed</option>
                              <option value="pending">pending</option>
                              <option value="declined">declined</option>
                              <option value="closed">closed</option>
                            </select>
                            <!-- <input type="hidden" name="status" id="status" value="?php echo $row['status']; ?>"/> -->
                          </td>
                          <td>

                            <button type="submit" name="submit" value="submit" class="btn btn-primary" onclick="return validation()">Edit</button>
                          </td>
                        </form>
                      </tr>
                    <?php
                  }
                    ?>
                    </tbody>
                    <!-- <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                      </tr>
                      
                    </tbody> -->
                    <!-- <tfoot>
                      <tr>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Affiliation</th>
                        <th>Phone</th>
                        <th>Abstract</th>
                        <th>File name</th>
                        <th>Status</th>
                      </tr>
                    </tfoot> -->

                </table>
                <script>
                  function validation() {
                    var curstatus = document.getElementById('curstatus').value;
                    var newstatus = document.getElementById('newstatus').value;
                    var curreviewer = document.getElementById('newstatus').value;
                    var newreviewer = document.getElementById('newstatus').value;
                    // console.log(curstatus,newstatus);
                    if (curstatus == newstatus && curreviewer == newreviewer) {
                      alert("No change in status");
                      return false;
                    } else {
                      <?php

                      ?>
                      return true;
                    }
                  }
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>