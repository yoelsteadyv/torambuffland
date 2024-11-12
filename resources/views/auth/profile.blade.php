@extends('layouts.app')

@section('content')
    <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">CodeBuffLand</span>
            </a>
            <button data-collapse-toggle="navbar-multi-level" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-multi-level" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                    @auth
                        <li>
                            <a href="{{ route('profile') }}"
                                class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent"
                                aria-current="page">{{ Auth::user()->name }}</a>
                        </li>
                        <button onclick="confirmLogout()"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            aria-current="page">Logout
                        </button>
                    @else
                        <li>
                            <a href="{{ route('login') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                aria-current="page">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                aria-current="page">Register</a>
                        </li>

                    @endauth


                </ul>
            </div>
        </div>
    </nav>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-3/4">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="text-white bg-blue-600 p-4 rounded-t-lg">Profil Pengguna</div>
                    <div class="p-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody>
                                <tr>
                                    <th class="text-left text-sm font-medium text-gray-700">Nama</th>
                                    <td class="text-sm text-gray-900">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left text-sm font-medium text-gray-700">Email</th>
                                    <td class="text-sm text-gray-900">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left text-sm font-medium text-gray-700">Code Land</th>
                                    <td class="text-sm text-gray-900">{{ $user->codeLand }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left text-sm font-medium text-gray-700">Level</th>
                                    <td class="text-sm text-gray-900">{{ $user->levelId }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left text-sm font-medium text-gray-700">Buff</th>
                                    <td class="text-sm text-gray-900">
                                        {{ $user->buffId == 0 ? 'Tidak Ada Buff' : 'Buff ' . $user->buffId }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left text-sm font-medium text-gray-700">Second Level ID</th>
                                    <td class="text-sm text-gray-900">{{ $user->secondLevelId }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left text-sm font-medium text-gray-700">Second Buff ID</th>
                                    <td class="text-sm text-gray-900">
                                        {{ $user->secondBuffId == 0 ? 'Tidak Ada Buff' : 'Buff ' . $user->secondBuffId }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <a href="{{ route('dashboard') }}"
                                class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kembali ke
                                Dashboard</a>
                            <a href="{{ route('logout') }}"
                                class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
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
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', $user->name) }}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror">
                                        @error('name')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', $user->email) }}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror">
                                        @error('email')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="codeLand" class="block text-sm font-medium text-gray-700">Code
                                            Land</label>
                                        <input type="text" name="codeLand" id="codeLand"
                                            value="{{ old('codeLand', $user->codeLand) }}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('codeLand') border-red-500 @enderror">
                                        @error('codeLand')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="levelId" class="block text-sm font-medium text-gray-700">Level</label>
                                        <select
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                            id="levelId" name="levelId" required>
                                            <option value="1" {{ $user->levelId == 1 ? 'selected' : '' }}>Level 1
                                            </option>
                                            <option value="2" {{ $user->levelId == 2 ? 'selected' : '' }}>Level 2
                                            </option>
                                            <option value="3" {{ $user->levelId == 3 ? 'selected' : '' }}>Level 3
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="buffId" class="block text-sm font-medium text-gray-700">Buff</label>
                                        <select
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                            id="buffId" name="buffId" required>
                                            <option value="0" {{ $user->buffId == 0 ? 'selected' : '' }}>Tidak Ada
                                                Buff</option>
                                            <option value="1" {{ $user->buffId == 1 ? 'selected' : '' }}>Buff 1
                                            </option>
                                            <option value="2" {{ $user->buffId == 2 ? 'selected' : '' }}>Buff 2
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="secondLevelId" class="block text-sm font-medium text-gray-700">Second
                                            Level ID</label>
                                        <select
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                            id="secondLevelId" name="secondLevelId">
                                            <option value="1" {{ $user->secondLevelId == 1 ? 'selected' : '' }}>Level
                                                1</option>
                                            <option value="2" {{ $user->secondLevelId == 2 ? 'selected' : '' }}>Level
                                                2</option>
                                            <option value="3" {{ $user->secondLevelId == 3 ? 'selected' : '' }}>Level
                                                3</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="secondBuffId" class="block text-sm font-medium text-gray-700">Second
                                            Buff ID</label>
                                        <select
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                            id="secondBuffId" name="secondBuffId">
                                            <option value="0" {{ $user->secondBuffId == 0 ? 'selected' : '' }}>Tidak
                                                Ada Buff</option>
                                            <option value="1" {{ $user->secondBuffId == 1 ? 'selected' : '' }}>Buff 1
                                            </option>
                                            <option value="2" {{ $user->secondBuffId == 2 ? 'selected' : '' }}>Buff 2
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Perbarui Profil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Form Hapus Pengguna -->
                <div class="mt-4 bg-white shadow-md rounded-lg mb-6">
                    <div class="text-white bg-red-600 p-4 rounded-t-lg">Hapus Akun</div>
                    <div class="p-4">
                        <form action="{{ route('profile.delete') }}" method="POST" id="deleteUserForm">
                            @csrf
                            @method('DELETE')
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Masukkan Password
                                    untuk Menghapus Akun</label>
                                <input type="password" id="password" name="password" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="button"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                onclick="confirmDelete(event)">Hapus Akun</button>
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
