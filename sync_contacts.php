<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "offlinedata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    foreach ($data as $contact) {
        $name = $contact['name'];
        $phone = $contact['phone'];

        $sql = "INSERT INTO users (name, phone) VALUES ('$name', '$phone')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "No data received";
}

$conn->close();
?>