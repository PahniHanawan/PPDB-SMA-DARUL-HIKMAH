<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('adminLTE/dist/assets/img/logo.png') }}" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- Notifikasi menggunakan SweetAlert2 -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops!',
                text: 'Email atau Password salah!',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    <!-- Login Form -->
    <div class="auth-container" id="loginForm">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Sekolah" class="logo">
        <h2 class="auth-title">Login</h2>
        <form method="POST" action="{{ route('login') }}" onsubmit="return validateForm()">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Email" required
                    value="{{ old('email') }}" onkeyup="checkEmail()">
                <small id="email-error" class="text-danger"></small>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password" required
                        onkeyup="checkPassword()">
                    <span class="input-group-text" onclick="togglePassword('password', 'togglePasswordIcon')">
                        <i id="togglePasswordIcon" class="bi bi-eye"></i>
                    </span>
                </div>
                <small id="password-error" class="text-danger"></small>
            </div>

            <div class="mb-3 form-check text-start">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="rememberMe">Ingat Saya</label>
            </div>
            <button type="submit" class="btn btn-auth">Masuk</button>
        </form>
        <p class="mt-3">Belum punya akun? <a class="toggle-link" href="{{ route('register') }}">Daftar</a></p>
    </div>

    <script>
        // Fungsi untuk menampilkan / menyembunyikan password
        function togglePassword(fieldId, iconId) {
            var passwordField = document.getElementById(fieldId);
            var icon = document.getElementById(iconId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }

        // Validasi email agar formatnya benar
        function checkEmail() {
            let email = document.getElementById("email").value;
            let emailError = document.getElementById("email-error");
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Format email yang benar

            if (!emailRegex.test(email)) {
                emailError.innerText = "Format email tidak valid.";
            } else {
                emailError.innerText = "";
            }
        }

        // Validasi password minimal 8 karakter
        function checkPassword() {
            let password = document.getElementById("password").value;
            let passwordError = document.getElementById("password-error");

            if (password.length < 8) {
                passwordError.innerText = "Password minimal harus 8 karakter.";
            } else {
                passwordError.innerText = "";
            }
        }

        // Validasi sebelum submit form
        function validateForm() {
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            if (!email.includes("@") || !email.includes(".")) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Format email tidak valid!',
                    timer: 3000,
                    showConfirmButton: false
                });
                return false;
            }

            if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Password minimal harus 8 karakter!',
                    timer: 3000,
                    showConfirmButton: false
                });
                return false;
            }

            return true;
        }
    </script>

</body>

</html>
