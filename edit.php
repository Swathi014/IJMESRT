<?php
if (isset($_GET['submit'])) {
    include('connection.php');
    if (isset($_GET['email']) && isset($_GET['curstatus']) && isset($_GET['newstatus'])) {
        $email = $_GET['email'];
        // $curstatus = $_GET['curstatus'];
        $newstatus = $_GET['newstatus'];

        if($newstatus != $curstatus){
        $sql = "UPDATE article SET status = '$newstatus' WHERE email = '$email'";

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
            header('Location: admindashboard.php');
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
          
          mysqli_close($conn);
        } else {
           echo 'alert("There is no change")';
        }
        
    } else {
        echo "something went wrong!!!";
    }
} else {
    echo " Something Went Wrong !!!";
}
