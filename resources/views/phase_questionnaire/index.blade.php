@extends('layouts.app',['activePage' => 'questionnaire_mng', 'titlePage' => __('แบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการ</h4>
                </div>
                    <div class="card-body row">
                        @foreach($questionnaires as $questionnaire)
                            <div class="card my-1 col-md-6">
                                <h5 class="card-header">{{ $questionnaire->name }}</h5>
                                <div class="card-body">
                                    <h5 class="card-title">ชื่อวิชา : {{ $questionnaire->category->name }}</h5>
                                    <p>{{ $questionnaire->detail }}</p>
                                    <ul>
                                        <li class="">สถานะ :
                                            @if($questionnaire->count_public() > 0)
                                                ถูกต้องและเผยแพร่แล้ว {{$questionnaire->count_public()}} ด้าน
                                            @else
                                                ยังไม่ได้เผยแแพร่
                                            @endif</li>
                                    </ul>
                                    <div>
                                            <a href="{{ route('option_questionnaire.show', $questionnaire->id) }}"
                                                    class="btn btn-primary mt-1">สร้างตัวเลือก</a>

                                       <a href="{{ route('group_questionnaire.show', $questionnaire->id) }}"
                                                    class="btn btn-primary mt-1 @if($questionnaire->option_questionnaires->isEmpty())
                                                            disabled @endif ">สร้างกลุ่มและให้คะแนน</a>

                                       <a href="{{ route('phase_questionnaire.create', $questionnaire->id) }}"
                                                    class="btn btn-primary mt-1 @if($questionnaire->group_questionnaires->isEmpty())
                                                            disabled @endif ">สร้างด้าน</a>

                                       <a href="{{ route('phase_questionnaire.show', $questionnaire->id) }}"
                                           class="btn btn-primary mt-1 @if($questionnaire->phase_questionnaires->isEmpty())
                                                   disabled @endif ">สร้างคำถาม</a>

                                       <a href="{{ route('measurement_phase_questionnaire.show', $questionnaire->id) }}"
                                           class="btn btn-primary mt-1  @if($questionnaire->phase_questionnaires->isEmpty())
                                                   disabled @endif">สร้างเกณฑ์การให้คะแนน</a>
                                       <a href="{{ route('publish_questionnaire.show', $questionnaire->id) }}"
                                           class="btn btn-primary mt-1 @if($questionnaire->phase_questionnaires->isEmpty())
                                                   disabled @endif">ตรวจสอบความถูกต้องและเผยแพร่</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $questionnaires->links() }}
      
                </div>
            </div>
        </div>
@endsection
