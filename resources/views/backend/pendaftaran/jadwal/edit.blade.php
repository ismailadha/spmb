@extends('backend.main')

@section('jadwal-menu-active')
    active
@endsection

@section('jadwal-menu-open')
    show
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Edit Jadwal Pendaftaran</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Edit jadwal pendaftaran</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('jadwal.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left fs-4 me-2"></i>Kembali
                </a>
            </div>
        </div>
        <div class="card-body py-4">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-success">Berhasil</h4>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-10">
                            <label class="form-label required">Periode Pendaftaran</label>
                            <select name="periode_id" class="form-select form-select-solid" required>
                                <option value="">Pilih Periode</option>
                                @foreach($periodes as $periode)
                                    <option value="{{ $periode->id }}" {{ $jadwal->periode_id == $periode->id ? 'selected' : '' }}>
                                        {{ $periode->tahun_ajaran }} @if($periode->semester)- {{ $periode->semester }}@endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-10">
                            <label class="form-label required">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-solid" value="{{ $jadwal->tanggal_mulai ? \Carbon\Carbon::parse($jadwal->tanggal_mulai)->format('Y-m-d') : '' }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-10">
                            <label class="form-label required">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-solid" value="{{ $jadwal->tanggal_selesai ? \Carbon\Carbon::parse($jadwal->tanggal_selesai)->format('Y-m-d') : '' }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-10">
                            <label class="form-label required">Kuota</label>
                            <input type="number" name="kuota" class="form-control form-control-solid" value="{{ $jadwal->kuota }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-10">
                            <label class="form-label required">Status</label>
                            <select name="status" class="form-select form-select-solid" required>
                                <option value="draft" {{ $jadwal->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="open" {{ $jadwal->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="selesai" {{ $jadwal->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-10">
                            <label class="form-label required">Sekolah</label>
                            <select name="sekolah_id" class="form-select form-select-solid" required>
                                <option value="">Pilih Sekolah</option>
                                @foreach($sekolahs as $sekolah)
                                    <option value="{{ $sekolah->id }}" {{ $jadwal->sekolah_id == $sekolah->id ? 'selected' : '' }}>{{ $sekolah->nama_sekolah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-10">
                            <label class="form-label required">Jalur</label>
                            <select name="jalur_id" class="form-select form-select-solid" required>
                                <option value="">Pilih Jalur</option>
                                @foreach($jalurs as $jalur)
                                    <option value="{{ $jalur->id }}" {{ $jadwal->jalur_id == $jalur->id ? 'selected' : '' }}>{{ $jalur->nama_jalur }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!--end::Card-->
@endsection