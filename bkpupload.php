<?php
if (isset($_POST['submit'])) {
    if (
        isset($_POST['email']) && isset($_POST['uname']) &&
        isset($_POST['fname']) && isset($_POST['lname']) &&
        isset($_POST['addr']) && isset($_POST['affl']) && isset($_POST['phno']) && isset($_POST['phno_2']) && isset($_POST['fstudy']) && isset($_POST['abstract'])
    ) {

        $email = $_POST['email'];
        $username = $_POST['uname'];
        // $password = $_POST['cpwd'];
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $addr = $_POST['addr'];
        $affl = $_POST['affl'];
        $phno = $_POST['lname'];
        $phno_2 = $_POST['phno_2'];
        $fstudy = $_POST['fstudy'];
        $abstract = $_POST['abstract'];
        $filename = $_FILES["filename"]["name"];
        // Create connection
        // $mysqliConnection = mysqli_connect($mysqliHost, $mysqliUser, $mysqliPassword, $mysqliDatabase);
        include('connection.php');
        // Check connection
        // if (!$mysqliConnection) {die("Connection failed: " . mysqli_connect_error());}

        // $insertOfData = "INSERT INTO styles (userID,pictureLikes,pictureDislikes,pictureGender) VALUES ('$userID', '0', '0', '$userGender')";
        $insertOfData = "INSERT INTO article(email, username, firstname, lastname, addr, affl, phno, phno_2, fstudy, abstract, filename) values('$email','$username','$firstname','$lastname','$addr','$affl','$phno','$phno_2','$fstudy','$abstract','$filename')";

        if (mysqli_query($conn, $insertOfData)) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["filename"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check file size
            if ($_FILES["filename"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
                echo "Sorry, only PDF,DOC,DOCX files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["filename"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "Error: " . $insertOfData . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
