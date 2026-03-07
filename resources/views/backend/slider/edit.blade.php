@extends('backend.main')

@section('content')
<div class="content-wrapper">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row pt-2">
                {{-- <div class="col-md-12 m-2">
                    <h3>Update Slider</h3>
                </div> --}}
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">Update Slider</h3></div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ url('slider/update' , $slider->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="caption" class="form-label">Caption</label>
                                    <input type="text" class="form-control" id="caption" name="caption" value="{{ $slider->caption }}">
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" value="{{ $slider->gambar }}">
                                    <div class="mt-2">

                                        <img src="{{ asset('storage/' . $slider->gambar) }}" alt="Current Image" class="img-fluid" style="max-width: 200px;" id="current-image">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
