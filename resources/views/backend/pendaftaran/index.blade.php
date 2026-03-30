@extends('backend.main')

@section('pendaftaran-menu-active', 'active')

@section('content')
    <!--begin::Card-->
    <div class="card" style="background-color: #fff5f5; border: 1px solid #ffe2e5;">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3>Data Pendaftaran</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            {{-- Status data sudah submit --}}
            <div class="alert alert-success">
                Data anda sudah submit
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection
