@if(session()->has('error_import'))
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach (session()->get('error_import') as $key => $error)
                <li class="list-group-item" style="color:black;">
                    แถว {{$key}}
                    @foreach($error as $detail)
                        {{$detail}}
                    @endforeach
                </li>
            @endforeach
        </ul>
    </div>
@endif