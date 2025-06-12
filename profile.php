<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = '';
$records = [];

$conn = new mysqli("localhost", "root", "", "testdatabase");
if ($conn->connect_error) {
    $error = "Verbindung fehlgeschlagen: " . $conn->connect_error;
} else {
    $username = $_GET['user'] ?? '';
    if (!empty($username)) {
        $stmt = $conn->prepare("SELECT Benutzer, Film_Titel, Empfohlen_am FROM filmverlauf WHERE Benutzer = ? ORDER BY Empfohlen_am DESC");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        } elseif (!$result) {
            $error = "Fehler beim Laden der Daten: " . $conn->error;
        }
        $stmt->close();
    } else {
        $error = "Kein Benutzername übergeben. Wenn dies dein erstes Mal ist, versuche dich neu anzumelden.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
    body {
        background-color: #121212;
        color: #fff;
        font-family: 'Inter', sans-serif;
        font-weight: 300;
        line-height: 1.6;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 500;
        letter-spacing: -0.02em;
    }

    .table {
        background-color: #1f1f1f;
        color: #fff;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #900C3F;
        border-color: #900C3F;
    }

    .btn-primary:hover {
        background-color: #7d0a36;
        border-color: #7d0a36;
    }

    .alert {
        border-radius: 0.75rem;
    }

    footer {
        background-color: #1f1f1f;
        padding: 20px 0;
        font-weight: 300;
    }

    .social-icons a {
        margin: 0 10px;
        color: #fff;
        font-size: 1.5rem;
    }

    .social-icons a:hover {
        color: #900C3F;
    }
    </style>
</head>

<body>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">MovieFinder - Profil</h1>
            <div class="d-flex gap-2"> <a href="main_categories.php" class="btn btn-outline-light">Neuer Film</a>
                <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </header>

    <main class="container mt-5">
        <h2 class="mb-4">Filmverlauf von <?= htmlspecialchars($username) ?></h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php elseif (count($records) === 0): ?>
            <div class="alert alert-warning">Keine Daten für diesen Benutzer gefunden.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Benutzer</th>
                            <th>Film-Titel</th>
                            <th>Empfohlen am</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['Benutzer'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['Film_Titel'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['Empfohlen_am'] ?? '') ?></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="window.open('https://www.google.com/search?q=<?= urlencode(htmlspecialchars($row['Film_Titel'] ?? '')) ?> Film', '_blank')">
                                        Mehr erfahren
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

    <footer class="text-center mt-5">
        <p>© MovieFinder 2025</p>
        <div class="social-icons">
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank"><i class="bi bi-twitter"></i></a>
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank"><i class="bi bi-instagram"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('user')) {
                const username = localStorage.getItem('username');
                if (username) {
                    window.location.href = window.location.origin + window.location.pathname + '?user=' + encodeURIComponent(username);
                } else {
                    console.error("Kein Benutzername im localStorage gefunden. Bitte anmelden.");
                }
            }
        });
    </script>
</body>

</html>