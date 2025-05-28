<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>MovieFinder – Ergebnis</title>
    <script src="chatgpt.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-weight: 300;
        }

        h1, h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 500;
            letter-spacing: -0.02em;
        }

        .btn-primary {
            background-color: #900C3F;
            border-color: #900C3F;
        }

        .btn-primary:hover {
            background-color: #7d0a36;
            border-color: #7d0a36;
        }

        .result-box {
            background-color: #1f1f1f;
            border-radius: 8px;
            padding: 20px;
            margin-top: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            <h1 class="h3">MovieFinder – Ergebnis</h1>
            <a href="logout.php" class="btn btn-primary">Abmelden</a>
        </div>
    </header>

    <div class="container text-center">
        <h2>Deine Filmempfehlung:</h2>
        
        <div class="result-box mx-auto mb-4" style="max-width: 600px; background-color: #900C3F; padding: 25px; margin-bottom: 30px;">
            <div class="text-center" id="chatgpt-result" style="font-size: 2rem; font-weight: bold;"></div>
            <button id="moreInfoBtn" class="btn btn-light mt-3" onclick="googleSucheFilm()">Mehr erfahren</button>

            <script>
            function googleSucheFilm() {
                const film = localStorage.getItem('film')?.trim();
                const url = `https://www.google.com/search?q=${encodeURIComponent(film + " Film")}`;
                window.open(url, "_blank");
            }
            </script>
        </div>

        <h5>Basierend auf folgenden Präferenzen:</h5>

        <div class="result-box mx-auto" style="max-width: 600px;">
            <div id="result-content"></div>
        </div>
        
        <div class="mt-3">
            <button onclick="history.back()" class="btn btn-secondary btn-lg px-5 mt-4">Zurück</button>
        </div>
    </div>
    

    <footer class="text-center mt-5">
        <p>&copy; MovieFinder 2025</p>
        <div class="social-icons">
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank"><i class="bi bi-twitter"></i></a>
            <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank"><i class="bi bi-instagram"></i></a>
        </div>
    </footer>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const resultContent = document.getElementById('result-content');

    const movieLength = JSON.parse(localStorage.getItem('movieLength'));
    const categories = JSON.parse(localStorage.getItem('selectedCategories'));
    const country = JSON.parse(localStorage.getItem('selectedCountry'));

    let content = '';

    if (categories && categories.length > 0) {
        content += '<h3>Kategorien</h3>';
        content += '<p>' + categories.join(', ') + '</p>';
    }

    if (country) {
        content += '<h3>Land</h3>';
        content += '<p>' + country + '</p>';
    }

    if (movieLength) {
        content += '<h3>Filmlänge</h3>';
        content += `<p>${movieLength.min} Minuten - ${movieLength.max === "300+" ? "300+" : movieLength.max + " Minuten"}</p>`;
    }

    if (content) {
        resultContent.innerHTML = content;

        const minDuration = movieLength ? movieLength.min : 0;
        const maxDuration = movieLength && movieLength.max !== "300+" ? movieLength.max : 300;

        askChatGPT(categories, country, { minDuration, maxDuration });

    } else {
        resultContent.innerHTML = '<p>Keine Filmdaten gefunden. Bitte wähle deine Präferenzen erneut.</p>';
    }

//filmverlauf tabelle füllen aus localstorage (username und film) -> filmhistory.php tabelle anzeigen auf username gefiltert

});
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>