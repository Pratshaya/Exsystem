@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-item-center">
                            POST
                            <div class="ml-auto">
                                <a href="{{route('post.create')}}" class="btn  btn-sm btn-outline-secondary">Create
                                    Post</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped border">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        <a href="{{route('student.post',$post->id)}}"
                                           class="btn btn-primary mr-2">Link</a>
                                        <a href="{{route('post.edit',$post->id)}}"
                                           class="btn btn-secondary mr-2">Edit</a>

                                        <button class="btn btn-danger" onClick="handleDelete({{ $post->id }})">Delete
                                        </button>
                                        <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form action="{{route('post.destroy', $post->id)}}" method="POST"
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
                                                                Are you sure you want to delete {{ $post->title }}
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
                            {{$posts->links()}}
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