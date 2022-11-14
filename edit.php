<?php
if (isset($_GET['submit'])) {
    include('connection.php');
    if (isset($_GET['email']) && isset($_GET['curstatus']) && isset($_GET['newstatus']) && isset($_GET['curreviewer']) && isset($_GET['setreviewer'])) {

        $email = $_GET['email'];
        $curstatus = $_GET['curstatus'];
        $newstatus = $_GET['newstatus'];
        $curreviewer = $_GET['curreviewer'];
        $setreviewer = $_GET['setreviewer'];

        if ($newstatus != $curstatus) {
            $sql = "UPDATE article SET status = '$newstatus' WHERE email = '$email'";

            if (mysqli_query($conn, $sql)) {
                echo "Record updated successfully";
                header('Location: admindashboard.php');
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
                //only edit one at a time RN
            mysqli_close($conn);
        } elseif ($setreviewer != $curreviewer) {
            $sql = "UPDATE article SET reviewer = '$setreviewer' WHERE email = '$email'";

            if (mysqli_query($conn, $sql)) {
                echo "Record updated successfully";
                header('Location: admindashboard.php');
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo 'alert("There is no change")';
        }
    } else {
        echo "something went wrong!!!";
    }
} else {
    echo " Something Went Wrong !!!";
}
