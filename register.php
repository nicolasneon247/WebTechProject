<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$error = '';
$records = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['field2'] !== $_POST['field2_repeat']) {
        $error = "Die Passwörter stimmen nicht überein!";
    } else {
        $conn = new mysqli("localhost", "root", "", "testdatabase");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $field1 = $_POST['field1'];
        $field2 = password_hash($_POST['field2'], PASSWORD_DEFAULT);


        $stmt = $conn->prepare("INSERT INTO testtable (name, passwort) VALUES (?, ?)");
        $stmt->bind_param("ss", $field1, $field2);
        //localStorage.setItem("username", $field1);

        if (!$stmt->execute()) {
            $error = "Fehler beim Einfügen: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}

$conn = new mysqli("localhost", "root", "", "testdatabase");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM testtable");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}
$conn->close();

include 'register_view.php';

?>
