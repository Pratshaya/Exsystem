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
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Card') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('card') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('card') ? ' is-invalid' : '' }}" name="card" id="input-card" type="text" placeholder="{{ __('Card') }}" value="{{ old('card') }}" required="true" aria-required="true"/>
                      @if ($errors->has('card'))
                        <span id="name-error" class="error text-danger" for="input-card">{{ $errors->first('card') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Student ID') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('student_id') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('student_id') ? ' is-invalid' : '' }}" name="student_id" id="input-student_id" type="text" placeholder="{{ __('Student ID') }}" value="{{ old('Student ID') }}" required="true" aria-required="true"/>
                      @if ($errors->has('student_id'))
                        <span id="name-error" class="error text-danger" for="input-student_id">{{ $errors->first('student_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label for="role" class="col-sm-2 col-form-label">{{ __('Room') }}</label>
                  <div class="col-md-6">
                    <select class="custom-select {{ $errors->has('room_id') ? 'is-invalid' : '' }}"
                            id="input-role" name="room_id">
                      <option selected value="0">Choose...</option>
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
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Add User') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection