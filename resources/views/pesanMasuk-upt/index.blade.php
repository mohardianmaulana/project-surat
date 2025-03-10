<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Pesan Masuk</title>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-header {
            background-color: #6c757d;
            color: white;
            font-weight: bold;
            padding: 15px;
        }
        .btn-custom {
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
    </style>
  </head>
  <body>
    <div class="d-flex">
      @include('template.sidebar')
      @include('template.navbar')

      <div class="container mt-4">
        @foreach ($pesan_masuk as $item)
        <div class="card shadow mb-4">
          <div class="card-header">
            Kepada: {{ $item->unit_name }}
          </div>
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5 class="card-title text-dark">
                <strong>Dari : </strong> {{ $item->user_name }}
                <small class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s || d-m-Y') }}</small>
              </h5>
              <p class="card-text">{{ $item->complaint_text }}</p>
            </div>
            <div>
            <form action="#" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm btn-custom me-2">Balas</button>
            </form>
              <a class="btn btn-secondary btn-sm btn-custom" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}">Detail</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @include('template.script')
    @foreach ($pesan_masuk as $item)
<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">Detail Laporan</h5>
            </div>
            <div class="modal-body">
                <h5>Data Pelapor</h5>
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="col-md-1 text-center">Kepada</th>
                            <th class="col-md-1 text-center">Nama</th>
                            <th class="col-md-2 text-center">NIM</th>
                            <th class="col-md-2 text-center">Nomor</th>
                            <th class="col-md-2 text-center">Permasalahan</th>
                            <th class="col-md-1 text-center">Diajukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="col-md-1 text-center">{{ $item->unit_name }}</td>
                            <td class="col-md-1 text-center">{{ $item->user_name }}</td>
                            <td class="col-md-2 text-center">{{ $item->nim }}</td>
                            <td class="col-md-2 text-center">{{ $item->nomor }}</td>
                            <td class="col-md-2 text-center">{{ $item->complaint_text }}</td>
                            <td class="col-md-1 text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

  </body>

</html>