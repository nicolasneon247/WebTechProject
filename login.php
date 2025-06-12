<?php
session_start();

$error = '';
$records = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['field1'] ?? '';
    $password = $_POST['field2'] ?? '';

    $conn = new mysqli("localhost", "root", "", "testdatabase");
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM testtable WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['passwort'])) {
            $_SESSION['loginSuccess'] = true;
            $_SESSION['username'] = $username;
        } else {
            $_SESSION['error'] = 'Falsches Passwort';
        }
    } else {
        $_SESSION['error'] = 'Benutzer nicht gefunden';
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
