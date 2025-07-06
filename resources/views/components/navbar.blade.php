 <nav class="app-header navbar navbar-expand bg-body">
     <div class="container-fluid">
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                     <i class="bi bi-list"></i>
                 </a>
             </li>
         </ul>
         <ul class="navbar-nav ms-auto">
             <li class="nav-item dropdown user-menu">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                     @php
                         $pasfoto = Auth::user()->dokumen->where('kategori_dokumen', 'PasFoto')->first();
                         $fotoProfil = $pasfoto
                             ? asset('storage/' . $pasfoto->file_path)
                             : asset('adminLTE/dist/assets/img/profile.png');
                     @endphp
                     <img src="{{ $fotoProfil }}" class="user-image rounded-circle shadow" alt="User Image" />
                     <span class="d-none d-md-inline">
                         @if (Auth::user()->pendaftaran && !empty(Auth::user()->pendaftaran->nama))
                             {{ Auth::user()->pendaftaran->nama }}
                         @else
                             {{ Auth::user()->email }}
                         @endif
                     </span>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <li class="user-header text-bg-primary">
                         <img src="{{ $fotoProfil }}" class="rounded-circle shadow" alt="User Image" />
                         <p>
                             @if (Auth::user()->pendaftaran && !empty(Auth::user()->pendaftaran->nama))
                                 {{ Auth::user()->pendaftaran->nama }}
                             @else
                                 {{ Auth::user()->email }}
                             @endif
                             <small>
                                 @if (Auth::user()->role === 'cpd')
                                     Calon Peserta Didik
                                 @else
                                     {{ ucfirst(Auth::user()->role) }}
                                 @endif
                             </small>
                         </p>
                     </li>
                 </ul>
             </li>
         </ul>


     </div>
 </nav>
