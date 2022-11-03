<!-- <?php

if (!empty($_FILES['file'])) {

    $target = "uploads/" . $_FILES["file"]["name"];

    move_uploaded_file($_FILES['file']['tmp_name'], $target);

    echo json_encode(['uploaded' => $target]);
} else {

    echo json_encode(['error' => 'No files found for upload.']);
}

?> -->

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (!empty($_FILES['fileToUpload'])) {
   move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)
} else {
    echo "There was an error try again";
}
?>