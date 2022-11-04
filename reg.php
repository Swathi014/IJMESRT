<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['uname']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['pwd'])) {
        $username = $_POST['uname'];
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];

        //connection phase
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "article_site";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        } else {
            $Select = "SELECT username FROM user WHERE username = ? LIMIT 1";
            $Insert = "INSERT INTO user(username, firstname, lastname, email, password) values(?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sssss", $username, $firstname, $lastname, $email, $password);
                if ($stmt->execute()) {
                    // echo "New record inserted sucessfully.";
                    header('Location: index.html');
                    exit();
                } else {
                    echo $stmt->error;
                }
            } else {
                echo "Someone already registers using this username.";
            }
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "All field are required.";
        die();
    }
} else {
    echo "submit not fired !!";
}
