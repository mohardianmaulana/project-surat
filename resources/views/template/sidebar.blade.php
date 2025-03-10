<!-- Sidebar -->
    <div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-light vh-100" style="width: 280px;">
      <a href="/" class="d-flex align-items-center justify-content-center w-100 text-decoration-none" style="color: blue;">
        <img src="{{ asset('template/img/Logo Poliwangi.png') }}"  alt="Logo" width="50" height="50">
        <span class="sidebar-text fs-4 mx-2" style="color: black;">ULT<sup class="mx-1">Poliwangi</sup></span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="mb-3"><a href="#" id="list" class="nav-link link-dark"><i id="icon" class="fa-solid fa-house fa-lg"></i><span id="text" class="sidebar-text ms-3">Home</span></a></li>
        <li class="mb-3"><a href="/dashboard" id="list-1" class="nav-link link-dark"><i id="icon1" class="fa-solid fa-database fa-lg "></i><span id="text1" class="sidebar-text ms-3">Dashboard</span></a></li>
        <li class="mb-3"><a href="/pelapor" id="list-4" class="nav-link link-dark"><i id="icon4" class="fa-solid fa-user fa-lg "></i><span id="text4" class="sidebar-text ms-3">Pelapor</span></a></li>
        @if(Auth::user()->getRoleNames()->first() == 'pelapor')
        <li class="mb-3"><a href="/balasan" id="list-2" class="nav-link link-dark"><i id="icon2" class="fa-solid fa-envelope fa-lg "></i><span id="text2" class="sidebar-text ms-3">Pesan Masuk</span></a></li>
        <li class="mb-3"><a href="/pesanKeluar" id="list-3" class="nav-link link-dark"><i id="icon3" class="fa-solid fa-envelope-open fa-lg "></i><span id="text3" class="sidebar-text ms-3">Pesan Keluar</span></a></li>
        @endif
        @if(Auth::user()->getRoleNames()->first() == 'admin')
        <li class="mb-3"><a href="/pesan-masuk" id="list-2" class="nav-link link-dark"><i id="icon2" class="fa-solid fa-envelope fa-lg "></i><span id="text2" class="sidebar-text ms-3">Pesan Masuk</span></a></li>
        <li class="mb-3"><a href="#" id="list-3" class="nav-link link-dark"><i id="icon3" class="fa-solid fa-envelope-open fa-lg "></i><span id="text3" class="sidebar-text ms-3">Pesan Keluar</span></a></li>
        @endif
        @if(Auth::user()->getRoleNames()->first() == 'upt')
        <li class="mb-3"><a href="/pesanupt" id="list-2" class="nav-link link-dark"><i id="icon2" class="fa-solid fa-envelope fa-lg "></i><span id="text2" class="sidebar-text ms-3">Pesan Masuk</span></a></li>
        <li class="mb-1"><a href="#" id="list-3" class="nav-link link-dark"><i id="icon3" class="fa-solid fa-envelope-open fa-lg "></i><span id="text3" class="sidebar-text ms-3">Pesan Keluar</span></a></li>
        @endif
      
      </ul>
      <hr>
      <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="border-0 btn btn-light" id="sidebarToggle">
                <i class="fa-regular fa-circle-right fa-2xl"></i>
            </button>
        </div>
    </div>