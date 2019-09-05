@extends('layouts.app',['activePage' => 'quiz_q', 'titlePage' => __('ผลสอบของนักเรียน')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('คะแนนสอบของนักเรียน') }}</h4>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped border text-center">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <a class="btn btn-primary" href=" {{ route('result.result_show', $user->id)}} ">Result</a>
                                        <a class="btn btn-primary" href="{{ route('result.chart', $user->id) }}">Chart</a>
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
            var form = document.getElementById('deleteUserForm');
            $('#deleteModal' + id).modal('show');
        }
    </script>
@endsection