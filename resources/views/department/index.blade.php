@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Department</div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <th class="text-center">{{ $department->name }}</th>
                                    <th class="text-center">
                                        <a class="btn btn-secondary" href="{{ route('department.edit',$department->id) }}">Edit</a>
                                        <button class="btn btn-danger" onClick="handleDelete({{ $department->id }})">
                                            Delete
                                        </button>
                                        <div class="modal fade" id="deleteModal{{$department->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form action="{{ route('department.destroy', $department->id) }}" method="POST"
                                                  id="deleteCategoryForm">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete
                                                                Department</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-center">
                                                                Are you sure you want to delete {{ $department->name }}
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
                        {{ $departments->links() }}
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Create Department</div>
                        <div class="card-body">
                            <form action="{{ route('department.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Department name" name="name" value="{{ old('name') }}" required>
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