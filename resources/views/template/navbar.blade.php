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