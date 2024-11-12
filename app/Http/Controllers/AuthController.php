<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  // Menampilkan halaman dashboard
  public function dashboard()
  {
    $users = User::all(); // Ambil semua data user
    return view('welcome', compact('users'));
  }

  // Menampilkan form login
  public function showLoginForm()
  {
    return view('auth.login');
  }

  // Menampilkan form register
  public function showRegisterForm()
  {
    return view('auth.register');
  }

  // Menampilkan profil pengguna
  public function showProfile()
  {
    return view('auth.profile', ['user' => Auth::user()]);
  }

  // Proses login
  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
      return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    return back()->withErrors([
      'email' => 'Email atau password salah.',
    ]);
  }

  // Proses register
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
  }

  // Proses logout
  public function logout(Request $request)
  {
    Auth::logout();
    return redirect()->route('dashboard')->with('success', 'Anda telah logout.');
  }

  // Menampilkan form edit profil
  public function showEditProfile()
  {
    return view('auth.edit', ['user' => Auth::user()]);
  }

  // Proses update profil
  public function updateProfile(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
      'codeLand' => 'required|string|max:255',
      'levelId' => 'required|integer',
      'buffId' => 'required|integer',
      'secondLevelId' => 'nullable|integer',
      'secondBuffId' => 'nullable|integer',
    ]);

    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->codeLand = $request->codeLand;
    $user->levelId = $request->levelId;
    $user->buffId = $request->buffId;
    $user->secondLevelId = $request->secondLevelId;
    $user->secondBuffId = $request->secondBuffId;
    $user->save();

    return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
  }

  // Proses update password
  public function updatePassword(Request $request)
  {
    $request->validate([
      'current_password' => 'required|string',
      'password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    // Cek apakah password saat ini benar
    if (!Hash::check($request->current_password, $user->password)) {
      return back()->withErrors(['current_password' => 'Password saat ini tidak valid.']);
    }

    // Update password
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('profile')->with('success', 'Password berhasil diperbarui!');
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'password' => 'required|string',
    ]);

    $user = Auth::user();

    // Cek apakah password yang dimasukkan benar
    if (!Hash::check($request->password, $user->password)) {
      return back()->withErrors(['password' => 'Password yang dimasukkan tidak valid.']);
    }

    Auth::logout(); // Logout pengguna setelah dihapus
    $user->delete(); // Hapus pengguna dari database

    return redirect('/')->with('success', 'Akun Anda telah dihapus.');
  }
}
