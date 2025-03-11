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
       <form action="{{ route('response.store') }}" method="POST">
      <div class="card mt-3 mx-3 shadow" style="border-radius: 15px;">
        <div class="card-body">
            <h1 class="mx-5 mb-3" style="color: grey;">Laporan</h1>
            @if (session('success'))
                <div class="alert alert-success mx-5">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('response.store') }}" method="POST">
             @csrf

            
                <input type="hidden" name="complaint_id" value="{{ $balasPesan->id }}">
                <input type="hidden" name="unit_id" value="{{ $balasPesan->unit_id }}">

                <div class="mx-5 mt-3">
                    <label for="namaPelapor" class="form-label">Nama Pelapor</label>
                    <input type="text" class="form-control" value="{{ $balasPesan->user_name }}" readonly>
                </div>

                <div class="mx-5 mt-3">
                    <label for="complaintText" class="form-label">Laporan</label>
                    <textarea class="form-control" rows="3" readonly>{{ $balasPesan->complaint_text }}</textarea>
                </div>

                <div class="mx-5 mt-3">
                    <label for="namaUPT" class="form-label">Nama UPT</label>
                    <input type="text" class="form-control" value="{{ $balasPesan->unit_name }}" readonly>
                </div>
            

            <div class="mx-5 mt-3">
                <label for="response_text" class="form-label">Solusi</label>
                <textarea class="form-control" id="response_text" name="response_text" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-end mx-5">
                <a href="{{ route('pesanupt') }}" class="btn btn-danger btn-lg mt-3 mx-3">Kembali</a>
                <button type="submit" class="btn btn-secondary btn-lg mt-3">Kirim</button>
            </div>
            </form>

            </div>
        </div>

    @include('template.script')
  </body>
</html>