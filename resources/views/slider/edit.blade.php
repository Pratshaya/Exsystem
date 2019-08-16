@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Slider</div>
                    <div class="card-body">
                        <form action="{{ route('slider.update',$slider->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Slider name" name="title"
                                       value="{{ isset($slider) ? $slider->title : '' }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Slider detail" name="detail"
                                       value="{{ isset($slider) ? $slider->detail : '' }}">
                            </div>
                            @if (isset($slider))
                                <img src="{{asset('/storage/'.$slider->image)}}" alt="" srcset="" style="width:100%">
                            @endif
                            <div class="form-group">
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="0">Select Status</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                    @if(isset($slider))
                                                    @if($status->id == $slider->status_id)
                                                    selected
                                                    @endif
                                                    @endif>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
