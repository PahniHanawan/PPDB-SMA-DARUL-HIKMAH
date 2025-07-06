<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    <!-- Notifikasi Laravel dengan SweetAlert2 -->
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

    <!-- Register Form -->
    <div class="auth-container">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Sekolah" class="logo">
        <h2 class="auth-title">Register</h2>
        <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm(event)">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required
                        placeholder="Masukkan Password Anda" onkeyup="checkPassword()">
                    <span class="input-group-text" onclick="togglePassword('password', 'togglePasswordIcon')">
                        <i id="togglePasswordIcon" class="bi bi-eye"></i>
                    </span>
                </div>
                <small id="password-error" class="text-danger"></small>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required placeholder="Konfirmasi Password Anda" onkeyup="checkPassword()">
                    <span class="input-group-text"
                        onclick="togglePassword('password_confirmation', 'toggleConfirmPasswordIcon')">
                        <i id="toggleConfirmPasswordIcon" class="bi bi-eye"></i>
                    </span>
                </div>
                <small id="confirm-password-error" class="text-danger"></small>
            </div>

            <button type="submit" class="btn btn-auth">Daftar</button>
        </form>
        <p class="mt-3">Sudah punya akun? <a class="toggle-link" href="{{ route('login') }}">Masuk</a></p>
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

        // Validasi Password Minimal 8 Karakter & Konfirmasi Password
        function checkPassword() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("password_confirmation").value;
            let passwordError = document.getElementById("password-error");
            let confirmPasswordError = document.getElementById("confirm-password-error");

            // Validasi minimal 8 karakter
            if (password.length < 8) {
                passwordError.innerText = "Password minimal harus 8 karakter.";
            } else {
                passwordError.innerText = "";
            }

            // Validasi konfirmasi password
            if (confirmPassword && password !== confirmPassword) {
                confirmPasswordError.innerText = "Konfirmasi password tidak sesuai.";
            } else {
                confirmPasswordError.innerText = "";
            }
        }

        // Validasi sebelum submit form dengan SweetAlert2
        function validateForm(event) {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("password_confirmation").value;

            if (password.length < 8) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Password minimal harus 8 karakter!',
                    timer: 3000,
                    showConfirmButton: false
                });
                return false;
            }

            if (password !== confirmPassword) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Konfirmasi password tidak sesuai!',
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
