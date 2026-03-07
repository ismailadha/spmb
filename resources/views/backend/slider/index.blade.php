@extends('backend.main')

@section('content')
<div class="content-wrapper">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row pt-4">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Slider</h3>
                            <div class="card-tools">
                                <a href="{{ route('slider.create') }}" class="btn btn-primary btn-sm">Add New</a>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Caption</th>
                                        <th>Image</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($sliders->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">No sliders found.</td>
                                        </tr>
                                    @else
                                        @foreach ($sliders as $slider)
                                        <?php $counter = 1; ?>
                                            <tr class="align-middle">
                                                <td>{{ $counter }}</td>
                                                <td>{{ $slider->caption }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $slider->gambar) }}" alt="Slider Image" class="img-fluid" style="max-width: 150px;">
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ url('slider/edit/' . $slider->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                        <form action="{{ url('slider/destroy/' . $slider->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slider?');" style="display: inline-block;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $counter++; ?>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-end">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
