<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




$error = '';
$records = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $film = $_POST['film'] ?? '';
    $user = $_POST['user'] ?? '';
    $date = $_POST['date'] ?? '';


    echo "<script>
    console.log('DEBUG - Film:', " . json_encode($film) . ");
    console.log('DEBUG - User:', " . json_encode($user) . ");
    console.log('DEBUG - Date:', " . json_encode($date) . ");
    console.log('DEBUG - Fehler:', " . json_encode($error) . ");
</script>";

    
    if (empty($film) || empty($user) || empty($date)) {
        $error = "Daten unvollständig!";
    } else {
        $conn = new mysqli("localhost", "root", "", "testdatabase");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO filmverlauf (Benutzer, Film_Titel, Empfohlen_am) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $film, $date);

        if (!$stmt->execute()) {
            $error = "Fehler beim Einfügen: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}

include 'result.php';
