@extends('backend.main')

@section('jadwal-menu-active')
    active
@endsection

@section('jadwal-menu-open')
    show
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-8">Buat Jadwal Pendaftaran Baru</h4>
        
        <!-- Wizard Progress / Tabs -->
        <ul class="nav nav-pills nav-fill mb-8" id="wizard-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="step1-tab" data-bs-toggle="pill" data-bs-target="#step1" type="button" role="tab" aria-controls="step1" aria-selected="true" disabled>
                    <span class="d-block">Step 1</span>
                    <strong>Periode Pendaftaran</strong>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="step2-tab" data-bs-toggle="pill" data-bs-target="#step2" type="button" role="tab" aria-controls="step2" aria-selected="false" disabled>
                    <span class="d-block">Step 2</span>
                    <strong>Sekolah & Jalur</strong>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="step3-tab" data-bs-toggle="pill" data-bs-target="#step3" type="button" role="tab" aria-controls="step3" aria-selected="false" disabled>
                    <span class="d-block">Step 3</span>
                    <strong>Jadwal & Kuota</strong>
                </button>
            </li>
        </ul>

        <form id="wizard-form" method="POST" action="{{ route('jadwal.store') }}">
            @csrf
            <div class="tab-content" id="wizard-content">
                
                <!-- Step 1 Content -->
                <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                    <h5 class="mb-3">Pilih Periode Pendaftaran</h5>
                    <p class="text-muted mb-6">Pilih periode yang sedang aktif untuk jadwal pendaftaran ini.</p>
                    
                    <div class="mb-5">
                        <label class="form-label required">Periode Pendaftaran</label>
                        <select name="periode_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Periode" required>
                            <option value=""></option>
                            @foreach($periodes as $periode)
                                <option value="{{ $periode->id }}">
                                    {{ $periode->tahun_ajaran }} @if($periode->semester)- {{ $periode->semester }}@endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Step 2 Content -->
                <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                    <h5 class="mb-3">Sekolah & Jalur Tujuan</h5>
                    <p class="text-muted mb-6">Pilih sekolah target dan jalur pendaftaran untuk jadwal ini.</p>
                    
                    <div class="mb-5">
                        <label class="form-label required">Sekolah</label>
                        <select name="sekolah_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Sekolah" required>
                            <option value=""></option>
                            @foreach($sekolahs as $sekolah)
                                <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="form-label required">Jalur Pendaftaran</label>
                        <select name="jalur_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Jalur" required>
                            <option value=""></option>
                            @foreach($jalurs as $jalur)
                                <option value="{{ $jalur->id }}">{{ $jalur->nama_jalur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Step 3 Content -->
                <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                    <h5 class="mb-3">Jadwal & Kuota</h5>
                    <p class="text-muted mb-6">Tentukan waktu mulai, selesai, dan kuota.</p>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-solid" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-solid" required />
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Kuota (Opsional)</label>
                        <input type="number" name="kuota" class="form-control form-control-solid" placeholder="Contoh: 100" />
                    </div>
                </div>
            </div>

            <!-- Wizard Navigation -->
            <div class="d-flex justify-content-between mt-8 pt-5 border-top border-light">
                <button type="button" class="btn btn-secondary d-none" id="btn-prev">Kembali</button>
                <div class="ms-auto">
                    <button type="button" class="btn btn-primary" id="btn-next">Lanjut</button>
                    <button type="submit" class="btn btn-primary d-none" id="btn-submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = ['step1', 'step2', 'step3'];
        let currentStep = 0;

        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');
        const btnSubmit = document.getElementById('btn-submit');
        
        const tabLinks = [
            document.getElementById('step1-tab'),
            document.getElementById('step2-tab'),
            document.getElementById('step3-tab')
        ];
        
        const tabPanes = [
            document.getElementById('step1'),
            document.getElementById('step2'),
            document.getElementById('step3')
        ];

        function updateUI() {
            // Hide all
            tabPanes.forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            // Show current
            tabPanes[currentStep].classList.add('show', 'active');

            // Update Progress Nav
            tabLinks.forEach((link, index) => {
                if (index <= currentStep) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            // Buttons
            if (currentStep === 0) {
                btnPrev.classList.add('d-none');
            } else {
                btnPrev.classList.remove('d-none');
            }

            if (currentStep === tabs.length - 1) {
                btnNext.classList.add('d-none');
                btnSubmit.classList.remove('d-none');
            } else {
                btnNext.classList.remove('d-none');
                btnSubmit.classList.add('d-none');
            }
        }

        function validateStep() {
            const currentPane = tabPanes[currentStep];
            // Validasi select dan select2 serta input biasa
            const requiredInputs = currentPane.querySelectorAll('input[required], select[required]');
            let isValid = true;
            
            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                    
                    // Validasi tampilan select2
                    if (input.tagName === 'SELECT') {
                        $(input).next('.select2-container').find('.select2-selection').css('border-color', '#f1416c');
                    }
                } else {
                    input.classList.remove('is-invalid');
                    if (input.tagName === 'SELECT') {
                        $(input).next('.select2-container').find('.select2-selection').css('border-color', '');
                    }
                }
            });

            return isValid;
        }

        btnNext.addEventListener('click', function () {
            if (validateStep()) {
                if (currentStep < tabs.length - 1) {
                    currentStep++;
                    updateUI();
                }
            }
        });

        btnPrev.addEventListener('click', function () {
            if (currentStep > 0) {
                currentStep--;
                updateUI();
            }
        });
        
        document.querySelectorAll('input[required], select[required]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
            });
        });

        $('select[data-control="select2"]').on('change', function() {
            if ($(this).val()) {
                $(this).removeClass('is-invalid');
                $(this).next('.select2-container').find('.select2-selection').css('border-color', '');
            }
        });
    });
</script>
@endsection
