@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quiz</div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quizzes as $quiz)
                                <tr>
                                    <th class="text-center">{{ $quiz->name }}</th>
                                    <td class="text-center">{{ $quiz->type_quiz }}</td>
                                    <th class="text-center">
                                        <a class="btn btn-secondary" href="{{ route('quiz.edit',$quiz->id) }}">Edit</a>
                                        <button class="btn btn-danger" onClick="handleDelete({{ $quiz->id }})">Delete
                                        </button>

                                        <div class="modal fade" id="deleteModal{{$quiz->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST"
                                                  id="deleteQuizForm">
                                                @method('delete')
                                                @csrf
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
                                                                Are you sure you want to delete {{ $quiz->name }}
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
                        {{ $quizzes->links() }}
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Create Quiz</div>
                        <div class="card-body">
                            <form action="{{ route('quiz.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Quiz Name" name="name"
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Quiz Detail" name="detail"
                                           value="{{ old('detail') }}" required>
                                </div>
                                <div class="form-group">
                                    <select name="type" class="form-control">
                                        <option value="0">Select Type</option>
                                        <option value="M">Matching</option>
                                        <option value="C">Choice</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="category_id" class="form-control">
                                        <option value="0">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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