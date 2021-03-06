@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('ผู้ใช้งาน')])

@section('content')
    <div class="content">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>User successfully deleted.
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('รายการผู้ใช้งาน') }}</h4>
                            <p class="card-category"> {{ __('ผู้ใช้ที่มีอยู่ในระบบทั้งหมด') }}</p>
                                    <a href="{{ route('user.create') }}"
                                       class="btn btn-sm btn-success">{{ __('เพิ่มผู้ใช้') }}</a>
                                    <a href="{{ route('user.import') }}"
                                       class="btn btn-sm btn-success">{{ __('นำเข้า') }}</a>


                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif


                                <div class="table-responsive dataTables_wrapper">

                                    <table class="display dataTable" id="example">

                                        <thead class=" text-primary">
                                        <th>{{ __('ชื่อ') }}</th>
                                        <th>{{ __('อีเมลล์') }}</th>
                                        <th>{{ __('วิทยาเขต') }}</th>
                                        <th>{{ __('คณะ') }}</th>
                                        <th>{{ __('ภาควิชา') }}</th>
                                        <th>{{ __('สาขาวิชา') }}</th>
                                        <th>{{ __('ข้อมูลการสอบ') }}</th>
                                        <th>{{ __('ห้อง') }}</th>
{{--                                        <th>{{ __('วันที่สร้าง') }}</th>--}}
                                        <th class="text-right">{{ __('จัดการผู้ใช้') }}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->departments->faculties->campuses->name }}</td>
                                                <td>{{ $user->departments->faculties->name }}</td>
                                                <td>{{ $user->departments->name  }}</td>
                                                <td>{{ $user->branches->name  }}</td>
                                                <td>
                                                    @if($user->hasRole('user'))
                                                        <a class="btn btn-primary" href=" {{ route('result.result_show', $user->id)}} ">สถานะการสอบ</a>
                                                        <a class="btn btn-primary" href="{{ route('result.chart', $user->id) }}">ดูแผนภูมิ</a>
                                                    @else
                                                        ผู้ใช้ไม่มีการสอบ
                                                    @endif
                                                </td>
                                                <td>{{ $user->rooms->name  }}</td>
{{--                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>--}}
                                                <td class="td-actions text-right">
                                                    @if ($user->id != auth()->id())
                                                        <form action="{{ route('user.destroy', $user) }}" method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <a rel="tooltip" class="btn btn-success btn-link"
                                                               href="{{ route('user.edit', $user) }}"
                                                               data-original-title=""
                                                               title="">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-link"
                                                                    data-original-title="" title=""
                                                                    onclick="confirm('{{ __("คุณต้องการลบผู้ใช้นี้?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">delete</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                           href="{{ route('profile.edit') }}" data-original-title=""
                                                           title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready(function() {
            $('.dataTable').DataTable();
        } );
    </script>
    @endsection