<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>MovieFinder - Länder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
    body {
        background-color: #121212;
        color: #fff;
        font-family: 'Inter', sans-serif;
        font-weight: 300;
        line-height: 1.6;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
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

    .category-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }

    .category-card:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .category-card .card-body {
        position: relative;
        z-index: 2;
    }

    .category-card:hover {
        background-color: rgb(144, 12, 63);
    }

    .category-card:hover:before {
        background: rgba(0, 0, 0, 0.6);
    }

    .card-title {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        font-size: 1.5rem;
    }

    .selected .category-card {
        border: 10px solid #900C3F;
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(144, 12, 63, 0.3);
    }

    .selected-categories {
        color: #aaa;
        font-size: 0.9rem;
        font-style: italic;
    }

    .selected-categories span {
        display: inline-block;
        margin-right: 8px;
        padding: 2px 8px;
        background-color: rgba(144, 12, 63, 0.2);
        border-radius: 4px;
    }
    </style>
</head>

<body>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">MovieFinder - Entdecke Filme aus aller Welt!</h1>
            <a href="logout.php" class="btn btn-primary">Abmelden</a>
        </div>
    </header>

    <div class="container mt-5">
        <div id="previous-categories" class="selected-categories mb-3 text-center"></div>

        <div class="text-center mb-5">
            <h1>Wähle bei Bedarf eine Geographische Eingrenzung</h1>
        </div>

        <div class="text-center mb-4">
            <button id="continueBtn" class="btn btn-primary btn-lg px-5">Weiter zur Filmdauer</button>
        </div>

        <div class="text-center mb-4">
            <button id="backBtn" class="btn btn-secondary btn-lg px-5 mb-3" onclick="history.back()">Zurück zu
                Hauptkategorien</button>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/USA.svg.png'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">USA</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Deutschland.svg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Deutschland</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Frankreich.webp'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Frankreich</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/England.webp'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">United Kingdom</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Japan.svg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Japan</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Mexiko.svg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Mexiko</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Indien.svg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Indien</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/China.png'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">China</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Südkorea.svg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Südkorea</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Spanien.png'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Spanien</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Italien.svg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Italien</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card"
                        style="background-image: url('country_pictures/Russland.svg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Russland</h2>
                        </div>
                    </div>
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

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const previousCategories = JSON.parse(localStorage.getItem('selectedCategories')) || [];
        const previousCategoriesEl = document.getElementById('previous-categories');
        if (previousCategories.length > 0) {
            previousCategoriesEl.innerHTML = 'Ausgewählte Hauptkategorien: ' +
                previousCategories.map(cat => `<span>${cat}</span>`).join(' ');
        }

        window.selectCategory = function(element) {
            element.classList.toggle('selected');

            const selected = document.querySelectorAll('.category-box.selected');
            const selectedNames = Array.from(selected).map(el =>
                el.querySelector('.card-title').textContent
            );

            if (selected.length > 1) {
                element.classList.remove('selected');
            }

            localStorage.setItem('selectedCountry', JSON.stringify(selectedNames));
        };

        document.getElementById('continueBtn').addEventListener('click', function() {
            const selected = document.querySelectorAll('.category-box.selected');
            window.location.href = 'movie_selection.php';
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>