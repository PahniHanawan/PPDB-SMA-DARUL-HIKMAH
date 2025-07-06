<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="m-0">Manajemen Pengguna</h3>
            </div>

            <div class="card-body">
                <!-- Alert Success dari Session -->
                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: "{{ session('success') }}",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        });
                    </script>
                @endif

                <!-- Tabel Data -->
                <div class="table-responsive">
                    <table id="pendaftarTable" class="table table-hover table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span
                                            class="badge
                                            {{ $user->role == 'admin' ? 'bg-success' : ($user->role == 'cpd' ? 'bg-primary' : 'bg-secondary') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <select class="form-select role-select w-100" data-id="{{ $user->id }}">
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="cpd" {{ $user->role == 'cpd' ? 'selected' : '' }}>Calon
                                                Peserta Didik</option>
                                        </select>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- DataTables & SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#pendaftarTable').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "→",
                        previous: "←"
                    }
                }
            });

            $('.role-select').change(function() {
                var userId = $(this).data('id');
                var newRole = $(this).val();

                Swal.fire({
                    title: 'Konfirmasi Perubahan',
                    text: "Apakah Anda yakin ingin mengubah role pengguna ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('/admin/users') }}/' + userId + '/update-role',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                role: newRole
                            },
                            success: function() {
                                Swal.fire(
                                    'Berhasil!',
                                    'Role pengguna telah diperbarui.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan, silakan coba lagi.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</x-layout>
