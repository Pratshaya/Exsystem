@extends('layouts.app',['activePage' => 'category_q', 'titlePage' => __('แบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">ด้านของแบบสอบถาม
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped-column">
                        <thead>
                        <tr>
                            <th class="text-center">ชื่อด้าน</th>
                            <th class="text-center">จัดการตัวเลือก</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($phase_questionnaires as $phase)
                            <tr>
                                <th class="text-center">{{ $phase->name }}</th>
                                <th></th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(!$questionnaire->option_questionnaires->isEmpty())
                    <div class="text-center">
                        <a href="{{route('phase_questionnaire.show',$questionnaire->id)}}" class="btn btn-primary">ต่อไป</a>
                    </div>
                    @endif
                </div>
            </div>
            <hr>
            <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">สร้างด้าน
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true"><a class="fas fa-close" data-toggle="modal" data-target="#modal-close"></a></span>
                                        </button></h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('phase_questionnaire.store_phase',$questionnaire->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="ชื่อด้าน"
                                                   name="name" value="{{ old('name') }}" required>
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