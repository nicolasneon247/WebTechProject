<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['field2'] !== $_POST['field2_repeat']) {
        $error = "Die Passwörter stimmen nicht überein!";
    } else {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "testdatabase";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $field1 = $_POST['field1'];
        $field2 = $_POST['field2'];

        $stmt = $conn->prepare("INSERT INTO testtable (name, passwort) VALUES (?, ?)");
        $stmt->bind_param("ss", $field1, $field2);

        if ($stmt->execute()) {
            echo "Data inserted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}

$records = [];
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFinder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        a {
            color: #0d6efd;
        }
        a:hover {
            color: #0a58ca;
        }
        footer {
            background-color: #1f1f1f;
            color: #ffffff;
            padding: 20px 0;
        }
        .social-icons a {
            margin: 0 10px;
            color: #ffffff;
            font-size: 1.5rem;
        }
        .social-icons a:hover {
            color: #0d6efd;
        }
        .project-info {
            font-family: 'Courier New', monospace;
            margin-top: 10px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <header class="py-3 mb-4 border-bottom"></header>
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">MovieFinder Registrierung</h1>
            <nav></nav>
                <a href="news.php" class="btn btn-outline-light">News</a>
            </nav>
        </div>
    </header>

    <div class="container mt-5"></div>
        <header class="mb-4">
            <p class="text-center project-info">Ein Uni Projekt von Yannick, Silas und Nicolas</p>
            <h1 class="text-center">Registrierung</h1>
            <p class="text-center">Bitte wähle einen Username und ein Passwort</p>
        </header>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="POST" action="" class="p-4 border rounded shadow-sm">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error)): ?>
                        <div class="alert alert-success">Registrierung erfolgreich!</div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="field1" class="form-label">Name</label>
                        <input type="text" id="field1" name="field1" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="field2" class="form-label">Passwort</label>
                        <input type="password" id="field2" name="field2" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="field2_repeat" class="form-label">Passwort wiederholen</label>
                        <input type="password" id="field2_repeat" name="field2_repeat" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrieren</button>
                    <button type="button" class="btn btn-primary w-100" onclick="askChatGPT()">Test ChatGPT</button>
                    <script>
                        // function askChatGPT() {
                        //     fetch('https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent', {
                        //         method: 'POST',
                        //         headers: {
                        //             'Content-Type': 'application/json',
                        //             'x-goog-api-key': 'AIzaSyA3-yu43kouAliDx-4MMCA0aNClnOYn-4Q'
                        //         },
                        //         body: JSON.stringify({
                        //             contents: [{
                        //                 parts: [{
                        //                     text: "Write a one-sentence bedtime story about a unicorn."
                        //                 }]
                        //             }]
                        //         })
                        //     })
                        //     .then(response => response.json())
                        //     .then(data => {
                        //         if (data.candidates && data.candidates.length > 0 && 
                        //             data.candidates[0].content && 
                        //             data.candidates[0].content.parts && 
                        //             data.candidates[0].content.parts.length > 0) {
                        //             document.getElementById('chatgpt-result').textContent = data.candidates[0].content.parts[0].text;
                        //         } else {
                        //             document.getElementById('chatgpt-result').textContent = "Invalid response from API: " + JSON.stringify(data);
                        //         }
                        //     })
                        //     .catch(error => {
                        //         document.getElementById('chatgpt-result').textContent = "Error: " + error.message;
                        //         console.error('Error:', error);
                        //     });
                        // }
                    </script>
                    <h3 class="text-center" id="chatgpt-result">Keine Antwort</h3>
                </form>
            </div>
        </div>

        <div class="container mt-5">
            <h2 class="text-center">All Records</h2>
            <table class="table table-dark table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Passwort</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['id']); ?></td>
                            <td><?php echo htmlspecialchars($record['name']); ?></td>
                            <td><?php echo htmlspecialchars($record['passwort']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <footer class="text-center mt-5">
        <p>&copy; MovieFinder</p>
        <div class="social-icons">
            <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>