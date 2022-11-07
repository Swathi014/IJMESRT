<?php
if (isset($_POST['submit'])) {
    include('connection.php');
    if (isset($_POST['email']) && isset($_POST['uname'])) {
        $email = $_POST['email'];
        $username = $_POST['uname'];

        if (mysqli_connect_errno()) {
            die('Could not connect to the database.');
        } else {

            $sql = "SELECT * FROM user WHERE email = '$email' and username = '$username'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);

            if($count == 1){
                $sql = "UPDATE user SET admin='0' WHERE username='$username'";
                if (mysqli_query($conn, $sql)) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . mysqli_error($conn);
                  }
                  
                  mysqli_close($conn);
            } else {
                echo "There is no user registered with the given email and username";
            }
        }
    } else {
        echo "Error";
    }
} else {
    echo " Something Went Wrong !!!";
}
