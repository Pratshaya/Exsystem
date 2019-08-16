@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-item-center">
                            User
                            <div class="ml-auto">
                                <a href="{{route('user.create')}}" class="btn  btn-sm btn-outline-secondary">Create
                                    User</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped border">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    @foreach($user->roles as $role)
                                        <td>{{ $role->display_name }}</td>
                                    @endforeach
                                    <td>
                                        <a href="{{route('user.edit',$user->id)}}"
                                           class="btn btn-secondary mr-2">Edit</a>
                                        <button class="btn btn-danger" onClick="handleDelete({{ $user->id }})">ลบ
                                        </button>
                                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form action="{{route('user.destroy', $user->id)}}" method="POST"
                                                  id="deleteUserForm">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete
                                                                Category</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-cetner">
                                                                Are you sure you want to delete {{ $user->name }}
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
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="mx-auto">
                            {{$users->links()}}
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