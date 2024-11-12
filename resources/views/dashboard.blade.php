@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dashbosidjhfksdjf</h3>
        </div>
        <div class="card-body">
            @auth
                <h4>Selamat datang, {{ Auth::user()->name }}!</h4>
                <a href="{{ route('profile') }}" class="btn btn-primary">Edit Profile</a>
                <button onclick="confirmLogout()" class="btn btn-danger">Logout</button>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <p>Anda belum login. <a href="{{ route('login') }}">Login disini</a></p>
            @endauth
        </div>
    </div>

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
    </script>
@endsection
