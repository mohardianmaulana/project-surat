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
  @include('template.sidebar')

@include('template.navbar')

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

    @include('template.script')
  </body>
</html>