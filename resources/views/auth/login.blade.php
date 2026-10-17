<x-layout title="Login Pustakawan">
    <div class="row justify-content-center py-4">
        <div class="col-12 col-md-8 col-lg-5">
            <!-- Kartu Login Pustakawan -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden; border: 1px solid var(--del-border);">
                <!-- Banner Header Del -->
                <div class="p-4 text-center text-white" style="background: linear-gradient(135deg, var(--del-primary) 0%, var(--del-primary-hover) 100%);">
                    <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle mb-3 shadow-sm" style="background-color: rgba(255, 255, 255, 0.15); width: 64px; height: 64px;">
                        <i class="bi bi-shield-lock-fill fs-2 text-white"></i>
                    </div>
                    <h1 class="h4 fw-bold mb-1 text-white">Portal Pustakawan Del</h1>
                    <p class="small text-white-50 mb-0">Masuk untuk mengelola sirkulasi buku, mutasi data, dan transaksi perpustakaan.</p>
                </div>

                <div class="card-body p-4 p-md-4">
                    <!-- Demo Account Info Box -->
                    <div class="p-3 mb-4 rounded-3" style="background-color: var(--del-soft-purple); border: 1px solid var(--del-border-purple);">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-info-circle-fill" style="color: var(--del-primary);"></i>
                            <span class="fw-bold small" style="color: var(--del-primary);">Akun Pengujian Modul Minggu 6</span>
                        </div>
                        <div class="small text-muted" style="font-size: 0.8rem;">
                            Email: <code class="fw-semibold text-dark">pustakawan@del.ac.id</code><br>
                            Password: <code class="fw-semibold text-dark">password123</code>
                        </div>
                    </div>

                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login.attempt') }}" novalidate>
                        @csrf

                        <!-- Input Email Pustakawan -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark small">
                                Alamat Email Pustakawan <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email"
                                       class="form-control border-start-0 @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $rememberedEmail ?? request()->cookie('del_last_librarian_email')) }}"
                                       placeholder="nama@del.ac.id"
                                       required
                                       autofocus
                                       style="border-radius: 0 8px 8px 0; font-size: 0.875rem;">
                            </div>
                            @if ($rememberedEmail ?? request()->cookie('del_last_librarian_email'))
                                <div class="form-text text-muted" style="font-size: 0.725rem;">
                                    <i class="bi bi-cookie text-primary"></i> Email dipulihkan dari cookie browser (Sesi sebelumnya).
                                </div>
                            @endif
                            @error('email')
                                <div class="invalid-feedback d-block small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Input Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-dark small">
                                Kata Sandi <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">
                                    <i class="bi bi-key"></i>
                                </span>
                                <input type="password"
                                       class="form-control border-start-0 @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Masukkan kata sandi..."
                                       required
                                       style="border-radius: 0 8px 8px 0; font-size: 0.875rem;">
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me & Keamanan Sesi -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                                <label class="form-check-label small text-muted" for="remember">
                                    Ingat sesi saya di perangkat ini
                                </label>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-del btn-lg justify-content-center py-2" style="font-size: 0.95rem;">
                                <i class="bi bi-box-arrow-in-right"></i> Masuk ke SIPUS-Del
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none small text-muted">
                                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard Publik
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
