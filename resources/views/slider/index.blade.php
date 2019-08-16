@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Slider</div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Detail</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <th class="text-center"><img style="height: 100px;width: 100px;"
                                                                 src="{{asset('storage/'.$slider->image)}}"></th>
                                    <th class="text-center">{{ $slider->title }}</th>
                                    <th class="text-center">{{ $slider->detail }}</th>
                                    <th class="text-center">{{ $slider->status->name }}</th>
                                    <th class="text-center">
                                        <a class="btn btn-secondary"
                                           href="{{ route('slider.edit',$slider->id) }}">Edit</a>
                                        <button class="btn btn-danger" onClick="handleDelete({{ $slider->id }})">
                                            Delete
                                        </button>
                                        <div class="modal fade" id="deleteModal{{$slider->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form action="{{ route('slider.destroy', $slider->id) }}" method="POST"
                                                  id="deleteCategoryForm">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete
                                                                Slider</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-cetner">
                                                                Are you sure you want to delete {{ $slider->title }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">No, Go back
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Yes, Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $sliders->links() }}
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Create Slider</div>
                        <div class="card-body">
                            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Slider name" name="title"
                                           value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Slider detail" name="detail"
                                           value="{{ old('detail') }}">
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="image" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="0">Select Status</option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function handleDelete(id) {
            $('#deleteModal' + id).modal('show');
        }
    </script>
@endsection