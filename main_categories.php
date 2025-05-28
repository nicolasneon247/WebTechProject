<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <script src="chatgpt.js"></script>
    <title>MovieFinder</title>
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
            <a href="logout.php" class="btn btn-primary">Abmelden</a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1>Wähle bis zu 3 Kategorien</h1>
        </div>
        <?php if(isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger mb-4 text-center">
                <?= $_SESSION['error_message']; ?>
                <?php unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>

        <div class="text-center mb-4">
            <button id="continueBtn" class="btn btn-primary btn-lg px-5">Weiter zu den Ländern</button>
            <div id="errorMessage" class="text-danger mt-2" style="display: none;">
                Bitte wähle mindestens eine Kategorie aus.
            </div>
        </div>

        <script>
        document.getElementById('continueBtn').addEventListener('click', function() {
            const selected = document.querySelectorAll('.category-box.selected');
            
            if (selected.length === 0) {
                document.getElementById('errorMessage').style.display = 'block';
            } else {
                window.location.href = 'countries.php';
            }
        });
        </script>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/action.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Action</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/abenteuer.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Abenteuer</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/komoedie.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Komödie</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/drama.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Drama</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/horror.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Horror</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/thriller.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Thriller</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/krimi.png'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Krimi</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/sci-fi.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Sci-Fi</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/fantasy.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Fantasy</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/romance.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Romantik</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/animation.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Animation</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/dokumentation.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Dokumentation</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/musical.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Musical</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/western.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Western</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/historienfilm.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Historienfilm</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="category-box d-block text-decoration-none" onclick="selectCategory(this)">
                    <div class="card bg-dark text-white category-card" style="background-image: url('categorie_pictures/krieg.jpg'); background-size: cover; height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h2 class="card-title">Krieg</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
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
                background-color:rgb(144,12,63);
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
        </style>

        <script>
            function selectCategory(element) {
                const selected = document.querySelectorAll('.category-box.selected');
                if (selected.length < 3 || element.classList.contains('selected')) {
                    element.classList.toggle('selected');
                }

                const updatedSelected = document.querySelectorAll('.category-box.selected');
                const selectedNames = Array.from(updatedSelected).map(el =>
                    el.querySelector('.card-title').textContent
                );

                localStorage.setItem('selectedCategories', JSON.stringify(selectedNames));
            }
        </script>
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