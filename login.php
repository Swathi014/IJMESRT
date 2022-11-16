<?php
if (isset($_POST['submit'])) {
    include('connection.php');
    if (isset($_POST['uname']) && isset($_POST['psw'])) {
        $username = $_POST['uname'];
        $password = $_POST['psw'];

        $sql = "SELECT admin FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) <= 0) {
            echo "0 results";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                // echo $row['admin'];
                $usertype = $row['admin'];
            }
            if ($usertype == 2) {
                $sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    // echo "<h1><center> Login successful </center></h1>";
                    // readfile('Login.html');
                    session_start();
                    $_SESSION["sessionuser"] = $username;
                    $_SESSION["sessionadmin"] = 'reviewer';
                    header('Location: reviewerdashboard.php');
                    exit();
                } else {
                    echo "<h1> Login failed. Invalid username or password.</h1>";
                }
            } elseif ($usertype == 1) {
                $sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    // echo "<h1><center> Login successful </center></h1>";
                    // readfile('Login.html');
                    session_start();
                    $_SESSION["sessionuser"] = $username;
                    $_SESSION["sessionadmin"] = 'admin';
                    header('Location: admindashboard.php');
                    exit();
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
                    session_start();
                    $_SESSION["sessionuser"] = $username;
                    $_SESSION["sessionadmin"] = 'user';
                    header('Location: userdashboard.php');
                    exit();
                } else {
                    echo "<h1> Login failed. Invalid username or password.</h1>";
                }
            }
        }
        $conn->close();
    } else {
        echo "Data not received";
    }
} else {
    echo " Something Went Wrong !!!";
}
