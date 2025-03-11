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
      <div class="card mt-3 mx-3 shadow" style="border-radius: 15px;">
        <div class="card-body">
            <h1 class="mx-5 mb-3" style="color: grey;">Laporan</h1>
            @if (session('success'))
                <div class="alert alert-success mx-5">
                    {{ session('success') }}
                </div>
            @endif
            <fieldset disabled>
            <div class="mx-5 mt-3">
                <label for="disabledTextInput" class="form-label">Nama Pelapor</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="Nama Pelapor">
            </div>
            <div class="mx-5 mt-3">
                <label for="exampleFormControlTextarea1" class="form-label">Laporan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="complaint_text" rows="3"></textarea>
            </div>
            <div class="mx-5 mt-3">
                <label for="disabledTextInput" class="form-label">Nama UPT</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="Nama UPT">
            </div>
            </fieldset>
            <div class="mx-5 mt-3">
                <label for="exampleFormControlTextarea1" class="form-label">Solusi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="complaint_text" rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-end mx-5">
                <button type="submit" class="btn btn-secondary btn-lg mt-3">Kirim</button>
            </div>
            </div>
        </div>

    @include('template.script')
  </body>
</html>