<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
    .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
    }
    </style>
</head>
<body>
<!-- Content Row -->
<div class="row">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="{{ asset('template/img/Logo Poliwangi.png') }}" alt="Logo" width="50" height="50" class="me-2">
                <div class="d-flex flex-column" style="font-size: 15px;">
                    <span>Politeknik</span>
                    <span>Negeri</span>
                    <span>Banyuwangi</span>
                </div>
            </a>
            <div class="d-flex flex-grow-1 justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link mx-4" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-4" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-4" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <a href="/" class="btn btn-outline-secondary me-2">Login</a>
                <a href="/register" id="register" class="btn btn-secondary">Sign Up</a>
            </div>
        </div>
    </nav>
</div>

<div class="position-relative">
    <img src="{{ asset('template/img/poliwangi.jpg') }}" alt="Gambar" class="img-fluid">
</div>

    <!-- Content Row -->
<div class="row mt-4 mx-3">
    <!-- Card 1 -->
    <div class="col-md-4 mb-4">
        <div class="card" style="border-radius: 15px;">
            <div id="pengumuman" class="card-body text-center">
            <i class="fa-solid fa-bullhorn"></i>
                Pengunguman
            </div>
        </div>
    </div>
    
    <!-- Card 2 -->
    <div class="col-md-4 mb-4">
        <div class="card" style="border-radius: 15px;">
            <div id="agenda" class="card-body text-center">
            <i class="fa-solid fa-calendar-days"></i>
                Agenda Kampus
            </div>
        </div>
    </div>
    
    <!-- Card 3 -->
    <div class="col-md-4 mb-4">
        <div class="card" style="border-radius: 15px;">
            <div id="informasi" class="card-body text-center">
            <i class="fa-solid fa-circle-info"></i>
                Informasi Kampus
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container text-center text-md-start">
        <div class="row">
            <!-- Logo dan Deskripsi -->
            <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mt-3">
                <img src="{{ asset('template/img/Logo Poliwangi.png') }}"  alt="Logo" width="50" height="50">
                <h5 class="text-uppercase mb-4 font-weight-bold mt-3">Politeknik Negeri Banyuwangi</h5>
                <p>
                    Menjadi institusi pendidikan vokasi unggulan yang berorientasi pada pengembangan ilmu pengetahuan dan teknologi.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Quick Links</h5>
                <p><a href="#" class="text-white text-decoration-none">Home</a></p>
                <p><a href="#" class="text-white text-decoration-none">Pricing</a></p>
                <p><a href="#" class="text-white text-decoration-none">Contact</a></p>
                <p><a href="#" class="text-white text-decoration-none">About</a></p>
            </div>

            <!-- Kontak -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Contact</h5>
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-map-location-dot mb-3"></i>
                    <p class="ms-3">Jalan Raya Jember KM 13 Banyuwangi 68461, Jawa Timur – Indonesia</p>
                </div>
                <p><i class="fas fa-envelope me-3"></i> poliwangi@poliwangi.ac.id</p>
                <p><i class="fas fa-phone me-3"></i> +62 821 329 45801</p>
            </div>

            <!-- Sosial Media -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
                <h5 class="text-uppercase mb-4 font-weight-bold">Follow Us</h5>
                <a href="#" id="facebook" class="btn btn-outline-primary btn-floating m-1"><i class="fab fa-facebook-f"></i></a>
                <a href="#" id="youtube" class="btn btn-outline-danger btn-floating m-1"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" id="instagram" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3 mt-3" style="background-color: rgba(255, 255, 255, 0.1);">
        © <span id="year"></span> Politeknik Negeri Banyuwangi. All Rights Reserved.
    </div>
</footer>


        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
        const register = document.getElementById('register');
        register.addEventListener('mouseover', () => {
            register.classList.add("bg-white", "text-secondary", "border", "border-secondary");
        });
        register.addEventListener('mouseleave', () => {
            register.classList.remove("bg-white", "text-secondary", "border", "border-secondary");
        });
        document.querySelectorAll(".nav-link").forEach(item => {
            item.addEventListener("mouseover", () => {
                item.classList.add("bg-secondary", "text-white");
            });

            item.addEventListener("mouseout", () => {
                item.classList.remove("bg-secondary", "text-white");
            });
        });
        document.querySelectorAll(".dropdown-item").forEach(item => {
            item.addEventListener("mouseover", () => {
                item.classList.add("bg-secondary", "text-white");
            });

            item.addEventListener("mouseout", () => {
                item.classList.remove("bg-secondary", "text-white");
            });
        });
        document.querySelectorAll(".dropdown").forEach(item => {
            item.addEventListener("mouseover", () => {
                item.querySelector(".nav-link").classList.add("bg-secondary", "text-white");
            });

            item.addEventListener("mouseleave", () => {
                item.querySelector(".nav-link").classList.remove("bg-secondary", "text-white");
            });
        });
        const facebook = document.getElementById('facebook');
        facebook.addEventListener('mouseover', () => {
            facebook.style.color = 'white';
        });
        facebook.addEventListener('mouseout', () => {
            facebook.style.color = '';
        });
        const youtube = document.getElementById('youtube');
        youtube.addEventListener('mouseover', () => {
            youtube.style.color = 'white';
        });
        youtube.addEventListener('mouseout', () => {
            youtube.style.color = '';
        });
        document.querySelectorAll(".card").forEach(card => {
            card.addEventListener("mouseover", () => {
                card.style.backgroundColor = "#666";
                card.style.color = "white";
                card.style.borderColor = "#666";
                card.querySelector("i").style.color = "white";
            });

            card.addEventListener("mouseout", () => {
                card.style.backgroundColor = "";
                card.style.color = "";
                card.style.borderColor = "";
                card.querySelector("i").style.color = "";
            });
        });
    </script>
</body>
</html>
