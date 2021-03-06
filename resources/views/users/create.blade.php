@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add User') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('ชื่อ-นามสกุล') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('กรุณากรอกชื่อ-นามสกุล') }}" value="{{ old('name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('หมายเลขบัตรประจำตัวประชาชน') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('card') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('card') ? ' is-invalid' : '' }}" name="card" id="input-card" type="text" placeholder="{{ __('กรุณากรอกหมายเลขบัตรประชาชน 13 หลัก') }}" value="{{ old('card') }}" required="true" aria-required="true"/>
                      @if ($errors->has('card'))
                        <span id="name-error" class="error text-danger" for="input-card">{{ $errors->first('card') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('รหัสนักศึกษา') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('student_id') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('student_id') ? ' is-invalid' : '' }}" name="std_id" id="input-student_id" type="text" placeholder="{{ __('กรุณากรอกรหัสนักศึกษา') }}" value="{{ old('Student ID') }}" required="true" aria-required="true"/>
                      @if ($errors->has('student_id'))
                        <span id="name-error" class="error text-danger" for="input-student_id">{{ $errors->first('std_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('อีเมลล์') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('กรุณากรอกอีเมลล์ส่วนตัวด้วยข้อมูลจริง') }}" value="{{ old('email') }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <label for="role" class="col-sm-2 col-form-label">{{ __('ภาควิชา') }}</label>
                  <div class="col-md-6">
                    <select class="custom-select {{ $errors->has('department_id') ? 'is-invalid' : '' }}"
                            id="department_id" name="department_id">
                      <option selected value="0">คลิ้กเพื่อเลือก...</option>
                      @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('department_id'))
                      <div class="invalid-feedback">
                        <strong>{{$errors->first('department_id')}}</strong>
                      </div>
                    @endif
                  </div>
                </div>
                <br>
                <div class="row">
                  <label for="role" class="col-sm-2 col-form-label">{{ __('สาขาวิชา') }}</label>
                  <div class="col-md-6">
                    <select class="custom-select {{ $errors->has('branch_id') ? 'is-invalid' : '' }}"
                            id="branch_id" name="branch_id">
                      <option selected value="0">คลิ้กเพื่อเลือก...</option>
                      @foreach($branches as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('branch_id'))
                      <div class="invalid-feedback">
                        <strong>{{$errors->first('branch_id')}}</strong>
                      </div>
                    @endif
                  </div>
                </div>
                <br>
                <div class="row">
                  <label for="role" class="col-sm-2 col-form-label">{{ __('ห้อง') }}</label>
                  <div class="col-md-6">
                    <select class="custom-select {{ $errors->has('room_id') ? 'is-invalid' : '' }}"
                            id="room_id" name="room_id">
                      <option selected value="0">คลิ้กเพื่อเลือก...</option>
                      @foreach($rooms as $room)
                        <option value="{{$room->id}}">{{$room->name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('room_id'))
                      <div class="invalid-feedback">
                        <strong>{{$errors->first('room_id')}}</strong>
                      </div>
                    @endif
                  </div>
                </div>
                <br>
                <div class="row">
                  <label for="role" class="col-md-2 col-form-label">{{ __('ระดับผู้ใช้งาน') }}</label>
                  <div class="col-md-6">
                    <select class="custom-select {{ $errors->has('role_id') ? 'is-invalid' : '' }}"
                            id="input-role" name="role_id">
                      <option selected value="0">คลิ้กเพื่อเลือก...</option>
                      @foreach($roles as $role)
                        @if($role->name != 'superadministrator')
                          <option value="{{$role->id}}">{{$role->display_name}}</option>
                        @endif
                      @endforeach
                    </select>
                    @if ($errors->has('role_id'))
                      <div class="invalid-feedback">
                        <strong>{{$errors->first('role_id')}}</strong>
                      </div>
                    @endif
                  </div>
                </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('ยืนยันการสร้างผู้ใช้งาน') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#department_id').on('change', function (e) {
      const department_id = $(this).find('option:selected').val();
      const room_selected = $('#room_id').empty();
      $.get('department/' + department_id + '/rooms', function (data) {
        $.each(data, function (i, item) {
          room_selected.append($('<option>', {
            value: item.id,
            text: item.name
          }));
        });
      });
    });
  </script>
@endsection