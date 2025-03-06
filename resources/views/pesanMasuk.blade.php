<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Template</title>

    <style>
        @media (max-width: 768px) {
            #sidebar {
                width: 80px !important; /* Ukuran lebih kecil */
                overflow: hidden;
            }

            #sidebar .sidebar-text {
                display: none; /* Sembunyikan teks */
            }

            #sidebar a {
                justify-content: center;
            }

            #sidebar img {
                margin-right: 0 !important;
            }
        }

        .collapsed {
        width: 100px !important;
        }

        .collapsed .sidebar-text {
        display: none; /* Sembunyikan teks saat sidebar mengecil */
        }

        .collapsed a {
        text-align: center;
        }

        .collapsed i {
        margin-right: 0 !important;
        }
    </style>
  </head>
  <body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-light vh-100" style="width: 280px;">
      <a href="/" class="d-flex align-items-center justify-content-center w-100 text-decoration-none" style="color: blue;">
        <img src="{{ asset('template/img/Logo Poliwangi.png') }}"  alt="Logo" width="50" height="50">
        <span class="sidebar-text fs-4 mx-2" style="color: black;">ULT<sup class="mx-1">Poliwangi</sup></span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="mb-3"><a href="#" id="list" class="nav-link link-dark"><i id="icon" class="fa-solid fa-house fa-lg"></i><span id="text" class="sidebar-text ms-3">Home</span></a></li>
        <li class="mb-3"><a href="#" id="list-1" class="nav-link link-dark"><i id="icon1" class="fa-solid fa-database fa-lg "></i><span id="text1" class="sidebar-text ms-3">Dashboard</span></a></li>
        <li class="mb-3"><a href="#" id="list-4" class="nav-link link-dark"><i id="icon4" class="fa-solid fa-user fa-lg "></i><span id="text4" class="sidebar-text ms-3">Pelapor</span></a></li>
        <li class="mb-3"><a href="#" id="list-2" class="nav-link link-dark"><i id="icon2" class="fa-solid fa-envelope fa-lg "></i><span id="text2" class="sidebar-text ms-3">Pesan Masuk</span></a></li>
        <li class="mb-3"><a href="/pesanMasuk" id="list-3" class="nav-link link-dark"><i id="icon3" class="fa-solid fa-envelope-open fa-lg "></i><span id="text3" class="sidebar-text ms-3">Pesan Keluar</span></a></li>
        
      </ul>
      <hr>
      <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="border-0 btn btn-light" id="sidebarToggle">
                <i class="fa-regular fa-circle-right fa-2xl"></i>
            </button>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="flex-grow-1">
      <!-- Navbar -->
      <nav class="navbar navbar-light bg-secondary px-3">
          <div class="container-fluid d-flex justify-content-between align-items-center flex-nowrap">
              <!-- Search Bar di Kiri -->
              <form class="d-flex">
                  <input class="form-control me-2 mt-3 mb-3" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-light mt-3 mb-3" type="submit">Search</button>
              </form>

              <!-- Profile Dropdown di Kanan -->
              <div class="dropdown ms-5">
                  <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="{{ asset('template/img/Logo Super.png') }}" style="filter: invert(50%) brightness(500%);" alt="" width="32" height="32" class="rounded-circle me-2">
                      <strong>mdo</strong>
                  </a>
                  <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                      <li><a class="dropdown-item" href="#">New project</a></li>
                      <li><a class="dropdown-item" href="#">Settings</a></li>
                      <li><a class="dropdown-item" href="#">Profile</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="/login">Sign out</a></li>
                  </ul>
              </div>
          </div>
      </nav>


      <!-- Isi konten -->
      <!-- Content Row -->
      <div class="card mx-5 mt-3">
        <div class="card-header">
            Kepada ....
        </div>
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="text-start">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
            <div>
                <a href="#" class="btn btn-primary me-2">Teruskan</a>
                <a href="#" class="btn btn-danger">Arsipkan</a>
            </div>
        </div>
    </div>

    <div class="card mx-5 mt-3">
        <div class="card-header">
            Kepada ....
        </div>
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="text-start">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
            <div>
                <a href="#" class="btn btn-primary me-2">Teruskan</a>
                <a href="#" class="btn btn-danger">Arsipkan</a>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
        document.getElementById("sidebarToggle").addEventListener("click", function () {
            document.getElementById("sidebar").classList.toggle("collapsed");
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
    </script>
  </body>
</html>