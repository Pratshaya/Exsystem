@extends('layouts.app',['activePage' => 'questionnaire_mng', 'titlePage' => __('แบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">เกณฑ์การให้คะแนน
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span></h4>
                </div>
                    <div class="card-header"><a
                                href="{{route('phase_questionnaire.index')}}">{{$questionnaire->name }} </a> /
                        เกณฑ์การให้คะแนน
                    </div>
                    <div class="card-body">

                        @if($questionnaire->phase_questionnaires->isEmpty())
                            <table id="example" class="table table-bordered table-striped-column">
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Not Found
                                        <br>
                                        You must to Create Phase & Option & Question
                                        <hr>
                                        <a class="buttons btn btn-info"
                                           href="{{route('phase_questionnaire.show',$questionnaire->id)}}">Create</a>
                                    </td>
                                </tr>
                            </table>
                        @else
                            @if($questionnaire->type =='SP' || $questionnaire->type == "S")
                                <table id="example" class="table table-bordered table-striped-column">
                                    <thead>
                                    <tr>
                                        <th colspan="4" class="text-center">คะแนนรวม</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">คะแนนน้อยสุดในช่วง</th>
                                        <th class="text-center">คะแนนมากสุดในช่วง</th>
                                        <th class="text-center">เกณฑ์ที่ได้รับ</th>
                                        <th class="text-center">จัดการเกณฑ์</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($questionnaire->measurements_questionnaire as $measurement)
                                        <tr>
                                            <td class="text-center">{{ $measurement->score_min }}</td>
                                            <td class="text-center">{{ $measurement->score_max }}</td>
                                            <td class="text-center">{{ $measurement->result }}</td>
                                            <td class="text-center" style="width: 150px;">
                                                <a class="btn btn-success btn-link"
                                                   href="{{route('measurement_questionnaire.edit',$measurement->id)}}">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form action="{{route('measurement_questionnaire.destroy', $measurement->id)}}"
                                                      method="POST"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-link">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">ไม่พบเกณฑ์</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <hr>
                            @endif
                            @if($questionnaire->type =='SP' || $questionnaire->type == 'P')
                                @foreach($questionnaire->phase_questionnaires as $phase_questionnaires)
                                    <table id="example" class="table table-bordered table-striped-column">
                                        <thead>
                                        <tr>
                                            <th colspan="4" class="text-center">{{$phase_questionnaires->name}}</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">คะแนนน้อยสุดในช่วง</th>
                                            <th class="text-center">คะแนนมากสุดในช่วง</th>
                                            <th class="text-center">เกณฑ์ที่ได้รับ</th>
                                            <th class="text-center">จัดการเกณฑ์</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @forelse($phase_questionnaires->measurements_phase_questionnaire as $measurement)
                                            <tr>
                                                <td class="text-center">{{ $measurement->score_min }}</td>
                                                <td class="text-center">{{ $measurement->score_max }}</td>
                                                <td class="text-center">{{ $measurement->result }}</td>
                                                <td class="text-center" style="width: 150px;">
                                                    <a class="btn btn-success btn-link"
                                                       href="{{route('measurement_phase_questionnaire.edit',$measurement->id)}}">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <form action="{{route('measurement_phase_questionnaire.destroy', $measurement->id)}}"
                                                          method="POST"
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-info btn-link"><i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">ไม่พบเกณฑ์</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                @endforeach
                            @endif
                                <div class="text-center" >
                                    <a href="{{route('phase_questionnaire.show',$questionnaire)}}" class="btn btn-primary">กลับ</a>
                                        <a href="{{route('publish_questionnaire.show',$questionnaire)}}" class="btn btn-primary">ต่อไป</a>
                                </div>
                        @endif
                    </div>
                </div>
                <hr>
                @if(!$questionnaire->phase_questionnaires->isEmpty())
                <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">สร้างกลุ่มวิชา <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span  aria-hidden="true"><a class="fas fa-close" data-toggle="modal" data-target="#modal-close"></a></span>
                                            </button></h4>
                                    </div>
                            <div class="card-body">
                                <form action="{{ route('measurement_phase_questionnaire.store',$questionnaire->id) }}"
                                      method="POST">
                                    @csrf
                                    <div class="input-group">
                                        @if($questionnaire->type=='P')
                                            <select name="phase_questionnaire_id" class="form-control">
                                                <option value="0">กรุณาเลือกด้านของแบบสอบถามที่ต้องการประเมิน</option>
                                                @foreach($questionnaire->phase_questionnaires as $phase_questionnaires)
                                                    <option value="{{ $phase_questionnaires->id }}">{{ $phase_questionnaires->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if($questionnaire->type=='SP')
                                            <select name="phase_questionnaire_id" class="form-control">
                                                <option value="-1">กรุณาเลือกด้านของแบบสอบถามที่ต้องการประเมิน</option>
                                                <option value="0">ผลรวม</option>
                                                @foreach($questionnaire->phase_questionnaires as $phase_questionnaires)
                                                    <option value="{{ $phase_questionnaires->id }}">{{ $phase_questionnaires->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <input type="number" class="form-control text-center" placeholder="ระบุคะแนนที่น้อยที่สุดในช่วง"
                                               name="score_min"
                                               value="{{ old('score_min') }}" required>
                                        <input type="number" class="form-control text-center" placeholder="ระบุคะแนนที่มากที่สุดในช่วง"
                                               name="score_max"
                                               value="{{ old('score_max') }}" required>
                                        <label for="">&nbsp;&nbsp; = &nbsp;&nbsp;</label>
                                        <input type="text" class="form-control text-center" placeholder="ระบุเกณฑ์แปลผลของช่วงคะแนนดังกล่าว"
                                               name="result"
                                               value="{{ old('result') }}" required>
                                    </div>
                                    <br>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary">สร้างเกณฑ์</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        <!-- DELETE-->
        $('.btn-delete').on('click', function (e) {
            e.preventDefault();
            const form = $(this).parents('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });

        });
    </script>

@endsection