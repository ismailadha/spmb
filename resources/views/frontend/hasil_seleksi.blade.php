@extends('frontend.main')

@section('content')
<style>
    .seleksi-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 4rem 0;
        border-bottom: 1px solid #dee2e6;
    }
    .rounded-xl {
        border-radius: 1rem !important;
    }
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transform: translateY(-3px);
    }
    .form-label {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    .result-card {
        border-left: 5px solid #28a745;
    }
    .result-card.rejected {
        border-left: 5px solid #dc3545;
    }
    .status-badge {
        font-size: 1.25rem;
        padding: 0.75rem 1.5rem;
        border-radius: 50rem;
    }
    .info-table th {
        width: 35%;
        color: #6c757d;
        font-weight: 600;
        border-top: none;
    }
    .info-table td {
        font-weight: 500;
        border-top: none;
    }
    .info-table tr {
        border-bottom: 1px solid #dee2e6;
    }
    .info-table tr:last-child {
        border-bottom: none;
    }
</style>

<div class="seleksi-header text-center mb-5">
    <div class="container">
        <h1 class="display-4 font-weight-bold text-dark">Pengumuman Hasil Seleksi</h1>
        <p class="lead text-secondary mt-3 mx-auto" style="max-width: 800px;">
            Cek status penerimaan peserta didik baru dengan memasukkan Nomor Pendaftaran dan Tanggal Lahir Anda.
        </p>
    </div>
</div>

<div class="container pb-5">
    <!-- Form Pencarian -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-xl hover-shadow">
                <div class="card-body p-4 p-md-5">
                    <h4 class="font-weight-bold text-dark mb-4 text-center">Cek Status Penerimaan</h4>
                    <form action="#" method="POST" id="form-cek-seleksi">
                        <div class="form-group mb-4">
                            <label for="no_pendaftaran" class="form-label">Nomor Pendaftaran</label>
                            <input type="text" class="form-control form-control-lg bg-light" id="no_pendaftaran" placeholder="Masukkan 10 digit nomor pendaftaran..." value="REG-2023-08912">
                        </div>
                        <div class="form-group mb-4">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-lg bg-light" id="tgl_lahir" value="2008-05-15">
                        </div>
                        <button type="button" class="btn btn-primary btn-lg btn-block rounded font-weight-bold mt-2" onclick="showResult()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mr-2 mb-1" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            Cek Hasil Seleksi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dummy Result Section (Hidden until button clicked) -->
    <div id="result-section" class="row justify-content-center d-none">
        <div class="col-lg-10">
            <h3 class="font-weight-bold text-dark mb-4 text-center">Hasil Pencarian</h3>
            
            <div class="card border-0 shadow rounded-xl result-card overflow-hidden">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 text-center">
                    <span class="badge badge-success status-badge justify-content-center align-items-center d-inline-flex mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="mr-2" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        &nbsp;SELAMAT! ANDA DINYATAKAN LULUS
                    </span>
                    <h5 class="text-secondary mb-0">Seleksi Penerimaan Peserta Didik Baru Tahap 1</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h5 class="font-weight-bold mb-3 border-bottom pb-2">Biodata Peserta</h5>
                            <table class="table info-table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <th>No. Pendaftaran</th>
                                        <td>: REG-2023-08912</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>: Ahmad Fauzi R.</td>
                                    </tr>
                                    <tr>
                                        <th>NISN</th>
                                        <td>: 0081234567</td>
                                    </tr>
                                    <tr>
                                        <th>Asal Sekolah</th>
                                        <td>: SD Negeri 1 Banda Sakti</td>
                                    </tr>
                                    <tr>
                                        <th>Jalur Pendaftaran</th>
                                        <td>: Zonasi</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 border-md-left">
                            <h5 class="font-weight-bold mb-3 border-bottom pb-2 pl-md-3">Informasi Penerimaan</h5>
                            <div class="pl-md-3">
                                <p class="text-muted mb-1 font-weight-bold">Diterima di Sekolah:</p>
                                <h4 class="font-weight-bold text-primary mb-3">SMP Negeri 1 Lhokseumawe</h4>
                                
                                <p class="text-muted mb-1 font-weight-bold">Program Keahlian / Jurusan:</p>
                                <h5 class="font-weight-bold text-dark mb-4">MIPA (Matematika dan Ilmu Pengetahuan Alam)</h5>

                                <div class="alert alert-warning mb-0 shadow-sm" style="border-radius: 0.75rem;" role="alert">
                                    <strong class="d-flex align-items-center mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                        Perhatian:
                                    </strong>
                                    Silakan lakukan daftar ulang pada tanggal <strong>10 - 15 Juli 2026</strong> di sekolah penerima dengan membawa berkas asli.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-top-0 py-3 text-center text-md-right px-4 px-md-5">
                    <button class="btn btn-outline-secondary mr-2 mb-2 mb-md-0 font-weight-bold px-4 rounded" onclick="hideResult()">
                        Kembali
                    </button>
                    <button class="btn btn-success font-weight-bold d-inline-flex align-items-center mb-2 mb-md-0 px-4 rounded shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="mr-2" viewBox="0 0 16 16">
                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        </svg>
                        Cetak Bukti Kelulusan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showResult() {
        var btn = document.querySelector('button[onclick="showResult()"]');
        var originalText = btn.innerHTML;
        
        // Loading status
        btn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Mencari data...';
        btn.disabled = true;

        setTimeout(function() {
            // Restore button
            btn.innerHTML = originalText;
            btn.disabled = false;

            // Show result section
            var resultSection = document.getElementById('result-section');
            resultSection.classList.remove('d-none');
            
            // Scroll to result smoothly
            resultSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 800);
    }
    
    function hideResult() {
        var resultSection = document.getElementById('result-section');
        resultSection.classList.add('d-none');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
@endsection