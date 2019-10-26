@extends('layouts.app',['activePage' => 'branch', 'titlePage' => __('ภาควิชา')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการสาขาวิชา
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped-column">
                        <thead>
                        <tr>
                            <th class="text-center">ชื่อสาขาวิชา</th>
                            <th class="text-center">ชื่อภาควิชา</th>
                            <th class="text-center">การจัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)
                            <tr>
                                <th class="text-center">{{ $branch->name }}</th>
                                <th class="text-center">{{ $branch->departments->name }}</th>
                                <th class="text-center">
                                    <a class="btn btn-success btn-link"
                                       href="{{ route('branch.edit',$branch->id) }}">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button class="btn btn-danger btn-link"
                                            onClick="handleDelete({{ $branch->id }})">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <div class="modal fade" id="deleteModal{{$branch->id}}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form action="{{ route('branch.destroy', $branch->id) }}" method="POST"
                                              id="deleteCategoryForm">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete
                                                            Branch</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center">
                                                            Are you sure you want to delete {{ $branch->name }}
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
                    {{ $branches->links() }}
                </div>
            </div>
            <hr>
            <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">สร้างสาขาวิชา <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true"><a class="fas fa-close" data-toggle="modal" data-target="#modal-close"></a></span>
                                        </button></h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('branch.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อสาขาวิชา"
                                                   name="name" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <select name="department_id" class="form-control">
                                                <option value="0">กรุณาเลือกคณะ</option>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary">สร้าง</button>
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