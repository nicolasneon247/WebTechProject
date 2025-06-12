<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>MovieFinder – Filmlänge wählen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.css" rel="stylesheet">
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

        #slider {
            margin-top: 50px;
        }

        .value-labels {
            margin-top: 20px;
            font-size: 1.2rem;
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
            <h1 class="h3">MovieFinder – Filmlänge festlegen</h1>
            <div class="d-flex gap-2">
                <a href="profile.php" class="btn btn-outline-light">
                    <i class="bi bi-person-circle me-1"></i> Profil
                </a>
                <a href="logout.php" class="btn btn-primary">Abmelden</a>
            </div>
        </div>
    </header>

    <div class="container text-center">
        <h2>Wie lang soll der Film sein?</h2>
        <p>Ziehe den Regler, um die gewünschte Filmlänge in Minuten auszuwählen.</p>

        <div id="slider" class="mx-auto" style="max-width: 600px;"></div>
        <div class="value-labels">
            <span id="length-min">0</span> – <span id="length-max">300</span> Minuten
        </div>

        <div class="mt-5">
            <button id="continueBtn" class="btn btn-primary btn-lg px-5">Weiter zum Ergebnis</button>
        </div>

        <div class="mt-3">
            <button onclick="history.back()" class="btn btn-secondary btn-lg px-5">Zurück</button>
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

    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.js"></script>
    <script>
        const slider = document.getElementById('slider');

        noUiSlider.create(slider, {
            start: [60, 180],
            connect: true,
            range: {
                'min': 15,
                'max': 300
            },
            step: 5,
            format: {
                to: value => Math.round(value),
                from: value => Number(value)
            }
        });

        const minLabel = document.getElementById('length-min');
        const maxLabel = document.getElementById('length-max');

        slider.noUiSlider.on('update', (values) => {
            minLabel.textContent = values[0];
            maxLabel.textContent = values[1];

            if (maxLabel.textContent == 300) {
                maxLabel.textContent = "300+";
            }
        });

        document.getElementById('continueBtn').addEventListener('click', () => {
            const values = slider.noUiSlider.get();
            localStorage.setItem('movieLength', JSON.stringify({
                min: values[0],
                max: values[1]
            }));
            window.location.href = 'result_filldatabase.php';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
