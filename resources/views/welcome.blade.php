@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-white card-header bg-primary">
                        <h4 class="mb-0">Dashboard</h4>
                    </div>
                    <div class="card-body">
                        @auth
                            <div class="alert alert-success">
                                Selamat datang, {{ Auth::user()->name }}!
                            </div>

                            <!-- Card untuk menampilkan data user -->
                            <div class="mb-3 card">
                                <div class="card-header">
                                    <h5 class="mb-0">Informasi User</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3 text-center">
                                                <i class="fas fa-user-circle fa-5x text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <table class="table">
                                                <tr>
                                                    <th width="30%">Nama</th>
                                                    <td>: {{ Auth::user()->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>: {{ Auth::user()->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Code Land</th>
                                                    <td>
                                                        <span class="codeLand"
                                                            onclick="copyToClipboard('{{ Auth::user()->codeLand }}')">
                                                            {{ Auth::user()->codeLand }}
                                                        </span>
                                                        <i class="fas fa-copy"
                                                            onclick="copyToClipboard('{{ Auth::user()->codeLand }}')"
                                                            style="cursor: pointer; margin-left: 5px;"
                                                            title="Salin Code Land"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Level</th>
                                                    <td>: Level {{ Auth::user()->levelId }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Buff</th>
                                                    <td>:
                                                        {{ Auth::user()->buffId == 0 ? 'Tidak Ada Buff' : 'Buff ' . Auth::user()->buffId }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Second Level ID</th>
                                                    <td>: Level {{ Auth::user()->secondLevelId }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Second Buff ID</th>
                                                    <td>:
                                                        {{ Auth::user()->secondBuffId == 0 ? 'Tidak Ada Buff' : 'Buff ' . Auth::user()->secondBuffId }}
                                                    </td>
                                                </tr>
                                            </table>

                                            <div class="mt-3">
                                                <a href="{{ route('profile') }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> Edit Profile
                                                </a>
                                                <button onclick="confirmLogout()" class="btn btn-danger">
                                                    <i class="fas fa-sign-out-alt"></i> Logout
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center">
                                <h4>Selamat Datang di Aplikasi Kami</h4>
                                <p>Silakan login atau register untuk mengakses fitur lengkap.</p>
                                <div class="mt-4">
                                    <a href="{{ route('login') }}" class="btn btn-primary me-2">
                                        <i class="fas fa-sign-in-alt"></i> Login
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-success">
                                        <i class="fas fa-user-plus"></i> Register
                                    </a>
                                </div>
                            </div>
                        @endauth

                        <!-- Filter Section -->
                        <div class="mt-4">
                            <h5>Filter Pengguna</h5>
                            <div class="mb-3">
                                <label for="filterLevel" class="form-label">Pilih Level</label>
                                <select id="filterLevel" class="form-select" onchange="filterUsers()">
                                    <option value="">Semua Level</option>
                                    <option value="1">Level 1</option>
                                    <option value="2">Level 2</option>
                                    <option value="3">Level 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="filterBuff" class="form-label">Pilih Buff</label>
                                <select id="filterBuff" class="form-select" onchange="filterUsers()">
                                    <option value="">Semua Buff</option>
                                    <option value="0">Tidak Ada Buff</option>
                                    <option value="1">Buff 1</option>
                                    <option value="2">Buff 2</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tampilkan daftar pengguna -->
                        <h5 class="mt-4">Daftar Pengguna</h5>
                        <table class="table" id="userTable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Code Land</th>
                                    <th>Level</th>
                                    <th>Buff</th>
                                    <th>Second Level ID</th>
                                    <th>Second Buff ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr data-level="{{ $user->levelId }}" data-buff="{{ $user->buffId }}"
                                        data-second-level="{{ $user->secondLevelId }}"
                                        data-second-buff="{{ $user->secondBuffId }}">
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <span class="codeLand" onclick="copyToClipboard('{{ $user->codeLand }}')">
                                                {{ $user->codeLand }}
                                            </span>
                                            <i class="fas fa-copy" onclick="copyToClipboard('{{ $user->codeLand }}')"
                                                style="cursor: pointer; margin-left: 5px;" title="Salin Code Land"></i>
                                        </td>
                                        <td>{{ $user->levelId }}</td>
                                        <td>{{ $user->buffId == 0 ? 'Tidak Ada Buff' : 'Buff ' . $user->buffId }}</td>
                                        <td>{{ $user->secondLevelId }}</td>
                                        <td>{{ $user->secondBuffId == 0 ? 'Tidak Ada Buff' : 'Buff ' . $user->secondBuffId }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Logout -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari sistem",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }

        // Function to copy Code Land to clipboard
        function copyToClipboard(codeLand) {
            const input = document.createElement('input');
            input.setAttribute('value', codeLand);
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Code Land telah disalin ke clipboard.'
            });
        }

        // Filter users based on selected levels and buffs
        function filterUsers() {
            const selectedLevel = document.getElementById('filterLevel').value;
            const selectedBuff = document.getElementById('filterBuff').value;
            const rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(row => {
                const level = row.getAttribute('data-level');
                const buff = row.getAttribute('data-buff');
                const secondLevel = row.getAttribute('data-second-level');
                const secondBuff = row.getAttribute('data-second-buff');

                // Logika filter
                const levelMatch = selectedLevel === "" || selectedLevel === level || selectedLevel === secondLevel;
                const buffMatch = selectedBuff === "" || selectedBuff === buff;

                if (levelMatch && buffMatch) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        }
    </script>
@endsection
