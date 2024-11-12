@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="text-white card-header bg-primary">Profil Pengguna</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Code Land</th>
                                <td>{{ $user->codeLand }}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>{{ $user->levelId }}</td>
                            </tr>
                            <tr>
                                <th>Buff</th>
                                <td>{{ $user->buffId == 0 ? 'Tidak Ada Buff' : 'Buff ' . $user->buffId }}</td>
                            </tr>
                            <tr>
                                <th>Second Level ID</th>
                                <td>{{ $user->secondLevelId }}</td>
                            </tr>
                            <tr>
                                <th>Second Buff ID</th>
                                <td>{{ $user->secondBuffId == 0 ? 'Tidak Ada Buff' : 'buff' . $user->secondBuffId }}</td>
                            </tr>
                        </table>
                        <div class="mt-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                            <a href="{{ route('logout') }}" class="btn btn-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </div>
                    </div>
                </div>

                <!-- Form Edit Profil -->
                <div class="mt-4 card">
                    <div class="text-white card-header bg-warning">Edit Profil</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="codeLand" class="form-label">Code Land</label>
                                <input type="text" class="form-control @error('codeLand') is-invalid @enderror"
                                    id="codeLand" name="codeLand" value="{{ old('codeLand', $user->codeLand) }}" required>
                                @error('codeLand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="levelId" class="form-label">Level</label>
                                <select class="form-select" id="levelId" name="levelId" required>
                                    <option value="1" {{ $user->levelId == 1 ? 'selected' : '' }}>Level 1</option>
                                    <option value="2" {{ $user->levelId == 2 ? 'selected' : '' }}>Level 2</option>
                                    <option value="3" {{ $user->levelId == 3 ? 'selected' : '' }}>Level 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="buffId" class="form-label">Buff</label>
                                <select class="form-select" id="buffId" name="buffId" required>
                                    <option value="0" {{ $user->buffId == 0 ? 'selected' : '' }}>Tidak Ada Buff
                                    </option>
                                    <option value="1" {{ $user->buffId == 1 ? 'selected' : '' }}>Buff 1</option>
                                    <option value="2" {{ $user->buffId == 2 ? 'selected' : '' }}>Buff 2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="secondLevelId" class="form-label">Second Level ID</label>
                                <select class="form-select" id="secondLevelId" name="secondLevelId">
                                    <option value="1" {{ $user->secondLevelId == 1 ? 'selected' : '' }}>Level 1
                                    </option>
                                    <option value="2" {{ $user->secondLevelId == 2 ? 'selected' : '' }}>Level 2
                                    </option>
                                    <option value="3" {{ $user->secondLevelId == 3 ? 'selected' : '' }}>Level 3
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="secondBuffId" class="form-label">Second Buff ID</label>
                                <select class="form-select" id="secondBuffId" name="secondBuffId">
                                    <option value="0" {{ $user->secondBuffId == 0 ? 'selected' : '' }}>Tidak Ada Buff
                                    </option>
                                    <option value="1" {{ $user->secondBuffId == 1 ? 'selected' : '' }}>Buff 1</option>
                                    <option value="2" {{ $user->secondBuffId == 2 ? 'selected' : '' }}>Buff 2</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Perbarui Profil</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Form Hapus Pengguna -->
                <div class="mt-4 card">
                    <div class="text-white card-header bg-danger">Hapus Akun</div>
                    <div class="card-body">
                        <form action="{{ route('profile.delete') }}" method="POST" id="deleteUserForm">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <label for="password" class="form-label">Masukkan Password untuk Menghapus Akun</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(event)">Hapus
                                Akun</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteUserForm').submit();
                }
            });
        }
    </script>
@endsection
