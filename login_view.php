<?php
session_start();

$error = $_SESSION['error'] ?? '';
$loginSuccess = $_SESSION['loginSuccess'] ?? false;
$records = $_SESSION['records'] ?? [];

unset($_SESSION['error'], $_SESSION['loginSuccess'], $_SESSION['records']);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <script src="chatgpt.js"></script>
    <title>MovieFinder Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.96/build/spline-viewer.js"></script>
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

    .btn {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        letter-spacing: 0.02em;
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

    .project-info {
        font-family: 'Space Grotesk', sans-serif;
        margin-top: 10px;
        font-style: italic;
        font-weight: 300;
        letter-spacing: 0.03em;
    }

    .spline-container {
        height: 100%;
        min-height: 500px;
    }

    spline-viewer {
        width: 100%;
        height: 100%;
    }

    .btn-primary {
        background-color: #900C3F;
        border-color: #900C3F;
    }

    .btn-primary:hover {
        background-color: #7d0a36;
        border-color: #7d0a36;
    }

    .btn-outline-primary {
        color: #900C3F;
        border-color: #900C3F;
    }

    .btn-outline-primary:hover {
        background-color: #900C3F;
        border-color: #900C3F;
    }

    a {
        color: #900C3F;
    }

    a:hover {
        color: #7d0a36;
    }

    .form-control {
        font-family: 'Inter', sans-serif;
        font-weight: 400;
    }

    .table {
        font-family: 'Inter', sans-serif;
        font-weight: 300;
    }

    .form-label {
        font-weight: 400;
        letter-spacing: 0.03em;
    }
    </style>
</head>

<body>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">MovieFinder - Entdecke Filme aus aller Welt!</h1>
            <a href="register.php" class="btn btn-primary">Registrieren</a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row g-4 align-items-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <p class="project-info">Ein Uni Projekt von Yannick, Silas und Nicolas</p>
                    <h1 class="mb-3">Login</h1>
                    <p>Bitte gib deinen Benutzernamen und dein Passwort ein</p>
                </div>

                <form method="POST" action="login.php" class="p-4 bg-dark bg-opacity-25 rounded-3 border-0 shadow">
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger rounded-pill"><?= htmlspecialchars($error) ?></div>
                    <?php elseif ($loginSuccess): ?>
                    <div class="alert alert-success rounded-pill">Login erfolgreich!</div>
                    <script>
                        setTimeout(() => {
                            window.location.href = 'main_categories.php';
                        }, 500);
                    </script>
                    <?php endif; ?>

                    <div class="mb-4">
                        <label for="field1" class="form-label text-secondary small">Name</label>
                        <input type="text" id="field1" name="field1"
                            class="form-control form-control-lg bg-dark bg-opacity-50 border-0 text-light" required>
                    </div>
                    <div class="mb-4">
                        <label for="field2" class="form-label text-secondary small">Passwort</label>
                        <input type="password" id="field2" name="field2"
                            class="form-control form-control-lg bg-dark bg-opacity-50 border-0 text-light" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill w-100 mb-4" onclick="
                    localStorage.setItem('username', document.getElementById('field1').value);
                    ">Anmelden</button>

                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <input type="text" id="promptInput"
                            class="form-control bg-dark bg-opacity-50 border-0 text-light mb-3"
                            placeholder="Deine Frage an die KI...">
                        <button type="button" class="btn btn-outline-primary rounded-pill w-100"
                            onclick="askChatGPT(document.getElementById('promptInput').value)">Frage senden</button>
                        <div class="mt-3 text-center" id="chatgpt-result">Keine Antwort</div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="spline-container"
                    style="position: relative; width: 100%; height: 600px; overflow: visible;">
                    <spline-viewer url="https://prod.spline.design/1819ovEYMtjRy6YY/scene.splinecode"
                        style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;"></spline-viewer>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-5">
        <p>&copy; MovieFinder 2025</p>
        <div class="social-icons">
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0&ab_channel=Duran" target="_blank"><i
                    class="bi bi-facebook"></i></a>
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0&ab_channel=Duran" target="_blank"><i
                    class="bi bi-twitter"></i></a>
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0&ab_channel=Duran" target="_blank"><i
                    class="bi bi-instagram"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>