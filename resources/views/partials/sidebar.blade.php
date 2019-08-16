<div class="col-md-4 col-xl-3" >
    <div class="sidebar px-4 ">
        <h4 class="sidebar-title mt-2">Categories Quiz</h4>
        <hr>
        <ul>
            <div>
                @foreach ($categories as $category)
                    <a href="{{ route('student.index_category', $category->id) }}">{{$category->name}}</a> <br>
                @endforeach
            </div>
        </ul>
        <hr>
        <h4 class="sidebar-title">Result</h4>
        <hr>
        <ul>
            <div>
                <a href="{{ route('student.result_all')}}">Score Quiz</a> <br>
                <a href="{{ route('student.result_all_questionnaire')}}">Score Questionnaire</a> <br>
            </div>
        </ul>
    </div>
</div>
