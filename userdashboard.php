<?php
session_start();
if (!isset($_SESSION["sessionuser"])) {
    header('Location: 404error.html');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>user Dashboard</title>

</head>

<body>

    <!--   navbar   -->




    <nav class="navbar navbar-expand-sm fixed-top " style="background-color: #252E67; padding: 0.5px; ">
        <a class="navbar-brand" href="index.html">
            <img src="images/logo image.jpeg" alt="Logo" style="width:70px; padding-bottom: 10px; padding-left: 20px;">
        </a>
        <a href="index.html" class="navbar-brand fs-2">IJMESRT </a>


        <button class="navbar-toggler" " 
      type=" button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">HOME</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.html">journal Overview</a></li>
                        <li><a class="dropdown-item" href="aboutjournal.html">About Journal</a></li>
                        <li><a class="dropdown-item" href="aimsandscope.html">Aims & Scope</a></li>
                        <li><a class="dropdown-item" href="editorialboard.html">Editorial Board</a></li>
                        <li><a class="dropdown-item" href="publicationethics.html">Publication Ethics</a></li>
                        <li><a class="dropdown-item" href="peerreviewprocess.html">Peer Review Process</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown me-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="10,20">AUTHOR GUIDELINES</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="contents.html">Instruction For Authors</a></li>
                        <li><a class="dropdown-item" href="contents.html">Submission & Varification</a></li>
                        <li><a class="dropdown-item" href="contents.html">Journal Template</a></li>
                        <li><a class="dropdown-item" href="contents.html">Indexing & Abstracting</a></li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="contact.html" class="nav-link">CONTACT US</a>
                </li>
                <li class="nav-item"><a href="logout.php" class="nav-link">LOG OUT</a></li>

            </ul>
        </div>
        </div>
    </nav>

    <!---        navbar end     -->







    <!---       UPLOAD FILES     -->

    <!-- learn   -->

    <section id="learn" class="text-light" style="background-color:#ffffff;">
        <div class="container">
            <div class="row align-items-center justify-content-between ">
                <div class="col-md p-3">

                    <!-- upload  -->

                    <div class="card box-shadow mx-auto my-5 " style="max-width: 400px; background-color: #252E67;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/upload.svg" alt="">
                            </div>
                            <div class="col-md-8 col-sm-12 ">
                                <div class="card-body text-white">
                                    <h5><a href="upload.html" class="card-title card-title2  fw-bold">SUBMIT</a></h5>

                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- DOWNLOAD  -->


                    <div class="card box-shadow mx-auto my-5" style="max-width: 400px; background-color: #252E67;">
                        <?php
                        include('connection.php');
                        $username = $_SESSION['sessionuser'];
                        $sql = "SELECT filename FROM article WHERE username='$username' ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) <= 0) {
                            echo "0 results";
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/download.svg" alt="">
                                    </div>
                                    <div class="col-md-8 ">
                                        <div class="card-body text-light">
                                            <h5><a href="uploads/<?php echo $row['filename']; ?>" class="card-title card-title2  fw-bold"><?php echo $row['filename']; ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }

                        $conn->close();

                        ?>

                    </div>

                </div>



                <!-- LEARN CONTENT    -->
                <div class="col-md-8">
                    <div class="container pdetail">
                        <?php
                        if (isset($_SESSION['sessionuser'])) {
                            $username = $_SESSION['sessionuser'];
                            include('connection.php');
                            $sql = "SELECT firstname,lastname,username,email FROM user WHERE username='$username' ";

                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) <= 0) {
                                echo "0 results";
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                                    <div class="row pd">
                                        <div class="col-6 ">
                                            <p>First Name :</p>
                                        </div>
                                        <div class="col-6">
                                            <p><?php echo $row['firstname']; ?></p>
                                        </div>

                                    </div>

                                    <div class="row pd">
                                        <div class="col-6 ">
                                            <p>Last Name :</p>
                                        </div>
                                        <div class="col-6">
                                            <p><?php echo $row['lastname']; ?></p>
                                        </div>

                                    </div>

                                    <div class="row pd">
                                        <div class="col-6 ">
                                            <p>Username :</p>
                                        </div>
                                        <div class="col-6">
                                            <p><?php echo $row['username']; ?></p>
                                        </div>

                                    </div>

                                    <div class="row pd">
                                        <div class="col-6 ">
                                            <p>Email :</p>
                                        </div>
                                        <div class="col-6">
                                            <p><?php echo $row['email']; ?></p>
                                        </div>

                                    </div>

                        <?php
                                }
                            }

                            $conn->close();
                        } else {

                            echo "No user";
                        }
                        ?>
                    </div>

                </div>


    </section>







    <!--footer -->

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="single_footer">
                        <h4>Services</h4>
                        <ul>
                            <li><a href="login.html">Publish Journal</a></li>
                            <li><a href="#">Download Journal</a></li>

                        </ul>
                    </div>
                </div>

                <!--- END COL -->

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single_footer single_footer_address">
                        <h4>Page Link</h4>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="#">Terms & Condition</a></li>
                            <li><a href="#">Privacy Policy</a></li>


                        </ul>
                    </div>
                </div>

                <!--- END COL -->


                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single_footer single_footer_address">
                        <h4>Subscribe today</h4>
                        <div class="signup_form">
                            <form action="#" class="subscribe">
                                <input type="text" class="subscribe__input" placeholder="Enter Email Address">
                                <button type="button" class="subscribe__btn"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>

                </div>

                <!--- END COL -->

            </div>

            <!--- END ROW -->

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <p class="copyright">Copyright © 2022 <a href="#">IJMESRT</a>.</p>
                </div>

                <!--- END COL -->

            </div>

            <!--- END ROW -->

        </div>

        <!--- END CONTAINER -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>