@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a
                                href="{{route('phase_questionnaire.index')}}">{{$questionnaire->name }} </a> /
                        create measurement <span class="float-right"></div>
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
                            @foreach($questionnaire->phase_questionnaires as $phase_questionnaires)
                                <table id="example" class="table table-bordered table-striped-column">
                                    <thead>
                                    <tr>
                                        <th colspan="4" class="text-center">{{$phase_questionnaires->name}}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Score Min</th>
                                        <th class="text-center">Score Max</th>
                                        <th class="text-center">WHAT</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($phase_questionnaires->measurements_phase_questionnaire as $measurement)
                                        <tr>
                                            <td class="text-center">{{ $measurement->score_min }}</td>
                                            <td class="text-center">{{ $measurement->score_max }}</td>
                                            <td class="text-center">{{ $measurement->result }}</td>
                                            <td class="text-center" style="width: 150px;">
                                                <a class="btn btn-info"
                                                   href="{{route('measurement_phase_questionnaire.edit',$measurement->id)}}">Edit
                                                </a>
                                                <form action="{{route('measurement_phase_questionnaire.destroy', $measurement->id)}}"
                                                      method="POST"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-info btn-delete">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Not Found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>

                                </table>
                            @endforeach
                        @endif
                    </div>
                </div>
                <hr>
                @if(!$questionnaire->phase_questionnaires->isEmpty())

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Create Measurement</div>
                            <div class="card-body">
                                <form action="{{ route('measurement_phase_questionnaire.store') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <select name="phase_questionnaire_id" class="form-control">
                                            <option value="0">Select Category</option>
                                            @foreach($questionnaire->phase_questionnaires as $phase_questionnaires)
                                                <option value="{{ $phase_questionnaires->id }}">{{ $phase_questionnaires->name }}</option>
                                            @endforeach
                                        </select>

                                        <input type="number" class="form-control text-center" placeholder="Score Min"
                                               name="score_min"
                                               value="{{ old('score_min') }}" required>
                                        <input type="number" class="form-control text-center" placeholder="Score Max"
                                               name="score_max"
                                               value="{{ old('score_max') }}" required>
                                        <label for="">&nbsp;&nbsp; = &nbsp;&nbsp;</label>
                                        <input type="text" class="form-control text-center" placeholder="What ?"
                                               name="result"
                                               value="{{ old('result') }}" required>
                                    </div>
                                    <br>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary">Create</button>
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