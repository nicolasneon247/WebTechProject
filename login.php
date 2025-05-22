<?php
session_start();

$error = '';
$loginSuccess = false;
$records = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['field1'] ?? '';
    $password = $_POST['field2'] ?? '';

    $conn = new mysqli("localhost", "root", "", "testdatabase");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM testtable WHERE name = ? AND passwort = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['loginSuccess'] = true;
    } else {
        $_SESSION['error'] = 'Falscher Benutzername oder Passwort';
    }

    $stmt->close();

    $result = $conn->query("SELECT * FROM testtable");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }
    $conn->close();

    $_SESSION['records'] = $records;
    header('Location: login_view.php');
    exit;
}

header('Location: login_view.php');
exit;
