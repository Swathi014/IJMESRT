<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['uname']) && isset($_POST['psw'])) {
        $username = $_POST['uname'];
        $password = $_POST['psw'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "article_site";
        $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        } else {

            $chk = "SELECT admin FROM user WHERE admin = '1' and username = '$username'";
            $rslt = mysqli_query($conn, $chk);
            $rw = mysqli_fetch_array($rslt, MYSQLI_ASSOC);
            $usertype = mysqli_num_rows($rslt);

            if ($usertype) {

                $sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    // echo "<h1><center> Login successful </center></h1>";
                    readfile('dashboard.html');
                } else {
                    echo "<h1> Login failed. Invalid username or password.</h1>";
                }
            } else {
                $sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    // echo "<h1><center> Login successful </center></h1>";
                    // readfile('Login.html');
                    header('Location: upload.html');
                    exit();
                } else {
                    echo "<h1> Login failed. Invalid username or password.</h1>";
                }
            }
        }
    } else {
        echo "Error";
    }
} else {
    echo " Something Went Wrong !!!";
}
