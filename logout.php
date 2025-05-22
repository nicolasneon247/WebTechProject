<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <script src="chatgpt.js"></script>
    <title>MovieFinder Logout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

    .btn-primary {
        background-color: #900C3F;
        border-color: #900C3F;
    }

    .btn-primary:hover {
        background-color: #7d0a36;
        border-color: #7d0a36;
    }

    a {
        color: #900C3F;
    }

    a:hover {
        color: #7d0a36;
    }
    
    .logout-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
    }
    </style>
</head>

<body>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">MovieFinder - Entdecke Filme aus aller Welt!</h1>
        </div>
    </header>

    <div class="container">
        <div class="logout-container">
            <div class="alert alert-success text-center mb-4 w-75">
                <h2>Du hast dich erfolgreich abgemeldet</h2>
            </div>
            <a href="login.php" class="btn btn-primary btn-lg rounded-pill">Login</a>
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