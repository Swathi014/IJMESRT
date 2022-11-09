<?php
//Main starts
if (isset($_POST['submit'])) {
  if (
    isset($_POST['email']) && isset($_POST['uname']) &&
    isset($_POST['fname']) && isset($_POST['lname']) &&
    isset($_POST['addr']) && isset($_POST['affl']) && isset($_POST['phno']) && isset($_POST['phno_2']) && isset($_POST['fstudy']) && isset($_POST['abstract'])
  ) {
    toSave();
  } else {
    echo "Something Went Wrong?! Please try again later.";
  }
} else {
  return false;
}
//main ends

//file save starts
function toSave()
{
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  // if(isset($_POST["submit"])) {
  //   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  //   if($check !== false) {
  //     echo "File is an image - " . $check["mime"] . ".";
  //     $uploadOk = 1;
  //   } else {
  //     echo "File is not an image.";
  //     $uploadOk = 0;
  //   }
  // }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $error_msg = 'only document file type supported';
    echo $error_msg;
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
      toDB();
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
//file save ends

//database entry starts
function toDB()
{
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
      $fileToUpload = $_FILES["fileToUpload"]["name"];

      $host = "localhost";
      $dbUsername = "root";
      $dbPassword = "";
      $dbName = "article_site";
      $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
      if ($conn->connect_error) {
        die('Could not connect to the database.');
      } else {
        $Select = "SELECT email FROM article WHERE email = ? LIMIT 1";
        $Insert = "INSERT INTO article(email, username, firstname, lastname, addr, affl, phno, phno_2, fstudy, abstract, fileToUpload) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($Select);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($resultEmail);
        $stmt->store_result();
        $stmt->fetch();
        $rnum = $stmt->num_rows;
        if ($rnum == 0) {
          $stmt->close();
          $stmt = $conn->prepare($Insert);
          $stmt->bind_param("sssssssssss", $email, $username, $firstname, $lastname, $addr, $affl, $phno, $phno_2, $fstudy, $abstract, $fileToUpload);
          if ($stmt->execute()) {
            // echo "New record inserted sucessfully.";
            readfile('index.html');
          } else {
            echo $stmt->error;
          }
        } else {
          echo "Someone already registers using this email.";
          remove();
        }
        $stmt->close();
        $conn->close();
      }
    } else {
      echo "All field are required.";
      remove();
      die();
    }
  } else {
    echo "Submit button is not set";
  }
}
//database entry ends

//remove on failure starts
function remove()
{

  $fileToUpload = $_FILES["fileToUpload"]["name"];
  if (!unlink($fileToUpload)) {
    echo ("$fileToUpload cannot be deleted due to an error");
  } else {
    echo ("$fileToUpload has been deleted");
  }
}
//remove on failuire ends